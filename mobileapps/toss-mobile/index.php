<?php include('includes/header.php'); ?>
<body>
	<div data-role="page">

		<header data-role="header" data-them="a">
			<h1>TOSS Mob!le</h1>
		</header>

		<div data-role="content">
			<ul data-role="listview" data-theme="c">
				<li> </li>
				<li><a href="site.php?siteName=news"> News </a>
				</li>
				<li><a href="site.php?siteName=article"> Articles </a>
				</li>
				<li><a href="site.php?siteName=blog"> Blog </a>
				</li>
				<li><a href="site.php?siteName=review"> Review </a>
				</li>
				<li><a href="site.php?siteName=howto"> How-To </a>
				</li>
			</ul>
		</div>

		<footer data-role="footer" data-position="fixed">
			<h4>
				&copy;
				<?=date("Y");?>
				thaiopensource.org
			</h4>
		</footer>

	</div>

</body>
</html>

