<?php
	Header("content-type: application/x-javascript");

	//load the main music files into the player
	
	//----------THIS SECTION LOADS THE ACTIVE SONG LIST-----
	// set the XML file name as a PHP string
	$mySongList = "../musicplayer/config.xml"; 
	// load the XML file 
	$xml = @simplexml_load_file($mySongList); 
	//store first song for loading player
	echo "//allSongs contains all song information\n";
	echo "var allSongs = [\n";
	$output = "";
	$arrayCount = 0;
	foreach ($xml->song as $song) {
		$output .= "	{\"name\": \"" . $song->name . "\", \"location\": \"" . $song->location . "\",\"tag\": \"" . $song->tag . "\"},\n";
		$arrayCount++;
	}
	echo substr($output,0,strlen($output) - 2) . "\n";
	echo "];\n\n";
	//----------------------------------------------------------------------------------
	
	//----------THIS SECTION LOADS THE ENTIRE SONG LIST-----
	// set the XML file name as a PHP string
	$mySongList2 = "../musicplayer/config2.xml"; 
	// load the XML file 
	$xml2 = @simplexml_load_file($mySongList2); 
	//store first song for loading player
	echo "//songs contains active song information\n";
	echo "var songs = [\n";
	$output = "";
	$arrayCount = 0;
	foreach ($xml2->song as $song) {
		$output .= "	{\"name\": \"" . $song->name . "\", \"location\": \"" . $song->location . "\",\"tag\": \"" . $song->tag . "\",\"id\": \"" . $arrayCount . "\"},\n";
		$arrayCount++;
	}
	echo substr($output,0,strlen($output) - 2) . "\n";
	echo "];";
	//----------------------------------------------------------------------------------
?>


//for clearInterval
var timerId; 

//to store current song that is playing
var currentSongId="";
var firstSong = "haroldcalled";
var maxId="2";

//loads initial song, but doesn't play it
function initialLoadSong(songToUse) {
	this.obj = FlashHelper.getMovie(name);
	if (!FlashHelper.movieIsLoaded(this.obj)) {
		clearInterval(timerId);
		currentSongId = songToUse;
		$(currentSongId).addClass('loaded');
		loadSongByTag(currentSongId.replace("song-",""), false);
	}
	
	//loads the google tracking for the player
	//category: Music
	//action: play, stop, finished
	//label: song name
	//SONG OVER is below
	niftyplayer('musicplayer').registerEvent('onPlay', 'googleEventLoader(\'Music\',\'Play\',tagToSong(currentSongId.replace(\'song-\',\'\')).name);');
	niftyplayer('musicplayer').registerEvent('onPause', 'googleEventLoader(\'Music\',\'Stop\',tagToSong(currentSongId.replace(\'song-\',\'\')).name);');
	niftyplayer('musicplayer').registerEvent('onStop', 'googleEventLoader(\'Music\',\'Stop\',tagToSong(currentSongId.replace(\'song-\',\'\')).name);');
}

//loadPlayer loads a swf music player
function loadPlayer() {
	var params = {
		bgcolor: "#353f6a",
		quality: "high",
		wmode: "transparent"
		
	};
	swfobject.embedSWF("/musicplayer/niftyplayer.swf", "musicplayer", "168", "38", "6,0,0,0", false, false, params);
	
	//load first song after a short wait to give the swf time to load
	var timerId = setInterval("initialLoadSong(firstSong)", 800);
	setTimerId(timerId);

	loadAllSongs();
}

//makes sure all song links work
function loadAllSongs() {
	$('.song').click(function() {
		loadSongByTag(this.id.replace("song-",""), true);
	});
	
}

//loads and potentially plays a song by song tag
function loadSongByTag(tag, play) {
	var songToPlay = tagToSong(tag);
	
	// if the song DOES NOT exist in the queue then add it
	if (songToPlay == "") {
		songToPlay = createNewSongEntry(tag);
	}
	
	//then load/play song
	loadSongBySong(songToPlay, play);
}

//converts a tag into a song
function tagToSong(tag) {
	var songToReturn = "";
	for(var i = 0; i < songs.length; i++) {
		if (songs[i].tag == tag) {
			songToReturn = songs[i]; 
			break;
		}
	}
	return songToReturn;

}
//loads and potentially plays a song by song location
function loadSongBySong(songToLoad, play) {
	niftyplayer('musicplayer').load(songToLoad.location);
	var oldSongId = currentSongId;
	$('#' + oldSongId).removeClass('loaded');
	currentSongId = 'song-' + songToLoad.tag;
	$('#' + currentSongId).addClass('loaded');
	//load next song and create te finished song handler for google tracking
	niftyplayer('musicplayer').registerEvent('onSongOver', 'nextSong(' + songToLoad.id + '); googleEventLoader(\'Music\',\'Finished\',\'' + songToLoad.name + '\');');
	if (play) {
		niftyplayer('musicplayer').play();
	}
}

//manages switching to next song
function nextSong(currSongId) {
	if (currSongId >= songs.length - 1) {
		currSongId = 0;
	} else {
		currSongId++;
	}
	loadSongBySong(songs[currSongId], true);
}

function createNewSongEntry(songToLoadTag) {
	//get info from allSongs
	var newSong = "";
	for (var i = 0; i < allSongs.length; i++) {
		if (allSongs[i].tag == songToLoadTag) {
			newSong = allSongs[i];
			break;
		}
	} //assume it was found
	
	//add it to visible list
	$('#songList').append($('<li></li>').addClass('song musicPlayerSong').attr('id','song-' + songToLoadTag).append('<a>' + newSong.name + '</a>'));
	
	//add it to javascript list
	var newId = songs.length;
	songs.push({"name" : newSong.name, "location" : newSong.location, "tag" : newSong.tag, "id": newId});
	
	//makes sure this link now works
	loadAllSongs();
	
	return songs[newId];
}
//makes sure that the clearInterval can function
function setTimerId(theId) {
	timerId = theId;
}