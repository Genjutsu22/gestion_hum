<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidat extends Model
{
    use HasFactory;
    protected $table = 'candidats';

    protected $primaryKey = 'id_candidat';

    protected $fillable = ['id_personne', 'cv', 'motivation'];

    public $timestamps = false;

    public function personne()
    {
        return $this->belongsTo(personne::class, 'id_personne');
    }
}
