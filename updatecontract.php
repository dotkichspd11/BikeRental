<?php
include 'config.php';
$idhd = $_GET['idhd'];

if(isset($_POST['submit']))
{
	$namecus = $_POST['namecus'];
	$address = $_POST['address'];
	$datestart = $_POST['datestart'];
	$datefinish = $_POST['datefinish'];
	$note = $_POST['note'];

	$msg = "";
	$frontimg = $_FILES['frontimg']['name'];
	$backimg = $_FILES['backimg']['name'];
	$target = "img/".basename($frontimg);
    $target = "img/".basename($backimg);
	if (move_uploaded_file($_FILES['frontimg']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

    if (move_uploaded_file($_FILES['backimg']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

	$update = "UPDATE rentalinfo SET namecus='$namecus', address = '$address', datestart = '$datestart', datefinish = '$datefinish', note = '$note', frontimg = '$frontimg', backimg = '$backimg' WHERE idhd=$idhd ";
	$run_update = mysqli_query($link,$update);

	if($run_update){
		header('location:contract.php');
	}else{
		echo "Dữ liệu không được cập nhật!";
	}
}

?>