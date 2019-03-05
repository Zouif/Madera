<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_module
 * @property int $id_produit
 */
class ModuleProduit extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'module_produit';

    /**
     * @var array
     */
    protected $fillable = ['id_module', 'id_produit'];

}
