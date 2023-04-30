<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conge extends Model
{
    use HasFactory;
    protected $table = 'conges';

    protected $fillable = [
        'date_debut',
        'date_fin',
        'certificat_medical'
    ];

    public $timestamps = false;
}
