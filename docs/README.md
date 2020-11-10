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

Implémentation d'un loader pour la session :

```php
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
```

Injection du loader dans le contrôleur **TodoController**:

```php
namespace controllers;

use services\TodoSessionLoader;

/**
 * Controller TodoController
 */
class TodoController extends ControllerBase {

	/**
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
	...
}
```
