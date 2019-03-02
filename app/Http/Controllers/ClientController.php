<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = client::all();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }


    public function search(Request $request){
        $search = $request->get('search');
        //$clients = client::all();
        $clients = DB::table('client')->where('nom_client', 'like' , '%' . $search . '%')
                                            ->orWhere('prenom_client', 'like' , '%' . $search . '%')
                                            ->orWhere('adresse_client', 'like' , '%' . $search . '%')
                                            ->orWhere('nom_collectivite', 'like' , '%' . $search . '%')
                                            ->orWhere('telephone_client', 'like' , '%' . $search . '%')
                                            ->orWhere('mail_client', 'like' , '%' . $search . '%')
                                            ->orWhere('ref_client', 'like' , '%' . $search . '%');
        $clients = $clients->get();
        return view('clients.index', ['clients' => $clients]);
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
            'nom_client'=>'required',
            'prenom_client'=>'required',
            'adresse_client'=>'required',
            'nom_collectivite'=>'required',
            'telephone_client'=>'required',
            'mail_client'=>'required'
        ]);
        $client = new client([
            'nom_client' => $request->get('nom_client'),
            'prenom_client'=> $request->get('prenom_client'),
            'adresse_client'=> $request->get('adresse_client'),
            'nom_collectivite' => $request->get('nom_collectivite'),
            'telephone_client'=> $request->get('telephone_client'),
            'mail_client'=> $request->get('mail_client'),
            'ref_client'=> str_random(5)
        ]);
        $client->save();
        return redirect('/clients')->with('success', 'Un client a été rajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_client
     * @return \Illuminate\Http\Response
     */
    public function show($id_client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_client
     * @return \Illuminate\Http\Response
     */
    public function edit($id_client)
    {

        $client = client::find($id_client);

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_client)
    {
        $request->validate([
            'nom_client'=>'required',
            'prenom_client'=>'required',
            'adresse_client'=>'required',
            'nom_collectivite'=>'required',
            'telephone_client'=>'required',
            'mail_client'=>'required'
        ]);

        $client = client::find($id_client);
        $client->nom_client = $request->get('nom_client');
        $client->prenom_client = $request->get('prenom_client');
        $client->adresse_client = $request->get('adresse_client');
        $client->nom_collectivite = $request->get('nom_collectivite');
        $client->telephone_client = $request->get('telephone_client');
        $client->mail_client = $request->get('mail_client');
        $client->save();

        return redirect('/clients')->with('success', 'Le client a été mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_client)
    {
        $client = client::find($id_client);
        $client->delete();

        return redirect('/clients')->with('success', 'Un client a été supprimé');
    }
}
