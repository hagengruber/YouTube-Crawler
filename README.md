# YouTube-Crawler
PHP-Klasse, die eine bestimmte Anzahl an neu erschienenen Videos eines YouTubers zurückgibt.
<br><a href="https://implod3.github.io/YouTube-Crawler" target="_blank"> View Github Page </a>

## Voraussetzungen

Der YouTube-Crawler benötigt, abgesehen von einer Internetverbindung, <b>keine</b> zusätzlichen Software.

## Installation

Die Datei 'youtube-crawler.php' in die PHP-Script einbinden und die Funktion 'new_video' aufrufen:

<code> include_once('./YouTube-Crawler/youtube-crawler.php'); </code> <br>
<code> $y = new ytcrawler; </code> <br>
<code> $links = $y->new_video('https://www.youtube.com/user/MrSuicideSheep', 10); </code> <br>
<code> for($i = 0; $i != count($links); $i++) </code> <br>
<code> echo 'Link: ' . $links[$i]['link'] . '<br>' . 'Name: ' . $links[$i]['name'] . '<br><br>'; </code>
<br><br>
Als Übergabeparameter wird der Link des YouTubers und die Anzahl an Videos übergeben.
