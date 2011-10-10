<?php

$siteName = $_GET['siteName'];
$origLink = $_GET['origLink'];

$path="http://query.yahooapis.com/v1/public/yql?q=SELECT%20*%20FROM%20feed%20WHERE%20url%3D%22http%3A%2F%2Fthaiopensource.org%2Fview%2Ffeed%2F".$siteName."%22%20AND%20guid%3D%22".urlencode($origLink)."%22&format=json";
$feed = json_decode(file_get_contents($path));
$feed = $feed->query->results->item;

include('views/article.tmpl.php'); 

?>
