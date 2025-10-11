<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class JenisInventaris extends Model
{
    use HasFactory;

    protected $table = 'jenis_inventaris';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'jenis_inventaris',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener to generate UUID before creating
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
