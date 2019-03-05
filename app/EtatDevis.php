<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_etat_devis
 * @property string $nom_etat_devis
 * @property Devi[] $devis
 */
class EtatDevis extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_etat_devis';

    /**
     * @var array
     */
    protected $fillable = ['nom_etat_devis'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devis()
    {
        return $this->hasMany('App\Devi', 'id_etat_devis', 'id_etat_devis');
    }
}
