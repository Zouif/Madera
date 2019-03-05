<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devis;
use App\Module;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\couverture;
use App\cctp;
use App\Coupeprincipe;
use App\gamme;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listedevis = devis::all()->Where('id_projet', '=', session()->get('id_projet'))
            ->Where('archive', '=', false);

        return view('devis.index', ['listedevis' => $listedevis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->put('prix_produit_ht',

            DevisController::calculPrixProduitFaux()

            );


        return view('devis.create');
    }


    public function search(Request $request)
    {
        $search = $request->get('search');
        //$deviss = devis::all();
        $deviss = DB::table('devis')->where('id_devis', 'like', '%' . $search . '%')
            ->orWhere('id_client', 'like', '%' . $search . '%')
            ->orWhere('id_user', 'like', '%' . $search . '%')
            ->orWhere('nom_devis', 'like', '%' . $search . '%')
            ->orWhere('date_devis', 'like', '%' . $search . '%')
            ->orWhere('ref_devis', 'like', '%' . $search . '%');
        $deviss = $deviss->get();
        return view('deviss.index', ['deviss' => $deviss]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'duree_validite_devis'=>'required',
            'taux_horaire_main_oeuvre'=>'required',
            'montant_frais_deplacement'=>'required',
            'prix_prestation'=>'required',
            'taux_tva'=>'required'
        ]);

        $devis = new devis([
            'id_etat_devis'=> 1,
            'id_entreprise'=> 1,
            'id_projet'=> session()->get('id_projet'),
            'id_tva'=> 1,
            'date_devis'=> Carbon::now()->toDateTimeString(),
            'duree_validite_devis'=> $request->duree_validite_devis,
            'taux_horaire_main_oeuvre'=>$request->taux_horaire_main_oeuvre,
            'montant_frais_deplacement'=>$request->montant_frais_deplacement,
            'prix_prestation'=>$request->prix_prestation,
            'modalite_decompte_passe'=>20,
            'taux_tva'=>$request->taux_tva,
            'montant_tva'=>$request->taux_tva/100 * ($request->prix_prestation+$request->montant_frais_deplacement),
            'prix_total_ht'=>$request->prix_prestation+$request->montant_frais_deplacement,
            'ref_devis'=> str_random(10)
        ]);
        $devis->save();
        return redirect('/devis')->with('success', 'Un devis a été rajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_devis
     * @return \Illuminate\Http\Response
     */
    public function show($id_projet)
    {
        session()->put('id_projet', $id_projet);
        return redirect('/devis');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_devis
     * @return \Illuminate\Http\Response
     */
    public function edit($id_devis)
    {
        $devis = devis::find($id_devis);

        return view('devis.edit', compact('devis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_devis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_devis)
    {
        $request->validate([
            'duree_validite_devis'=>'required',
            'taux_horaire_main_oeuvre'=>'required',
            'montant_frais_deplacement'=>'required',
            'prix_prestation'=>'required',
            'taux_tva'=>'required'
        ]);

        $devis = devis::find($id_devis);

        $listeproduits = DB::table('produit')->join('produit_devis', 'produit.id_produit', '=', 'produit_devis.id_produit')
            ->Where('produit_devis.id_devis', '=', $id_devis);
        $listeproduits = $listeproduits->get();

        $devis->duree_validite_devis = $request->get('duree_validite_devis');
        $devis->taux_horaire_main_oeuvre = $request->get('taux_horaire_main_oeuvre');
        $devis->montant_frais_deplacement = $request->get('montant_frais_deplacement');
        $devis->prix_prestation = $request->get('prix_prestation');
        $devis->taux_tva = $request->get('taux_tva');
        $devis->prix_total_ht = DevisController::calculPrixTotalHt($devis->montant_frais_deplacement, $devis->prix_prestation, $listeproduits);
        $devis->montant_tva = DevisController::calculMontantTva($devis->prix_total_ht, $devis->taux_tva);
        $devis->save();

        return redirect('/devis')->with('success', 'Le devis a été mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_devis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_devis)
    {
        $devis = devis::find($id_devis);
        $devis->archive = true;
        $devis->save();

        return redirect('/devis')->with('success', 'Un devis a été supprimé');
    }

    public function deleteModule(Request $request)
    {
        session()->pull('modules.' . $request->key_module);
        return redirect('/devis/create');

    }

    public function calculMontantTva($prix_total_ht, $taux_tva){
        return $prix_total_ht * $taux_tva/100;
    }

    public function calculPrixTotalHt($montant_frais_deplacement, $prix_prestation, $listeproduits){
        return $montant_frais_deplacement + $prix_prestation + DevisController::calculPrixProduits($listeproduits);
    }

    public function calculPrixProduits($listeproduits){

        $prix_total = 0;
        foreach($listeproduits as $produit){
            $prix_total += (DevisCOntroller::calculPrixProduit($produit)*$produit->quantite_produit);
        }
        return $prix_total;
    }

    public function calculPrixProduit($produit){

        $prix = 0;

        $couverture = couverture::find($produit->id_couverture);
        $prix += $couverture->prix_couverture;
        $cctp = cctp::find($produit->id_cctp);
        $prix += $cctp->prix_cctp;
        $coupeprincipe = coupeprincipe::find($produit->id_coupe_principe);
        $prix += $coupeprincipe->prix_coupe_principe;
        $gamme = gamme::find($produit->id_gamme);
        $prix += $gamme->prix_gamme;

        $moduleproduit = DB::table('module_produit')->where('id_produit', '=', $produit->id_produit);
        $moduleproduit = $moduleproduit->get();

        foreach($moduleproduit as $module){
            $module = module::find($module->id_module);
            $prix += $module->prix_module;
        }

        return $prix;
    }


    public function calculPrixProduitFaux(){

        $prix = 0;



        if(session()->has('couverture')){
            $prix += session()->get('couverture.prix_couverture');
        }
        if(session()->has('cctp')){
            $prix += session()->get('cctp.prix_cctp');
        }
        if(session()->has('coupeprincipe')){
            $prix += session()->get('coupeprincipe.prix_coupe_principe');
        }
        if(session()->has('gamme')){
            $prix += session()->get('gamme.prix_gamme');
        }
        if(session()->has('modules')){
            foreach(session()->get('modules') as $module){
                $prix += $module->prix_module;
            }
        }

        return $prix;
    }
}
