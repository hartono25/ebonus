<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-left">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <!-- <div class=""> -->
                    <div class="col-md-6">
                        <div class="ibox-title">Data Penerimaan Bonus</div>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('bonus/tambah') ?>" class="btn btn-default btn-sm">
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
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">KODE PENERIMAAN</th>
                                <th class="text-center">NIK</th>
                                <th class="text-left">NAMA KARYAWAN</th>
                                <th class="text-left">JUMLAH BONUS</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?>.</td>
                                    <td class="text-center"><?= date('d F Y', strtotime($d['tgl_penerimaan'])) ?></td>
                                    <td class="text-center"><?= $d['kode_bonus'] ?></td>
                                    <td class="text-center"><?= $d['nik'] ?></td>
                                    <td class="text-left"><?= $d['nama_karyawan'] ?></td>
                                    <td class="text-left"><?= 'Rp ' . number_format($d['jml_bonus']) ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('bonus/' . $d['kode_bonus']) ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-fw fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="#" onclick="hapus('<?= $d['kode_bonus'] ?>')" class="btn btn-danger btn-sm">
                                            <i class="fa fa-fw fa-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>

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
            location.href = "<?= site_url('bonus/hapus/" + data+"') ?>";
        }
    }
</script>