
<?php
  // 1. Create a database connection
  define("DB_SERVER", "localhost");
  define("DB_USER", "diupc");
  define("DB_PASS", "diu123");
  define("DB_NAME", "dcms");
  
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }  else {
     // echo 'db';
}  
?> 



