<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_produit
 * @property int $id_couverture
 * @property int $id_cctp
 * @property int $id_gamme
 * @property int $id_coupe_principe
 * @property string $nom_produit
 * @property float $taux_tva
 * @property float $prix_produit_ht
 * @property Cctp $cctp
 * @property CoupePrincipe $coupePrincipe
 * @property Couverture $couverture
 * @property Gamme $gamme
 * @property Module[] $modules
 * @property ProduitDevi[] $produitDevis
 * @property Tva[] $tvas
 */
class Produit extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'produit';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_produit';

    /**
     * @var array
     */
    protected $fillable = ['id_couverture', 'id_cctp', 'id_gamme', 'id_coupe_principe', 'nom_produit', 'taux_tva', 'prix_produit_ht'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cctp()
    {
        return $this->belongsTo('App\Cctp', 'id_cctp', 'id_cctp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupePrincipe()
    {
        return $this->belongsTo('App\CoupePrincipe', 'id_coupe_principe', 'id_coupe_principe');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function couverture()
    {
        return $this->belongsTo('App\Couverture', 'id_couverture', 'id_couverture');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gamme()
    {
        return $this->belongsTo('App\Gamme', 'id_gamme', 'id_gamme');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modules()
    {
        return $this->belongsToMany('App\Module', null, 'id_produit', 'id_module');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produitDevis()
    {
        return $this->hasMany('App\ProduitDevi', 'id_produit', 'id_produit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tvas()
    {
        return $this->belongsToMany('App\Tva', null, 'id_produit', 'id_tva');
    }
}
