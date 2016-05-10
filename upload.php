<style type = "text/css">

.myFont{
	font-size: 24px;
	font-family: monospace;
	text-align: center;
}


body {
	background-color: #996633;
}

</style>

<?php


$target_dir = "uploads/";
$target_dir_ii = "/uploads";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$info = pathinfo($target_file);
	if ($info["extension"] == "core") {
		echo "Core File Uploaded,will now generate MD5...";
		$uploadOk =1;
	}
	else {
		echo "Please upload a Core File,uploaded file is not a Core\n";
		$uploadOk = 0;
	}
}

if ($uploadOk ==0) {
	echo "Sorry,your file was not uploaded.\n";
}

else{
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo nl2br ("The file ".basename($_FILES["fileToUpload"]["name"]). " has been uploaded.\n");
	}
}

function md5_dir($dir) {
	if (is_dir($dir)) {
		if (opendir($dir)) {
			$dh = opendir($dir);
			//echo "This is dn: $dh \n";
			while (($file = readdir($dh)) !=false) {
				//echo nl2br($file . "\n" . md5_file($dir.$file) . "\n\n");
				echo ("<h1 class = \"myFont\">". ("<br>" . "<br>" . $file. "<br>" . md5_file($dir.$file)). "</h1>");
			}
			closedir($dh);
		}
	}
	else {
		echo "Not a directory";
	}
}

md5_dir($target_dir);

clearstatcache();

?>