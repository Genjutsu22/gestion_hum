<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conge extends Model
{
    use HasFactory;
    protected $table = 'conges';
    protected $primaryKey = 'id_conge';
    protected $fillable = [
        'date_debut',
        'date_fin',
        'certificat_medical',
        'id_employe',
        'date_demande',
        'etat',
        'justif',
        'date_accept',
        'type_conge'
    ];

    public $timestamps = false;
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }
}
