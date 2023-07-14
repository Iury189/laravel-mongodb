<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class TipoSanguineoModel extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = "tipos_sanguineos";
    protected $primary_key = '_id';
    protected $fillable = [
        'descricao',
    ];

    public function tipo_sanguineo()
    {
        return $this->hasMany(HunterModel::class, 'tipo_sanguineo_id');
    }
}
