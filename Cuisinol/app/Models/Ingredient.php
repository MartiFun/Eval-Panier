<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'slug'];

    public function plats()
    {
      return $this->belongsToMany(Plat::class);
    }
}
