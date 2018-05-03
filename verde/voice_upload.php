<?php
	$fileExistsFlag = 0; 
	$fileName = $_FILES['audio_file']['name']; 
	$path = "audio_files/";		
	$filePath = $path.$fileName;
	$link = mysqli_connect("localhost","root","SperaenDeo1","verde_app") or die("Error ".mysqli_error($link));
	/* 
	*	Checking whether the file already exists in the destination folder 
	*/
	$query = "SELECT filepath FROM voice WHERE filepath='$filePath'";	
	$result = $link->query($query) or die("Error : ".mysqli_error($link));
	while($row = mysqli_fetch_array($result)) {
		if($row['filepath'] == $filePath) {
			$fileExistsFlag = 1;
		}		
	}
	/*
	* 	If file is not present in the destination folder
	*/
	if($fileExistsFlag == 0) {	
		$tempFileName = $_FILES["audio_file"]["tmp_name"];
		$result = move_uploaded_file($tempFileName,$filePath);
		/*
		*	If file was successfully uploaded in the destination folder
		*/
		if($result) { 	
			$query = "INSERT INTO voice(filepath) VALUES ('$filePath')";
			$link->query($query) or die("Error : ".mysqli_error($link));			
		}
		else {			
			echo "Sorry !!! There was an error in uploading your file";			
		}
		mysqli_close($link);
		// header("Location: voice.html");
		exit; 
	}
	/*
	* 	If file is already present in the destination folder
	*/
	else {
		echo "File <html><b><i>".$fileName."</i></b></html> already exists in your folder. Please rename the file and try again.";
		mysqli_close($link);
	}	
?>