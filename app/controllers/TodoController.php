<?php

namespace controllers;

use Ubiquity\utils\http\URequest;
use models\TodoItem;
use services\TodoSessionLoader;

/**
 * Controller TodoController
 *
 * @property \Ajax\php\ubiquity\JsUtils $jquery
 */
class TodoController extends ControllerBase {

	/**
	 *
	 * @autowired
	 * @var TodoSessionLoader
	 */
	private $loader;
	/**
	 *
	 * @param \services\TodoSessionLoader $loader
	 */
	public function setLoader($loader) {
		$this->loader = $loader;
	}
	private function displayItems() {
		$items = $this->loader->all ();
		$dt = $this->jquery->semantic ()->dataTable ( 'dtItems', TodoItem::class, $items );
		$dt->setFields ( [ 
				'caption'
		] );
		$dt->addDeleteButton ();
	}

	/**
	 *
	 * @route('_default')
	 */
	public function index() {
		$this->_index ();
	}

	/**
	 *
	 * @get("add")
	 */
	public function add() {
		$this->jquery->postFormOnClick ( '#btValidate', '/add', 'frmItem', '#response', [ 
				'hasLoader' => 'internal'
		] );
		if (URequest::isAjax ()) {
			$this->jquery->renderView ( 'TodoController/add.html' );
		} else {
			$this->_index ( $this->jquery->renderView ( 'TodoController/add.html', [ ], true ) );
		}
	}

	/**
	 *
	 * @post("add")
	 */
	public function submit() {
		$item = new TodoItem ();
		$item->setCaption ( URequest::post ( 'caption', 'no caption' ) );
		$this->loader->add ( $item );
		echo $this->jquery->semantic ()->htmlMessage ( '', 'Item ajouté' );
		$this->displayItems ();
	}
	private function _index($response = '') {
		$this->jquery->getHref ( 'a', '', [ 
				'hasLoader' => 'internal'
		] );
		$this->displayItems ();

		$this->jquery->renderView ( 'TodoController/index.html', [ 
				'response' => $response
		] );
	}
}











