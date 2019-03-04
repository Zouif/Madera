<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_echelon_paiement
 * @property float $signature_echelon_paiement
 * @property float $permis_construire_echelon_paiement
 * @property float $chantier_echelon_paiement
 * @property float $fondation_echelon_paiement
 * @property float $mur_echelon_paiement
 * @property float $mise_hors_echelon_paiement
 * @property float $travaux_echelon_paiement
 * @property float $remise_clef_echelon_paiement
 * @property Devi[] $devis
 */
class EchelonPaiement extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'echelon_paiement';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_echelon_paiement';

    /**
     * @var array
     */
    protected $fillable = ['signature_echelon_paiement', 'permis_construire_echelon_paiement', 'chantier_echelon_paiement', 'fondation_echelon_paiement', 'mur_echelon_paiement', 'mise_hors_echelon_paiement', 'travaux_echelon_paiement', 'remise_clef_echelon_paiement'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function devis()
    {
        return $this->belongsToMany('App\Devi', 'devis_echelonpaiement', 'id_echelon_paiement', 'id_devis');
    }
}
