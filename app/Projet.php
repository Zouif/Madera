<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_projet
 * @property int $id_client
 * @property int $id_user
 * @property string $nom_projet
 * @property string $date_projet
 * @property string $ref_projet
 * @property Client $client
 * @property User $user
 * @property Devi[] $devis
 */
class Projet extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'projet';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_projet';

    /**
     * @var array
     */
    protected $fillable = ['id_client', 'id_user', 'nom_projet', 'date_projet', 'ref_projet'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client', 'id_client', 'id_client');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devis()
    {
        return $this->hasMany('App\Devi', 'id_projet', 'id_projet');
    }
}
