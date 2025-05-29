<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class CampaignDonasi extends Model
{
    use HasFactory;

    protected $table = 'campaign_donasis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'judul',
        'deskripsi',
        'gambar',
        'target_dana',
        'tanggal_mulai',
        'tanggal_selesai',
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
