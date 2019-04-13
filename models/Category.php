<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
   protected $guarded=[];
   public $timestamps = false;

    public function pizzas()
    {
        return $this->hasMany('App\Models\Pizza');
    }
}