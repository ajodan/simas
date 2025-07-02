<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class DonasiManual extends Model
{
    use HasFactory;

    protected $table = 'donasi_manuals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'nama_donatur',
        'jenis_donasi',
        'jumlah',
        'tanggal',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
