<?php

  namespace App\Frontend\Controller;

  class PagesController extends AbstractController {
    public function showPage(string $pageKey) {
      $this->render('pages/showPage', []);
    }
  }