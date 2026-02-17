<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Jadwal extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'jadwal';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'hari',
        'lapangan',
        'status',
        'waktu',
    ];
    public function lap()
    {
        return $this->belongsTo(Lapangan::class, foreignKey: 'lapangan');
    }
    public function booking()
    {
        return $this->hasMany(Booking::class, 'jadwal');
    }
}