<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="ibox">
                <div class="ibox-head">
                    <!-- <div class=""> -->
                    <div class="col-md-6">
                        <div class="ibox-title">Data User</div>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('user/input') ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-fw fa-plus-square"></i>
                            Tambah Data
                        </a>
                    </div>
                    <!-- </div> -->

                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover" id="example">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Action</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Telp / Fax</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">is active?</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="text-center">1.</td>
                                <td class="text-center" width="15%">
                                    <a href="#" class="btn btn-info btn-sm">
                                        <i class="fa fa-fw fa-edit"></i>
                                        Edit
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fa fa-fw fa-trash"></i>
                                        Delete
                                    </a>
                                </td>
                                <td class="text-center">USR001/1311-21</td>
                                <td class="text-left">Administrator</td>
                                <td class="text-left">admin@admin.com</td>
                                <td class="text-center">- / -</td>
                                <td class="text-left">Jakarta</td>
                                <td class="text-center">
                                    <span class="badge badge-success">active</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT-->