<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_devis
 * @property int $id_etat_devis
 * @property int $id_entreprise
 * @property int $id_projet
 * @property int $id_tva
 * @property string $date_devis
 * @property int $duree_validite_devis
 * @property float $taux_horaire_main_oeuvre
 * @property float $montant_frais_deplacement
 * @property float $prix_prestation
 * @property string $modalite_decompte_passe
 * @property float $taux_tva
 * @property float $montant_tva
 * @property float $prix_total_ht
 * @property string $ref_devis
 * @property Entreprise $entreprise
 * @property EtatDevi $etatDevi
 * @property Projet $projet
 * @property Tva $tva
 * @property EchelonPaiement[] $echelonPaiements
 * @property Facture $facture
 * @property ProduitDevi[] $produitDevis
 */
class Devis extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_devis';

    /**
     * @var array
     */
    protected $fillable = ['id_etat_devis', 'id_entreprise', 'id_projet', 'id_tva', 'date_devis', 'duree_validite_devis', 'taux_horaire_main_oeuvre', 'montant_frais_deplacement', 'prix_prestation', 'modalite_decompte_passe', 'taux_tva', 'montant_tva', 'prix_total_ht', 'ref_devis'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise()
    {
        return $this->belongsTo('App\Entreprise', 'id_entreprise', 'id_entreprise');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function etatDevi()
    {
        return $this->belongsTo('App\EtatDevi', 'id_etat_devis', 'id_etat_devis');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projet()
    {
        return $this->belongsTo('App\Projet', 'id_projet', 'id_projet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tva()
    {
        return $this->belongsTo('App\Tva', 'id_tva', 'id_tva');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function echelonPaiements()
    {
        return $this->belongsToMany('App\EchelonPaiement', 'devis_echelonpaiement', 'id_devis', 'id_echelon_paiement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function facture()
    {
        return $this->hasOne('App\Facture', 'id_devis', 'id_devis');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produitDevis()
    {
        return $this->hasMany('App\ProduitDevi', 'id_devis', 'id_devis');
    }
}
