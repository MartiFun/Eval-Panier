<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegetarien extends Model
{
    use HasFactory;

    public function plats()
    {
      return $this->hasMany(Plat::class);
    }
}
