<?php
include 'config.php';
session_start();
if(isset($_GET['MaXe'])){
    $MaXe=$_GET['MaXe'];
} 
$action = (isset($_GET['action']) ? $_GET['action']: 'add');

$query =mysqli_query($link,"SELECT * FROM chitietxe where MaXe= $MaXe");

if($action=='add'){
$NgayBatDau = $_POST["datestart"];
$NgayKetThuc = $_POST["datefinish"];

if($NgayBatDau<$NgayKetThuc){
    if($query){
         $product=mysqli_fetch_assoc($query);
    }
    $item =[
        'MaXe'=>$product['MaXe'],
        'TenXe'=>$product['TenXe'],
        'HinhAnh'=>$product['HinhAnh'],
        'GiaTheoGio'=>$product['GiaThueTheoGio'],
        'GiaTheoNgay'=>$product['GiaThueTheoNgay'],
        'GiaTheoThang'=>$product['GiaThueTheoThang'],

        'NgayBatDau'=>$NgayBatDau,
        'NgayKetThuc'=>$NgayKetThuc
    ];
    $_SESSION['cart'][$MaXe]=$item;
    if(isset($_SESSION['cart'][$MaXe])){
        $newitem =[
            'MaXe'=>$product['MaXe'],
            'TenXe'=>$product['TenXe'],
            'HinhAnh'=>$product['HinhAnh'],
            'GiaTheoGio'=>$product['GiaThueTheoGio'],
            'GiaTheoNgay'=>$product['GiaThueTheoNgay'],
            'GiaTheoThang'=>$product['GiaThueTheoThang'],

            'NgayBatDau'=>$NgayBatDau,
            'NgayKetThuc'=>$NgayKetThuc
        ];
        $_SESSION['cart'][$MaXe]=$newitem;
    }else{
        $_SESSION['cart'][$MaXe]=$item;
    }
    header('location:product.php');
}else{
    echo "Ngày Tháng Năm Nhập Vào Không Hợp Lệ .Vui Lòng Quay Lại Trang";
}
}
if($action =='delete'){
    unset($_SESSION['cart'][$MaXe]);
    header('location:product.php');


}
?>