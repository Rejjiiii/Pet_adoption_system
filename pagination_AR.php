<?php
  //include configuration file
  include('db/dbconnect.php');

  $start = 0;
  $per_page = 10;
  $page_counter = 0;
  $next = $page_counter + 1;
  $previous = $page_counter - 1;

  if (isset($_GET['start'])) {
    $start = $_GET['start'];
    $page_counter =  $_GET['start'];
    $start = $start *  $per_page;
    $next = $page_counter + 1;
    $previous = $page_counter - 1;
  }
  // query to get messages from messages table
  $q = "SELECT * FROM adopted LIMIT $start, $per_page";
  $query = $con->prepare($q);
  $query->execute();

  if ($query->rowCount() > 0) {
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
  }
  // count total number of rows in students table
  $count_query = "SELECT * FROM adopted";
  $query = $con->prepare($count_query);
  $query->execute();
  $count = $query->rowCount();
  // calculate the pagination number by dividing total number of rows with per page.
  $paginations = ceil($count / $per_page);
  ?>