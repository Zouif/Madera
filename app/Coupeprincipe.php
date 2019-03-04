<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_coupe_principe
 * @property string $nom_coupe_principe
 * @property int $prix_coupe_principe
 * @property Produit[] $produits
 */
class Coupeprincipe extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'coupe_principe';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_coupe_principe';

    /**
     * @var array
     */
    protected $fillable = ['nom_coupe_principe', 'prix_coupe_principe'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany('App\Produit', 'id_coupe_principe', 'id_coupe_principe');
    }
}
