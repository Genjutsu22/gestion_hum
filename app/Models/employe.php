<?php

namespace App\Models;
use App\Models\Personne;
use App\Models\Profession;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employe extends Model
{
    use HasFactory;
    protected $table = 'employes';

    protected $fillable = [
        'id_personne',
        'id_prof',
        'id_depart',
        'num_bureau'
    ];

    public $timestamps = false;

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'id_prof');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_depart');
    }
}
