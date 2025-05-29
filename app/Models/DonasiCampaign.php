<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class DonasiCampaign extends Model
{
    use HasFactory;

    protected $table = 'donasi_campaigns';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'uuid_campaign',
        'nama_pendonasi',
        'nominal_donasi',
        'bukti_transfer',
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
