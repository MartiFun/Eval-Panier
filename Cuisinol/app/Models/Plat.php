<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prix', 'type_id', 'vegetarien_id', 'poid', 'origine'];

    public function type()
    {
      return $this->belongsTo(Type::class);
    }

    public function vegetarien()
    {
      return $this->belongsTo(Vegetarien::class);
    }

    public function ingredients()
    {
      return $this->belongsToMany(Ingredient::class);
    }

    public function users()
    {
      return $this->belongsToMany(User::class);
    }

}
