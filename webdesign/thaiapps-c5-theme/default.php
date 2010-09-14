<html>
<head>
<?php Loader::element('header_required'); ?>
<link rel="stylesheet" type="text/css" href="<?=$this->getThemePath();?>/styles.css" />
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
	<div id="nav2">
        <!-- nav2 -->
        <?php
            $a = new Area('Header Content');
            $a->display($c);
        ?>
	</div>
	<div id="main-full">
	    <div id="round" >
            <!-- body message -->
            <?php
               $a = new Area('Main Content');
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
