<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegetarien extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'slug'];

    public function plats()
    {
      return $this->hasMany(Plat::class);
    }
}
