<?php
$page = basename($_SERVER['SCRIPT_NAME']);
?>
<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <div class="header-left">
        <a href="index.html" class="logo">
          <img src="assets/img/logo1.png" width="40" height="40" alt="Logo trường">
          <span class="text-uppercase">CNPMHHH</span>
        </a>
      </div>
      <ul class="sidebar-ul">
        <li class="menu-title">Menu</li>

        <!-- <li class="<?= $page == 'index.php' ? '' : '' ?>">
          <a href="index.php">
            <img src="assets/img/sidebar/icon-1.png" alt="icon"><span>Nhập điểm</span>
          </a>
        </li>

        <li class="submenu <?= $page == 'giangvien.php' ? '' : '' ?>">
          <a href="giangvien.php">
            <img src="assets/img/sidebar/icon-2.png" alt="icon"> <span> Giảng viên</span>
          </a>
        </li>

        <li class="submenu <?= $page == 'sinhvien.php' ? '' : '' ?>">
          <a href="sinhvien.php">
            <img src="assets/img/sidebar/icon-3.png" alt="icon"> <span> Sinh viên</span>
          </a>
        </li>

        <li class="submenu <?= in_array($page, ['hoc-ky.php', 'nam-hoc.php', 'nien-khoa.php']) ? '' : '' ?>">
          <a href="#">
            <img src="assets/img/sidebar/icon-4.png" alt="icon"> <span> Thông tin chung</span> <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display: none;">
            <li><a href="hoc-ky.php" class="<?= $page == 'hoc-ky.php' ? '' : '' ?>"><span>Học kỳ</span></a></li>
            <li><a href="nam-hoc.php" class="<?= $page == 'nam-hoc.php' ? '' : '' ?>"><span>Năm học</span></a></li>
            <li><a href="nien-khoa.php" class="<?= $page == 'nien-khoa.php' ? '' : '' ?>"><span>Niên khóa</span></a></li>
          </ul>
        </li> -->

        <li class=" <?= in_array($page, ['monhoc.php', 'the-loai.php', 'tin-chi.php']) ? '' : '' ?>">
          <a href="monhoc.php">
            <img src="assets/img/sidebar/icon-4.png" alt="icon"> <span>Môn Học</span> <span class="menu-arrow"></span>
          </a>
        </li>
        <li class=" <?= $page == 'account.php' ? '' : '' ?>">
          <a href="account.php">
            <img src="assets/img/sidebar/icon-4.png" alt="icon"> <span> Tài khoản</span>
          </a>
        </li>
        <li class=" <?= $page == 'cauhoi.php' ? '' : '' ?>">
          <a href="cauhoi.php">
            <img src="assets/img/sidebar/icon-4.png" alt="icon"> <span> Câu hỏi</span>
          </a>
        </li>
        <li class=" <?= $page == '#' ? '' : '' ?>">
          <a href="#">
            <img src="assets/img/sidebar/icon-4.png" alt="icon"> <span>Quản lý Thi</span>
          </a>
        </li><li class=" <?= $page == '#' ? '' : '' ?>">
          <a href="#">
            <img src="assets/img/sidebar/icon-4.png" alt="icon"> <span> Thống kê điểm</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div