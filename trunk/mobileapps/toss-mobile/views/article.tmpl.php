<?php include('includes/header.php'); ?>
<body> 

<div data-role="page">

   <header data-role="header" class="<?php echo $siteName; ?>">
      <a  data-rel="back" data-role="button" data-icon="back" data-iconpos="notext">Back</a>
      <h1> <?php echo $feed->title; ?> </h1>
     <a href="index.php" data-role="button" data-icon="home" data-iconpos="notext">Home</a>
   </header><!-- /header -->

   <div data-role="content">	
        <h1><?php echo $feed->title; ?> </h1>
        <div><?php echo str_replace("read more","",$feed->description); ?> </div>        
   </div><!-- /content -->

   <footer data-role="footer" data-position="fixed">
      <h4>thaiopensource.org</h4>
   </footer>
</div>

</body>
</html>
