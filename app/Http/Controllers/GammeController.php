<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gamme;
use Illuminate\Support\Facades\DB;

class GammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gammes = gamme::all();

        return view('gammes.index', compact('gammes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gammes.create');
    }


    public function search(Request $request){
        $search = $request->get('search');
        //$gammes = gamme::all();
        $gammes = DB::table('gamme')->where('nom_gamme', 'like' , '%' . $search . '%')
            ->orWhere('finition_gamme', 'like' , '%' . $search . '%')
            ->orWhere('huisseries_gamme', 'like' , '%' . $search . '%')
            ->orWhere('isolant_gamme', 'like' , '%' . $search . '%')
            ->orWhere('prix_gamme', 'like' , '%' . $search . '%');
        $gammes = $gammes->get();
        return view('gammes.index', ['gammes' => $gammes]);
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
            'nom_gamme'=>'required',
            'prenom_gamme'=>'required',
            'adresse_gamme'=>'required',
            'nom_collectivite'=>'required',
            'telephone_gamme'=>'required',
            'mail_gamme'=>'required'
        ]);
        $gamme = new gamme([
            'nom_gamme' => $request->get('nom_gamme'),
            'prenom_gamme'=> $request->get('prenom_gamme'),
            'adresse_gamme'=> $request->get('adresse_gamme'),
            'nom_collectivite' => $request->get('nom_collectivite'),
            'telephone_gamme'=> $request->get('telephone_gamme'),
            'mail_gamme'=> $request->get('mail_gamme'),
            'ref_gamme'=> str_random(5)
        ]);
        $gamme->save();
        return redirect('/gammes')->with('success', 'Un gamme a été rajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_gamme
     * @return \Illuminate\Http\Response
     */
    public function show($id_gamme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_gamme
     * @return \Illuminate\Http\Response
     */
    public function edit($id_gamme)
    {

        $gamme = gamme::find($id_gamme);

        return view('gammes.edit', compact('gamme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_gamme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_gamme)
    {
        $request->validate([
            'nom_gamme'=>'required',
            'prenom_gamme'=>'required',
            'adresse_gamme'=>'required',
            'nom_collectivite'=>'required',
            'telephone_gamme'=>'required',
            'mail_gamme'=>'required'
        ]);

        $gamme = gamme::find($id_gamme);
        $gamme->nom_gamme = $request->get('nom_gamme');
        $gamme->prenom_gamme = $request->get('prenom_gamme');
        $gamme->adresse_gamme = $request->get('adresse_gamme');
        $gamme->nom_collectivite = $request->get('nom_collectivite');
        $gamme->telephone_gamme = $request->get('telephone_gamme');
        $gamme->mail_gamme = $request->get('mail_gamme');
        $gamme->save();

        return redirect('/gammes')->with('success', 'Le gamme a été mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_gamme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_gamme)
    {
        $gamme = gamme::find($id_gamme);
        $gamme->delete();

        return redirect('/gammes')->with('success', 'Un gamme a été supprimé');
    }

    public function sendToDevis(Request $request)
    {
        $gamme = gamme::find($request->id_gamme);
        session()->put('gamme', $gamme);
        return redirect('/devis/create');

    }
}
