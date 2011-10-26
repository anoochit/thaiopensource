<?
   $siteName = empty($_GET['siteName']) ? 'news' : $_GET['siteName'];

   // Prepare array of tutorial sites
   $siteList = array(
      'news',
      'article',
      'howto',
      'review',
      'blog'
   );
// For security reasons. If the string isn't a site name, just change to 
// nettuts instead.
if ( !in_array($siteName, $siteList) ) {
   $siteName = 'news';
}


$cache = dirname(__FILE__) . "/cache/".$siteName;
// Re-cache every three hours
if (((filemtime($cache)) < (time() - 10800)) OR (!file_exists($cache))) {

   // YQL query (SELECT * from feed ... ) // Split for readability
   $path = "http://query.yahooapis.com/v1/public/yql?q=";
   $path .= urlencode("SELECT * FROM feed WHERE url='http://thaiopensource.org/view/feed/$siteName'");
   $path .= "&format=json";

   // Call YQL, and if the query didn't fail, cache the returned data
   $feed = file_get_contents($path, true);

   var_dump($feed);
   // If something was returned, cache
   //if ( is_object($feed) && $feed->query->count ) {
      $cachefile = fopen($cache, 'wb');
      fwrite($cachefile, $feed);
      fclose($cachefile);
   //}
   
} else {
   // We already have local cache. Use that instead.
   $feed = file_get_contents($cache);
}

// Decode that shizzle
$feed = json_decode($feed);

// Include the view
include('views/site.tmpl.php');

?>
