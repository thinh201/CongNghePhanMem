</div>
<script></script>
<script>
  <?php if (isset($_SESSION['alert'])) { ?>
    // Hiển thị thông báo khi thêm thành công
    alertify.set('notifier', 'position', 'top-right');
    alertify.success('<?= $_SESSION['alert']; ?>');
  <?php
    unset($_SESSION['alert']);
  } ?>
</script>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>


<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="assets/js/app.js"></script>
</body>

</html>