<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Ustadz extends Model
{
    use HasFactory;

    protected $table = 'ustadzs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'nama_ustadz',
        'no_ponsel',
        'alamat',
        'photo',
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
