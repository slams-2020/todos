<?php
namespace controllers;
 /**
 * Controller TestController
 */
class TestController extends ControllerBase{

	public function index(){
		$this->loadDefaultView();
	}

	/**
	 * @route("salut/{message}")
	 */
	public function hello($message){
		$this->loadView('TestController/hello.html',['msg'=>$message]);

	}

}
