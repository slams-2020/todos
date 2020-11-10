<?php

namespace models;

class TodoItem {
	private $id;
	private $caption;
	/**
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getCaption() {
		return $this->caption;
	}

	/**
	 *
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 *
	 * @param mixed $caption
	 */
	public function setCaption($caption) {
		$this->caption = $caption;
	}
	public function __toString() {
		return $this->caption;
	}
}





