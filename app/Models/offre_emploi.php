<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offre_emploi extends Model
{
    use HasFactory;
    protected $table = 'offre_emplois';

    protected $primaryKey = 'id_offre';

    protected $fillable = ['id_prof', 'detail'];

    public $timestamps = false;

    public function profession()
    {
        return $this->belongsTo('App\Models\Prof', 'id_prof');
    }
}
