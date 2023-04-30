<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class personne extends Model
{

    use HasFactory;
    protected $table = 'personnes';


    protected $hidden = ['password'];


    protected $casts = [
        'OTP_expiry' => 'datetime',
    ];


    protected $primaryKey = 'id_personne';
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'OTP',
        'OTP_expiry',
        'cin',
        'id_adresse',
    ];
    public $timestamps = false;

    public function adresse()
    {
        return $this->belongsTo(adresse::class, 'id_adresse');
    }
}
