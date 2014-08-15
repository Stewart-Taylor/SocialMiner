<?php

function twitter_time($tweetTimeStamp) 
{
    //get current timestamp
    $currentTime = strtotime("now"); 
    //get timestamp when tweet created
    $tweetTime = strtotime($tweetTimeStamp);
    //get difference
    $difference = $currentTime - $tweetTime;
    //calculate different time values
    $minute = 60;
    $hour = $minute * 60;
    $day = $hour * 24;
    $week = $day * 7;
        
    if(is_numeric($difference) && $difference > 0) 
    {
        //if less then minute
        if($difference < $minute) return floor($difference) . "s";
        //if less then hour
        if($difference < $hour) return floor($difference / $minute) . "m";
        //if less then day
        if($difference < $day) return floor($difference / $hour) . "h";
        //if less then year
        if($difference < $day * 365) return floor($difference / $day) . "d";
    }
}

?>