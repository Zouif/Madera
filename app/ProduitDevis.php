<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_devis
 * @property int $id_produit
 * @property int $quantite_produit
 * @property Devi $devis
 * @property Produit $produit
 */
class ProduitDevis extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['id_devis', 'id_produit', 'quantite_produit'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function devis()
    {
        return $this->belongsTo('App\Devis', 'id_devis', 'id_devis');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produit()
    {
        return $this->belongsTo('App\Produit', 'id_produit', 'id_produit');
    }
}
