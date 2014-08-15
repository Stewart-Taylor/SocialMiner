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
	if(is_object(@$content))
	{
		include 'getTweets.php';
	}
	else
	{
		include 'login.php';	
	}
?>
</body>
</html>