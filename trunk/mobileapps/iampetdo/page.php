<?php

include ("includes/header.php");

$idx=$_GET['id'];

// load feed
$playlist="iampetdo.xml";
$fcontent = file_get_contents(dirname(__FILE__)."/cache/".$playlist, true);
$rss_feed = simplexml_load_string($fcontent);

?>
<body>
	<div data-role="page">
	<?php 
	// bad idea
	$id=0;
	foreach ($rss_feed->channel->item as $item) {
		if ($id==$idx) {
	?>
		<header data-role="header">
			<!--<a  data-rel="back" data-role="button" data-icon="back" >กลับ</a>-->
			<h1>
			<?php 				
				echo $item->title; 
			?>			
			</h1>
		</header>
		<!-- /header -->
		<div data-role="content">
		<?php 
			$description=$item->description;
			preg_match_all('/<img[^>]+>/i',$description, $result);
			
			foreach ($result[0] as $value) {
				echo $value;	
			}
			
		?>
		</div>
<?php 
			
		}
		$id++;
	}
?>
		<footer data-role="footer">
			<h4>iampetdo.com</h4>
		</footer>

	</div>
	<!-- /page -->
</body>
</html>
