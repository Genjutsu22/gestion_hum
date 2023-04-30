<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demande_conge extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'demande_conges';
    protected $primaryKey = ['id_conge', 'id_employe'];
    public $incrementing = false;
    protected $keyType = 'integer';

    public function conge()
    {
        return $this->belongsTo(Conge::class, 'id_conge');
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }
}
