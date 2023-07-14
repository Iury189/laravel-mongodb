<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class TipoNenModel extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = "tipos_nen";
    protected $primary_key = '_id';
    protected $fillable = [
        'descricao',
    ];

    public function tipo_nen()
    {
        return $this->hasMany(HunterModel::class, 'tipo_nen_id');
    }
}
