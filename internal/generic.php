<?php 
require('functions.php');
require('header.php'); 
?>


<body id="body" class="<?php echo $pageName; ?>">

<?php 
	# invisible images to load are at imageLoad.xml
	require('imageLoad.xml'); 
?>



<!-- Main Section -->

<div id="mainSection">
		<div id="title" title="Evan Hammer"><span>Evan Hammer</span></div>
		<div id="updateSectionContainer">
			<div id="mailingListWrapper"><div>
<?php
			# short mailing list form
			require(dirname(__FILE__) . '/' . '../internal/mailinglistShort.html');
			echo "\n\n\n";
?>
			</div></div>
		
			<div id="updateSection">
		
<?php 
	# home page
	requireFileOrDefault($pageLocation, '../external/index.php');
?>
		
			</div>
		</div>

		<br /><br />
		
<?php 
	# footer
	require('footer.php'); 
?>
		
		
</div>

<!-- End Main -->

<?php 
# main menu navigation
require('menu.php'); 
echo "\n\n\n";

echo "<div id=\"sidebarWrapper\">";

# social badges section
require('socialBadges.html'); 
echo "\n\n\n";

# music player section
require('musicplayer.php'); 
echo "\n\n\n";

echo "</div>";

?>

</body>
</html>