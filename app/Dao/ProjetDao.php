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
        return ProjetDao::addRefClientToObjects($projets);
    }

    public function selectProjetByIdUser($id_user){
        return projet::all()->Where('id_user', '=', $id_user);
    }

    public function addRefClientToObjects($objects){
        $clientDao = new ClientDao();
        foreach ($objects as $object) {
            $client = $clientDao->clientById($object->id_client);
            $object->ref_client = $client->ref_client;
        }
        return $objects;
    }

}