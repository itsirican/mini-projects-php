<?php

  namespace App\Admin\Controller;

  use App\Admin\Controller\AbstractAdminController;

  class PagesAdminController extends AbstractAdminController {
    public function index() {
      $this->render("pages/index", []);
    }
  }