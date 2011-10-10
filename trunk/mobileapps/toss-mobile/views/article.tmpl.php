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
      <center><a href="<?php echo $feed->link;?>" data-role="button" data-inline="true" data-theme="b">อ่านต่อ...</a>
   </footer>
</div>

</body>
</html>
