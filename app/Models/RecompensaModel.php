<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class RecompensaModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'recompensas';
    protected $primary_key = '_id';
    protected $fillable = [
        'descricao_recompensa',
        'valor_recompensa',
    ];

    public function recompensados()
    {
        return $this->hasMany(RecompensadoModel::class, 'recompensa_id');
    }

}
