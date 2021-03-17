<?php
include 'config.php';
if(isset($_POST['submit'])){
	
	$namecus = $_POST['namecus'];
	$address = $_POST['address'];
	$datestart = $_POST['datestart'];
	$datefinish = $_POST['datefinish'];
	$note = $_POST['note'];
	// $description = $_POST['description'];

	//image upload

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

  	$insert_data = "INSERT INTO rentalinfo (namecus,address,datestart,datefinish,note,frontimg,backimg) VALUES ('$namecus','$address','$datestart','$datefinish','$note','$frontimg','$backimg')";
  	
    $run_data = mysqli_query($link,$insert_data);

  	if($run_data){
  		header('location:detailproductready.php');
  	}else{
  		echo "Thuê xe không thành công!";
  	}

}
?>