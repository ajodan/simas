<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Inventaris extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'jenisinventaris_id',
        'kode_inventaris',
        'nama_inventaris',
        'jumlah',
        'satuan',
        'kondisi',
        'keterangan',
        'photo',
        'tahun_perolehan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    }

    public function jenisInventaris()
    {
        return $this->belongsTo(JenisInventaris::class, 'jenisinventaris_id');
    }
}
