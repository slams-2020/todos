## Todo application

### Routes

- Créer le contrôleur ``TodoController`` (avec vue associée)
- Ajouter les routes suivantes :

| Method  | url       | action  | route     |   |
|---------|-----------|---------|-----------|---|
| ALL     | /         | index   | _default  |   |
| GET     | /add      | add     |           |   |
| POST    | /add      | submit  |           |   |
| GET     | /update   | update  |           |   |
| POST    | /update   | uSbmit  |           |   |
| DELETE  | /delete   | delete  |           |   |


### Services

Création d'une interface définissant la persistance d'une liste de todo items :

```php
namespace services;

use models\TodoItem;

interface ITodoItemLoader {
	/**
	 * Retourne une liste de todo-items
	 *
	 * @return TodoItem[]
	 */
	public function all(): array;

	/**
	 * Supprime un todo-item par son id
	 *
	 * @param int $id
	 * @return bool
	 */
	public function remove(int $id): bool;

	/**
	 *
	 * @param TodoItem $item
	 * @return bool
	 */
	public function update(TodoItem $item): bool;

	/**
	 * Ajoute un Todo-item
	 *
	 * @param TodoItem $item
	 */
	public function add(TodoItem $item): void;
}
```