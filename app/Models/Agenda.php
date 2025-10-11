<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'judul',
        'tanggal',
        'deskripsi',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener to create UUID before saving
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
