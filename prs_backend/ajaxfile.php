<?php

// file name
$filename = $_FILES['file']['name'];

//$username  = $_POST['username'];
// Location
//$location = 'upload/'.$filename;
$location = 'upload/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

// Valid image extensions
$image_ext = array("jpg","png","jpeg","gif","doc","docx");
$rename =  date(Ymd) .'_001';
$newname = $rename . '.'.$file_extension;
$response = 0;
if(in_array($file_extension,$image_ext)){
	// Upload file
	if(move_uploaded_file($_FILES['file']['tmp_name'],'upload/' . $newname)){
		echo $newname;
	}
}

echo $response;  
