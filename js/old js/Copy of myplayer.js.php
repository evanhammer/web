<?php
	Header("content-type: application/x-javascript");

	//load the main music files into the player
	
	// set the XML file name as a PHP string
	$mySongList = "../musicplayer/config2.xml"; 
	// load the XML file 
	$xml = @simplexml_load_file($mySongList); 
	//store first song for loading player
	echo "//songs contains all song information\n";
	echo "var songs = [\n";
	$output = "";
	foreach ($xml->song as $song) {
		$output .= "	{\"name\": \"" . $song->name . "\", \"location\": \"" . $song->location . "\"},\n";
	}
	echo substr($output,0,strlen($output) - 2) . "\n";
	echo "];";
?>


//for clearInterval
var timerId; 

//to store current song that is playing
var currentSongId="";
var firstSong = "song0";

//loads initial song, but doesn't play it
function initialLoadSong(songToUse) {
	this.obj = FlashHelper.getMovie(name);
	if (!FlashHelper.movieIsLoaded(this.obj)) {
		clearInterval(timerId);
		currentSongId = songToUse;
		$(currentSongId).addClass('loaded');
		loadSong(currentSongId.replace("song",""), false);
	}
}

//loadPlayer loads a swf music player
function loadPlayer() {
	var params = {
		bgcolor: "#353f6a",
		quality: "high"
	};
	swfobject.embedSWF("/musicplayer/niftyplayer.swf", "musicplayer", "165", "38", "6,0,0,0", false, false, params);
	
	//load first song after a short wait to give the swf time to load
	var timerId = setInterval("initialLoadSong(firstSong)", 400);
	setTimerId(timerId);
		
	$('.song').click(function() {
		loadSong(this.id.replace("song",""), true);
	});
	
}

//loads and potentially plays a song by song id
function loadSong(id, play) {
	niftyplayer('musicplayer').load(songs[id].location);
	var oldSongId = currentSongId;
	$('#' + oldSongId).removeClass('loaded');
	currentSongId = 'song' + id;
	$('#' + currentSongId).addClass('loaded');
	niftyplayer('musicplayer').registerEvent('onSongOver', 'nextSong(' + id + ')');
	if (play) {
		niftyplayer('musicplayer').play();
	}
}

//manages switching to next song
function nextSong(currSong) {
	if (currSong >= songs.length - 1) {
		currSong = 0;
	} else {
		currSong++;
	}
	loadSong(currSong, true);
}

//makes sure that the clearInterval can function
function setTimerId(theId) {
	timerId = theId;
}