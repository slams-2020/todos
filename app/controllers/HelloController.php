<?php
namespace controllers;

 /**
 * Controller HelloController
 * @route('hello','automated'=>true)
 **/
class HelloController extends ControllerBase{

	public function index(){
	    echo 'Hello world!';
	}

    /**
     * 
     * @post
     */
	public function msg($msg){
		echo $msg;
	}

}
