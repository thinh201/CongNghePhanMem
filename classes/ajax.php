<?php
include_once('../lib/session.php');
include_once('../lib/database.php');
$db = new Database();

//Bảng Acount
if (isset($_POST['id_Account'])) {
  $id_Account = $_POST['id_Account'];
  $select = "SELECT * FROM taikhoan WHERE id='$id_Account '";
  $result = $db->select($select);
  if (!empty($result)) {
    while ($row = $result->fetch_assoc()) {
  ?>
      <div class="col-sm-8">
        <div class="form-group form-focus">
          <input name="name" type="text" class="form-control floating" id="editName" value="<?= $row['username'] ?>" required>
          <label class="focus-label">Tên <span class="text-danger">*</span></label>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="form-group form-focus">
          <input name="email" type="email" class="form-control floating" id="editEmail" value="<?= $row['email'] ?>" required>
          <label class="focus-label">Email <span class="text-danger">*</span></label>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="form-group form-focus">
          <select class="form-control" name="role" id="editRole" required>
            <option value="1" <?= $row['role'] == 1 ? 'selected' : '' ?>>Quản trị</option>
            <option value="2" <?= $row['role'] == 2 ? 'selected' : '' ?>>Giảng viên</option>
            <option value="3" <?= $row['role'] == 3 ? 'selected' : '' ?>>Sinh viên</option>
          </select>
          <label class="focus-label">Quyền</label>
        </div>
        <div class="m-t-20 text-center">
          <button class="btn btn-primary btn-lg" type="submit" name="submit_edit">Sửa tài khoản</button>
        </div>
      </div>
    <?php
    }
  }
}

//Bảng monhoc
if (isset($_POST['id_monhoc'])) {
  $id_monhoc = $_POST['id_monhoc'];
  $select = "SELECT monhoc.maHP, monhoc.tenHP, monhoc.maTL, theloai.tenTL
              	  FROM monhoc
				          JOIN theloai ON monhoc.maTL = theloai.maTL
                  WHERE monhoc.maHP = '$id_monhoc'";
  $result = $db->select($select);
  if (!empty($result)) {
    while ($row = $result->fetch_assoc()) {
    ?>
      <div class="col-sm-8">
        <div class="form-group form-focus">
          <input name="maHP" type="text" class="form-control floating" id="editmaHP" value="<?= $row['maHP'] ?>" readonly required>
          <label class="focus-label">Mã môn học <span class="text-danger"></span></label>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="form-group form-focus">
          <input name="tenHP" type="text" class="form-control floating" id="edittenHP" value="<?= $row['tenHP'] ?>" required>
          <label class="focus-label">Tên môn học <span class="text-danger">*</span></label>
        </div>
      </div>

      </div>
      <div class="col-sm-8">
        <div class="form-group form-focus">
          <select class="form-control" name="maTL" id="editmaTL" required>
            <option value="<?= $row['maTL'] ?>"> <?= $row['tenTL'] ?></option>
            <?php
            $selectTL = "SELECT * FROM theloai";
            $resultTL = $db->select($selectTL);
            if (!empty($resultTL)) {
              while ($rowTL = $resultTL->fetch_assoc()) {

                echo '<option value="' . $rowTL['maTL'] . '">' . $rowTL['tenTL'] . '</option>';
              }
            } else {
              echo '<option value="">Không có dữ liệu</option>';
            }
            ?>
          </select>
          <label class="focus-label">Thể loại</label>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="m-t-20 text-center">
          <button class="btn btn-primary btn-lg" type="submit" name="submit_edit">Sửa môn học</button>
        </div>
      </div>
    <?php
    }
  }
}
//cauhoi
if (isset($_POST['id_cauhoi'])) {
  $id_cauhoi = $_POST['id_cauhoi'];
  $select = "SELECT cauhoi.maCH, cauhoi.noidung, cauhoi.loaiCauHoi, cauhoi.maTL, theloai.tenTL
             FROM cauhoi
             JOIN theloai ON cauhoi.maTL = theloai.maTL
             WHERE cauhoi.maCH = '$id_cauhoi'";
  $result = $db->select($select);
  if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
?>
          <div class="col-sm-8">
              <div class="form-group form-focus">
                  <input name="maCH" type="text" class="form-control floating" id="editmaCH" value="<?= $row['maCH'] ?>" readonly required>
                  <label class="focus-label">Mã câu hỏi <span class="text-danger"></span></label>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="form-group form-focus">
                  <input name="noidung" type="text" class="form-control floating" id="editnoidung" value="<?= $row['noidung'] ?>" required>
                  <label class="focus-label">Nội dung <span class="text-danger">*</span></label>
              </div>
          </div>

          <div class="col-sm-8">
              <div class="form-group form-focus">
                  <select class="form-control" name="maTL" id="editmaTL" required>
                      <option value="<?= $row['maTL'] ?>"> <?= $row['tenTL'] ?></option>
                      <?php
                      // Lấy danh sách thể loại để hiển thị
                      $selectTL = "SELECT * FROM theloai";
                      $resultTL = $db->select($selectTL);
                      if ($resultTL && $resultTL->num_rows > 0) {
                          while ($rowTL = $resultTL->fetch_assoc()) {
                              echo '<option value="' . $rowTL['maTL'] . '">' . $rowTL['tenTL'] . '</option>';
                          }
                      } else {
                          echo '<option value="">Không có dữ liệu</option>';
                      }
                      ?>
                  </select>
                  <label class="focus-label">Thể loại</label>
              </div>
          </div>
          <div class="col-sm-8">
                    <div class="form-group form-focus">
                        <select name="loaiCauHoi" class="form-control floating" required>
                            <option value="trac_nghiem">Trắc nghiệm</option>
                            <option value="tu_luan">Tự luận</option>
                        </select>
                        <label class="focus-label">Loại câu hỏi <span class="text-danger">*</span></label>
                    </div>
          </div>
          <div class="col-sm-8">
              <div class="m-t-20 text-center">
                  <button class="btn btn-primary btn-lg" type="submit" name="submit_edit">Sửa câu hỏi</button>
              </div>
          </div>
<?php
      }
  } else {
      echo "<p class='text-danger'>Không tìm thấy câu hỏi.</p>";
  }
  
}
// Đáp án
// if (isset($_POST['id_dapan'])) {
//   $id_dapan = $_POST['id_dapan'];
//   $select = "SELECT * FROM dapans WHERE idch = '$id_dapan'";
//   $result = $db->select($select);
  
//   if ($result && $result->num_rows > 0) {
//       while ($row = $result->fetch_assoc()) {
// ?>
//           <div class="col-sm-8">
//               <div class="form-group form-focus">
//                   <input name="idch" type="text" class="form-control floating" value="<?= $row['idch'] ?>" readonly>
//                   <label class="focus-label">ID Câu hỏi</label>
//               </div>
//           </div>
//           <div class="col-sm-8">
//               <div class="form-group form-focus">
//                   <input name="noidung" type="text" class="form-control floating" value="<?= $row['noidung'] ?>" required>
//                   <label class="focus-label">Nội dung Đáp án <span class="text-danger">*</span></label>
//               </div>
//           </div>
//           <div class="col-sm-8">
//               <div class="m-t-20 text-center">
//                   <button class="btn btn-primary btn-lg" type="submit" name="submit_edit">Sửa Đáp Án</button>
//               </div>
//           </div>
// <?php
//       }
//   } else {
//       echo "<p class='text-danger'>Không tìm thấy đáp án.</p>";
//   }
// }
// ?>

?>
