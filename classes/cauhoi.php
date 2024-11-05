<?php
class cauhoi {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function show_cauhoi() {
        $query = "SELECT cauhoi.idch,cauhoi.maCH, cauhoi.noidung, cauhoi.loaiCauHoi, theloai.tenTL
                  FROM cauhoi
                  JOIN theloai ON cauhoi.maTL = theloai.maTL"; // Đảm bảo là bạn có maTL trong SELECT
        return $this->db->select($query);
    }
    

    public function add_cauhoi($data) {
        $maCH = mysqli_real_escape_string($this->db->link, $data['maCH']);
        $noidung = mysqli_real_escape_string($this->db->link, $data['noidung']);
        $loaiCauHoi = mysqli_real_escape_string($this->db->link, $data['loaiCauHoi']);
        $maTL = mysqli_real_escape_string($this->db->link, $data['maTL']); // Lấy giá trị maTL
    
        $check_maCH = "SELECT maCH FROM cauhoi WHERE maCH = '$maCH'";
        $check_query = $this->db->select($check_maCH);
        
        if ($check_query && mysqli_num_rows($check_query) > 0) {
            $_SESSION['error'] = "Mã câu hỏi đã tồn tại";
            return false;
        } else {
            if (empty($maCH) || empty($noidung) || empty($loaiCauHoi) || empty($maTL)) { // Kiểm tra maTL
                $_SESSION['error'] = "Không được để trống";
                return false;
            }
    
            // Thêm maTL vào câu lệnh INSERT
            $insert = "INSERT INTO cauhoi(maCH, noidung, loaiCauHoi, maTL) VALUES ('$maCH', '$noidung', '$loaiCauHoi', '$maTL')";
            $query = $this->db->insert($insert);
    
            if ($query) {
                $_SESSION['alert'] = "Tạo câu hỏi thành công";
                return true;
            } else {
                $_SESSION['error'] = "Đã xảy ra sự cố";
                return false;
            }
        }
    }
    
    public function del_cauhoi($maCH) {
        $query = "DELETE FROM cauhoi WHERE maCH = '$maCH'";
        $result = $this->db->delete($query);

        if ($result) {
            $_SESSION['alert'] = "Xóa thành công";
            return true;
        } else {
            $_SESSION['error'] = "Đã xảy ra lỗi";
            return false;
        }
    }

    public function get_cauhoi($maCH) {
        $query = "SELECT * FROM cauhoi WHERE maCH = '$maCH'";
        return $this->db->select($query);
    }
    public function get_theloai() {
        $query = "SELECT * FROM theloai";
        return $this->db->select($query);
    }
    public function update_cauhoi($data) {
        // Lấy và làm sạch các giá trị từ dữ liệu đầu vào
        $maCH = mysqli_real_escape_string($this->db->link, $data['maCH']);
        $noidung = mysqli_real_escape_string($this->db->link, $data['noidung']);
        $maTL = mysqli_real_escape_string($this->db->link, $data['maTL']); // Mã thể loại
        $loaiCauHoi = mysqli_real_escape_string($this->db->link, $data['loaiCauHoi']); // Loại câu hỏi
    
        // Kiểm tra xem các trường có bị bỏ trống hay không
        if (empty($maCH) || empty($noidung) || empty($maTL) || empty($loaiCauHoi)) {
            $_SESSION['error'] = "Không được để trống";
            return false;
        }
    
        // Câu lệnh cập nhật
        $query = "UPDATE cauhoi SET noidung = '$noidung', maTL = '$maTL', loaiCauHoi = '$loaiCauHoi' WHERE maCH = '$maCH'";
        $result = $this->db->update($query);
    
        // Kiểm tra kết quả cập nhật
        if ($result) {
            $_SESSION['alert'] = 'Cập nhật thành công';
            return true;
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại';
            return false;
        }
    }
}    