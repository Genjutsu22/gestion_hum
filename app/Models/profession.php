<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profession extends Model
{
    use HasFactory;
    protected $table = 'professions';

    protected $primaryKey = 'id_prof';

    protected $fillable = ['nom_prof'];

    public $timestamps = false;
}
