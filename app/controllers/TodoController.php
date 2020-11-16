<?php

namespace controllers;

/**
 * Controller TodoController
 *
 * @property \Ajax\php\ubiquity\JsUtils $jquery
 */
class TodoController extends ControllerBase {

	/**
	 *
	 * @autowired
	 * @var TodoDAOLoader
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
		$msg = new HtmlMessage ( '', "Aucun élément à afficher !" );
		$msg->addIcon ( "shower" );
		$dt->setEmptyMessage ( $msg );
		$dt->setFields ( [ 
				'id',
				'caption'
		] );

		$dt->setIdentifierFunction ( 'getId' );
		$dt->addEditDeleteButtons ( false );

		$dt->setEdition ();
		$this->jquery->getOnClick ( '._delete', 'delete', 'body', [ 
				'hasLoader' => 'internal',
				'attr' => 'data-ajax'
		] );

		$this->jquery->getOnClick ( '._edit', Router::path ( 'todo.update', [ 
				''
		] ), '#response', [ 
				'hasLoader' => 'internal',
				'attr' => 'data-ajax'
		] );
	}

	/**
	 *
	 * @param string $id
	 * @get('delete/{id}')
	 */
	public function delete(string $id) {
		$this->loader->remove ( $id );
		$msg = $this->jquery->semantic ()->htmlMessage ( '', 'Item supprimé' );
		$this->_index ( $msg );
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
		$this->jquery->postFormOnClick ( '#btValidate', '/add', 'frmItem', 'body', [ 
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
		$msg = $this->jquery->semantic ()->htmlMessage ( '', 'Item ajouté' );
		$this->_index ( $msg );
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

	/**
	 *
	 * @get("clear")
	 */
	public function clear() {
		$this->loader->clear ();
		$msg = $this->jquery->semantic ()->htmlMessage ( 'clearMsg', 'Liste d\'items vidée', 'info' );
		$msg->addIcon ( 'info' );
		$this->_index ( $msg );
	}

	/**
	 *
	 * @route("test/db")
	 */
	public function testDb() {
		$todos = DAO::getAll ( TodoItem::class );
		foreach ( $todos as $todo ) {
			echo $todo->getCaption () . "<br>";
		}

		$grippe = DAO::getOne ( TodoItem::class, "caption= ?", false, [ 
				'Grippe'
		] );
		var_dump ( $grippe );
	}

	/**
	 *
	 * @get("update/{id}","name"=>"todo.update")
	 * @param string $id
	 */
	public function update($id) {
		$instance = $this->loader->get ( $id );
		$form=$this->jquery->semantic ()->dataForm ( 'frm-item', $instance );
		$form->fieldAsHidden('id');
		$form->addSubmit('btValidate', "Ajouter item","green","/test","body",['hasLoader'=>'internal']);
		$this->jquery->renderDefaultView ();
	}
	
	/**
	 *
	 * @post("update/{id}","name"=>"todo.update")
	 * @param string $id
	 */
	public function update($id) {
}








