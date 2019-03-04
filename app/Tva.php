<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tva
 * @property string $libelle_tva
 * @property float $taux_tva
 * @property string $date_effet_tva
 * @property boolean $activite
 * @property Devi[] $devis
 * @property Produit[] $produits
 */
class Tva extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tva';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tva';

    /**
     * @var array
     */
    protected $fillable = ['libelle_tva', 'taux_tva', 'date_effet_tva', 'activite'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devis()
    {
        return $this->hasMany('App\Devi', 'id_tva', 'id_tva');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produits()
    {
        return $this->belongsToMany('App\Produit', null, 'id_tva', 'id_produit');
    }
}
