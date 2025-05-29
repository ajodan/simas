<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class DonaturTetap extends Model
{
    use HasFactory;

    protected $table = 'donatur_tetaps';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'uuid_user',
        'nominal',
        'tanggal_mulai',
        'frekuensi',
        'last_reminder_send',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function jamaah()
    {
        return $this->belongsTo(DataJamaah::class, 'uuid_user', 'uuid');
    }
}
