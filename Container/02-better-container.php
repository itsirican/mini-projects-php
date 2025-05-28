<?php

  header('Content-Type: text/plain');

  class PostsRepository {
    public function __construct(private string $a, private string $b) {}
  }

  class PostsController {
    public function __construct(private PostsRepository $postsRepository) {}
  }

  class Container {
    private PostsRepository $postsRepository;
    public function getPostsRepository(): PostsRepository {
      if (empty($this->postsRepository)) {
        $this->postsRepository = new PostsRepository('A', 'B');
      }
      return $this->postsRepository;
      // return new PostsRepository('A', 'B');
    }

    private PostsController $postsController;
    public function getPostsController(): PostsController {
      if (empty($this->postsController)) {
        $postsRepository = new PostsRepository('A', 'B');
        $this->postsController =  new PostsController($postsRepository);
      }
      return $this->postsController;
    }
  }

  $container = new Container();
  $postsController = $container->getPostsController();
  var_dump($postsController);