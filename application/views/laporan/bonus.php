<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="col-md-4">
                        <div class="ibox-title">Laporan Data Penerimaan Bonus</div>
                    </div>
                    <div class="col-md-8 text-right">
                        <form action="<?= site_url('laporan/nasabah') ?>" method="post">
                            <div class="form-group mt-3" id="date_5">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input class="input-sm form-control" type="date" name="start" value="<?= $awal; ?>">
                                    <span class="input-group-addon p-l-10 p-r-10">to</span>
                                    <input class="input-sm form-control" type="date" name="end" value="<?= $akhir ?>">
                                    <button type="submit" class="btn btn-outline-primary ml-3">
                                        <i class="fa fa-fw fa-search"></i>
                                        Cari
                                    </button>
                                    <a href="<?= site_url('laporan/bonus/' . $awal . '/' . $akhir) ?>" class="btn btn-outline-primary ml-3" target="_blank">
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
                                <th class="text-center">KODE PENERIMAAN</th>
                                <th class="text-center">NIK</th>
                                <th class="text-left">NAMA KARYAWAN</th>
                                <th class="text-left">BONUS</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">ABSENSI</th>
                                <th class="text-center">PERILAKU</th>
                                <th class="text-center">KEDISIPLINAN</th>
                                <th class="text-center">WAWASAN</th>
                                <th class="text-center">KERJASAMA TIM</th>
                                <th class="text-center">KINERJA</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $d) :
                                $nilai = $this->Model->get_penilaian_karyawan_laporan($d['nik']);
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?>.</td>
                                    <td class="text-center"><?= $d['kode_bonus'] ?></td>
                                    <td class="text-center"><?= $d['nik'] ?></td>
                                    <td class="text-left"><?= $d['nama_karyawan'] ?></td>
                                    <td class="text-left"><?= 'Rp ' . number_format($d['jml_bonus']) ?></td>
                                    <td class="text-center"><?= date('d F Y', strtotime($d['tgl_penerimaan'])) ?></td>
                                    <th class="text-center"><?= $d['keterangan'] ?></th>
                                    <th class="text-center"><?= $d['keterangan_perilaku'] ?></th>
                                    <th class="text-center"><?= $d['keterangan_disiplin'] ?></th>
                                    <th class="text-center"><?= $d['keterangan_wawasan'] ?></th>
                                    <th class="text-center"><?= $d['keterangan_kerjasama'] ?></th>
                                    <th class="text-center"><?= $d['keterangan_kinerja'] ?></th>
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