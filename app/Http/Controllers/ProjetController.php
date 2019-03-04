<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use Illuminate\Support\Facades\DB;
use App\Client;
use Carbon\Carbon;
use App\Dao\ProjetDao;

class ProjetController extends Controller
{
    public $projetDao;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projetDao = new ProjetDao();
        $projets = $projetDao->selectProjetAndRefClientByIdUser(auth()->id());

        return view('projets.index', compact('projets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$id = $request->get('id');

        return view('projets.create');
    }


    public function search(Request $request)
    {
        //dd($request->all());

        $search = $request->get('search');

        $projets = DB::table('projet')->join('client', 'client.id_client', '=', 'projet.id_client')
            ->Where(
                [
                    ['id_user', '=', auth()->id()],
                    ['id_projet', 'like', '%' . $search . '%'],
                    ['client.archive', '=', false]
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['ref_client', 'like', '%' . $search . '%'],
                    ['client.archive', '=', false]
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['id_user', 'like', '%' . $search . '%'],
                    ['client.archive', '=', false]
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['nom_projet', 'like', '%' . $search . '%'],
                    ['client.archive', '=', false]
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['date_projet', 'like', '%' . $search . '%'],
                    ['client.archive', '=', false]
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['ref_projet', 'like', '%' . $search . '%'],
                    ['client.archive', '=', false]
                ]);
        $projets = $projets->get();
        return view('projets.index', ['projets' => $projets]);
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
            'ref_client'=>'required',
            'nom_projet'=>'required'

        ]);

        $clients = DB::table('client')->where('ref_client', '=', $request->get('ref_client'));
        $clients = $clients->get();

        $projet = new projet([
            'id_client' => $clients[0]->id_client,
            'id_user'=> auth()->id(),
            'nom_projet'=> $request->get('nom_projet'),
            'date_projet' => Carbon::now()->toDateTimeString(),
            'ref_projet'=> str_random(5)
        ]);
        $projet->save();
        return redirect('/projets')->with('success', 'Un projet a été rajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_projet
     * @return \Illuminate\Http\Response
     */
    public function show($id_client)
    {

        return redirect('/projets/create')->with('id', $id_client);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_projet
     * @return \Illuminate\Http\Response
     */
    public function edit($id_projet)
    {

        $projet = projet::find($id_projet);

        return view('projets.edit', compact('projet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_projet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_projet)
    {
        $request->validate([
            'nom_projet'=>'required',
            'date_projet'=>'required'
        ]);

        $projet = projet::find($id_projet);
        $projet->nom_projet = $request->get('nom_projet');
        $projet->date_projet = $request->get('date_projet');
        $projet->save();

        return redirect('/projets')->with('success', 'Le projet a été mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_projet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_projet)
    {
        $projet = projet::find($id_projet);
        $projet->delete();

        return redirect('/projets')->with('success', 'Un projet a été supprimé');
    }
}
