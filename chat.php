<?php

//echo new chat()
/***
offer-flow->offer reads page
                [if page is not answer] -> sends ice -> saves ice!
                [if page is answer] -> gotAnswer();
                                        [if gotAnswer fails] -> sends ice -> saves ice;

answer-flow->sends ice-->if(validates ice against existing file) if valid->saves answer ice
****/
$maxFileAge = 5;//seconds
$search = new A_search($_REQUEST['chat'],$GLOBALS['db']);

//check validity of location
if(count($search->get_results()) < 1) die("false");
    //does not work at unclaimed property
$dir = $search->get_real_path();
$file = $dir."/chat.json";
$fileObj = null;
$requestObj = null;


echo " ";

if(is_file($file) && (time()-filemtime($dir."/chat.json")) < $maxFileAge){
        echo file_get_contents($dir."/chat.json");
}

if(isset($_REQUEST['ice']) && $_REQUEST['ice'] != ""){
            $newIce = trim($_REQUEST['ice']);
            $requestObj = json_decode($newIce);
            if($file && filemtime($file) < $maxFileAge && filesize($file) > 10) $fileObj = json_decode(file_get_contents($file));
            if(($fileObj && $requestObj->type == "answer" && $fileObj->type == "offer") || $fileObj == null)
                                                                                file_put_contents($dir."/chat.json",$newIce,LOCK_EX);
}

yo_exit();
