//converts track code into useable name
var trackMapping = [ {"number" : "1204431", "name" : "brightday"}, {"number" : "1202164", "name" : "haroldcalled"},{"number" : "1204434", "name" : "martinkanes"},{"number" : "1202173", "name" : "hellolove"},{"number" : "1204507", "name" : "rascalandabum"},{"number" : "1204518", "name" : "littlegirl"},{"number" : "1204519", "name" : "whatshewants"},{"number" : "1204520", "name" : "lunaticsdown"},{"number" : "1204522", "name" : "honeypotdelinquents"},{"number" : "1204523", "name" : "abarrenblue"}];

//single load google trackings
var initialGoogleTrackingsLoaded = false;

//using jQuery
$(document).ready(function(){

	//load music player on initial page load, function is in myplayer.js.php
	loadPlayer();
	
	//creates special onclick links at start
	$('#menu a[href]').click(function() {
		sendRequest(this.href, 'updateSection', this.className); return false;
  });
	 
	//load special onclicks if appropriate page
	activateSpecialOnclicks();
	
	//loads short Form mailing list
	activateShortMailingList();
	
	//googletracking
	gaSSDSLoad("UA-6096453-1");
	
	//createGoogleLinks 
	createGoogleLinks();
	
	//load single google links
	$('.socialBadgeLink').click(function() {
		pageTracker._trackEvent('Outbound Clicks',this.title,'From Badge');
	});
	
	//fade frog in and out
	//var timeToFade = 10000;
	//$('#logoImg').fadeTo(timeToFade,.1).fadeTo(timeToFade,1);
	//setInterval('$(\'#logoImg\').fadeTo(10000,.1).fadeTo(10000,1);', 20000);
});

function activateSpecialOnclicks() {
	//hide jHidden Classes
	$('.jHidden').css({'display' : 'none'});
	$('.jInvisible').css({'visibility' : 'hidden'});
	
	// if title page then set onclick for albumLink
	//$('#albumLink a').click(function() {
  //  sendRequest(this.href, 'updateSection', this.className); return false;
  //});

	// if music page then set onclick for lyrics pages
	$('#tracks a').click(function() {
    sendRequest(this.href, 'updateSection', this.className); return false;
  });
	$('#trackList .lyricsListItem a').click(function() {
    sendRequest(this.href, 'updateSection', this.className); return false;
  });
	
	//if music page then make sure all play links work
	loadAllSongs();
	
	// if music page then set extended info links
	$('#albumInfoExtender a').click(function() {
		$('#albumExtendedInfo').fadeIn('slow');
		$('#albumInfoExtender').fadeOut('slow');
		return false;
  });
	
	//if music page then make sure purchase button display works
	$('#mp3SelectForm input:checkbox').click(function() {
		$('#buySelectedMP3sLink').fadeIn('slow');
		return true;
	});
	
}


//updateCurrentDisplay(newClassName) uses the class name to decide which links should be active
// and any other new page load updates
function updateCurrentDisplay(newClassName) {

	//get current class from body
	var currClassName = document.getElementById('body').className;
	var newMenu = $('#' + newClassName + ' a');
	var currMenu = $('#' + currClassName + ' a');
	//disable recently used link
	newMenu.removeAttr('href').unbind('click');
	
	//hide switching links and then switch body classes, and create a link out of current menu, then show links
	if($('#' + newClassName).length > 0) {
		$('#' + newClassName).fadeOut(400, function() {
			$('body').removeClass(currClassName).addClass(newClassName);
			currMenu.attr('href','/' + currClassName + '.php');
			currMenu.click(function() {
				//$('#updateSection').load("/external/" + newClassName + ".php", '', alert('me'));
				sendRequest(this.href, 'updateSection', this.className); return false;
			});
			$('#' + newClassName).fadeIn(1000);	
		});
	} else { // if there is no newClassName, then still reset current objects
		$('body').removeClass(currClassName).addClass(newClassName);
		currMenu.attr('href','/' + currClassName + '.php');
		currMenu.click(function() {
			//$('#updateSection').load("/external/" + newClassName + ".php", '', updateCurrentDisplay(this.className));
			sendRequest(this.href, 'updateSection', this.className); return false;
		});
	}
	
	//create special page onclicks
	activateSpecialOnclicks();
	
	//load longform mailing list focus abilities
	activateLongMailingList();
	
	//send user to top of page (#mainSection)
	var currLocation = window.location;
	var tempLocation = currLocation + "";
	var newLocation = tempLocation.replace("#mainSection","");
	window.location = newLocation + "#mainSection";
		
	//update title
	var tempTitle = $("#titleForPage").html();
	if (tempTitle != "") {
		document.title = tempTitle;
	}
	
	//send new page load to google analytics
	pageTracker._trackPageview("/" + newClassName + ".php");
	
	//create any google links for this new page
	createGoogleLinks();
	
}

