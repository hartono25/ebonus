<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="">
                        <div class="ibox-title">Hasil Penilaian</div>
                        <!-- <div class="col-md-6">
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('karyawan/tambah') ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-fw fa-plus-square"></i>
                            Tambah Data
                        </a>
                    </div> -->
                    </div>

                </div>
                <div class="ibox-body">
                    <!-- <label for="">Periode :</label> -->
                    <div class="row col-md-8 text-right mb-3">
                        <!-- <form action="<?= site_url('laporan/nasabah') ?>" method="post"> -->
                        <div class="form-group mt-3" id="date_5">
                            <div class="input-daterange input-group" id="datepicker">
                                <input class="input-sm form-control" type="text" name="start" value="Periode" readonly>
                                <span class=" input-group-addon p-l-10 p-r-10">:</span>
                                <input class="input-sm form-control datepicker" type="text" name="end" value="<?= date('F Y'); ?>" readonly>
                                <!-- <button type="submit" class="btn btn-outline-primary ml-3">
                                        <i class="fa fa-fw fa-search"></i>
                                        Cari
                                    </button> -->
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                    <!-- <div class="form-group">
                        <label>Tanggal:</label>
                        <input type="text" name="tanggal" class="form-control datepicker" required />
                    </div> -->
                    <table class="table table-striped table-hover" id="example">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No.</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">NIK</th>
                                <th class="text-left">NAMA KARYAWAN</th>
                                <th class="text-center">Vektor Si</th>
                                <th class="text-center">Vektor (Vi)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?>.</td>
                                    <td class="text-center"><?= date('d F Y', strtotime($d['tgl_penilaian'])) ?></td>
                                    <td class="text-center"><?= $d['nik'] ?></td>
                                    <td class="text-left"><?= $d['nama_lengkap'] ?></td>
                                    <td class="text-center"><?= $d['nilai_si'] ?></td>
                                    <td class="text-center"><?= $d['nilai_vi'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <hr>
                    <div class="ibox-head bg-ebony-400 text-white">
                        <div class="row">
                            <div class="ibox-title">Urutan Hasil Seleksi</div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped table-hover" id="example">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No.</th>
                                    <th class="text-center">NIK</th>
                                    <th class="text-left">NAMA KARYAWAN</th>
                                    <th class="text-center">Vektor (Vi)</th>
                                    <th class="text-center">RANK</th>
                                    <th class="text-center">Bonus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $bonus = 500000;
                                foreach ($urut as $u) :

                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?>.</td>
                                        <td class="text-center"><?= $u['nik'] ?></td>
                                        <td class="text-left"><?= $u['nama_lengkap'] ?></td>
                                        <td class="text-center"><?= $u['nilai_vi'] ?></td>
                                        <td class="text-center"><?= $no ?></td>
                                        <td class="text-center"><?= 'Rp ' . number_format($bonus) ?></td>
                                    </tr>
                                <?php
                                    $bonus -= 100000;
                                    $no++;
                                endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT-->