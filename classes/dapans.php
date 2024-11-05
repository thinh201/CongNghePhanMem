<?php
class Dapans {
    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    

    public function show_dapans($maCH) {
        $query = "SELECT * FROM dapans WHERE idCH = '$maCH'";
        return $this->db->select($query);
    }

    public function get_dapan($idch) {
          $query = "SELECT * FROM dapans WHERE idch = '$idch'";
          return $this->db->select($query);}

    public function update_dapan($data) {
        // Lặp qua danh sách đáp án để cập nhật từng cái một
        foreach ($data['maDA'] as $index => $maDA) {
            $noidung = mysqli_real_escape_string($this->db->link, $data['noidung'][$index]);
            
            if (!empty($maDA)) {  // Nếu có maDA thì tiến hành cập nhật
                $query = "UPDATE dapans SET noidung = '$noidung' WHERE maDA = '$maDA'";
                $result = $this->db->update($query);
    
                if (!$result) {
                    return false; // Trả về false nếu cập nhật thất bại
                }
            } else {
                // Nếu không có `maDA`, nghĩa là đáp án mới, ta thêm mới
                $idCH = mysqli_real_escape_string($this->db->link, $data['edit_id']);
                $query = "INSERT INTO dapans (idCH, noidung) VALUES ('$idCH', '$noidung')";
                $result = $this->db->insert($query);
    
                if (!$result) {
                    return false; // Trả về false nếu thêm thất bại
                }
            }
        }
        return true; // Cập nhật thành công
    }
    
}