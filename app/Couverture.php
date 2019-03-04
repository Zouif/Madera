<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_couverture
 * @property string $nom_couverture
 * @property int $prix_couverture
 * @property Produit[] $produits
 */
class Couverture extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'couverture';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_couverture';

    /**
     * @var array
     */
    protected $fillable = ['nom_couverture', 'prix_couverture'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany('App\Produit', 'id_couverture', 'id_couverture');
    }
}
