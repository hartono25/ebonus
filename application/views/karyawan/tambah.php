<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row">
        <!-- <div class="col-lg-3 col-md-4">
            <div class="ibox">
                <div class="ibox-body text-center">
                    <div class="m-t-20">
                        <img src="<?= base_url('template/html/dist') ?>/assets/img/admin-avatar.png" width="50%" />
                    </div>
                    <h5 class="font-strong m-b-10 m-t-10">*****</h5>
                                <div class="m-b-20 text-muted">TELLER</div>
                    <div class="profile-social mb-20 mt-5">
                        <a href="javascript:;"><i class="fa fa-twitter mr-3"></i></a>
                        <a href="javascript:;"><i class="fa fa-facebook mr-3"></i></a>
                        <a href="javascript:;"><i class="fa fa-pinterest mr-3"></i></a>
                        <a href="javascript:;"><i class="fa fa-dribbble"></i></a>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-lg-8 col-md-8">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="ibox-title">Tambah Data Karyawan</div>
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
                    <form method="POST" action="<?= site_url('karyawan/tambah') ?>">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>NIK</label>
                                <input class="form-control" type="text" name="kodepts" value="<?= $nik; ?>" readonly>
                            </div>
                            <!-- <div class="col-sm-6 form-group">
                                <label></label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>">
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>&nbsp;</label>
                                <div class="form-group">
                                    <label class="ui-checkbox ui-checkbox-success">
                                        <input type="radio" name="gender" value="L">
                                        <span class="input-span"></span>Laki-Laki
                                    </label>
                                    <label class="ui-checkbox ui-checkbox-success ml-3">
                                        <input type="radio" name="gender" value="P">
                                        <span class="input-span"></span>Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Tempat Lahir</label>
                                <input class="form-control" type="text" placeholder="Tempat Kelahiran" name="t_lahir">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Tanggal Lahir</label>
                                <input class="form-control" type="date" name="tgl_lahir">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" placeholder="email@mail.com" name="email">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Telepon</label>
                                <input class="form-control" type="text" placeholder="xxxx-xxxx-xxxx" name="phone">
                            </div>
                        </div>

                        <hr>
                        <div class="form-group text-left">
                            <a href="<?= site_url('karyawan') ?>" class="btn btn-danger">
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