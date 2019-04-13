<?php 
namespace App\Controllers;

use App\Models\Ingredient;
use App\Models\Pizza;

class IngredientController extends CoreController {

    public function __construct($container) {
        parent::__construct($container);
    }

    public function index($request, $response, $args) {
    	$ingredients = Ingredient::get();
    	$this->view($response, 'ingredients/index.twig', compact('ingredients'));
    }

    public function add($request, $response, $args) {
    	$this->view($response, 'ingredients/form.twig');
    }

    public function save($request, $response, $args) {
    	Ingredient::create($request->getParsedBody());
    	return $response->withRedirect('/ingredients');
    }

    public function edit($request, $response, $args) {
    	$ingredient = Ingredient::findOrFail($args['id']);
    	$this->view($response, 'ingredients/form.twig', compact('ingredient'));
    }

    public function update($request, $response, $args) {
    	$ingredient = Ingredient::findOrFail($args['id']);
    	$ingredient->update($request->getParsedBody());
    	return $response->withRedirect('/ingredients');
    }

    public function delete($request, $response, $args) {
    	$ingredient = Ingredient::findOrFail($args['id']);
    	$ingredient->delete();
    	return $response->withRedirect('/ingredients');
    }
}