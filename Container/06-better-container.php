<?php

  header('Content-Type: text/plain');

  class PostsRepository {
    public function __construct(private string $a, private string $b) {}
  }

  class PostsController {
    public function __construct(private PostsRepository $postsRepository) {}
  }

  class Container {
    private array $instances = [];
    public array $recipes = [];

    public function __construct() {
      $this->recipes['postsRepository'] = function(): PostsRepository {
        return new PostsRepository('A', 'B');
      };
      $this->recipes['postsController'] = function(): PostsController {
        $postsRepository = $this->get('postsRepository');
        return new PostsController($postsRepository);
      };
    }

    public function get($what) {
      if (empty($this->instances[$what])) {
        if (empty($this->recipes[$what])) {
          echo "Could not build {$what}";
          die();
        }
        $this->instances[$what] = $this->recipes[$what];
      }
      return $this->instances[$what];
    }
  }

  $container = new Container();
  // $container2= new Container();
  // var_dump($container->recipes);
  $postsController = $container->get('postsController');
  var_dump($postsController);
  $postsRepository = $container->get('postsRepository');