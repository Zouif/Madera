<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_gamme
 * @property string $nom_gamme
 * @property string $finition_gamme
 * @property string $huisseries_gamme
 * @property string $isolant_gamme
 * @property int $prix_gamme
 * @property Produit[] $produits
 */
class Gamme extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gamme';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_gamme';

    /**
     * @var array
     */
    protected $fillable = ['nom_gamme', 'finition_gamme', 'huisseries_gamme', 'isolant_gamme', 'prix_gamme'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany('App\Produit', 'id_gamme', 'id_gamme');
    }
}
