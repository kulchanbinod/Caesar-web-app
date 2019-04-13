<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Utils;

class Drink extends Model {
	protected $table = "sides";

	protected $guarded=[];
	public $timestamps = false;

	protected $attributes = [
        'is_drink' => 1,
    ];

	public function getImageAttribute($value)
	{
		return Utils::getBaseUrl() . 'images/drinks/' .$value;
	}

	public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('is_drink', '=', 1);
    }
}