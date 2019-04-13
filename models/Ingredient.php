<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {
   protected $guarded=[];
   public $timestamps = false;

   public function pizzas()
    {
        return $this->belongsToMany('App\Models\Pizza');
    }
}