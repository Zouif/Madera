<?php
/**
 * Created by PhpStorm.
 * User: Zouif
 * Date: 03/03/2019
 * Time: 20:55
 */

namespace App\Dao;

use Illuminate\Http\Request;
use App\Projet;
use Illuminate\Support\Facades\DB;
use App\Client;

class ClientDao
{

    public function clientById($id_client)
    {
        //$client = DB::table('client')->Where('id_client', '=', $id_client);
        return Client::find($id_client);
    }
}