<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

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
        return $this->hasMany(RecompensadosModel::class, 'recompensa_id');
    }

}
