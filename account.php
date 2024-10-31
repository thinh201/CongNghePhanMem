<?php
include 'includes/header.php';
include 'classes/user.php';

$account = new user();
if (isset($_GET['id'])) {
  $getid = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['submit'])) {
    $create_acc = $account->register_account($_POST);
  }
  if (isset($_POST['submit_del'])) {
    if (isset($_POST['del_id'])) {
      $del_account = $account->del_account($_POST['del_id']);
    }
  }
  if (isset($_POST['submit_edit'])) {
    if (isset($_POST['edit_id'])) {
      $update_account = $account->update_account($_POST);
    }
  }
}
?>

<div class="row">
  <div class="col-sm-4 col-4"></div>
  <div class="col-sm-8 col-8 text-right add-btn-col">
    <?php if (Session::get('role') == '1') { ?>
      <a href="#" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#add_account">
        <i class="fas fa-plus"></i> Thêm tài khoản
      </a>
    <?php } ?>
  </div>
</div>

<div class="content-page">
  <div class="row filter-row">
    <div class="col-sm-6 col-md-3">
      <div class="form-group form-focus select-focus">
        <select class="form-control">
          <option></option>
          <option>Quản trị</option>
          <option>Giảng viên</option>
          <option>Sinh viên</option>
        </select>
        <label class="focus-label">Tài khoản</label>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="form-group form-focus"></div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="form-group form-focus"></div>
    </div>
    <!-- <div class="col-sm-6 col-md-3">
      <a href="#" class="btn btn-search rounded btn-block mb-3"> Tìm kiếm </a>
    </div> -->
  </div>

  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="table-responsive">
        <table class="table custom-table datatable">
          <thead class="thead-light">
            <tr>
              <th style="width:30%;">Tên</th>
              <th>Email</th>
              <th>Quyền</th>
              <th class="text-right">Chức năng</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $show_account = $account->show_account();
            if ($show_account && $show_account->num_rows > 0) {
              while ($result = $show_account->fetch_assoc()) {
            ?>
                <tr>
                  <td>
                    <a href="profile.html" class="avatar">D</a>
                    <h2><a href="profile.html"><?= $result['username'] ?></a></h2>
                  </td>
                  <td>
                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="dfbbbeb1b6bab3afb0adabbaad9fbaa7beb2afb3baf1bcb0b2"><?= $result['email'] ?></a>
                  </td>
                  <td>
                    <?php if ($result['role'] == 1) { ?>
                      <span class="badge badge-danger-border">Quản trị viên</span>
                    <?php } else if ($result['role'] == 2) { ?>
                      <span class="badge badge-success-border">Giảng viên</span>
                    <?php } else { ?>
                      <span class="badge badge-info-border">Sinh viên</span>
                    <?php } ?>
                  </td>
                  <?php if (Session::get('role') == '1') { ?>
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item edit-account" data-id="<?= $result['id'] ?>" data-toggle="modal" data-target="#edit_account">
                            <i class="fas fa-pencil-alt m-r-5"></i> Sửa
                          </a>
                          <a class=" dropdown-item delete-account" data-id="<?= $result['id'] ?>" data-toggle="modal" data-target="#delete_account">
                            <i class="fas fa-trash-alt m-r-5"></i> Xóa
                          </a>
                        </div>
                      </div>
                    </td>
                  <?php } ?>
                </tr>
            <?php }
            } else {
              echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="add_account" class="modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered justify-content-center">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h4 class="modal-title">Tạo tài khoản</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="account.php" method="post" class="m-b-30">
          <div class="row justify-content-center">
            <div class="col-sm-8">
              <div class="form-group form-focus">
                <input name="name" type="text" class="form-control floating" required>
                <label class="focus-label">Tên <span class="text-danger">*</span></label>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group form-focus">
                <input name="email" type="email" class="form-control floating" required>
                <label class="focus-label">Email <span class="text-danger">*</span></label>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group form-focus">
                <input name="pass" type="password" class="form-control floating" required>
                <label class="focus-label">Mật khẩu <span class="text-danger">*</span></label>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group form-focus">
                <input name="cpass" type="password" class="form-control floating" required>
                <label class="focus-label">Nhập lại mật khẩu <span class="text-danger">*</span></label>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group form-focus">
                <select class="form-control" name="role" required>
                  <option value="1">Quản trị</option>
                  <option value="2">Giảng viên</option>
                  <option value="3">Sinh viên</option>
                </select>
                <label class="focus-label">Quyền</label>
              </div>
              <div class="m-t-20 text-center">
                <button class="btn btn-primary btn-lg" name="submit">Tạo tài khoản</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="edit_account" class="modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h4 class="modal-title">Sửa tài khoản</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="account.php" method="post" class="m-b-30" id="editForm">
          <input type="hidden" name="edit_id" id="editAccountId" value="">
          <div class="row justify-content-center" id="account">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div id="delete_account" class="modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-md">
      <div class="modal-header">
        <h4 class="modal-title">Xóa tài khoản</h4>
      </div>
      <form id="deleteForm" method="post" action="account.php">
        <div class="modal-body">
          <p>Bạn có chắc chắn muốn xóa không?</p>
          <input type="hidden" id="deleteAccountId" name="del_id" value="">
          <div class="m-t-20">
            <a href="#" class="btn btn-white" data-dismiss="modal">Đóng</a>
            <button type="submit" name="submit_del" class="btn btn-danger">Xóa</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  document.body.addEventListener('click', function(event) {
    if (event.target.classList.contains('edit-account')) {
      const idValue = event.target.getAttribute('data-id');
      document.getElementById('editAccountId').value = idValue;
      $.ajax({
        url: 'classes/ajax.php', // Thay thế bằng đường dẫn đến tệp PHP của bạn
        method: 'POST',
        data: {
          id_Account: idValue
        },
        success: function(response) {
          $('#account').html(response); // Chèn nội dung HTML trả về vào phần tử div
        },
        error: function(xhr, status, error) {
          console.error("Lỗi: " + error);
        }
      });
    }
  });
  document.body.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-account')) {
      const idValue = event.target.getAttribute('data-id');
      document.getElementById('deleteAccountId').value = idValue;
    }
  });
</script>
<?php include 'includes/footer.php'; ?>