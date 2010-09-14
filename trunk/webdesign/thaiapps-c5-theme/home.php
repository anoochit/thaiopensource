<html>
<head>
<?php Loader::element('header_required'); ?>
<link rel="stylesheet" type="text/css" href="<?=$this->getThemePath();?>/styles.css" />
<link rel="stylesheet" type="text/css" href="<?=$this->getThemePath();?>/slide.css" />
</head>
<body>
<div id="wrap">
	<div id="subheader">
        <!-- menu -->
        <?php
               $a = new Area('Header Nav');
               $a->display($c);
        ?>
    </div>
	<div id="header"><img src="<?=$this->getThemePath();?>/images/logo.png" alt="Thai OS"></div>
	<div id="nav">
        <img src="<?=$this->getThemePath();?>/images/slide01.png" alt="1" />
	</div>
	<div id="main">
	  <div id="round" >
		<?php
		   $a = new Area('Main Content 1');
		   $a->display($c);
		?>	
	    </div>		
        <img src="<?=$this->getThemePath();?>/images/space.png">
        <div id="round" >
		<?php
		   $a = new Area('Main Content 2');
		   $a->display($c);
		?>		
        </div>		
	</div>
	<div id="sidebar">
        <div id="round" >
		<?php
		   $a = new Area('Main Content 3');
		   $a->display($c);
		?>		
        </div>		
        <img src="<?=$this->getThemePath();?>/images/space.png">
        <div id="round" >
		<?php
		   $a = new Area('Main Content 4');
		   $a->display($c);
		?>		
        </div>		
	</div>
	<div id="footer">
		<?
           $a = new Area('Footer Content');
            $a->display($c);
        ?>

	</div>
</div> 
</body>
</html>
