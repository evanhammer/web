<?php

# SET UP XML OBJECT. (ONLY CHANNEL)
$xmlObjRSS = simplexml_load_file("http://www.evanhammer.com/blog/category/news/feed/");
$xmlObjChannel = $xmlObjRSS -> channel;

$tempCounter = 0;
$max = 6;
foreach ( $xmlObjChannel -> item as $item )
{                    
		# DISPLAY ONLY $max ITEMS.
    if ( $tempCounter <= $max )
    {
			#$titleEdited = htmlentities($item -> title);
			$titleEdited = $item -> title;
      echo "<div class=\"rssItem genericItem\"><h3><a href=\"{$item -> link}\" target=\"_blank\">" . $titleEdited . "</a></h3><br />\n";
			#DATE DISPLAY/FORMATTING
			$dateTime = new DateTime($item -> pubDate, new DateTimeZone('GMT'));
			$dateTime->setTimezone(new DateTimeZone('America/New_York'));
 			$amorpm = $dateTime->format("a");
			$formattedDate = strtolower(($dateTime->format("Y.m.d D g:i")) . $amorpm[0]);
			echo "<h6>posted {$formattedDate}</h6><br /><br />\n";

			$content = $item -> children('http://purl.org/rss/1.0/modules/content/') -> encoded;
			#echo "<h5>{$content}</h5><h6><br />-evan</h6>
			echo "<div class=\"h5\">{$content}</div>\n";
			if ($tempCounter != $max) {
				echo "</div>\n";
			} else {
				echo "</div>\n";
			}
    }

    $tempCounter += 1;
}

?>

