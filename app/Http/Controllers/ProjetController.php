<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projets = projet::all()->Where('id_user', '=', auth()->id());

        return view('projets.index', compact('projets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projets.create');
    }


    public function search(Request $request)
    {
        $search = $request->get('search');
        //$projets = projet::all();
        $projets = DB::table('projet')->where('id_projet', 'like', '%' . $search . '%')
            ->orWhere('id_client', 'like', '%' . $search . '%')
            ->orWhere('id_user', 'like', '%' . $search . '%')
            ->orWhere('nom_projet', 'like', '%' . $search . '%')
            ->orWhere('date_projet', 'like', '%' . $search . '%')
            ->orWhere('ref_projet', 'like', '%' . $search . '%');
        $projets = $projets->get();
        return view('projets.index', ['projet' => $projets]);
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
            'id_client'=>'required',
            'nom_projet'=>'required',
            'ref_projet'=>'required'
        ]);
        $projet = new projet([
            'id_client' => $request->get('id_client'),
            'id_user'=> auth()->id(),
            'nom_projet'=> $request->get('nom_projet'),
            'date_projet' => Carbon::now()->toDateTimeString(),
            'ref_projet'=> $request->get('ref_projet')
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
    public function show($id_projet)
    {
        //
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
