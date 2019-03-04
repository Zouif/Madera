<?php
/**
 * Created by PhpStorm.
 * User: Zouif
 * Date: 03/03/2019
 * Time: 20:55
 */

namespace App\Dao;

use App\Projet;

class ProjetDao
{
    public function selectProjetAndRefClientByIdUser($id_user)
    {
        $projets = ProjetDao::selectProjetByIdUser($id_user);
        return ProjetDao::addRefClientToProjets($projets);
    }

    public function selectProjetByIdUser($id_user){
        return projet::all()->Where('id_user', '=', $id_user);
    }

    public function addRefClientToProjets($projets){
        $clientDao = new ClientDao();
        foreach ($projets as $projet) {
            $client = $clientDao->clientById($projet->id_client);
            $projet->ref_client = $client->ref_client;
        }
        return $projets;
    }

}