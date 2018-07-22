<?php
/********************************************************/
/**************  WEBRTC PHP MIRROR SERVER  **************/
/********************************************************/
/*************** implemented in didlie.com **************/
/********************************************************/
/**** Isaac Jacobs :: July 9, 2018 :: www.didlie.com ****/
/********************************************************/
/******* free to use, change, sell, distribute **********/
/**** license: Isaac Jacobs(c) === MIT License **********/
/********************************************************/

/*********************************************************************
I removed comments because the code speaks for itself
***********************************************************************/

$maxFileAge = 5;//seconds
$dir = "yourdir";
$file = $dir."/mirror.json";


///////////////////////////////////////////////////////////////////////////////////////////////////////

echo " ";//you need this... believe me (:-P)

if(isset($_REQUEST['ice']) && $_REQUEST['ice'] != ""){
         
  //polling and file-write ajax requests are selected exclusively by the client browser
  
            $newIce = trim($_REQUEST['ice']);
  
            file_put_contents($file,$newIce,LOCK_EX);
  
}elseif(is_file($file) && (time()-filemtime($file)) < $maxFileAge){
  
  // this condition is met by javascript polling
  
        echo file_get_contents($file);
  
}

exit();// because this file is an "include" after your regular PHP security files. 
// didlie.com uses a more robust exit function.
