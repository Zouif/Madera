<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devis;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ref)
    {
        $listedevis = devis::all()->Where('ref_devis', '=', $ref);

        return view('devis.index', ['listedevis' => $listedevis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$id = $request->get('id');

        return view('deviss.create');
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
            'ref_client'=>'required',
            'nom_devis'=>'required'

        ]);

        $clients = DB::table('client')->where('ref_client', '=', $request->get('ref_client'));
        $clients = $clients->get();

        $devis = new devis([
            'id_client' => $clients[0]->id_client,
            'id_user'=> auth()->id(),
            'nom_devis'=> $request->get('nom_devis'),
            'date_devis' => Carbon::now()->toDateTimeString(),
            'ref_devis'=> str_random(10)
        ]);
        $devis->save();
        return redirect('/deviss')->with('success', 'Un devis a été rajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_devis
     * @return \Illuminate\Http\Response
     */
    public function show($id_devis)
    {
        return view('devis.index', compact($id_devis));
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
}
