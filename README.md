# YouTube-Crawler
PHP-Klasse, die eine bestimmte Anzahl an neu erschienenen Videos eines YouTubers zurückgibt.
<br><a href="https://implod3.github.io/YouTube-Crawler" target="_blank"> View Github Page </a>

## Voraussetzungen

Der YouTube-Crawler benötigt, abgesehen von einer Internetverbindung, <b>keine</b> zusätzlichen Software.

## Installation

Die Datei 'youtube-crawler.php' in dein PHP-Script einbinden und die Funktion 'new_video' aufrufen:

<code>
<?php
	
	include_once('./YouTube-Crawler/youtube-crawler.php');
	
	$y = new ytcrawler;
	
	$links = $y->new_video('https://www.youtube.com/user/MrSuicideSheep', 10);
	
	for($i = 0; $i != count($links); $i++)
		echo 'Link: ' . $links[$i]['link'] . '<br>' . 'Name: ' . $links[$i]['name'] . '<br><br>';
	
?>
</code>