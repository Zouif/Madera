<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_facture
 * @property int $id_devis
 * @property string $date_emission
 * @property string $cee
 * @property Devi $devi
 */
class Facture extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'facture';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_facture';

    /**
     * @var array
     */
    protected $fillable = ['id_devis', 'date_emission', 'cee'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function devi()
    {
        return $this->belongsTo('App\Devi', 'id_devis', 'id_devis');
    }
}
