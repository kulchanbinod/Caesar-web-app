<?php 
namespace App\Controllers;

use App\Models\User;

class UsersController extends CoreController {

    public function __construct($container) {
        parent::__construct($container);

        // $user = User::find(1);
        // $user->orders()->create([
        // 	'total' => 29.99,
        // 	'comments' => 'test',
        // 	'status' => 1
        // ])->pizzas()->attach([1 => ['rate' => 20.00, 'qty' => 1],2 => ['rate' => 15.00, 'qty' => 1]]);
        // $user->save();
        // echo json_encode($user->orders());
        // $user->orders()->delete();
        // exit;

    }

    public function index($request, $response, $args) {
    	$users = User::get();
    	$this->view($response, 'users/index.twig', compact('users'));
    }
}