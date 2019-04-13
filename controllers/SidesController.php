<?php 
namespace App\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Side;
use App\Models\Drink;

class SidesController extends CoreController {

    public function __construct($container) {
        parent::__construct($container);
    }

    public function index($request, $response, $args) {
    	$sides = Side::get();
    	$this->view($response, 'sides/index.twig', compact('sides'));
    }

    public function add($request, $response, $args) {
    	$this->view($response, 'sides/form.twig');
    }

    public function save($request, $response, $args) {
    	$side = Side::create($this->getData($request));
    	$storage = new \Upload\Storage\FileSystem(__DIR__.'/../images/sides/');
		$file = new \Upload\File('image', $storage);
		
		$new_filename = uniqid();
		$file->setName($new_filename);

		$file->addValidations(array(
		    new \Upload\Validation\Size('5M')
		));

		try {
		    $file->upload();
		} catch (\Exception $e) { }

		$side->image = $file->getNameWithExtension();
		$side->save();

    	return $response->withRedirect('/sides');
    }

    public function edit($request, $response, $args) {
    	$side = Side::findOrFail($args['id']);
    	$this->view($response, 'sides/form.twig', compact('side'));
    }

    public function update($request, $response, $args) {
    	$side = Side::findOrFail($args['id']);
        $side->update($this->getData($request));
		if ($_FILES['image']['name'] != '') {
	    	$storage = new \Upload\Storage\FileSystem(__DIR__.'/../images/sides/');
			$file = new \Upload\File('image', $storage);

			$new_filename = uniqid();
			$file->setName($new_filename);
			$file->addValidations(array(
			    new \Upload\Validation\Size('5M')
			));
			try {
			    $file->upload();
			} catch (\Exception $e) { }
			$side->image = $file->getNameWithExtension();
			$side->update();
		}

    	return $response->withRedirect('/sides');
    }

    public function delete($request, $response, $args) {
    	$side = Side::findOrFail($args['id']);
        $side->delete();
    	return $response->withRedirect('/sides');
    }

    public function getData($request) {
        $data = $request->getParsedBody();
        return $data;
    }
}