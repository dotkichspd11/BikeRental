<?php
include 'config.php';
$MaXe = $_GET['MaXe'];
if(isset($_POST['submit']))
{
	$TenXe = $_POST["TenXe"];
	$BienSoXe = $_POST["BienSoXe"];
    $KhungXe = $_POST["KhungXe"];
    $MauSac = $_POST["MauSac"];
	$GiaTheoGio = $_POST["GiaThueTheoGio"];
	$GiaTheoNgay = $_POST["GiaThueTheoNgay"];
	$GiaTheoThang = $_POST["GiaThueTheoThang"];

    $NamDangKy = $_POST["NamDangKy"];
    $TrangThai = $_POST["TrangThai"];
    // $TenLoaiXe = $_POST["TenLoaiXe"];        
	$TenLoaiXe1 = $_REQUEST["TenLoaiXe1"];
 

	$msg = "";
	$HinhAnh = $_FILES['HinhAnh']['name'];
	if($HinhAnh !==""){
	$target = "img/".basename($HinhAnh);

		if (move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $target)) {
  			$msg = "Image uploaded successfully";
  		}else{
  			$msg = "Failed to upload image";
  		}

		$update = "UPDATE chitietxe SET TenXe='$TenXe', BienSoXe = '$BienSoXe', KhungXe = '$KhungXe', MauSac = '$MauSac', GiaThueTheoGio = '$GiaTheoGio', GiaThueTheoNgay = '$GiaTheoNgay', GiaThueTheoThang = '$GiaTheoThang', NamDangKy = '$NamDangKy', MaLoaiXe=$TenLoaiXe1, TrangThai = '$TrangThai', HinhAnh = '$target'  WHERE MaXe = $MaXe ";
		$run_update = mysqli_query($link,$update);

		if($run_update){
			header('location:product.php');
		}else{
			echo "Dữ liệu không được cập nhật!";
		}
	}else{	
		$update = "UPDATE chitietxe SET TenXe='$TenXe', BienSoXe = '$BienSoXe', KhungXe = '$KhungXe', MauSac = '$MauSac', GiaThueTheoGio = '$GiaTheoGio', GiaThueTheoNgay = '$GiaTheoNgay', GiaThueTheoThang = '$GiaTheoThang', NamDangKy = '$NamDangKy', MaLoaiXe=$TenLoaiXe1, TrangThai = '$TrangThai' WHERE MaXe = $MaXe ";
		$run_update = mysqli_query($link,$update);
		if($run_update){
			header('location:product.php');
		}else{
			echo "Dữ liệu không được cập nhật!";
		}
	}
}

?>