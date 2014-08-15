<?php
	function expandURL($url)
	{	
		$realLocation = get_headers($url, 1);
		echo $realLocation['Location'];
	}

	expandURL($url = "http://t.co/zIdISG2b");
?>
