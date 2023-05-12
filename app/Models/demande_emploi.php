<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demande_emploi extends Model
{
    use HasFactory;
    
    protected $table = 'demande_emplois';
    protected $primaryKey = ['id_candidat', 'id_offre'];
    public $incrementing = false;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'id_candidat',
        'id_offre',
        'accepted'
    ];

    public function candidat()
    {
        return $this->belongsTo(Candidat::class, 'id_candidat');
    }

    public function offre()
    {
        return $this->belongsTo(OffreEmploi::class, 'id_offre');
    }
}
