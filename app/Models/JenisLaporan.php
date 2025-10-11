<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class JenisLaporan extends Model
{
    use HasFactory;

    protected $table = 'jenis_laporans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'jenis_laporan',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function laporanKeuangans()
    {
        return $this->hasMany(LaporanKeuangan::class, 'jenis_laporan_id');
    }
}
