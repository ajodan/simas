<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table = 'dokumentasis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'judul',
        'foto',
        'kegiatan_id',
        'keterangan',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function subDokumentasis()
    {
        return $this->hasMany(SubDokumentasi::class);
    }
}
