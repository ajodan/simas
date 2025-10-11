<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class JenisKegiatan extends Model
{
    use HasFactory;

    protected $table = 'jenis_kegiatans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'jenis_kegiatan',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
