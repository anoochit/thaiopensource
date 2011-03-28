<?php
// $Id: page.tpl.php,v 1.1.2.1 2009/02/24 15:34:45 dvessel Exp $
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
<link rel="alternate" type="application/rss+xml" title="News Feed" href="http://www.thaiopensource.org/view/feed/news" />
<link rel="alternate" type="application/rss+xml" title="Article Feed" href="http://www.thaiopensource.org/view/feed/article" />
<link rel="alternate" type="application/rss+xml" title="Review Feed" href="http://www.thaiopensource.org/view/feed/review" />
<link rel="alternate" type="application/rss+xml" title="How To Feed" href="http://www.thaiopensource.org/view/feed/howto" />
</head>

<body class="<?php print $body_classes; ?>">
  <div id="page" class="container-16 clear-block">

    <div id="site-header" class="clear-block">
 
    <?php if ($main_menu_links || $secondary_menu_links): ?>
      <div id="site-menu" class="grid-16">
        <?php print $main_menu_links; ?>
        <?php print $secondary_menu_links; ?>
      </div>
    <?php endif; ?>

    <?php if ($header): ?>
      <div id="header-region" class="region grid-16 clear-block">
        <?php print $header; ?>
      </div>
    <?php endif; ?>
    </div>
    
    <div id="header-logo" class="region grid-16 clear-block">
	<div id="logomini" class="grid-10 alpha">	
		<img id="logo-mini" src="<?php print base_path().path_to_theme(); ?>/images/tosslogo-mini.png">
 	</div>
    </div>

    <div id="main" class="column <?php print ns('grid-11', $left, 0, $right, 0) . ' ' . ns('push-0', !$left, 0); ?>">
      <?php //print $breadcrumb; ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php if ($tabs): ?>
        <div class="tabs"><?php print $tabs; ?></div>
      <?php endif; ?>
      <?php print $messages; ?>
      <?php print $help; ?>

      <div id="main-content" class="region clear-block">
        <?php print $content; ?>
      </div>
      <?php print $feed_icons; ?>
    </div>


  <?php if ($right): ?>
    <div id="sidebar-right" class="column sidebar region grid-5">
      <?php print $right; ?>
    </div>
  <?php endif; ?>

  <div id="area" class="grid-16">
      <div id="area1" class="grid-5 alpha">
         <?php print $area1; ?>
      </div>
      <div id="area2" class="grid-5">   
         <?php print $area2; ?>
      </div>
      <div id="area3" class="grid-6 omega">   
         <?php print $area3; ?>
      </div>
  </div>

  <div id="footer" class="prefix-0 suffix-0">
    <?php if ($footer): ?>
      <div id="footer-region" class="region grid-16 clear-block">
        <?php print $footer; ?>
      </div>
    <?php endif; ?>

    <?php if ($footer_message): ?>
      <div id="footer-message" class="grid-16">
        <?php print $footer_message; ?>
      </div>
    <?php endif; ?>
  </div>

  </div>

  <?php print $closure; ?>
</body>
</html>
