<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriArtikel extends Model
{
    use HasFactory;

    protected $table = 'kategori_artikels';

    protected $fillable = [
        'uuid',
        'nama_kategori',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'kategori_id');
    }
}
