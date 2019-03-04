<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_cctp
 * @property string $nom_cctp
 * @property int $prix_cctp
 * @property Produit[] $produits
 */
class Cctp extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cctp';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_cctp';

    /**
     * @var array
     */
    protected $fillable = ['nom_cctp', 'prix_cctp'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany('App\Produit', 'id_cctp', 'id_cctp');
    }
}
