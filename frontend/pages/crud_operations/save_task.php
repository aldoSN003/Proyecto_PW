<?php


include("../connection.php");

if (isset($_POST['save_task'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $query = "INSERT INTO task(title, description) VALUES ('$title', '$description')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['user']['message'] = 'Task Saved Successfully';
  $_SESSION['user']['message_type'] = 'success';
  header('Location: ../welcome.php');

}


