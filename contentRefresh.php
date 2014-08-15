<?php





function getContentType($link)
 {
	if(isImage($link) )
	{
		return "image";
	}
	else if (isVideo($link) )
	{
		return "video";
	}
	
	return "link";
}


 function isImage($url)
  {		
		$file_extension = substr($url, -4);
		if($file_extension == '.jpg')
		{
			return true;
		}
		else if($file_extension == 'jpeg')
		{
			return true;
		}
		else if($file_extension == '.png')
		{
			return true;
		}
		else if($file_extension == '.gif')
		{
			return true;
		}
  }


function isVideo($link)
{
   	$res = parse_url($link);
	
	if(isset($res['path']))
	{
		if ( preg_match( "/\/watch/" , $res['path']  ) ){
			return true;
		}
	}
	
	return false;
}


function getExpanded($url)
{

$pos = strpos($url,"t.co");

if($pos == true) 
{

echo "</br> TCO got| ";

$jsonurl = "http://expandurl.appspot.com/expand?url=" . $url ;
$json = file_get_contents($jsonurl,0,null,null);
$json_output = json_decode($json);


return $json_output->end_url;

}
else 
{
	return $url;
}


}





			include "dbConnection.php";
			
			
			$query = "SELECT * FROM link_set  ";
			
			
			$result=	mysql_query($query)  ;				
			
		
		
		
		$content  = null;
		$contentCount = null;
		$counter = 0;
		
			while($row = mysql_fetch_assoc($result))
			{
			
				if($counter == 0)
				{
					$content[0] = $row['expanded_url'] ;
					$contentCount[0] = 1;
				}
			
				if (!in_array($row['expanded_url'], $content ))
				{
					$content[$counter] = $row['expanded_url'] ;
					$contentCount[$counter] = 1;
				}
				else
				{
					$index = array_search($row['expanded_url'] , $content);
					$contentCount[$index] += 1;
				
				}
			
			
					//echo '</br>' . $row['expanded_url'] ;
	
					$counter += 1;
			}	
			
			
			$c2 = 0;
			foreach ($content as &$cItem) 
			{
				
				$index = array_search($cItem , $content);
				
				$contentType = getContentType($cItem);
				
				// $bigLink =  getExpanded($cItem);
				
				$bigLink =  $cItem;
				
				
			//	echo '</br>ITEM:	' . $cItem .  ' |  Count: '   . $contentCount[$index] . "     | TYPE: " .  $contentType ;
			
			echo '</br>ITEM:	' . $bigLink .  ' |  Count: '   . $contentCount[$index] . "     | TYPE: " .  $contentType ;
				
			
					$contentQuery = "replace INTO content (content_url, count , type) VALUES ('$bigLink', $contentCount[$index] , '$contentType');  ";

			
				mysql_query($contentQuery)  ;		
				
				
				$c2 += 1;
			}
			
			
	
mysql_close();













?>