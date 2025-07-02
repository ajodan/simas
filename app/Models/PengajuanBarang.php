<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class PengajuanBarang extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_barangs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'organisasi',
        'penanggung_jawab',
        'barang',
        'nomor',
        'surat',
        'status',
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
