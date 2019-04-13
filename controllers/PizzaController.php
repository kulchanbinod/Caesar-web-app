<?php 
namespace App\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Pizza;

class PizzaController extends CoreController {

    public function __construct($container) {
        parent::__construct($container);
    }

    public function index($request, $response, $args) {
    	$pizzas = Pizza::get();
    	$this->view($response, 'pizzas/index.twig', compact('pizzas'));
    }

    public function add($request, $response, $args) {
    	$categories = Category::get();
        $ingredients = Ingredient::get();
    	$this->view($response, 'pizzas/form.twig', compact('categories','ingredients'));
    }

    public function save($request, $response, $args) {
    	$pizza = Pizza::create($this->getData($request));
        $pizza->ingredients()->attach($request->getParsedBody()['ingredient_id']);
    	$storage = new \Upload\Storage\FileSystem(__DIR__.'/../images/pizzas/');
		$file = new \Upload\File('image', $storage);
		
		$new_filename = uniqid();
		$file->setName($new_filename);

		$file->addValidations(array(
		    new \Upload\Validation\Size('5M')
		));

		try {
		    $file->upload();
		} catch (\Exception $e) { }

		$pizza->image = $file->getNameWithExtension();
		$pizza->save();

    	return $response->withRedirect('/pizzas');
    }

    public function edit($request, $response, $args) {
    	$pizza = Pizza::findOrFail($args['id']);
        $ingredient_ids = $pizza->ingredients->map(function( $ingredient) {
            return $ingredient->pivot->ingredient_id;
        });
        $ingredients = Ingredient::get();
    	$categories = Category::get();
    	$this->view($response, 'pizzas/form.twig', compact('pizza', 'categories', 'ingredients', 'ingredient_ids'));
    }

    public function update($request, $response, $args) {
    	$pizza = Pizza::findOrFail($args['id']);
    	$pizza->update($this->getData($request));
        $pizza->ingredients()->detach();
        $pizza->ingredients()->attach($request->getParsedBody()['ingredient_id']);
		if ($_FILES['image']['name'] != '') {
	    	$storage = new \Upload\Storage\FileSystem(__DIR__.'/../images/pizzas');
			$file = new \Upload\File('image', $storage);

			$new_filename = uniqid();
			$file->setName($new_filename);
			$file->addValidations(array(
			    new \Upload\Validation\Size('5M')
			));
			try {
			    $file->upload();
			} catch (\Exception $e) { }
			$pizza->image = $file->getNameWithExtension();
			$pizza->update();
		}

    	return $response->withRedirect('/pizzas');
    }

    public function delete($request, $response, $args) {
    	$pizza = Pizza::findOrFail($args['id']);
        $pizza->ingredients()->detach();
        $pizza->delete();
    	return $response->withRedirect('/pizzas');
    }

    public function getData($request) {
        $data = $request->getParsedBody();
        unset($data['ingredient_id']);
        return $data;
    }
}