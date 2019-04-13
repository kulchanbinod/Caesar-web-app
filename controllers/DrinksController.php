<?php 
namespace App\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Drink;

class DrinksController extends CoreController {

    public function __construct($container) {
        parent::__construct($container);
    }

    public function index($request, $response, $args) {
    	$drinks = Drink::get();
    	$this->view($response, 'drinks/index.twig', compact('drinks'));
    }

    public function add($request, $response, $args) {
    	$this->view($response, 'drinks/form.twig');
    }

    public function save($request, $response, $args) {
    	$drink = Drink::create($this->getData($request));
    	$storage = new \Upload\Storage\FileSystem(__DIR__.'/../images/drinks/');
		$file = new \Upload\File('image', $storage);
		
		$new_filename = uniqid();
		$file->setName($new_filename);

		$file->addValidations(array(
		    new \Upload\Validation\Size('5M')
		));

		try {
		    $file->upload();
		} catch (\Exception $e) { }

		$drink->image = $file->getNameWithExtension();
		$drink->save();

    	return $response->withRedirect('/drinks');
    }

    public function edit($request, $response, $args) {
    	$drink = Drink::findOrFail($args['id']);
    	$this->view($response, 'drinks/form.twig', compact('drink'));
    }

    public function update($request, $response, $args) {
    	$drink = Drink::findOrFail($args['id']);
        $drink->update($this->getData($request));
		if ($_FILES['image']['name'] != '') {
	    	$storage = new \Upload\Storage\FileSystem(__DIR__.'/../images/drinks/');
			$file = new \Upload\File('image', $storage);

			$new_filename = uniqid();
			$file->setName($new_filename);
			$file->addValidations(array(
			    new \Upload\Validation\Size('5M')
			));
			try {
			    $file->upload();
			} catch (\Exception $e) { }
			$drink->image = $file->getNameWithExtension();
			$drink->update();
		}

    	return $response->withRedirect('/drinks');
    }

    public function delete($request, $response, $args) {
    	$drink = Drink::findOrFail($args['id']);
        $drink->delete();
    	return $response->withRedirect('/drinks');
    }

    public function getData($request) {
        $data = $request->getParsedBody();
        return $data;
    }
}