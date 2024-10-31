<?php
include_once('../lib/session.php');
include_once('../lib/database.php');
$db = new Database();

if (isset($_POST['id_cauhoi'])) {
    $id_cauhoi = $_POST['id_cauhoi'];
    // Truy vấn đáp án tương ứng với ID câu hỏi
    $select = "SELECT * FROM dapans WHERE maCH = '$id_cauhoi'";
    $result = $db->select($select);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-sm-8">
                <div class="form-group form-focus">
                    <input name="noidung" type="text" class="form-control floating" id="editnoidung" value="<?= $row['noidung'] ?>" required>
                    <label class="focus-label">Nội dung đáp án <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group form-focus">
                    <select name="dung" class="form-control floating" required>
                        <option value="1" <?= $row['dung'] == 1 ? 'selected' : '' ?>>Đúng</option>
                        <option value="0" <?= $row['dung'] == 0 ? 'selected' : '' ?>>Sai</option>
                    </select>
                    <label class="focus-label">Đáp án <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary btn-lg" type="submit" name="submit_edit">Sửa đáp án</button>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p class='text-danger'>Không tìm thấy đáp án.</p>";
    }
} 
?>
