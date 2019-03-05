<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\DB;
use App\Coupeprincipe;

class CoupeprincipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupeprincipes = Coupeprincipe::all();

        return view('coupeprincipes.index', compact('coupeprincipes'));
    }

    /* Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function create()
    {
        //$id = $request->get('id');
    }


    public function search(Request $request)
    {
        //dd($request->all());

        $search = $request->get('search');

        $coupeprincipes = DB::table('coupe_principe')->Where(
            [
                ['id_coupe_principe', 'like', '%' . $search . '%']
            ])
            ->orWhere(
                [
                    ['nom_coupe_principe', 'like', '%' . $search . '%']
                ])
            ->orWhere(
                [
                    ['prix_coupe_principe', 'like', '%' . $search . '%']
                ]);
        $coupeprincipes = $coupeprincipes->get();
        return view('coupeprincipes.index', ['coupeprincipes' => $coupeprincipes]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_module
     * @return \Illuminate\Http\Response
     */
    public function show($id_client)
    {

        return redirect('/modules/create')->with('id', $id_client);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_module
     * @return \Illuminate\Http\Response
     */
    public function edit($id_module)
    {

        $module = module::find($id_module);

        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_module)
    {
        $request->validate([
            'nom_module'=>'required',
            'date_module'=>'required'
        ]);

        $module = module::find($id_module);
        $module->nom_module = $request->get('nom_module');
        $module->date_module = $request->get('date_module');
        $module->save();

        return redirect('/modules')->with('success', 'Le modules a été mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_module
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_module)
    {

    }

    public function sendToDevis(Request $request)
    {
        $coupeprincipe = coupeprincipe::find($request->id_coupe_principe);
        session()->put('coupeprincipe',$coupeprincipe);
        if (strpos(session()->get('backUrl'), 'edit') !== false) {
            return redirect('/produits/'. session()->get('produit.id_produit') .'/edit');
        }
        return redirect('/produits/create');

    }
}