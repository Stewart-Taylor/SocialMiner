<?php

	include "dbConnection.php";

	
		for($i = 0; $i < sizeof($tweets); $i++)
		{
			if(!empty($tweets[$i]->entities->urls[0]))
			{
		
				//TWEET ID
				$id =   $tweets[$i]->id_str ;
				
				//TWEET
				$text =  $tweets[$i]->text;
				$expanded_url =  $tweets[$i]->entities->urls[0]->expanded_url ;
				$timestamp =  $tweets[$i]->created_at ;
				 
				 //USER
				 $userID =  $tweets[$i]->user->id ;
				 $userName =  $tweets[$i]->user->name ;
				 $userAvatar =  $tweets[$i]->user->profile_image_url ;
				 $userScreenName =  $tweets[$i]->user->screen_name ;
			 
			 
				 for($counter = 0; $counter < sizeof($tweets[$i]->entities->urls); $counter++)
				 {
					//LINKS Data
					$url = $tweets[$i]->entities->urls[$counter]->url  ;
					$expanded = $tweets[$i]->entities->urls[$counter]->expanded_url;

					$queryLink = " REPLACE INTO link_set (set_id , url  , expanded_url ) VALUES ('$id',  '$url' ,'$expanded' )  ";
					mysql_query($queryLink)  ;
				 }
			
				$queryUser = " INSERT INTO user (id , name  , profile_image_url , screen_name) VALUES ($userID,  '$userName' ,'$userAvatar' , '$userScreenName')  ";
				$query = "INSERT INTO tweet ( id , user , tweet_text  , created_at) VALUES ( '$id' , $userID , '$text'  , '$timestamp')  ";
				
				mysql_query($queryUser)  ;
				mysql_query($query)  ;
			}
		}

	mysql_close();
?>