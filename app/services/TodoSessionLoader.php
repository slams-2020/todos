<?php

namespace services;

use Ubiquity\utils\http\USession;
use models\TodoItem;

class TodoSessionLoader implements ITodoItemLoader {
	const SESSION_KEY = 'todo-items';
	public function all(): array {
		return USession::get ( self::SESSION_KEY, [ ] );
	}
	public function update(TodoItem $item): bool {
	}
	public function remove(int $id): bool {
	}
	public function add(TodoItem $item): void {
		USession::addOrRemoveValueFromArray ( self::SESSION_KEY, $item, true );
	}
}

