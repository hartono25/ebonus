<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row">

        <div class="col-lg-8 col-md-8">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="ibox-title">Tambah Data Penerimaan Bonus</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item">option 1</a>
                            <a class="dropdown-item">option 2</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-body">
                    <form method="POST" action="<?= site_url('bonus/tambah') ?>">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="nik" id="nik" placeholder="Nomor Induk Karyawan" readonly>
                            </div>
                            <input type="button" value="Pilih Karyawan" data-toggle="modal" data-target="#exampleModal">
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Nama Karyawan</label>
                                <input class="form-control" type="text" placeholder="Nama Karyawan" name="nama" id="nama" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Kode Penerimaan</label>
                                <input class="form-control" type="text" value="<?= $kode; ?>" name="kode" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label>&nbsp;</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Jumlah Bonus</label>
                                <input class="form-control" type="text" placeholder="0" name="bonus" id="bonus" readonly>
                            </div>
                            <div class="col-sm-6 form-group">
                                <!-- <label>Tanggal Lahir</label>
                                <input class="form-control" type="date" placeholder="xxxx-xxxx-xxx" name="phone"> -->
                            </div>
                        </div>

                        <hr>
                        <div class="form-group text-left">
                            <a href="<?= site_url('bonus') ?>" class="btn btn-danger">
                                <i class="fa fa-fw fa-times"></i>
                                Batal
                            </a>
                            <button class="btn btn-info" type="submit">
                                <i class="fa fa-fw fa-plus-square"></i>
                                Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .visitors-table tbody tr td:last-child {
            display: flex;
            align-items: center;
        }

        .visitors-table .progress {
            flex: 1;
        }

        .visitors-table .progress-parcent {
            text-align: right;
            margin-left: 10px;
        }
    </style>

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
                <table class="table table-striped table-hover" id="">
                    <thead>
                        <tr>
                            <!-- <th class="text-center"><i class="fa fa-fw fa-check"></i></th> -->
                            <th class="text-center">NIK</th>
                            <th class="text-center">NAMA</th>
                            <th class="text-center">JUMLAH BONUS</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $bonus = 500000;
                        foreach ($data as $d) : ?>
                            <tr>
                                <!-- <td class="text-center"><i class="fa fa-fw fa-check"></i></td> -->
                                <td class="text-center"><?= $d['nik'] ?></td>
                                <td class="text-center"><?= $d['nama_lengkap'] ?></td>
                                <td class="text-left"><?= 'Rp ' . number_format($bonus) ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" data-nik="<?= $d['nik'] ?>" data-nama="<?= $d['nama_lengkap'] ?>" data-bonus="<?= $bonus; ?>" id="select">
                                        <i class="fa fa-fw fa-check"></i>
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        <?php
                            $bonus -= 100000;
                        endforeach; ?>
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