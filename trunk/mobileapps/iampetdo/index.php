<?php

include ("includes/header.php");

// load rss feed

$path="http://iampetdo.com/rss.xml";
$playlist="iampetdo.xml";

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
		<header data-role="header" data-theme="a">
			<h1>I am Petdo!</h1>
		</header>
		<!-- /header -->
		<div data-role="content">
			<ul data-role="listview" data-theme="d" data-dividertheme="d">
			<?php 
				$id=0;
				foreach ($rss_feed->channel->item as $item) {					
			?>
				<li>
					<a href="page.php?id=<?php echo $id; ?>" >
					<?php  
						echo $item->title; 
						$description=$item->description;
						preg_match_all('/<img[^>]+>/i',$description, $result);
						echo $result[0][0];
					?>					
					</a>
					
				</li>
			<?php 
					$id++;
				}
			?>				
			</ul>
		</div>

		<footer data-role="footer" data-theme="a" >
			<h4>iampetdo.com</h4>
		</footer>

	</div>
	<!-- /page -->

	<!-- page: #about -->
	<div data-role="page" id="about">

		<div data-role="header" data-theme="a">
			<h1>เกี่ยวกับ</h1>

		</div>
		<!-- /header -->

		<div data-role="content" data-theme="c">
			<p>พัฒนาโดย : ThaiOpenSource.org</p>
			<p>สัญญาอนุญาต : General Public License Version 3.0</p>
			<p>
				เว็บไซต์โครงการ : <a href="http://code.google.com/p/thaiopensource">http://code.google.com/p/thaiopensource</a>
			</p>
			<br> <br>
		</div>
		<!-- /content -->

	</div>
	<!-- page about -->


</body>
</html>
