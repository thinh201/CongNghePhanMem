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
// cauhoi
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
// DA
if (isset($_POST['submit_edit'])) {
  $dapans = new Dapans();
  $result = $dapans->update_dapan($_POST); // Gọi phương thức update_dapan và truyền dữ liệu $_POST

  if ($result) {
      echo "Cập nhật đáp án thành công!";
  } else {
      echo "Có lỗi xảy ra khi cập nhật đáp án!";
  }
}
 
if (isset($_POST['id_dapan'])) {
  $id_dapan = $_POST['id_dapan'];
  $select = "SELECT dapans.maDA, dapans.idCH, dapans.noidung, cauhoi.maCH, cauhoi.idCH AS idCauHoi
              FROM dapans 
              JOIN cauhoi ON dapans.idCH = cauhoi.idCH 
              WHERE dapans.idCH = '$id_dapan'";
  $result = $db->select($select);

  // Khởi tạo biến để lưu trữ đáp án
  $answers = [];
  $maCH = ''; // Khởi tạo biến cho mã câu hỏi
  $idCH = ''; // Khởi tạo biến cho id câu hỏi

  if ($result && $result->num_rows > 0) {
      // Lấy tất cả đáp án vào mảng
      while ($row = $result->fetch_assoc()) {
          $answers[] = $row; // Thêm mỗi đáp án vào mảng
          $maCH = $row['maCH']; // Lấy ID câu hỏi từ đáp án đầu tiên
          $idCH = $row['idCauHoi']; // Lưu idCH từ hàng đầu tiên
      }
  }

  // Nếu không có đáp án, vẫn lấy idCH từ câu hỏi
  if (empty($maCH)) {
      // Truy vấn để lấy idCH nếu không có đáp án
      $selectCH = "SELECT idCH, maCH FROM cauhoi WHERE idCH = '$id_dapan'";
      $resultCH = $db->select($selectCH);
      if ($resultCH && $resultCH->num_rows > 0) {
          $rowCH = $resultCH->fetch_assoc();
          $maCH = $rowCH['maCH'];
          $idCH = $rowCH['idCH'];
      }
  }
  ?>

  <div class="col-sm-8">
      <div class="form-group form-focus">
          <input name="maCH" type="text" class="form-control floating" value="<?= $maCH ?>" readonly>
          <label class="focus-label">Mã Câu hỏi</label>
      </div>
  </div>

  <?php 
  // Hiển thị tối đa 4 ô textbox cho đáp án
  $answerLabels = ['A', 'B', 'C', 'D'];
  for ($index = 0; $index < 4; $index++) {
      if (isset($answers[$index])) {
          $noidung = $answers[$index]['noidung']; // Nếu có đáp án, lấy nội dung
          $maDA = $answers[$index]['maDA']; // ID đáp án
      } else {
          $noidung = ''; // Nếu không có đáp án, để trống
          $maDA = ''; // Nếu không có đáp án, để trống
      }
      ?>

      <div class="col-sm-8">
          <div class="form-group form-focus">
              <input name="noidung[]" type="text" class="form-control floating" value="<?= $noidung ?>" required>
              <label class="focus-label">Đáp án <?= $answerLabels[$index] ?> <span class="text-danger">*</span></label>
          </div>
      </div>

      <input type="hidden" name="maDA[]" value="<?= $maDA ?>"> <!-- ID Đáp án -->

      <?php 
  }
  ?>

  <div class="col-sm-8">
      <div class="m-t-20 text-center">
          <button class="btn btn-primary btn-lg" type="submit" name="submit_edit">Sửa Đáp Án</button>
      </div>
  </div>

  
  <?php
}
?>