<?php

  require_once "db.php";
  require_once "../model/Response.php";

  try {
    $writeDB = DB::connectWriteDB();
  } catch (PDOException $ex) {
    error_log("Connection error: ".$ex, 0);
    $response = new Response();
    $response->setHttpStatusCode(500);
    $response->setSuccess(false);
    $response->addMessage("Database connection error");
    $response->send();
    exit;
  }

  if (array_key_exists("sessionid", $_GET)) {

  } else if (empty($_GET)) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      $response = new Response();
      $response->setHttpStatusCode(405);
      $response->setSuccess(false);
      $response->addMessage("Request method not allowed");
      $response->send();
      exit;
    }

    sleep(1);

    if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Content Type header not set to JSON");
      $response->send();
      exit;
    }

    $rawPostData = file_get_contents('php://input');

    if (!$jsonData = json_decode($rawPostData)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Request body is not valid JSON");
      $response->send();
      exit;
    }

  } else {
    $response = new Response();
    $response->setHttpStatusCode(404);
    $response->setSuccess(false);
    $response->addMessage("Endpoint not found");
    $response->send();
    exit;
  }