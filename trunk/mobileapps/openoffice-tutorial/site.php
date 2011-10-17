<?php

include ("includes/header.php");

$playlist= $_GET['pl'];
$title= $_GET['title'];

$path="https://gdata.youtube.com/feeds/api/playlists/".$playlist."?v=2";



if (file_exists(dirname(__FILE__)."/cache/".$playlist)) {
	// if file modified date not over 3 hours	
	$mtime=filemtime(dirname(__FILE__)."/cache/".$playlist);
	if ($mtime < (time()- 10800)) {
		// make cache again
		$fcontent = file_get_contents($path, true);
		$fp=fopen(dirname(__FILE__)."/cache/".$playlist,"wb");
		fwrite($fp, $fcontent);
		fclose($fp);
	} 
 	$fcontent = file_get_contents(dirname(__FILE__)."/cache/".$playlist, true);
	
	
} else { 
	
	$fcontent = file_get_contents($path, true);
	$fp=fopen(dirname(__FILE__)."/cache/".$playlist,"wb");
	fwrite($fp, $fcontent);
	fclose($fp);
} 

$rss_feed = simplexml_load_string($fcontent);


?>
<body>
	<div data-role="page">
		<header data-role="header">
			<a  data-rel="back" data-role="button" data-icon="back" >Back</a>
			<h1><?php echo $title; ?></h1>
			
		</header>
		<!-- /header -->
		<div data-role="content">
		
		<ul data-role="listview" data-theme="c" data-dividertheme="d" data-counttheme="e" data-filter="true" data-inset="true">
		<?php 
			foreach ($rss_feed->entry as $item) {
			$thumb=str_replace("https://www.youtube.com/watch?v=", "", $item->link[0][0]['href']);
			$thumb=str_replace("&feature=youtube_gdata", "", $thumb);
		?>
			<li>
			<a href="<?php echo $item->link[0][0]['href'];?>">
			<?php 
			echo $item->title;
		 	?>
		 	</a>
		 	</li>
		<?php } ?>
		</ul>			
		</div>

		<footer data-role="footer">
			<h4>thaiopensource.org</h4>
		</footer>

	</div>
	<!-- /page -->
</body>
</html>