

<span id="titleForPage" class="hidden"><?php 
		$fileToLoad = '../internal/page-specific/title/' . $_GET['page'] . '.txt';
		if (is_file(dirname(__FILE__) . '/' . $fileToLoad)) {
			require(dirname(__FILE__) . '/' . $fileToLoad);
		} else {
			require(dirname(__FILE__) . '/' . '../internal/page-specific/title/index.txt');
		}
	?></span>
	
<?php 
	require(dirname(__FILE__) . '/' . $_GET['page'] . '.php');
?>

