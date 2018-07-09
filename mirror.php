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
offer-flow->offer reads page
                [if page is not answer] -> sends ice -> saves ice!
                [if page is answer] -> gotAnswer();
                                        [if gotAnswer fails] -> sends ice -> saves ice;

answer-flow->sends ice-->if(validates ice against existing file) if valid->saves answer ice
***********************************************************************/

$maxFileAge = 5;//seconds
$dir = "yourdir";
$file = $dir."/mirror.json";
$fileObj = null;
$requestObj = null;

//note: $_REQUEST['chat'] is a reference to the file location on the server, through the directory $dir
///////////////////////////////////////////////////////////////////////////////////////////////////////

echo " ";//you need this... believe me (:-P)
// this condition is met by javascript polling
if(is_file($file) && (time()-filemtime($dir."/chat.json")) < $maxFileAge){
        echo file_get_contents($dir."/chat.json");
}
// this condition below is met by the WEBRTC peer connection creation, 
//in a different process than polling, 
//so the echo() contents above are not relavent, 
//because the content of the xhhtp response are not relavant, 
//as every creation to an offerers peer connection MUST! be sent to the mirror, 
//and is already known by the sender.
if(isset($_REQUEST['ice']) && $_REQUEST['ice'] != ""){
            $newIce = trim($_REQUEST['ice']);
            $requestObj = json_decode($newIce);
            if($file && (time() - filemtime($file)) < $maxFileAge && filesize($file) > 10) $fileObj = json_decode(file_get_contents($file));
            if(($fileObj && $requestObj->type == "answer" && $fileObj->type == "offer") || $fileObj == null)
                                                                                file_put_contents($dir."/chat.json",$newIce,LOCK_EX);
}

exit();// because this file is an "include" after your regular PHP security files. 
// didlie.com uses a more robust exit function.
