<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDokumentasi extends Model
{
    use HasFactory;

    protected $table = 'sub_dokumentasis';
    protected $fillable = [
        'dokumentasi_id',
        'judul',
        'foto',
        'keterangan',
    ];

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class);
    }
}
