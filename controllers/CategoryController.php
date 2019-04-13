<?php 
namespace App\Controllers;

use App\Models\Category;
use App\Models\Pizza;

class CategoryController extends CoreController {

    public function __construct($container) {
        parent::__construct($container);
    }

    public function index($request, $response, $args) {
    	$categories = Category::get();
    	$this->view($response, 'categories/index.twig', compact('categories'));
    }

    public function add($request, $response, $args) {
    	$this->view($response, 'categories/form.twig');
    }

    public function save($request, $response, $args) {
    	Category::create($request->getParsedBody());
    	return $response->withRedirect('/categories');
    }

    public function edit($request, $response, $args) {
    	$category = Category::findOrFail($args['id']);
    	$this->view($response, 'categories/form.twig', compact('category'));
    }

    public function update($request, $response, $args) {
    	$category = Category::findOrFail($args['id']);
    	$category->update($request->getParsedBody());
    	return $response->withRedirect('/categories');
    }

    public function delete($request, $response, $args) {
    	$category = Category::findOrFail($args['id']);
    	$category->delete();
    	return $response->withRedirect('/categories');
    }
}