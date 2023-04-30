<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adresse extends Model
{
    use HasFactory;

    protected $table = 'adresses';
    protected $primaryKey = 'id_adresse';
    protected $fillable = [
        'pays',
        'ville',
        'quartier',
        'code_postal',
    ];

    public function personnes()
    {
        return $this->hasMany(Personne::class);
    }
}
