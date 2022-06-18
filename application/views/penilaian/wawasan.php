<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="ibox-title">Form Penilaian Karyawan : WAWASAN</div>

                </div>
                <div class="ibox-body">

                    <form method="POST" action="<?= site_url('penilaian/wawasan') ?>">
                        <div class="row col-md-4 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nomor Induk Karyawan" aria-describedby="basic-addon2" name="nik" id="nik" readonly>
                                <a href="#" class="input-group-addon btn btn-info text-white" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-fw fa-search"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row col-md-5 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nama Karyawan" name="nama" id="nama" readonly>
                            </div>
                        </div>

                        <!-- ini baru  -->

                        <div class="row mb-3 align-items-center">
                            <div class="col-2">
                                <label class="col-form-label">Hasil Test Out Evaluasi Karyawan</label>
                            </div>
                            <div class="col-2">
                                <input type="number" id="kebersihan" class="form-control" step="0.01" value="00.00" placeholder="00.00" name="hasil_evaluasi">
                            </div>
                        </div>

                        <div class="form-group col-md-4 text-right">
                            <a href="<?= site_url() ?>" class="btn btn-danger">
                                <i class="fa fa-fw fa-times"></i>
                                Batal
                            </a>
                            <button class="btn btn-info" type="submit">
                                <i class="fa fa-fw fa-plus-square"></i>
                                Tambah Data</button>
                            <!-- <a href="<?= site_url() ?>" class="btn btn-warning">
                                <i class="fa fa-fw fa-times"></i>
                                Ubah Data
                            </a> -->
                        </div>
                    </form>
                    <hr>

                    <div class="row" style="font-size: 14px; font-weight: bold;">
                        <div class="col-md-6">
                            Total Poin :
                        </div>
                        <div class="col-md-6">
                            Keterangan :
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="ibox-title">Data Penilaian Karyawan : WAWASAN</div>

                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover" id="example" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No.</th>
                                <th class="text-center">NIK</th>
                                <th class="text-left">NAMA KARYAWAN</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">HASIL TEST OUT</th>
                                <th class="text-center">TOTAL POIN</th>
                                <th class="text-center">KETERANGAN</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $d) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td><?= $d['nik'] ?></td>
                                    <td><?= $d['nama_lengkap'] ?></td>
                                    <td><?= date('d F Y', strtotime($d['tgl_penilaian_wawasan'])) ?></td>
                                    <td class="text-center"><?= number_format($d['hasil_evaluasi'], 2, ",", ".") ?></td>
                                    <td class="text-center"><?= number_format($d['total_poin_wawasan'], 2, ",", ".") ?></td>
                                    <td><?= $d['keterangan_wawasan'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('penilaian/wawasan/' . $d['nik']) ?>" class="btn btn-warning">
                                            <i class="fa fa-fw fa-edit"></i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

<div class="modal" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover" id="tatabel">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fa fa-fw fa-check"></i></th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">NAMA</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($karyawan as $k) {
                            $nik = $this->Model->karyawan_nik($k['nik']);

                        ?>
                            <tr>
                                <td class="text-center">
                                    <?php if ($nik != 0) : ?>
                                        <!-- <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-success active"> -->
                                        <input type="checkbox" autocomplete="off" checked>
                                        <!-- <span class="fa fa-fw fa-check"></span>
                                            </label>
                                        </div> -->
                                    <?php endif ?>
                                </td>
                                <td class="text-center"><?= $k['nik'] ?></td>
                                <td><?= $k['nama_lengkap'] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" data-nik="<?= $k['nik'] ?>" data-nama="<?= $k['nama_lengkap'] ?>" id="select" <?= ($nik != 0) ? "disabled" : ""; ?>>
                                        <i class="fa fa-fw fa-check"></i>
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        <?php

                        }

                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>