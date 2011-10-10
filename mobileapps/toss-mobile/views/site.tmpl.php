<?php include('includes/header.php'); ?>
<body> 

<div data-role="page">

   <header data-role="header" >
      <a  data-rel="back" data-role="button" data-icon="back" data-iconpos="notext">Back</a>
      <h1><?php echo ucwords($siteName); ?></h1>
      <a href="index.php" data-role="button" data-icon="home" data-iconpos="notext">Home</a>
   </header><!-- /header -->

   <div data-role="content">	

      <ul data-role="listview" data-theme="c">
      <?php
            foreach($feed->query->results->item as $item) {
               //$comments = $item->comments[1];
            ?>
            <li>
                <a href="article.php?siteName=<?php echo $siteName;?>&origLink=<?php echo urlencode($item->guid->content);?>"><?php echo $item->title; ?></a>
           </li>
      <?php  } ?>
      </ul>
   </div><!-- /content -->

    <footer data-role="footer" data-position="fixed">
      <h4>thaiopensource.org</h4>
   </footer>
</div><!-- /page -->

</body>
</html>


