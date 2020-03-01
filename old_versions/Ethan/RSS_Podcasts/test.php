<?php

require_once('vendor/dg/rss-php/src/Feed.php');

$url = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";

$rss = Feed::loadRss($url);

echo 'Title: ', $rss->title;
echo 'Description: ', $rss->description;
echo 'Link: ', $rss->link;

foreach ($rss->item as $item) {
	echo 'Title: ', $item->title;
	echo 'Link: ', $item->link;
	echo 'Timestamp: ', $item->timestamp;
	echo 'Description ', $item->description;
	echo 'HTML encoded content: ', $item->{'content:encoded'};
}

//$atom = Feed::loadAtom($url);

Feed::$cacheDir = __DIR__ . '/tmp';
Feed::$cacheExpire = '5 hours';

?>
