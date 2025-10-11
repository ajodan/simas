<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_keuangans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'jenis_laporan_id',
        'jenis_laporan',
        'saldo_akhir',
        'upload_file',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function jenisLaporan()
    {
        return $this->belongsTo(JenisLaporan::class, 'jenis_laporan_id');
    }
}
