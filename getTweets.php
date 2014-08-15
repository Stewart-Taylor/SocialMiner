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

		if($file_extension == '.jpg' || $file_extension == '.JPG' ||$file_extension == 'jpeg' || $file_extension == 'JPEG' || $file_extension == '.png' || $file_extension == '.PNG' || $file_extension == '.gif' || $file_extension == '.GIF')
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
			for($i = 0; $i < sizeof($tweets); $i++)
			{
				if(!empty($tweets[$i]->entities->urls[0]) && ($tweets[$i]->text[0] !=  'R' && $tweets[$i]->text[1] !=  'T'))
				{
					$ex_url =  $tweets[$i]->entities->urls[0]->expanded_url;
					$tweet_type = getTweetType($ex_url);


					if($tweet_type == "image")
					{
						echo '<article class="item '. $tweet_type .'" data-url="'. $ex_url .'">';
						echo '<img class="content_thumbnail" src="'. $tweets[$i]->entities->urls[0]->expanded_url .'" alt="" />';
					}
					else if($tweet_type == "video")
					{
						echo '<article class="item '. $tweet_type .'" data-url="'. getVideoThumbnail($ex_url) .'">';
						echo '<img class="content_thumbnail" src="http://img.youtube.com/vi/'. getVideoThumbnail($ex_url) .'/0.jpg" alt="" />';
					}
					else {
						echo '<article class="item '. $tweet_type .'" data-url="'. $ex_url .'">';
					}

					echo '<p>'.$tweets[$i]->text.'</p>'.
		                   '<span class="posted_by">'.
		                   '<span class="time_posted">'.twitter_time($tweets[$i]->created_at).'</span><img class="posted_by_avatar" src="'.$tweets[$i]->user->profile_image_url.'" alt="" />'.$tweets[$i]->user->name.'</span>'.
		                 '</article>';
		        }
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