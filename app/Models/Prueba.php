<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;
    protected $primarykey= 'id_prueba';
    protected $fillable = [ 'name', 'email', 'password', 'miembros'];
}
