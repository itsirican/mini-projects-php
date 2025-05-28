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

    public function get($what) {
      if ($what === 'postsRepository') {
        if (empty($this->instances['postsRepository'])) {
          $this->instances['postsRepository'] = new PostsRepository('A', 'B');
        }
        return $this->instances['postsRepository'];
      } else if ($what === 'postsController') {
        if (empty($this->instances['postsController'])) {
          $postsRepository = $this->get('postsRepository');
          $this->instances['postsController'] =  new PostsController($postsRepository);
        }
        return $this->instances['postsController'];
      }
    }
  }

  $container = new Container();
  $postsController = $container->get('postsController');
  var_dump($postsController);