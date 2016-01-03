<?php 
# $pageName let's included files know which subfiles to pull from
$pageName = "sitemap";
require('internal/functions.php');
require('internal/header.php'); 
?>


<body id="body">

<!-- Main Section -->

<div id="mainSection">
		<div id="title" title="Evan Hammer"><span>Evan Hammer</span></div>
		<div id="updateSection">
			<div class="genericHeader"><h2>Sitemap</h2></div>

			<a href="/index.php">Home</a><br />
			<a href="/blog.php">Blog: News, Thoughts, and Ramblings</a><br />
			<a href="/music.php">Music: Bright Day for a Frog's Rebellion (Album Info, Lyrics, and Store)</a><br />
			<a href="/connect.php">Connect with Evan Hammer</a><br />
			<a href="/presskit.php">Press: Reviews &amp; Bio</a><br />
		
			<br /><br />
			
			Lyrics
			

			<br /><br />

			<div >
				<a href="/lyrics/brightday.php">i. bright day</a>
			</div>
			<div >
				<a href="/lyrics/haroldcalled.php">ii. harold called this morning</a>
			</div>
			<div >
				<a href="/lyrics/martinkanes.php">iii. martin kane's magic kandy kanes</a>
			</div>
			<div >
				<a href="/lyrics/hellolove.php">iv. hello love</a>
			</div>
			<div >
				<a href="/lyrics/rascalandabum.php">v. rascal and a bum</a>
			</div>
			<div >
				<a href="/lyrics/littlegirl.php">vi. little girl</a>
			</div>
			<div >
				<a href="/lyrics/whatshewants.php">vii. what she wants with me</a>
			</div>
			<div >
				<a href="/lyrics/lunaticsdown.php">viii. lunatics down</a>
			</div>
			<div >
				<a href="/lyrics/honeypotdelinquents.php">ix. honeypot delinquents</a>
			</div>
			<div >
				<a href="/lyrics/abarrenblue.php">x. a barren blue</a>
			</div>
		</div>

		<br /><br />
		
		<?php 
			# footer
			require('internal/footer.php'); 
		?>
		
		
</div>

<!-- End Main -->

<?php 
# main menu navigation
require('internal/menu.php'); 
echo "\n\n\n";

?>

</body>
</html>