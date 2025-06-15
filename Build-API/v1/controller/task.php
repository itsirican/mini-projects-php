<?php

  require_once "db.php";
  require_once "../model/Response.php";
  require_once "../model/Task.php";

  try {
    $writeDB = DB::connectWriteDB();
    $readDB = DB::connectReadDB();
  } catch (PDOException $ex) {
    $res = new Response();
    $res->setHttpStatusCode(500);
    $res->setSuccess(false);
    $res->addMessage("Database Connection error");
    $res->send();
  }