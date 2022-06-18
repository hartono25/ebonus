<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-left">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <!-- <div class=""> -->
                    <div class="col-md-6">
                        <div class="ibox-title">Data Bobot Kriteria</div>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('bobot/tambah') ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-fw fa-plus-square"></i>
                            Tambah Data
                        </a>
                    </div>
                    <!-- </div> -->

                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover" id="example">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No.</th>
                                <th class="text-left">KRITERIA PENILAIAN</th>
                                <th class="text-center">BOBOT NILAI</th>
                                <th class="text-center">PERBAIKAN BOBOT</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            foreach ($data as $d) :

                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?>.</td>
                                    <td class="text-left"><?= $d['kriteria'] ?></td>
                                    <td class="text-center"><?= $d['nilai_bobot'] ?></td>
                                    <td class="text-center"><?= $d['perbaikan_bobot'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('bobot/' . $d['id_bobot']) ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-fw fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="#" onclick="hapus('<?= $d['id_bobot'] ?>')" class="btn btn-danger btn-sm">
                                            <i class="fa fa-fw fa-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT-->

<script>
    function hapus(data) {
        var r = confirm("Yakin ingin hapus?");
        if (r == true) {
            location.href = "<?= site_url('bobot/hapus/" + data+"') ?>";
        }
    }
</script>