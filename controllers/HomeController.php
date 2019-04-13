<?php 
namespace App\Controllers;

class HomeController extends CoreController {

    public function __construct($container) {
        parent::__construct($container);
    }

    public function index($request, $response, $args) {
    	$this->view($response, 'index.twig');
    }
}