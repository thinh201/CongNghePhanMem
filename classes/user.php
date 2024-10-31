<?php
$filepath = realpath(dirname(__FILE__));
include_once 'lib/session.php';
include_once 'lib/database.php';
include_once 'helpers/format.php';
?>



<?php

/**
 * 
 */
class user
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function show_account()
	{
		$query = "SELECT * FROM taikhoan order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function register_account($data)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
		$cpass = mysqli_real_escape_string($this->db->link, md5($data['cpass']));
		$role = mysqli_real_escape_string($this->db->link, $data['role']);
		$check_mail = "SELECT email FROM taikhoan WHERE email='$email'";
		$check_query = $this->db->select($check_mail);
		if ($check_query !== false && mysqli_num_rows($check_query) > 0) {
			$_SESSION['error'] = "Email đã tồn tại";
			return false;
		} else {
			if (empty($name) || empty($email) || empty($pass)) {
				$_SESSION['error'] = "Không được để trỗng";
				return false;
			} else {
				if ($pass == $cpass) {
					$insert = "INSERT INTO taikhoan(username,password,email,role) VALUES ('$name','$pass','$email','$role')";
					$query = mysqli_query($this->db->link, $insert);
					if ($query) {
						$_SESSION['alert'] = "Đăng kí thành công";
						return true;
					} else {
						$_SESSION['error'] = "Đã xảy ra sự cố";
						return false;
					}
				} else {
					$_SESSION['error'] = "Mật khẩu khác nhau hãy nhập lại";

					return false;
				}
			}
		}
	}
	public function del_account($id)
	{
		$query = "DELETE FROM taikhoan WHERE id = '$id'";
		$result = $this->db->delete($query);
		if ($result) {
			$_SESSION['alert'] = "Xóa thành công";
			return true;
		} else {
			$_SESSION['alert'] = "Đã xảy ra lỗi";
			return false;
		}
	}
	public function change_pass_user($data)
	{
		$passold = mysqli_real_escape_string($this->db->link, md5($data['passold']));
		$passnew = mysqli_real_escape_string($this->db->link, md5($data['passnew']));
		if ($passold == "" || $passnew == "") {
			$_SESSION['alert'] = "không được để trống";
			return true;
		} else {
			$query = "SELECT * FROM users WHERE pass='$passold'";
			$result_check = $this->db->select($query);
			if ($result_check == false) {
				$_SESSION['alert'] = "Mât khẩu sai hoặc mục đang để trống,làm ơn nhập lại";
				return true;
			}
			$query1 = "UPDATE users SET pass='$passnew' WHERE pass ='$passold'";
			$result = $this->db->insert($query1);
			if ($result) {
				$_SESSION['alert'] = 'Đã cập nhật thành công';
				return true;
			} else {
				$_SESSION['alert'] = "Cập nhật không thành công";
				return false;
			}
		}
	}
	public function get_account($id)
	{
		$query = "SELECT * FROM taikhoan WHERE id='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_account($data)
	{
		$id = mysqli_real_escape_string($this->db->link, $data['edit_id']);
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$role = mysqli_real_escape_string($this->db->link, $data['role']);
		$query = "UPDATE taikhoan SET username='$name', email='$email', role='$role' WHERE id ='$id' ";
		$result = $this->db->update($query);
		if ($result) {
			$_SESSION['alert'] = 'Cập nhật thành công';
			return true;
		} else {
			$_SESSION['alert'] = 'Cập nhật thất bại';
			return false;
		}
	}
	public function user_today()
	{
		$query = "SELECT COUNT(*) AS user_count FROM users WHERE DATE(created_at) = CURDATE() AND status='0'";
		$result = $this->db->select($query);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}
	public function user_today_page($begin)
	{
		$query = "SELECT * FROM users WHERE DATE(created_at) = CURDATE() AND status = '0' ORDER BY created_at DESC LIMIT $begin, 5";
		$result = $this->db->select($query);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}


	public function user_new()
	{
		$three_days_ago = date('Y-m-d H:i:s', strtotime('-3 days'));
		$query = "SELECT COUNT(*) AS user_count,name FROM users  WHERE status='0' AND created_at >= '$three_days_ago'";
		$result = $this->db->select($query);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}
}
?>