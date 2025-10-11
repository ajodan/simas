<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class DataJamaah extends Model
{
    use HasFactory;

    protected $table = 'data_jamaahs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'nama',
        'email',
        'jenis_kelamin',
        'alamat',
        'no_hp',
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

    public function users()
    {
        return $this->hasMany(User::class, 'data_jamaah_id');
    }
}
