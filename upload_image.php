<?php
	include ("usuarios.php");
	session_start();
	$ok = false;

	$dir = "assets/img/perfiles";
	$file = $_FILES['file'];
	$path = $_FILES['file']['name'];
	
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	
	$temporary_file = $file['tmp_name']; 
	$finfo 	    = finfo_open(FILEINFO_MIME_TYPE);
	$file_type  = finfo_file($finfo, $temporary_file);

	if(($file_type != "image/jpeg") && ($file_type != "image/png") && ($file_type != "image/jpg")){
		$ok = false;
	} else {
		$filename = $_SESSION['usuario'] . "." . $ext;
		if (move_uploaded_file($file["tmp_name"], "$dir/" . $filename)) {
			$ok = true;
			$u = new usuarios();
			$u->uploadFotoPerfil($_SESSION['usuario'], "$dir/" . $filename);	
		}
	}
	if ($ok)
	{
		echo json_encode(array("success" => true, "title" => "OK","icon" => "success", "msg" => "Foto de perfil Actualizada!"));
	}
	else echo json_encode(array("success" => false, "title" => "ERROR","icon" => "error", "msg" => "Hubo un error al subir la foto!"));
?>