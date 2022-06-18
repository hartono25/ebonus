<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="ibox-title">Form Penilaian Karyawan : KINERJA</div>

                </div>
                <div class="ibox-body">

                    <form method="POST" action="<?= site_url('penilaian/kinerja/' . $data['nik']) ?>">
                        <div class="row col-md-4 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nomor Induk Karyawan" aria-describedby="basic-addon2" name="nik" id="nik" readonly value="<?= $data['nik'] ?>">
                                <a href="#" class="input-group-addon btn btn-info text-white" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-fw fa-search"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row col-md-5 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nama Karyawan" name="nama" id="nama" readonly value="<?= $data['nama_lengkap'] ?>">
                            </div>
                        </div>

                        <!-- ini baru  -->
                        <div class="row mb-3 align-items-center">
                            <div class="col-2">
                                <label class="col-form-label">Komunikasi antar karyawan</label>
                            </div>
                            <div class="col-2">
                                <input type="hidden" name="idkinerja" value="<?= $data['id_kinerja'] ?>">
                                <input type="number" id="komunikasi" class="form-control" step="0.01" value="<?= $data['komunikasi'] ?>" placeholder="00.000" name="komunikasi">
                                <small>maks. 10 poin</small>
                            </div>

                            <div class="col-2">
                                <label class="col-form-label">Pencapaian target individu</label>
                            </div>
                            <div class="col-2">
                                <input type="number" id="target" class="form-control" step="0.01" value="<?= $data['target'] ?>" placeholder="00.000" name="target">
                                <small>maks. 30 poin</small>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-2">
                                <label class="col-form-label">Pengetahuan teknis (Jobdesk)</label>
                            </div>
                            <div class="col-2">
                                <input type="number" id="teknis" class="form-control" step="0.01" value="<?= $data['teknis'] ?>" placeholder="00.000" name="teknis">
                                <small>maks. 15 poin</small>
                            </div>

                            <div class="col-2">
                                <label class="col-form-label">Disiplin</label>
                            </div>
                            <div class="col-2">
                                <input type="number" id="disiplin" class="form-control" step="0.01" value="<?= $data['disiplin'] ?>" placeholder="00.000" name="disiplin">
                                <small>maks. 10 poin</small>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-2">
                                <label class="col-form-label">Kecepatan menyelesaikan pekerjaan</label>
                            </div>
                            <div class="col-2">
                                <input type="number" id="kecepatan" class="form-control" step="0.01" value="<?= $data['kecepatan'] ?>" placeholder="00.000" name="kecepatan">
                                <small>maks. 10 poin</small>
                            </div>

                            <div class="col-2">
                                <label class="col-form-label">Adaptasi</label>
                            </div>
                            <div class="col-2">
                                <input type="number" id="adaptasi" class="form-control" step="0.01" value="<?= $data['adaptasi'] ?>" placeholder="00.000" name="adaptasi">
                                <small>maks. 10 poin</small>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-2">
                                <label class="col-form-label">Manajemen waktu</label>
                            </div>
                            <div class="col-2">
                                <input type="number" id="waktu" class="form-control" step="0.01" value="<?= $data['waktu'] ?>" placeholder="00.000" name="waktu">
                                <small>maks. 15 poin</small>
                            </div>
                        </div>


                        <div class="form-group col-md-4 text-right">
                            <a href="<?= site_url() ?>" class="btn btn-danger">
                                <i class="fa fa-fw fa-times"></i>
                                Batal
                            </a>
                            <button class="btn btn-info" type="submit">
                                <i class="fa fa-fw fa-edit"></i>
                                Ubah Data</button>
                            <!-- <a href="<?= site_url() ?>" class="btn btn-warning">
                                <i class="fa fa-fw fa-times"></i>
                                Ubah Data
                            </a> -->
                        </div>
                    </form>
                    <hr>

                    <div class="row" style="font-size: 20px; font-weight: bold;">
                        <div class="col-md-6">
                            Total Poin : <?= number_format($data['total_poin_kinerja'], 2, ",", ".") ?>
                        </div>
                        <div class="col-md-6">
                            Keterangan : <?= $data['keterangan_kinerja'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- END PAGE CONTENT-->