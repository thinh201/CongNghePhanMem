<?php
include 'includes/header.php';
include 'classes/user.php';
include 'classes/monhoc.php';

$monhocs = new monhoc();
if (isset($_GET['maHP'])) {
    $getid = $_GET['maHP'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $create_monhoc = $monhocs->add_monhoc($_POST);
    }
    if (isset($_POST['submit_del'])) {
        if (isset($_POST['del_id'])) {
            $del_monhoc = $monhocs->del_monhoc($_POST['del_id']);
        }
    }
    if (isset($_POST['submit_edit'])) {
        if (isset($_POST['edit_id'])) {
            $update_monhoc = $monhocs->update_monhoc($_POST);
        }
    }
}
?>

<div class="row">
    <div class="col-sm-4 col-4"></div>
    <div class="col-sm-8 col-8 text-right add-btn-col">
        <?php if (Session::get('role') == '1') { ?>
            <a href="#" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#add_monhoc">
                <i class="fas fa-plus"></i> Thêm Môn học
            </a>
        <?php } ?>
    </div>
</div>

<div class="content-page">
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Tên môn học</label>
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
                            <th style="width:30%;">Mã môn học</th>
                            <th>Tên môn học</th>
                            <th>Loại môn học</th>

                            <th class="text-right">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $show_monhoc = $monhocs->show_monhoc();
                        $i = 1;
                        if ($show_monhoc && $show_monhoc->num_rows > 0) {
                            while ($result = $show_monhoc->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>
                                        <h2><a href=""><?= $result['maHP'] ?></a></h2>
                                    </td>
                                    <td>
                                        <h2><a href=""><?= $result['tenHP'] ?></a></h2>
                                    </td>
                                    <td>
                                        <h2><a href=""><?= $result['tenTL'] ?></a></h2>
                                    </td>

                                    <?php if (Session::get('role') == '1') { ?>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item edit-monhoc" data-id="<?= $result['maHP'] ?>" data-toggle="modal" data-target="#edit_monhoc">
                                                        <i class="fas fa-pencil-alt m-r-5"></i> Sửa
                                                    </a>
                                                    <a class=" dropdown-item delete-monhoc" data-id="<?= $result['maHP'] ?>" data-toggle="modal" data-target="#delete_monhoc">
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

<div id="add_monhoc" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered justify-content-center">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Thêm học phần</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="monhoc.php" method="post" class="m-b-30">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <div class="form-group form-focus">
                                <input name="maHP" type="text" class="form-control floating" required>
                                <label class="focus-label">Mã học phần <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group form-focus">
                                <input name="tenHP" type="text" class="form-control floating" required>
                                <label class="focus-label">Tên học phần <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group form-focus">
                                <select class="form-control" name="maTL" required>
                                    <?php 
                                    $tenTheloai = $monhocs->get_theloai(); 
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
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary btn-lg" name="submit">Thêm học phần</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal sửa học phần -->
<div id="edit_monhoc" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Sửa học phần</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="monhoc.php" method="post" class="m-b-30" id="editForm">
                    <input type="hidden" name="edit_id" id="editmonhocId" value="">
                    <div class="row justify-content-center" id="monhoc"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="delete_monhoc" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">Xóa học phần </h4>
            </div>
            <form id="deleteForm" method="post" action="monhoc.php">
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa không?</p>
                    <input type="hidden" id="deletemonhocId" name="del_id" value="">
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
        if (event.target.classList.contains('edit-monhoc')) {
            const idValue = event.target.getAttribute('data-id');
            document.getElementById('editmonhocId').value = idValue;
            $.ajax({
                url: 'classes/ajax.php',
                method: 'POST',
                data: { id_monhoc: idValue },
                success: function(response) {
                    $('#monhoc').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi: " + error);
                }
            });
        }
    });
    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-monhoc')) {
            const idValue = event.target.getAttribute('data-id');
            document.getElementById('deletemonhocId').value = idValue;
        }
    });
</script>
<?php include 'includes/footer.php'; ?>