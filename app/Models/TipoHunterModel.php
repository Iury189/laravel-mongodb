<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class TipoHunterModel extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = "tipos_hunters";
    protected $primary_key = '_id';
    protected $fillable = [
        'descricao',
    ];

    public function tipo_hunter()
    {
        return $this->hasMany(HunterModel::class, 'tipo_hunter_id');
    }
}
