<?php

  require_once 'Response.php';

  $response = new Response();

  $response->setSuccess(true);
  $response->setHttpStatusCode(200);
  $response->addMessage("data received successfully!");
  $response->setData([["id" => "1", "title" => "Product 1"], ["id" => "1", "title" => "Product 2"]]);
  $response->send();