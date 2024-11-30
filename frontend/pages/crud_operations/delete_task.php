<?php

include("../connection.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM task WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['user']['message'] = 'Task Removed Successfully';
  $_SESSION['user']['message_type'] = 'danger';
  header('Location: ../welcome.php');

}

?>
