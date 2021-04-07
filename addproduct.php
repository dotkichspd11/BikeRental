<?php
include 'config.php';
if(isset($_POST['submit'])){
	$TenXe = $_POST['TenXe'];
	$BienSoXe = $_POST["BienSoXe"];
    $KhungXe = $_POST["KhungXe"];
    $MauSac = $_POST["MauSac"];
	$GiaTheoGio = $_POST["GiaThueTheoGio"];
	$GiaTheoNgay = $_POST["GiaThueTheoNgay"];
	$GiaTheoThang = $_POST["GiaThueTheoThang"];

    $NamDangKy = $_POST["NamDangKy"];
    $TrangThai = $_POST["TrangThai"];
    $TenLoaiXe = $_REQUEST["TenLoaiXe"];

	//image upload

	$msg = "";
	$HinhAnh = $_FILES['HinhAnh']['name'];
	$target = "img/".basename($HinhAnh);

	if (move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

  	$insert_data = "INSERT INTO chitietxe (MaLoaiXe,TenXe,BienSoXe,KhungXe,MauSac,GiaThueTheoGio,GiaThueTheoNgay,GiaThueTheoThang,NamDangKy,TrangThai,HinhAnh) VALUES ('$TenLoaiXe','$TenXe','$BienSoXe','$KhungXe','$MauSac','$GiaTheoGio','$GiaTheoNgay','$GiaTheoThang','$NamDangKy','$TrangThai','$target')";
  	 
    $run_data = mysqli_query($link,$insert_data);

  	if($run_data){
  		header('location:product.php');
  	}else{
  		echo "Thêm xe không thành công";
  	}

}
?>