<?php
	function isImage($text) {
		$original = $text;
		$length = strlen($text); 
		$characters = 4; 
		$start = $length - $characters; 
		$text = substr($text , $start ,$characters);
		if($text == ".jpg" || $text == ".png" || $text == ".gif")
		{
			echo '<img class="content_thumbnail" src="'. $original .'" />';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Social Miner v0.2a</title>
  <link rel="stylesheet" href="css/style.css" />
  <script src="js/jquery-1.7.1.min.js"></script>
  <script src="js/jquery.masonry.min.js"></script>
  <script src="js/modernizr-transitions.js"></script>
  <script src="js/highlight.js"></script>
  <script src="js/scripts.js"></script>
</head>

<body>
<div id="slider">
  
  <!-- FIRST PANEL -->
  <div class="panel">
    <header></header>
    <div id="wrapper">
      <div id="container" class="transitions-enabled">
	  <?php	
		(include 'formatTime.php');

			include "dbConnection.php";
			$query = "SELECT * FROM (link_set join tweet on link_set.set_id = tweet.id) join user on tweet.user = user.id order by tweet.id DESC ";
			$result=	mysql_query($query)  ;				
			mysql_close();
		
			while($row = mysql_fetch_assoc($result))
			{
					echo '<article class="item link" data-url="' . $row['expanded_url'] . '">';
					isImage($row['expanded_url']);
		            echo '<p>'. $row['tweet_text'] .'</p>'.
		                   '<span class="posted_by">'.
		                   '<span class="time_posted">'. twitter_time($row['created_at']) .'</span><img class="posted_by_avatar" src="'. $row['profile_image_url'] .'" alt="" />'. $row['name'] .'</span>'.
		                 '</article>';
			}	
	?>
      </div>
	</div>
  </div>

  <!-- SECOND PANEL -->
  <div class="panel">
  	<div id="back"></div>
  	<div id="content_holder"></div>
  </div>
</div>

<script src="js/layout.js"></script>
</body>
</html>