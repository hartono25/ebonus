<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="ibox-title">Form Penilaian Karyawan : ABSENSI</div>

                </div>
                <div class="ibox-body">

                    <form method="POST" action="<?= site_url('penilaian/absensi/' . $absen['nik']) ?>">
                        <div class="row col-md-4 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nomor Induk Karyawan" aria-describedby="basic-addon2" name="nik" id="nik" readonly value="<?= $absen['nik'] ?>">
                                <a href="#" class="input-group-addon btn btn-info text-white" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-fw fa-search"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row col-md-5 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nama Karyawan" name="nama" id="nama" readonly value="<?= $absen['nama_lengkap'] ?>">
                                <input type="hidden" name="idabsen" id="idabsen" value="<?= $absen['id_absensi'] ?>">
                            </div>
                        </div>

                        <!-- ini baru  -->
                        <div class="row mb-3 align-items-center">
                            <div class="col-2">
                                <label class="col-form-label">Total Hari Kerja</label>
                            </div>
                            <div class="col-2">
                                <input type="number" id="total_hari" step="0.01" class="form-control" name="total_hari" value="<?= $absen['hari_kerja'] ?>">
                            </div>
                        </div>

                        <div class="row mb-5 align-items-center">
                            <div class="col-2">
                                <label class="col-form-label">Total Hari Masuk</label>
                            </div>
                            <div class="col-2">
                                <input type="number" step="0.01" id="total_masuk" class="form-control" name="total_masuk" value="<?= $absen['total_masuk'] ?>">
                            </div>
                        </div>

                        <div class="form-group col-md-4 text-right">
                            <a href="<?= site_url() ?>" class="btn btn-danger">
                                <i class="fa fa-fw fa-times"></i>
                                Batal
                            </a>
                            <button class="btn btn-info" type="submit">
                                <i class="fa fa-fw fa-edit"></i>
                                Ubah Data
                            </button>
                            <!-- <a href="<?= site_url() ?>" class="btn btn-warning">
                                <i class="fa fa-fw fa-times"></i>
                                Ubah Data
                            </a> -->
                        </div>
                    </form>
                    <hr>

                    <div class="row" style="font-size: 20px; font-weight: bold;">
                        <div class="col-md-6">
                            Total Poin : <?= number_format($absen['total_poin'], 2, ",", ".") ?>
                        </div>
                        <div class="col-md-6">
                            Keterangan : <?= $absen['keterangan'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->