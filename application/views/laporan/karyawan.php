<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="col-md-4">
                        <div class="ibox-title">Laporan Data Karyawan</div>
                    </div>
                    <div class="col-md-8 text-right">
                        <form action="<?= site_url('laporan/karyawan') ?>" method="post">
                            <div class="form-group mt-3" id="date_5">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input class="input-sm form-control" type="date" name="start" value="<?= $awal; ?>">
                                    <span class="input-group-addon p-l-10 p-r-10">to</span>
                                    <input class="input-sm form-control" type="date" name="end" value="<?= $akhir ?>">
                                    <button type="submit" class="btn btn-outline-primary ml-3">
                                        <i class="fa fa-fw fa-search"></i>
                                        Cari
                                    </button>
                                    <a href="<?= site_url('laporan/karyawan/' . $awal . '/' . $akhir) ?>" class="btn btn-outline-primary ml-3" target="_blank">
                                        <i class="fa fa-fw fa-print"></i>
                                        Cetak
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $d) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?>.</td>
                                    <td class="text-center"><?= $d['nik'] ?></td>
                                    <td class="text-left"><?= $d['nama_lengkap'] ?></td>
                                    <td class="text-left"><?= $d['gender'] ?></td>
                                    <td class="text-center"><?= $d['phone'] ?></td>
                                    <td class="text-left"><?= $d['email'] ?></td>
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