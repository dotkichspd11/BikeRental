<?php

include 'config.php';
$idhd = $_GET['idhd'];
$delete = "DELETE FROM rentalinfo WHERE idhd = $idhd";
$run_data = mysqli_query($link,$delete);

if($run_data){
	header('location:contract.php');
}else{
	echo "Lỗi. Không thể xóa!";
}


?>