# YouTube-Crawler
PHP-Klasse, die eine bestimmte Anzahl an neu erschienenen Videos eines YouTubers zurückgibt.
<br><a href="https://implod3.github.io/YouTube-Crawler" target="_blank"> View Github Page </a>

## Voraussetzungen

Der YouTube-Crawler benötigt, abgesehen von einer Internetverbindung, <b>keine</b> zusätzlichen Software.

## Installation - In PHP Datei einbinden

Die Datei 'youtube-crawler.php' in die PHP-Script einbinden und die Funktion 'new_video' aufrufen. <br>
<b> Diese Methode belastet die Performance der Website enorm </b>

<code> include_once('./YouTube-Crawler/youtube-crawler.php'); </code> <br>
<code> $y = new ytcrawler; </code> <br>
<code> $links = $y->new_video('https://www.youtube.com/user/MrSuicideSheep', 10); </code> <br>
<code> for($i = 0; $i != count($links); $i++){ </code> <br>
<code> echo ' </code> <br>
<code> &lt;a href="' . $links[$i]['link'] . '"> </code>
<code> &lt;img src="' . $links[$i]['thumbnail'] . '"&gt;' . $links[$i]['name'] . ' </code>
<code> &lt;/a&gt; </code>
<code> &lt;br&gt; </code> <br>
<code> '; </code> <br>
<code> } </code>


## Installation - Als Ajax-Schnittstelle verwenden

Mit XMLHttpRequest 'yt_Request' und 'count' als FormData() per POST an die 'youtube-crawler.php' senden. <br>
Die Daten werden als JSON-Array an die JavaScript-Datei mit dem Status '200 OK' zurückgesendet.<br>
<b> Da das Script asynchron mit dem Laden der Website läuft, wird die Performance dadurch nicht beeinträchtigt </b>

<code> &lt;script&gt; </code> <br> <br>
<code> var request = new XMLHttpRequest; </code> <br> <br>
<code> var data = new FormData(); </code> <br>
<code> data.append('yt_Request', 'https://www.youtube.com/user/MrSuicideSheep'); </code> <br>
<code> data.append('count', 5); </code> <br> <br>
<code> request.addEventListener('load', function(event) { </code> <br> <br>
<code> var jsonData = JSON.parse(request.responseText); </code> <br> <br>
<code> for (var i = 0; i < jsonData.length; i++) { </code> <br> <br>
<code> var data = jsonData[i]; </code> <br>
<code> console.log(data.link); </code> <br>
<code> console.log(data.name); </code> <br>
<code> console.log(data.thumbnail); </code> <br> <br>
<code> } </code> <br> <br>
<code> }); </code> <br> <br>
<code> request.open('POST', './YouTube-Crawler/youtube-crawler.php'); </code> <br>
<code> request.send(data); </code> <br> <br>
<code> &lt;/script&gt; </code> <br>


<br><br>
Als Übergabeparameter wird der Link des YouTubers und die Anzahl an Videos übergeben.
