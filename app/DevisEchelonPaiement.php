<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_devis
 * @property int $id_echelon_paiement
 * @property Devi $devi
 * @property EchelonPaiement $echelonPaiement
 */
class DevisEchelonPaiement extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'devis_echelonpaiement';

    /**
     * @var array
     */
    protected $fillable = [];

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
    public function echelonPaiement()
    {
        return $this->belongsTo('App\EchelonPaiement', 'id_echelon_paiement', 'id_echelon_paiement');
    }
}