//sendRequest and requestDone - this set passes new class name
function sendRequest(url, target, newClassName) {
	try {
    if (window.XMLHttpRequest) {
      req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
      req = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (req != undefined) {
    req.onreadystatechange = function() 
			{
				requestDone(url, target, newClassName);
			};
			req.open("GET", "/external/pageLoader.php?page=" + newClassName, true);
      req.send(null);
    }
  } catch (e) {}
}

function requestDone(url, target, newClassName) {
	if (req.readyState == 4) { // only if req is "loaded"
		if (req.status == 0 || req.status == 200) { // only if "OK" OR "0" on local
			var updatingObj = $('#' + target);
			updatingObj.fadeOut(300, function() {
				updatingObj.html(req.responseText);
				updateCurrentDisplay(newClassName);
				updatingObj.fadeIn(1000);
			});
			//document.getElementById(target).innerHTML = req.responseText;
			
		} 
	}
}

//validatePayForm validates form before submitting to buy
function validatePayForm(form) { 
	var flag;
	flag=0;
	if(document.form1.chk.length!=undefined) {
		for(i=0; i<document.form1.chk.length; i++) {
			if (document.form1.chk[i].checked ) { 
				flag=1;
			}
		}
	}
	else {
		if (document.form1.chk.checked) { 
			flag=1;
		}
	}
	if (flag==0) {
		alert("Please Select at least one Song "); 
		return false;
	}
	return true;
}

//makes sure that the mailing list works
function activateShortMailingList() {
	$('.mailFormSec #emailShort').focus(function() {
		if (this.value == 'email') {
			this.value="";
		}
	});
	
	$('.mailFormSec #zipShort').focus(function() {
		if (this.value == 'zip') {
			this.value="";
		}
	});
	
		$('.mailFormSec #emailShort').blur(function() {
		if (this.value == '') {
			this.value='email';
		}
	});
	
	$('.mailFormSec #zipShort').blur(function() {
		if (this.value == '') {
			this.value = 'zip'
		}
	});
	
	$('#shortFormSubmit').click(function() {
		$('#shortMailingListForm .mailingListForm').fadeOut('slow', function() {
			$('#downloadLinkShort').fadeIn('slow');
		});
	});
}

//makes sure that the mailing list works
function activateLongMailingList() {
	$('.mailFormSec #email').focus(function() {
		if (this.value == 'email') {
			this.value="";
		}
	});
	
	$('.mailFormSec #zip').focus(function() {
		if (this.value == 'zip') {
			this.value="";
		}
	});
	
		$('.mailFormSec #email').blur(function() {
		if (this.value == '') {
			this.value='email';
		}
	});
	
	$('.mailFormSec #zip').blur(function() {
		if (this.value == '') {
			this.value = 'zip'
		}
	});
	
	$('#longFormSubmit').click(function() {
		$('#downloadLink').fadeIn('slow');
	});	
}

/* acct is GA account number, i.e. "UA-6096453-1" */
function gaSSDSLoad (acct) {
  var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www."),
      s;
  s = document.createElement('script');
  s.src = gaJsHost + 'google-analytics.com/ga.js';
  s.type = 'text/javascript';
  s.onloadDone = false;
  function init () {
    pageTracker = _gat._getTracker(acct);
    pageTracker._trackPageview();
  }
  s.onload = function () {
    s.onloadDone = true;
    init();
  };
  s.onreadystatechange = function() {
    if (('loaded' === s.readyState || 'complete' === s.readyState) && !s.onloadDone) {
			s.onloadDone = true;
      init();
    }
  };
  document.getElementsByTagName('head')[0].appendChild(s);
}

//load all google links and events for tracking
function createGoogleLinks() {
	//google tracking already works for page updates
	
	//google track outbound links (social sites, badge
	//category: Outbound Clicks
	//label: [destination]
	//label: From Badge, From Connect, From Blog
	//NOTE: BADGES ARE ONLY DONE ONCE IN LOADING SECTION
	$('.trackedLinkOnConnect').click(function() {
		pageTracker._trackEvent('Outbound Clicks',this.id,'From Connect');
	});
	$('.rssItem a').click(function() {
		pageTracker._trackEvent('Outbound Clicks',this.href,'From Blog');
	});
	
	//google tracking for player
	//IS IN MYPLAYER.JSP.PHP for delayed load
		
	//google track music expand
	//as a page view
	$('#albumInfoExtender a').click(function() {
		pageTracker._trackPageview("/album.php - extended");
	});
	
	//google track mailing list / download
	//category: Mailing List
	//action: Sign Up,  Free Song Download
	//label: Short Form, Long Form, Page
	if (!initialGoogleTrackingsLoaded) {
		$('#shortMailingListForm .mailFormSubmit').click(function() {
			pageTracker._trackEvent('Mailing List','Sign Up', 'Short Form - ');
		});
		$('#downloadLinkShort').click(function() {
			pageTracker._trackEvent('Mailing List','Free Song Download','Short Form - ');
		});
	}
	$('#longMailingListForm .mailFormSubmit').click(function() {
		pageTracker._trackEvent('Mailing List','Sign Up', 'Long Form');
	});
	$('#downloadLink').click(function() {
		pageTracker._trackEvent('Mailing List','Free Song Download','Long Form');
	});
	
	//google track bio grabs
	//Category: Press
	//Action: Full Bio Download
	$('#fullbio').click(function() {
		pageTracker._trackEvent('Press','Full Bio Download');
	});
	
	//google track purchase button movement (check boxes, all purchase buttons)
	//Category: Store
	//Action: Select Track, Unselect Track, Buy Track, Number Selected, Buy MP3 Album, Buy CD, Third Party Store
	//Label: [track name], <emtpy>, BDFAFR, Amazon MP3, iTunes
	//Value: For 'Number Selected', the number selected
	$('.trackListItem input').click(function() {
		if (this.checked == true) {
			pageTracker._trackEvent('Store','Select Track',$('a',$(this).parent()).html());
		} else {
			pageTracker._trackEvent('Store','Unselect Track',$('a',$(this).parent()).html());
		}
	});
	$('#mp3SelectForm').submit(function() {
		isValid = validatePayForm(this);
		if (isValid) {
			//get selected track info
			var selectedTracks = $('#mp3SelectForm input:checkbox:checked').map(function () { return this.value;}).get();
			
			//convert number to name
			for(i=0; i<selectedTracks.length; i++) {
				var currName = "";
				for (j=0; j<trackMapping.length; j++) {
					if (trackMapping[j].number == selectedTracks[i]) {
						currName = trackMapping[j].name;
						break;
					}
				}
				//send off all Buy Track events
				pageTracker._trackEvent('Store','Buy Track',currName);
			}
			
			//send off a total number selected action
			pageTracker._trackEvent('Store','Number Selected','',selectedTracks.length);
		}
		return isValid;
	});
	$('#buyMP3AlbumLink').click(function() {
		pageTracker._trackEvent('Store','Buy MP3 Album','BDFAFR');
	});
	$('#buyCDForm').submit(function() {
		pageTracker._trackEvent('Store','Buy CD','BDFAFR');
	});
	$('#amazonmp3').click(function() {
		pageTracker._trackEvent('Store','Third Party Store','Amazon MP3');
	});
	$('#itunes').click(function() {
		pageTracker._trackEvent('Store','Third Party Store','iTunes');
	});
	
	
	//adds google tracking to the martin kanes download
	$('#ETMK').click(function() {
		pageTracker._trackPageview('/mp3s/listens/MartinKanes');
  });
	$('#ETMK').rightClick(function() {
		pageTracker._trackPageview('/mp3s/downloads/MartinKanes');
  });
	
	//google links has now been loaded once (so dont allow reloading certain functions
	initialGoogleTrackingsLoaded = true;
}

function googleEventLoader(category, action, label) {
	pageTracker._trackEvent(category,action,label);
}