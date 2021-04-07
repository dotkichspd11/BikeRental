<?php
include 'config.php';
$array=['Sẵn Sàng','Đang Được Thuê','Tới Hạn Trả'];
if($_POST['type']==""){
    $sql = "select * from loaixe"; 
    $result=$link->query($sql);
    foreach($result as $tl){
        echo " <option value=".$tl['MaLoaiXe'].">".$tl['TenLoaiXe']."</option>";
    }
}else if($_POST['type']=="Loadxedangthue"){
    if($_POST['id']==0){
        $result =$link->query( "SELECT chitietxe.MaXe,chitietxe.TenXe,chitietxe.MaLoaiXe,chitietxe.BienSoXe,chitietxe.KhungXe,chitietxe.MauSac,chitietxe.NamDangKy,chitietxe.TrangThai,chitietxe.HinhAnh,chitietxe.GiaThueTheoGio,chitietxe.GiaThueTheoNgay,chitietxe.GiaThueTheoThang,loaixe.TenLoaiXe,loaixe.SoLuong FROM (chitietxe inner join loaixe on chitietxe.MaLoaiXe = loaixe.MaLoaiXe) where TrangThai='Đang Được Thuê'");
    while($row=$result->fetch_assoc()){?>
<tr>
    <td><?php echo $row['MaXe'];?></td>
    <td><?php echo $row['TenXe'];?></td>
    <td><?php echo $row['TenLoaiXe'];?></td>
    <td class='card-status-ready' value="<?php echo $row['TrangThai'];?>"><?php echo $row['TrangThai'];?></td>
    <td><?php echo $row['GiaThueTheoGio']."đ";?></td>
    <td><?php echo $row['GiaThueTheoNgay']."đ";?></td>
    <td><?php echo $row['GiaThueTheoThang']."đ";?></td>

    <td class='card-table-item'>
        <a class='card-table-link' href='detailproductready.php?MaXe=<?php echo $row ['MaXe']; ?>' title='View Record'
            data-toggle='tooltip'><i class='fas fa-info-circle card-table-icon'></i></a>
        <p class='card-table-link' style='margin-bottom:0;margin-left:15px;cursor:pointer' title='Update Record'
            data-target='#exampleModalLong<?php echo $row ['MaXe']; ?>' data-toggle='modal'><i
                class='fas fa-edit card-table-icon update-config'></i>
        <form action='updateproduct.php?MaXe=<?php echo $row ['MaXe']; ?>' method='post' enctype='multipart/form-data'
            class='modal fade' id='exampleModalLong<?php echo $row ['MaXe']; ?>' tabindex='-1' role='dialog'
            aria-labelledby='exampleModalLongTitle<?php echo $row ['MaXe']; ?>' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLongTitle<?php echo $row ['MaXe']; ?>'>
                            Cập
                            nhật xe</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <div class='card-body_item'>
                            <label for=''>Chọn hình ảnh xe<sup>*</sup></label>
                            <input class='card-body_input' type='file' name='HinhAnh'
                                value=' <?php echo $row ['HinhAnh']; ?>' multiple require>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Tên xe<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='TenXe'
                                value='<?php echo $row ['TenXe']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Biển số xe<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='BienSoXe'
                                value='<?php echo $row ['BienSoXe']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Khung Xe<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='KhungXe'
                                value='<?php echo $row ['KhungXe']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Màu Sắc<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='MauSac'
                                value='<?php echo $row ['MauSac']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Năm đăng ký<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='NamDangKy'
                                value='<?php echo $row ['NamDangKy']; ?>' required>

                        </div>
                        <div class='card-body_item '>
                            <label for=''>Loại xe<sup>*</sup></label>
                            <select name='TenLoaiXe1' id='TenLoaiXe1'>
                                <option value='<?php echo $row ['MaLoaiXe']; ?>'>
                                    <?php echo $row ['TenLoaiXe']; ?></option>
                                <?php
                                $MaLoaiXe=$row ['MaLoaiXe']; 
                                  $sql1="SELECT MaLoaiXe,TenLoaiXe FROM `loaixe` where MaLoaiXe NOT in (SELECT MaLoaiXe from `loaixe` where MaLoaiXe=$MaLoaiXe)";
                                 $result1=$link->query($sql1);                                                        
                                ?>
                                <?php 
                             foreach($result1 as $tl1){
                             ?>
                                <option value="<?php echo $tl1 ['MaLoaiXe']; ?>">
                                    <?php echo $tl1 ['TenLoaiXe']; ?></option>
                                <?php
                                }
                             ?>
                            </select>
                        </div>
                        <div class="card-body_item ">
                            <label for="">Tình trạng xe<sup>*</sup></label>
                            <select id="TrangThai" name="TrangThai">
                                <?php 
                                 $TrangThai=$row ['TrangThai'];
                                $array=['Sẵn Sàng','Đang Được Thuê','Tới Hạn Trả'];
                                foreach($array as $tt){
                                    ?>
                                <option value="<?php echo $tt;?>" <?php  if ($tt=="Sẵn Sàng") echo 'style="color: green"';
                                               else if ($tt=="Đang Được Thuê") echo 'style="color: yellow"';
                                               else if ($tt=="Tới Hạn Trả") echo 'style="color: red"';
                                                if($tt==$TrangThai) {echo 'selected';
                                              }
                                               ?>>
                                    <?php echo $tt;?>
                                </option>
                                <?php
                                       }
                                    ?>
                            </select>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Giá Giờ<sup>*</sup></label>
                            <input class='card-body_input' type='number' name='GiaThueTheoGio' min='0'
                                value='<?php echo $row ['GiaThueTheoGio']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Giá Ngày<sup>*</sup></label>
                            <input class='card-body_input' type='number' name='GiaThueTheoNgay' min='0'
                                value='<?php echo $row ['GiaThueTheoNgay']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Giá Tháng<sup>*</sup></label>
                            <input class='card-body_input' type='number' name='GiaThueTheoThang' min='0'
                                value='<?php echo $row ['GiaThueTheoThang']; ?>' required>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Đóng</button>
                        <input type='submit' name='submit' class='btn btn-primary' value='Cập nhật'>
                    </div>
                </div>
            </div>
        </form>
        </p>
        <a class='card-table-link' href='deleteproduct.php?MaXe=<?php echo $row ['MaXe']; ?>' title='Delete Record'
            data-toggle='tooltip'><i class='fas fa-trash-alt card-table-icon'></i></a>
    </td>
</tr>
<?php } }else{
$result =$link->query( "SELECT
chitietxe.MaXe,chitietxe.TenXe,chitietxe.MaLoaiXe,chitietxe.BienSoXe,chitietxe.KhungXe,chitietxe.MauSac,chitietxe.NamDangKy,chitietxe.TrangThai,chitietxe.HinhAnh,chitietxe.GiaThueTheoGio,chitietxe.GiaThueTheoNgay,chitietxe.GiaThueTheoThang,loaixe.TenLoaiXe,loaixe.SoLuong
FROM (chitietxe inner join loaixe on chitietxe.MaLoaiXe = loaixe.MaLoaiXe) where chitietxe.MaLoaiXe={$_POST['id']} AND chitietxe.TrangThai='Đang Được Thuê'");
    while($row=$result->fetch_assoc()){?>
<tr>
    <td><?php echo $row['MaXe'];?></td>
    <td><?php echo $row['TenXe'];?></td>

    <td><?php echo $row['TenLoaiXe'];?></td>
    <td class='card-status-ready' value="<?php echo $row['TrangThai'];?>"><?php echo $row['TrangThai'];?></td>
    <td><?php echo $row['GiaThueTheoGio']."đ";?></td>
    <td><?php echo $row['GiaThueTheoNgay']."đ";?></td>
    <td><?php echo $row['GiaThueTheoThang']."đ";?></td>
    <td class='card-table-item'>
        <a class='card-table-link' href='detailproductready.php?MaXe=<?php echo $row ['MaXe']; ?>' title='View Record'
            data-toggle='tooltip'><i class='fas fa-info-circle card-table-icon'></i></a>
        <p class='card-table-link' style='margin-bottom:0;margin-left:15px;cursor:pointer' title='Update Record'
            data-target='#exampleModalLong<?php echo $row ['MaXe']; ?>' data-toggle='modal'><i
                class='fas fa-edit card-table-icon update-config'></i>
        <form action='updateproduct.php?MaXe=<?php echo $row ['MaXe']; ?>' method='post' enctype='multipart/form-data'
            class='modal fade' id='exampleModalLong<?php echo $row ['MaXe']; ?>' tabindex='-1' role='dialog'
            aria-labelledby='exampleModalLongTitle<?php echo $row ['MaXe']; ?>' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLongTitle<?php echo $row ['MaXe']; ?>'>
                            Cập
                            nhật xe</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <div class='card-body_item'>
                            <label for=''>Chọn hình ảnh xe<sup>*</sup></label>
                            <input class='card-body_input' type='file' name='HinhAnh'
                                value=' <?php echo $row ['HinhAnh']; ?>' multiple require>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Tên xe<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='TenXe'
                                value='<?php echo $row ['TenXe']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Biển số xe<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='BienSoXe'
                                value='<?php echo $row ['BienSoXe']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Khung Xe<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='KhungXe'
                                value='<?php echo $row ['KhungXe']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Màu Sắc<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='MauSac'
                                value='<?php echo $row ['MauSac']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Năm đăng ký<sup>*</sup></label>
                            <input class='card-body_input' type='text' name='NamDangKy'
                                value='<?php echo $row ['NamDangKy']; ?>' required>

                        </div>
                        <div class='card-body_item '>
                            <label for=''>Loại xe<sup>*</sup></label>
                            <select name='TenLoaiXe1' id='TenLoaiXe1'>
                                <option value='<?php echo $row ['MaLoaiXe']; ?>'>
                                    <?php echo $row ['TenLoaiXe']; ?></option>
                                <?php
                                $MaLoaiXe=$row ['MaLoaiXe']; 
                                  $sql1="SELECT MaLoaiXe,TenLoaiXe FROM `loaixe` where MaLoaiXe NOT in (SELECT MaLoaiXe from `loaixe` where MaLoaiXe=$MaLoaiXe)";
                                 $result1=$link->query($sql1);                                                        
                                ?>
                                <?php 
                             foreach($result1 as $tl1){
                             ?>
                                <option value="<?php echo $tl1 ['MaLoaiXe']; ?>">
                                    <?php echo $tl1 ['TenLoaiXe']; ?></option>
                                <?php
                                }
                             ?>
                            </select>
                        </div>
                        <div class="card-body_item ">
                            <label for="">Tình trạng xe<sup>*</sup></label>
                            <select id="TrangThai" name="TrangThai"
                                <?php  if ($row ['TrangThai']=="Sẵn Sàng") echo 'style="color: green"';
                                                                        else if ($row ['TrangThai']=="Đang Được Thuê") echo 'style="color: yellow"';
                                                                        else if ($row ['TrangThai']=="Tới Hạn Trả") echo 'style="color: red"';?>>
                                <?php 
                                 $TrangThai=$row ['TrangThai'];
                                $array=['Sẵn Sàng','Đang Được Thuê','Tới Hạn Trả'];
                                foreach($array as $tt){
                                    ?>
                                <option value="<?php echo $tt;?>" <?php  if ($tt=="Sẵn Sàng") echo 'style="color: green"';
                                               else if ($tt=="Đang Được Thuê") echo 'style="color: yellow"';
                                               else if ($tt=="Tới Hạn Trả") echo 'style="color: red"';
                                                if($tt==$TrangThai) {echo 'selected';
                                              }
                                               ?>>
                                    <?php echo $tt;?>
                                </option>
                                <?php
                                       }
                                    ?>
                            </select>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Giá Giờ<sup>*</sup></label>
                            <input class='card-body_input' type='number' name='GiaThueTheoGio' min='0'
                                value='<?php echo $row ['GiaThueTheoGio']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Giá Ngày<sup>*</sup></label>
                            <input class='card-body_input' type='number' name='GiaThueTheoNgay' min='0'
                                value='<?php echo $row ['GiaThueTheoNgay']; ?>' required>
                        </div>
                        <div class='card-body_item '>
                            <label for=''>Giá Tháng<sup>*</sup></label>
                            <input class='card-body_input' type='number' name='GiaThueTheoThang' min='0'
                                value='<?php echo $row ['GiaThueTheoThang']; ?>' required>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Đóng</button>
                        <input type='submit' name='submit' class='btn btn-primary' value='Cập nhật'>
                    </div>
                </div>
            </div>
        </form>
        </p>
        <a class='card-table-link' href='deleteproduct.php?MaXe=<?php echo $row ['MaXe']; ?>' title='Delete Record'
            data-toggle='tooltip'><i class='fas fa-trash-alt card-table-icon'></i></a>
    </td>
</tr>

<?php }}}?>
<script type="text/javascript" src="js/Color.js"></script>