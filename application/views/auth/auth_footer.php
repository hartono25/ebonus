<!-- END PAGE CONTENT-->
<footer class="page-footer">
    <div class="font-13">2021 © <b>Tia</b></div>
    <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
</footer>
</div>
</div>

<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS-->
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="<?= base_url('template/html/dist') ?>/assets/js/app.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS-->
<script src="<?= base_url('template/html/dist') ?>/assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>

<!-- DataTable -->
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('template/html/dist') ?>/assets/vendors/DataTables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('template/datepicker/js/bootstrap-datepicker.js') ?>"></script>
<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: "mm/yyyy",
            startView: "year",
            minViewMode: "year"
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var nik = $(this).data('nik');
            var nama = $(this).data('nama');
            var bonus = $(this).data('bonus');
            $('#nik').val(nik);
            $('#nama').val(nama);
            $('#bonus').val(bonus);
            $('#exampleModal').modal('hide');
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "scrollY": 250,
        });
    });
    $(document).ready(function() {
        $('#tatabel').DataTable({
            "scrollY": 350,
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".add-more").click(function() {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click", ".remove", function() {
            $(this).parents(".damn").remove();
        });
    });
</script>
</body>

</html>