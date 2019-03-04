<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_entreprise
 * @property string $adresse
 * @property string $telephone
 * @property string $rs
 * @property int $siret
 * @property Devi[] $devis
 */
class Entreprise extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'entreprise';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_entreprise';

    /**
     * @var array
     */
    protected $fillable = ['adresse', 'telephone', 'rs', 'siret'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devis()
    {
        return $this->hasMany('App\Devi', 'id_entreprise', 'id_entreprise');
    }
}
