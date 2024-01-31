<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class HunterModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'hunters';
    protected $primary_key = '_id';
    protected $fillable = [
        'nome_hunter',
        'idade_hunter',
        'altura_hunter',
        'peso_hunter',
        'tipo_hunter_id',
        'tipo_nen_id',
        'tipo_sangue_id',
        'inicio',
        'termino',
    ];

    public function recompensados()
    {
        return $this->hasMany(RecompensadoModel::class, 'hunter_id');
    }

    public function tipos_hunter()
    {
        return $this->belongsTo(TipoHunterModel::class, 'tipo_hunter_id');
    }

    public function tipos_nen()
    {
        return $this->belongsTo(TipoNenModel::class, 'tipo_nen_id');
    }

    public function tipos_sanguineos()
    {
        return $this->belongsTo(TipoSanguineoModel::class, 'tipo_sangue_id');
    }
}
