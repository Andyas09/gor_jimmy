<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Jenis;

class Lapangan extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'lapangan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'nama',
        'deskripsi',
    ];
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'lapangan');
    }
    public function booking()
    {
        return $this->hasMany(Booking::class, 'lapangan');
    }

}