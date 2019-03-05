<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Couverture;
use Illuminate\Support\Facades\DB;

class CouvertureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couvertures = couverture::all();

        return view('couvertures.index', compact('couvertures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('couvertures.create');
    }


    public function search(Request $request){
        $search = $request->get('search');
        //$couvertures = couverture::all();
        $couvertures = DB::table('couverture')->where('nom_couverture', 'like' , '%' . $search . '%')
            ->orWhere('prix_couverture', 'like' , '%' . $search . '%');
        $couvertures = $couvertures->get();
        return view('couvertures.index', ['couvertures' => $couvertures]);
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
            'nom_couverture'=>'required',
            'prenom_couverture'=>'required',
            'adresse_couverture'=>'required',
            'nom_collectivite'=>'required',
            'telephone_couverture'=>'required',
            'mail_couverture'=>'required'
        ]);
        $couverture = new couverture([
            'nom_couverture' => $request->get('nom_couverture'),
            'prenom_couverture'=> $request->get('prenom_couverture'),
            'adresse_couverture'=> $request->get('adresse_couverture'),
            'nom_collectivite' => $request->get('nom_collectivite'),
            'telephone_couverture'=> $request->get('telephone_couverture'),
            'mail_couverture'=> $request->get('mail_couverture'),
            'ref_couverture'=> str_random(5)
        ]);
        $couverture->save();
        return redirect('/couvertures')->with('success', 'Un couverture a été rajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_couverture
     * @return \Illuminate\Http\Response
     */
    public function show($id_couverture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_couverture
     * @return \Illuminate\Http\Response
     */
    public function edit($id_couverture)
    {

        $couverture = couverture::find($id_couverture);

        return view('couvertures.edit', compact('couverture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_couverture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_couverture)
    {
        $request->validate([
            'nom_couverture'=>'required',
            'prenom_couverture'=>'required',
            'adresse_couverture'=>'required',
            'nom_collectivite'=>'required',
            'telephone_couverture'=>'required',
            'mail_couverture'=>'required'
        ]);

        $couverture = couverture::find($id_couverture);
        $couverture->nom_couverture = $request->get('nom_couverture');
        $couverture->prenom_couverture = $request->get('prenom_couverture');
        $couverture->adresse_couverture = $request->get('adresse_couverture');
        $couverture->nom_collectivite = $request->get('nom_collectivite');
        $couverture->telephone_couverture = $request->get('telephone_couverture');
        $couverture->mail_couverture = $request->get('mail_couverture');
        $couverture->save();

        return redirect('/couvertures')->with('success', 'Le couverture a été mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_couverture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_couverture)
    {
        $couverture = couverture::find($id_couverture);
        $couverture->delete();

        return redirect('/couvertures')->with('success', 'Un couverture a été supprimé');
    }

    public function sendToDevis(Request $request)
    {
        $couverture = couverture::find($request->id_couverture);
        session()->put('couverture', $couverture);
        return redirect('/produits/create');

    }
}
