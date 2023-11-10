<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class RecompensadoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'recompensados';
    protected $primary_key = '_id';
    protected $fillable = [
        'hunter_id',
        'recompensa_id',
        'concluida',
    ];

    public function hunter()
    {
        return $this->belongsTo(HunterModel::class, 'hunter_id');
    }

    public function recompensa()
    {
        return $this->belongsTo(RecompensaModel::class, 'recompensa_id');
    }
}
