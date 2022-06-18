<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row">

        <div class="col-lg-8 col-md-8">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="ibox-title">Ubah Data Penerimaan Bonus</div>
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
                    <form method="POST" action="<?= site_url('bonus/' . $data['kode_bonus']) ?>">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="nik" id="nik" value="<?= $data['nik'] ?>" readonly>
                            </div>
                            <!-- <input type="button" value="Pilih Karyawan" data-toggle="modal" data-target="#exampleModal"> -->
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Nama Karyawan</label>
                                <input class="form-control" type="text" value="<?= $data['nama_karyawan'] ?>" name="nama" id="nama" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Kode Penerimaan</label>
                                <input class="form-control" type="text" value="<?= $data['kode_bonus'] ?>" name="kode" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label>&nbsp;</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d', strtotime($data['tgl_penerimaan'])) ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Jumlah Bonus</label>
                                <input class="form-control" type="text" value="<?= $data['jml_bonus'] ?>" name="bonus">
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
                                <i class="fa fa-fw fa-edit"></i>
                                Ubah Data</button>
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