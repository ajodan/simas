<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'nama_kegiatan',
        'tempat',
        'tanggal',
        'jam',
        'banner',
        'deskripsi',
        'jenis_kegiatan_id',
        'ustadz_id',
        'tema',
        'jumlah_hadir',
        'link_youtube',
        'flag',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class);
    }

    public function dokumentasis()
    {
        return $this->hasMany(Dokumentasi::class);
    }
    public function ustadz()
    {
        return $this->belongsTo(Ustadz::class);
    }
}
