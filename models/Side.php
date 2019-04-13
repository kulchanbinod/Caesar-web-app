<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Utils;

class Side extends Model {
   protected $guarded=[];
   public $timestamps = false;

   public function getImageAttribute($value)
    {
        return Utils::getBaseUrl() . 'images/sides/' .$value;
    }

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('is_drink', '=', 0);
    }
}