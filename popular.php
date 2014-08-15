<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Social Miner</title>
  <link rel="stylesheet" href="css/style.css" />
  <script src="js/jquery-1.7.1.min.js"></script>
  <script src="js/jquery.masonry.min.js"></script>
  <script src="js/modernizr-transitions.js"></script>
  <script src="js/highlight.js"></script>
  <script src="js/scripts.js"></script>
</head>

<body>

<?php



	include 'formatTime.php';

	function getTweetType($link)
	{
		if(isImage($link))
		{
			return "image";
		}
		else if (isVideo($link))
		{
			return "video";
		}
	
		return "link";
	}

	function isImage($url)
  	{		
		$file_extension = substr($url, -4);

		if($file_extension == '.jpg' || $file_extension == 'jpeg' || $file_extension == '.png' || $file_extension == '.gif')
		{
			return true;
		}
  	}

	function isVideo($link)
	{
	   	$res = parse_url($link);
		
		if(isset($res['path']))
		{
			if (preg_match( "/\/watch/" , $res['path'])) {
				return true;
			}
		}
		
		return false;
	}

	function getVideoThumbnail($url)
	{
		$thumbnail = $url;
		parse_str(parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars);
		return $my_array_of_vars['v'];
	}
?>

<div id="slider">
  
  <!-- FIRST PANEL -->
  <div class="panel">
   <?php include 'header.php';  ?>

    <div class="wrapper">
      <ul id="filters">
      	<li data-type="all" class="selected">All</li>     
      	<li data-type="image">Image</li> 	
      	<li data-type="link">Link</li>
      	<li data-type="video">Video</li>
      </ul>

      <div id="container" class="transitions-enabled">
		<?php
		
			include "dbConnection.php";
			$query = "SELECT * FROM content where count > 1 order by count DESC";
			$result=	mysql_query($query)  ;				
			mysql_close();
		
			while($row = mysql_fetch_assoc($result))
			{
					$ex_url =  $row['content_url'];
					$count =  $row['count'];
					$tweet_type = getTweetType($ex_url);


					if($tweet_type == "image")
					{
						echo '<article class="item '. $tweet_type .'" data-url="'. $ex_url .'">';
						echo '<img class="content_thumbnail" src="'. $ex_url .'" alt="" />';
					}
					else if($tweet_type == "video")
					{
						echo '<article class="item '. $tweet_type .'" data-url="'. getVideoThumbnail($ex_url) .'">';
						echo '<img class="content_thumbnail" src="http://img.youtube.com/vi/'. getVideoThumbnail($ex_url) .'/0.jpg" alt="" />';
					}
					else {
						echo '<article class="item '. $tweet_type .'" data-url="'. $ex_url .'">';
						echo '<p>'. $ex_url .'</p>';
					}

					
		             echo      '<span class="posted_by">'.   ' Mentions: ' . $count . '</span>'.
		                 '</article>';
		        
			}
		?>
      </div>
	</div>
  </div>

  <!-- SECOND PANEL -->
  <div class="panel">
  	<div id="back"></div>

  	<div id="loading">
  		<div class="bar1"></div>
  		<div class="bar2"></div>
  		<div class="bar3"></div>
  		<div class="bar4"></div>
  		<div class="bar5"></div>
  		<div class="bar6"></div>
  		<div class="bar7"></div>
  		<div class="bar8"></div>
  	</div>

  	<div id="content_holder"></div>
  	<div id="cover"></div>
  </div>
</div>

<script src="js/layout.js"></script>

</body>
</html>