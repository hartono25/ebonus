<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <!-- <div class=""> -->
                    <div class="col-md-6">
                        <div class="ibox-title">Data Karyawan</div>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('karyawan/tambah') ?>" class="btn btn-default btn-sm">
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
                                <th class="text-center">NIK</th>
                                <th class="text-left">NAMA KARYAWAN</th>
                                <th class="text-left">KELAMIN</th>
                                <th class="text-center">TELPON</th>
                                <th class="text-left">EMAIL</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?>.</td>
                                    <td class="text-center"><?= $d['nik'] ?></td>
                                    <td class="text-left"><?= $d['nama_lengkap'] ?></td>
                                    <td class="text-left"><?= ($d['gender'] == "L") ? "Laki-Laki" : "Perempuan"; ?></td>
                                    <td class="text-center"><?= $d['phone'] ?></td>
                                    <td class="text-left"><?= $d['email'] ?></td>
                                    <td class="text-center" width="15%">
                                        <a href="<?= site_url('karyawan/' . $d['nik']) ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-fw fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="#" onclick="hapus('<?= $d['nik'] ?>')" class="btn btn-danger btn-sm">
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
            location.href = "<?= site_url('karyawan/hapus/" + data+"') ?>";
        }
    }
</script>