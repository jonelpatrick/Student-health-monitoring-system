<?php
	define("UPLOAD_DIR", "../upload/");

	$file = $_GET['file'];

	header("Content-disposition: attachment; filename = ../upload/$file");
	$filename = basename($file);

	$file_extension = strtolower(substr(strrchr($file,"."),1));

	switch( $file_extension ) {
	    case "gif": $ctype="image/gif"; break;
	    case "png": $ctype="image/png"; break;
	    case "jpeg":
	    case "jpg": $ctype="image/jpeg"; break;
	    default:
	}

	header('Content-type: ' . $ctype);
	//header("Content-type: image/png");
	readfile("../upload/$file");

?>