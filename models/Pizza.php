<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Utils;

class Pizza extends Model {
   protected $guarded=[];
   public $timestamps = false;

   public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredient');
    }

    public function getImageAttribute($value)
    {
        return Utils::getBaseUrl() . 'images/pizzas/' .$value;
    }
}