<?php
# main navigation menu
# depends on global variable $pageName (index-album-presskit

# each menu item is of the format (file_name, id, display_name, title)
$indexPage = array('index', 'index', 'home', 'Come Home');
$blogPage = array('blog', 'blog', 'blog', 'The Blog: Thoughts, Ramblings, and News');
$musicPage = array('music', 'music', 'music', 'Music, Lyrics, Info, Store');
$connectPage = array('connect', 'connect', 'connect', 'Mailing List, Social Networks, Contact Info');
# $storePage = array('store', 'store', 'store', 'Store');
$presskitPage = array('presskit', 'presskit', 'press', 'Reviews &amp; Bio');

#array of all menu items
$menuItems = array($indexPage, $blogPage, $musicPage, $connectPage, $presskitPage);
?>

<!-- Menu Section -->

<div id="menuContainer">
	<div id="logoImg" class="titleObject"></div>
	<div id="menu">
<?php 
	# create a menuItem for each item in the declared array
	foreach ($menuItems as $m) {
		if ($pageName == $m[0]) {
?>
		<div class="menuItem" id="<?php echo $m[1]; ?>">
			<a title="<?php echo $m[3]; ?>" class="<?php echo $m[1]; ?>"><span><?php echo $m[2]; ?></span></a>
		</div>
<?php
		} else {
?>
		<div class="menuItem" id="<?php echo $m[1]; ?>">
			<a href="/<?php echo $m[0]; ?>.php" title="<?php echo $m[3]; ?>" class="<?php echo $m[1]; ?>"><span><?php echo $m[2]; ?></span></a>
		</div>
<?php 
		} 
	}
?>
	</div>
</div>

<!-- End Menu -->