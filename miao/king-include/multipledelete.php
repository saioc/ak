<?php
$output_dir = "uploads/";
$ThumbPrefix			= "thumb_";
if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))
{
	$fileName =$_POST['name'];
	$thumb_DestRandImageName 	= $output_dir.$ThumbPrefix.$fileName; //Thumbnail name with destination directory

	$fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files	
	$filePath = $output_dir. $fileName;
	if (file_exists($filePath)) 
	{
        unlink($filePath);
    }
		if (file_exists($thumb_DestRandImageName)) 
	{
        unlink($thumb_DestRandImageName);
    }
	echo "Deleted File ".$fileName."<br>";
}

?>