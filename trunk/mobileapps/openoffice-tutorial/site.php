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
			<a  data-rel="back" data-role="button" data-icon="back" >กลับ</a>
			<h1><?php echo $title; ?></h1>
			
		</header>
		<!-- /header -->
		<div data-role="content">
		
		<ul data-role="listview" data-theme="c" data-dividertheme="d" data-counttheme="e" data-inset="true">
		<?php 
			// list feed entry
			foreach ($rss_feed->entry as $item) {
			$thumb=str_replace("https://www.youtube.com/watch?v=", "", $item->link[0][0]['href']);
			$thumb=str_replace("&feature=youtube_gdata", "", $thumb);
		?>
			<li>
			<a href="vnd.youtube://<?php echo $thumb; //echo $item->link[0][0]['href'];?>">
			<?php
			
				// trim title to perfect display			
				if ($playlist=="87E9BE3AB4A2B957") {
					$feed_title=substr($item->title,strlen("Writer"));
				} else if ($playlist=="E026162FEB61C313") {
					$feed_title=substr($item->title,strlen("Calc"));				
				} else if ($playlist=="A940CE74BC571821") {
					$feed_title=substr($item->title,strlen("Base"));				
				} else if ($playlist=="F64D0F8F6C971927") {
					$feed_title=substr($item->title,strlen("Math"));				
				} else if ($playlist=="64FD4D8999FAF355") {
					$feed_title=substr($item->title,strlen("Macro"));				
				} else if ($playlist=="AD5557164669F31F") {
					$feed_title=substr($item->title,strlen("Impress"));				
				} else if ($playlist=="1BBC0D042C208D5A") {
					$feed_title=substr($item->title,strlen("Draw"));				
				} else {					
					$feed_title=$item->title;
				}
				
				echo $feed_title;
		 	?>
		 	</a>
		 	</li>
		<?php } ?>
		</ul>			
		</div>

		<!-- <footer data-role="footer" data-position="fixed">
			<h4>thaiopensource.org</h4>
		</footer> -->

	</div>
	<!-- /page -->
</body>
</html>