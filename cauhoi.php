<?php
include 'includes/header.php';
include 'classes/user.php';
include 'classes/cauhoi.php';

$cauhois = new cauhoi();
if (isset($_GET['maCH'])) {
    $getid = $_GET['maCH'];
}

    

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $create_cauhoi = $cauhois->add_cauhoi($_POST);
    }
    if (isset($_POST['submit_del'])) {
        if (isset($_POST['del_id'])) {
            $del_cauhoi = $cauhois->del_cauhoi($_POST['del_id']);
        }
    }
    if (isset($_POST['submit_edit'])) {
        if (isset($_POST['edit_id'])) {
            $update_cauhoi = $cauhois->update_cauhoi($_POST);
        }
    }
    
    
}

?>

<div class="row">
    <div class="col-sm-4 col-4"></div>
    <div class="col-sm-8 col-8 text-right add-btn-col">
        <?php if (Session::get('role') == '1') { ?>
            <a href="#" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#add_cauhoi">
                <i class="fas fa-plus"></i> Thêm Câu hỏi
            </a>
        <?php } ?>
    </div>
</div>

<div class="content-page">
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Tìm câu hỏi</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus"></div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus"></div>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-search rounded btn-block mb-3"> Tìm kiếm </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="table-responsive">
                <table class="table custom-table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th style="width:30%;">Mã câu hỏi</th>
                            <th>Nọi Dung</th>
                            <th>loại</th>
                            <th>Loại câu hỏi</th>

                            <th class="text-right">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $show_cauhoi = $cauhois->show_cauhoi();
                        $i = 1;
                        if ($show_cauhoi && $show_cauhoi->num_rows > 0) {
                            while ($result = $show_cauhoi->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?= $i++ ?></td>

                                    <td>
                                        <h2><a href=""><?= $result['maCH'] ?></a></h2>
                                    </td>
                                    <td>
                                        <h2><a href=""><?= $result['noidung'] ?></a></h2>
                                    </td>
                                    <td>
                                        <h2><a href=""><?= $result['tenTL'] ?></a></h2> <!-- Hiển thị tên thể loại -->
                                    </td>
                                    <td>
                                        <h2><a href=""><?= $result['loaiCauHoi'] ?></a></h2>
                                    </td>

                                    <?php if (Session::get('role') == '1') { ?>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit-cauhoi" data-id="<?= $result['maCH'] ?>" data-toggle="modal" data-target="#edit_cauhoi">
                                                        <i class="fas fa-pencil-alt m-r-5"></i> Sửa
                                                    </a>
                                                    <a class="dropdown-item edit-dapan" data-id="<?= $result['idch'] ?>" data-toggle="modal" data-target="#edit_dapan">
                                                        <i class="fas fa-pencil-alt m-r-5"></i> Sửa Đáp Án
                                                    </a>
                                                    <a class="dropdown-item delete-cauhoi" data-id="<?= $result['maCH'] ?>" data-toggle="modal" data-target="#delete_cauhoi">
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

<div id="add_cauhoi" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered justify-content-center">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Thêm câu hỏi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="cauhoi.php" method="post" class="m-b-30">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <div class="form-group form-focus">
                                <input name="maCH" type="text" class="form-control floating" required>
                                <label class="focus-label">Mã câu hỏi <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group form-focus">
                                <input name="noidung" type="text" class="form-control floating" required>
                                <label class="focus-label">Noi dung câu hỏi <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group form-focus">
                                <select class="form-control" name="maTL" required>
                                    <?php 
                                    $tenTheloai = $cauhois->get_theloai(); 
                                    if ($tenTheloai && $tenTheloai->num_rows > 0) {
                                        while ($theloai = $tenTheloai->fetch_assoc()) {
                                            
                                            echo '<option value="' . $theloai['maTL'] . '">' . $theloai['tenTL'] . '</option>';
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
                                <button class="btn btn-primary btn-lg" name="submit">Thêm câu hỏi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal sửa câu hỏi  -->
<div id="edit_cauhoi" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Sửa câu hỏi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="cauhoi.php" method="post" class="m-b-30" id="editForm">
                    <input type="hidden" name="edit_id" id="editcauhoiId" value="">
                    <div class="row justify-content-center" id="cauhoi"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- da -->
<div id="edit_dapan" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Sửa đáp án</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="classes/dapans.php" method="post" class="m-b-30" id="editForm">
                    <input type="hidden" name="edit_id" id="editdapanId" value="">
                    <div class="row justify-content-center" id="dapan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="delete_cauhoi" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">Xóa câu hỏi </h4>
            </div>
            <form id="deleteForm" method="post" action="cauhoi.php">
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa không?</p>
                    <input type="hidden" id="deletecauhoiId" name="del_id" value="">
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
        if (event.target.classList.contains('edit-cauhoi')) {
            const idValue = event.target.getAttribute('data-id');
            document.getElementById('editcauhoiId').value = idValue;
            $.ajax({
                url: 'classes/ajax.php',
                method: 'POST',
                data: { id_cauhoi: idValue },
                success: function(response) {
                    $('#cauhoi').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi: " + error);
                }
            });
        }
    });
    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-cauhoi')) {
            const idValue = event.target.getAttribute('data-id');
            document.getElementById('deletecauhoiId').value = idValue;
        }
    });

    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('edit-dapan')) {
            const idValue = event.target.getAttribute('data-id');
            document.getElementById('editdapanId').value = idValue;
            $.ajax({
                url: 'classes/ajax.php',
                method: 'POST',
                data: { id_dapan: idValue },
                success: function(response) {
                    $('#dapan').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi: " + error);
                }
            });
        }
    });

    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-cauhoi')) {
            const idValue = event.target.getAttribute('data-id');
            document.getElementById('deletecauhoiId').value = idValue;
        }
    });
</script>
<?php include 'includes/footer.php'; ?>