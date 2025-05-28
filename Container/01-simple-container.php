<?php

  header('Content-Type: text/plain');

  class PostsRepository {
    public function  __construct(private string $a, private string $b) {}
  }

  class PostsController {
    public function __construct(private PostsRepository $postsRepository){} 
  }

  // $postsRepository = new PostsRepository('A', 'B');
  // var_dump($postsRepository);
  // echo "\n";
  // $postsController = new PostsController($postsRepository);
  // var_dump($postsController);

  class Container {
    public function getPostsRepository(): PostsRepository {
      $postsRepository = new PostsRepository('A', 'B');
      return $postsRepository;
    }

    public function getPostsController(): PostsController {
      $postsRepository = new PostsRepository('A', 'B');
      return new PostsController($postsRepository);
    }
  }

  $controller = new Container();
  // var_dump($controller->getPostsRepository());
  var_dump($controller->getPostsController());