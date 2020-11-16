<?php

namespace services;

use Ubiquity\orm\DAO;
use models\TodoItem;

class TodoDAOLoader implements ITodoItemLoader {
	/**
	 *
	 * {@inheritdoc}
	 * @see \services\ITodoItemLoader::get()
	 */
	public function get($id): ?TodoItem {
		return DAO::getById ( TodoItem::class, $id );
	}

	/**
	 *
	 * {@inheritdoc}
	 * @see \services\ITodoItemLoader::add()
	 */
	public function add(TodoItem $item): void {
		DAO::insert ( $item );
	}

	/**
	 *
	 * {@inheritdoc}
	 * @see \services\ITodoItemLoader::all()
	 */
	public function all(): array {
		return DAO::getAll ( TodoItem::class );
	}

	/**
	 *
	 * {@inheritdoc}
	 * @see \services\ITodoItemLoader::clear()
	 */
	public function clear(): void {
		DAO::deleteAll ( TodoItem::class, '1=1' );
	}

	/**
	 *
	 * {@inheritdoc}
	 * @see \services\ITodoItemLoader::remove()
	 */
	public function remove(string $id): bool {
		return DAO::delete ( TodoItem::class, $id );
	}

	/**
	 *
	 * {@inheritdoc}
	 * @see \services\ITodoItemLoader::update()
	 */
	public function update(TodoItem $item): bool {
		return DAO::update ( $item );
	}
}

