<?php 
require('functions.php');
require('header.php'); 
?>


<body id="body" class="<?php echo $pageName; ?>">

<?php 
	# invisible images to load are at imageLoad.xml
	# require('imageLoad.xml'); 
?>



<!-- Main Section -->

<div id="mainSection">
		<div id="title" title="Evan Hammer"><span>Evan Hammer</span></div>
		<div id="updateSectionContainer">
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

<!-- Mailing List Section -->
<!-- <div id="functContainer">
	<div id="functMain">
		<div id="innerMain">
<?php
			# mailing list form
			#require('mailinglist.html'); 
			#echo "\n\n\n";
?>
			<div id="listHider"><span id="listHiderText">(or collapse back up)</span></div>
		</div>
		<span id="innerFunctImg">click here to join the mailing list</span>
	</div>
	<!-- <div id="functImg"></div> -->
<!-- </div> -->
<!-- End Mailing List -->

<?php
# google tracker javascript section
# require('googleTracker.xml'); 
?>

</body>
</html>