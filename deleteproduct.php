<?php

include 'config.php';
$MaXe = $_GET['MaXe'];
$delete = "DELETE FROM chitietxe WHERE MaXe = $MaXe";
$run_data = mysqli_query($link,$delete);

if($run_data){
	header('location:product.php');
}else{
	echo "Lỗi. Không thể xóa!";
}


?>