<?php require_once ("../includes/functions.php"); ?>
<?php 
session_start();
session_destroy();

header("Location: index.php?valid=logout");
exit();

?>
