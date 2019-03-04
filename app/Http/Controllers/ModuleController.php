<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use Illuminate\Support\Facades\DB;
use App\Module;
use Carbon\Carbon;
use App\Dao\ProjetDao;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = module::all();

        return view('modules.index', ['modules' => $modules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$id = $request->get('id');

        return view('modules.create');
    }


    public function search(Request $request)
    {
        //dd($request->all());

        $search = $request->get('search');

        $modules = DB::table('modules')->join('client', 'client.id_client', '=', 'modules.id_client')
            ->Where(
                [
                    ['id_user', '=', auth()->id()],
                    ['id_module', 'like', '%' . $search . '%']
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['ref_client', 'like', '%' . $search . '%']
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['id_user', 'like', '%' . $search . '%']
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['nom_module', 'like', '%' . $search . '%']
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['date_module', 'like', '%' . $search . '%']
                ])
            ->orWhere(
                [
                    ['id_user', '=', auth()->id()],
                    ['ref_module', 'like', '%' . $search . '%']
                ]);
        $modules = $modules->get();
        return view('modules.index', ['modules' => $modules]);
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
            'nom_module'=>'required'

        ]);

        $clients = DB::table('client')->where('ref_client', '=', $request->get('ref_client'));
        $clients = $clients->get();

        $module = new module([
            'id_client' => $clients[0]->id_client,
            'id_user'=> auth()->id(),
            'nom_module'=> $request->get('nom_module'),
            'date_module' => Carbon::now()->toDateTimeString(),
            'ref_module'=> str_random(5)
        ]);
        $module->save();
        return redirect('/modules')->with('success', 'Un modules a été rajouté');
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
        $module = module::find($id_module);
        $module->delete();

        return redirect('/modules')->with('success', 'Un modules a été supprimé');
    }
}
