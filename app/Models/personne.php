<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

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
    public static function updateExpiredOTP()
    {
        $expiredDateTime = Carbon::now()->subMinute();

        self::where('OTP_expiry', '<=', $expiredDateTime)
            ->update([
                'OTP' => null,
                'OTP_expiry' => null
            ]);
    }
}
