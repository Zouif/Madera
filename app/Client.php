<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_client
 * @property string $nom_client
 * @property string $prenom_client
 * @property string $adresse_client
 * @property string $nom_collectivite
 * @property string $telephone_client
 * @property string $mail_client
 * @property string $ref_client
 * @property Projet[] $projets
 */
class Client extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'client';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_client';

    /**
     * @var array
     */
    protected $fillable = ['nom_client', 'prenom_client', 'adresse_client', 'nom_collectivite', 'telephone_client', 'mail_client', 'ref_client'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projets()
    {
        return $this->hasMany('App\Projet', 'id_client', 'id_client');
    }
}
