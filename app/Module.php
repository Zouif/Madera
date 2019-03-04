<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_module
 * @property string $nom_module
 * @property string $description_module
 * @property int $prix_module
 * @property Composant[] $composants
 * @property Produit[] $produits
 */
class Module extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'module';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_module';

    /**
     * @var array
     */
    protected $fillable = ['nom_module', 'description_module', 'prix_module'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function composants()
    {
        return $this->belongsToMany('App\Composant', null, 'id_module', 'id_composant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produits()
    {
        return $this->belongsToMany('App\Produit', null, 'id_module', 'id_produit');
    }
}
