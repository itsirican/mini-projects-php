<?php

  require_once "Task.php";

  try {
    $task = new Task(1, "Task 1", "description task 1", "01/01/2026 09:00", "Yf");
    header("Content-Type: application/json;charset=UTF-8");
    echo json_encode($task->returnTaskAsArray());
  } catch(TaskException $ex) {
    echo "Error: ".$ex->getMessage();
  }