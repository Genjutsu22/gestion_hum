<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;
    protected $table = 'admins';

    protected $primaryKey = 'id_admin';

    protected $fillable = ['id_personne'];

    public $timestamps = false;

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne');
    }
}
