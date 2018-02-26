<?php 

  //--------------------------------------------------------------------------
  // Simple API for retrieving a random secret and associated comments from DB
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "";
  $pass = "";

  $databaseName = "secret";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  $connection = mysqli_connect($host,$user,$pass,$databaseName);
  $database = mysqli_select_db($connection,$databaseName);

  //--------------------------------------------------------------------------
  // 2) Query our database for the data
  //--------------------------------------------------------------------------
  $secret_id_query   = mysqli_query($connection, "select id from secret order by rand() limit 1");
  $secret_id_results = mysqli_fetch_all($secret_id_query);
  $secret_id = $secret_id_results[0][0];
  
  $randomSecret  = mysqli_query( $connection, "select * from secret where id = $secret_id;");      
  $secretAsArray = mysqli_fetch_all($randomSecret, MYSQLI_ASSOC);
  
  
  $relevantComments = mysqli_query($connection, "select * from comment where secret_id = $secret_id;");
  $commentsAsArray  = mysqli_fetch_all($relevantComments, MYSQLI_ASSOC);

  $combined_results = array_merge($secretAsArray, $commentsAsArray);
  
  //--------------------------------------------------------------------------
  // 3) return result as json 
  //--------------------------------------------------------------------------
  echo json_encode($combined_results);

?>
