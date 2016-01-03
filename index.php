<?php 
# $pageName let's included files know which subfiles to pull from
$pageName = "index";
# $pageLocation is required by generic.php to find the main included section
$pageLocation = "../external/" . $pageName . ".php";
require('internal/generic.php');
?>
