<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="ibox-title">Penilaian Karyawan</div>
                    <!-- <div class="">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('karyawan/tambah') ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-fw fa-plus-square"></i>
                            Tambah Data
                        </a>
                    </div>
                </div> -->

                </div>
                <div class="ibox-body">

                    <form method="POST" action="<?= site_url('penilaian/input') ?>">
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
                        <?php
                        $no = 0;
                        foreach ($data as $d) : ?>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label"><?= $d['kriteria'] ?></label>

                                <div class="col-sm-2">
                                    <input type="number" step="0.01" value="00.00" placeholder="0.00" name="bobot_nilai[]" class="form-control">
                                    <!-- <select class="form-control" name="bobot_nilai[]">
                                        <?php
                                        $nilai_kriteria = $this->Model->penilaian_kriteria($d['id_bobot']);
                                        foreach ($nilai_kriteria as $n) : ?>
                                            <option value="<?= $n['bobot'] ?>"><?= $n['nilai_kriteria'] ?></option>
                                        <?php endforeach; ?>
                                    </select> -->
                                    <input type="hidden" name="idnilai[]" value="<?= $d['id_bobot'] ?>">
                                    <input type="hidden" name="nilai[]" id="nilai" value="<?= $d['kriteria'] ?>">
                                    <input type="hidden" name="bobot_perbaikan[]" value="<?= $d['perbaikan_bobot'] ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="form-group col-md-4 text-right">
                            <a href="<?= site_url('petugas') ?>" class="btn btn-danger">
                                <i class="fa fa-fw fa-times"></i>
                                Batal
                            </a>
                            <button class="btn btn-info" type="submit">
                                <i class="fa fa-fw fa-plus-square"></i>
                                Tambah Data</button>
                        </div>
                    </form>
                    <hr>

                    <table class="table table-striped table-hover" id="example" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No.</th>
                                <th class="text-center">NIK</th>
                                <th class="text-left">NAMA KARYAWAN</th>
                                <th class="text-center">TANGGAL</th>
                                <?php foreach ($data as $da) : ?>
                                    <th class="text-center"><?= $da['kriteria'] ?></th>
                                <?php endforeach; ?>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            foreach ($group as $g) :
                                $pnk = $this->Model->get_penilaian_karyawan($g['nik']);
                            ?>
                                <tr>
                                    <td class="text-center" width="5%"><?= $no++ ?>.</td>
                                    <td class="text-center"><?= $g['nik'] ?></td>
                                    <td class="text-left"><?= $g['nama_lengkap'] ?></td>
                                    <td class="text-center"><?= date('d F Y', strtotime($g['tgl_penilaian'])) ?></td>

                                    <?php foreach ($pnk as $p) : ?>
                                        <td class="text-center"><?= $p['bobot_penilaian'] ?></td>
                                    <?php endforeach; ?>
                                    <!-- <td class="text-center">0.25</td>
                                    <td class="text-center">0.75</td>
                                    <td class="text-center">0.75</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">1</td> -->

                                    <td class="text-center" width="15%">
                                        <a href="<?= site_url('penilaian/' . $g['nik']) ?>" class="btn btn-danger btn-sm">
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