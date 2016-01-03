<!-- Music Player Section -->

<div id="musicWrapper">
	<div id="musicplayerWrapper">
		<ul id="songList">
<?php
		
		// set the XML file name as a PHP string
		$mySongList = dirname(__FILE__) . "/../musicplayer/config2.xml"; 
		// load the XML file 
		$xml = @simplexml_load_file($mySongList); 
		//store first song for loading player
		foreach ($xml->song as $song) {
			echo "			<li id=\"song-" . $song->tag . "\" class=\"song musicPlayerSong\"><a>" . $song->name . "</a></li>\n";
		}
?>
		</ul>
		<div id="musicplayer"><a href="http://www.macromedia.com/go/getflashplayer" title="evan hammer's music" >Get Flash </a>to see this mp3 player.</div>
		
	</div>
</div>

<!-- End Music Player -->