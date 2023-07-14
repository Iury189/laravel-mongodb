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
        'hunter_id',
        'descricao_recompensa',
        'valor_recompensa',
        'concluida',
    ];

    public function hunter()
    {
        return $this->belongsTo(HunterModel::class, 'hunter_id');
    }
}
