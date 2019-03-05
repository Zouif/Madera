<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DevisController;
use App\Devis;
use App\Produit;
use App\ProduitDevis;
use App\ModuleProduit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listeproduits = DB::table('produit')->join('produit_devis', 'produit.id_produit', '=', 'produit_devis.id_produit')
            ->Where('produit_devis.id_devis', '=', session()->get('id_devis'));
        $listeproduits = $listeproduits->get();

//        foreach($listeproduits as $produit){
//            $produitdevis = DB::table('produit_devis')->where('id_produit', '=', $produit->id_produit);
//            $produitdevis = $produitdevis->get();
//
//            dd($produit);
//            $produit->setAttribute('quantite_produit',$produitdevis->quantite_produit);
//        }

        return view('produits.index', ['listeproduits' => $listeproduits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//
//        $devis = new devis([
//            'id_etat_devis'=> 1,
//            'id_entreprise'=> 1,
//            'id_projet'=> session()->get('id_projet'),
//            'id_tva'=> 1,
//            'date_devis'=> Carbon::now()->toDateString(),
//            'duree_validite_devis'=> 90,
//            'taux_horaire_main_oeuvre'=> 0,
//            'montant_frais_deplacement'=> 0,
//            'prix_prestation'=> 0,
//            'modalite_decompte_passe'=> 0,
//            'taux_tva'=> 0,
//            'montant_tva'=> 0,
//            'prix_total_ht'=> 0,
//            'ref_devis'=> str_random(10)
//        ]);
//        $devis->save();

        session()->put('prix_produit_ht',

            ProduitController::calculPrixProduit()

            );


        return view('produits.create');
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
        return view('devis.index', ['devis' => $deviss]);
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
            'nom_produit'=>'required',
            'quantite_produit'=>'required',
            'prix_produit_ht'=>'required',
            'nom_couverture'=>'required',
            'nom_cctp'=>'required',
            'nom_coupe_principe'=>'required',
            'nom_gamme'=>'required',
            'nom_module'=>'required'

        ]);


        $produit = new produit([
            'nom_produit'=> $request->nom_produit,
            'taux_tva'=> 0,
            'prix_produit_ht'=> $request->prix_produit_ht,
            'id_couverture'=> session()->get('couverture.id_couverture'),
            'id_cctp'=> session()->get('cctp.id_cctp'),
            'id_gamme'=> session()->get('gamme.id_gamme'),
            'id_coupe_principe'=> session()->get('coupeprincipe.id_coupe_principe')
        ]);
        $produit->save();
//        $produit->fresh();

        foreach(session()->get('modules') as $module){

            $moduleproduit = new moduleproduit([
                'id_module'=> $module->id_module,
                'id_produit'=> $produit->id_produit
            ]);
            $moduleproduit->save();
        }

        // produit devis
        $produitdevis = new produitdevis([
            'id_devis'=> session()->get('id_devis'),
            'id_produit'=> $produit->id_produit,
            'quantite_produit'=> $request->quantite_produit
        ]);
        $produitdevis->save();

        $devis = devis::find(session()->get('id_devis'));


        $listeproduits = DB::table('produit')->join('produit_devis', 'produit.id_produit', '=', 'produit_devis.id_produit')
            ->Where('produit_devis.id_devis', '=', session()->get('id_devis'));
        $listeproduits = $listeproduits->get();

        $devisController = new DevisController();
        $devis->prix_total_ht = $devisController->calculPrixTotalHt($devis->montant_frais_deplacement, $devis->prix_prestation, $listeproduits);
        $devis->montant_tva = $devisController->calculMontantTva($devis->prix_total_ht, $devis->taux_tva);
        $devis->save();

        session()->pull('couverture');
        session()->pull('cctp');
        session()->pull('coupeprincipe');
        session()->pull('gamme');
        session()->pull('modules');

        return redirect('/produits')->with('success', 'Un devis a été rajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_devis
     * @return \Illuminate\Http\Response
     */
    public function show($id_devis)
    {
        session()->put('id_devis', $id_devis);
        return redirect('/produits');
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

        return view('deviss.edit', compact('devis'));
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
            'nom_devis'=>'required',
            'date_devis'=>'required'
        ]);

        $devis = devis::find($id_devis);
        $devis->nom_devis = $request->get('nom_devis');
        $devis->date_devis = $request->get('date_devis');
        $devis->save();

        return redirect('/deviss')->with('success', 'Le devis a été mis a jour');
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
        $devis->delete();

        return redirect('/deviss')->with('success', 'Un devis a été supprimé');
    }

    public function deleteModule(Request $request)
    {
        session()->pull('modules.' . $request->key_module);
        return redirect('/devis/create');

    }

    private function calculPrixProduit(){

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
