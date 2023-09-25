<?php
require_once 'app/core/view.php';
class Controller {
	public $model;
	public $view;

	function __construct() {
		$this->view = new View();
	}

	function index() { }
}