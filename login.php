<?php
   	if (isset($_SESSION['twitter_logged']))
	{
		header('Location: ./account-home.php');
	}
	else
	{
	?>
	<div id="loginlogo">
		<img alt=""  src="images/updatedlogo.png" />
		<h1><a href="./redirect.php">> Start Digging <</a></h1>
		</div>
		</br>
   		
   		
	<?php
	}
?>