<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_devis
 * @property int $id_produit
 * @property int $quantite_produit
 * @property Devi $devi
 * @property Produit $produit
 */
class ProduitDevi extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['quantite_produit'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function devi()
    {
        return $this->belongsTo('App\Devi', 'id_devis', 'id_devis');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produit()
    {
        return $this->belongsTo('App\Produit', 'id_produit', 'id_produit');
    }
}
