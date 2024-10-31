<?php
class monhoc {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function show_monhoc() {
        $query = "SELECT monhoc.maHP, monhoc.tenHP, monhoc.maTL, theloai.tenTL
                  FROM monhoc
                  JOIN theloai ON monhoc.maTL = theloai.maTL";
        return $this->db->select($query);
    }

    public function add_monhoc($data) {
        $maHP = mysqli_real_escape_string($this->db->link, $data['maHP']);
        $tenHP = mysqli_real_escape_string($this->db->link, $data['tenHP']);
        $maTL = mysqli_real_escape_string($this->db->link, $data['maTL']);

        $check_maHP = "SELECT maHP FROM monhoc WHERE maHP = '$maHP'";
        $check_query = $this->db->select($check_maHP);
        
        if ($check_query && mysqli_num_rows($check_query) > 0) {
            $_SESSION['error'] = "Mã học phần đã tồn tại";
            return false;
        } else {
            if (empty($maHP) || empty($tenHP) || empty($maTL)) {
                $_SESSION['error'] = "Không được để trống";
                return false;
            }

            $insert = "INSERT INTO monhoc(maHP, tenHP, maTL) VALUES ('$maHP', '$tenHP', '$maTL')";
            $query = $this->db->insert($insert);

            if ($query) {
                $_SESSION['alert'] = "Tạo học phần thành công";
                return true;
            } else {
                $_SESSION['error'] = "Đã xảy ra sự cố";
                return false;
            }
        }
    }

    public function del_monhoc($maHP) {
        $query = "DELETE FROM monhoc WHERE maHP = '$maHP'";
        $result = $this->db->delete($query);

        if ($result) {
            $_SESSION['alert'] = "Xóa thành công";
            return true;
        } else {
            $_SESSION['error'] = "Đã xảy ra lỗi";
            return false;
        }
    }

    public function get_monhoc($maHP) {
        $query = "SELECT * FROM monhoc WHERE maHP = '$maHP'";
        return $this->db->select($query);
    }

    public function get_theloai() {
        $query = "SELECT * FROM theloai";
        return $this->db->select($query);
    }

    public function update_monhoc($data) {
        $maHP = mysqli_real_escape_string($this->db->link, $data['edit_id']);
        $tenHP = mysqli_real_escape_string($this->db->link, $data['tenHP']);
        $maTL = mysqli_real_escape_string($this->db->link, $data['maTL']);

        if (empty($maHP) || empty($tenHP) || empty($maTL)) {
            $_SESSION['error'] = "Không được để trống";
            return false;
        }

        $query = "UPDATE monhoc SET tenHP = '$tenHP', maTL = '$maTL' WHERE maHP = '$maHP'";
        $result = $this->db->update($query);

        if ($result) {
            $_SESSION['alert'] = 'Cập nhật thành công';
            return true;
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại';
            return false;
        }
    }
}
