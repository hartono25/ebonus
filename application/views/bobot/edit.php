<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row">

        <div class="col-lg-8 col-md-8">
            <div class="ibox">
                <div class="ibox-head bg-ebony-400 text-white">
                    <div class="ibox-title">Ubah Data Bobot Kriteria</div>
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
                    <form method="POST" action="<?= site_url('bobot/' . $kode) ?>">

                        <div class="row">
                            <div class="col-sm-8 form-group">
                                <label>Nama Kriteria</label>
                                <input class="form-control" type="text" value="<?= $data['kriteria'] ?>" name="nama">
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-sm-4 form-group">
                                <label>Bobot Nilai</label>
                                <input class="form-control bobot" type="number" step="0.01" value="<?= $data['nilai_bobot'] ?>" placeholder="0.00" name="bobot" id="bobot">
                            </div>
                        </div>

                        <br>
                        <small>Nilai Kriteria</small>
                        <hr>

                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>min_value</label>

                            </div>
                            <div class="col-sm-2 form-group">
                                <label>max_value</label>

                            </div>
                            <div class="col-sm-2 form-group">
                                <label>Nilai Kriteria</label>

                            </div>
                            <div class="col-sm-2 form-group">
                                <label>Bobot </label>

                            </div>
                            <div class="col-sm-2 form-group">
                                <label>Action</label>

                            </div>
                        </div>
                        <br>
                        <?php foreach ($nilaikriteria as $k) : ?>
                            <div class="row after-add-more">
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="number" step="0.01" placeholder="0.00" name="min[]" value="<?= $k['min_value'] ?>">
                                </div>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="number" step="0.01" value="<?= $k['max_value'] ?>" placeholder="0.00" name="max[]">
                                </div>

                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" placeholder="Nilai Kriteria" name="nilai[]" value="<?= $k['nilai_kriteria'] ?>">
                                </div>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control bobot" type="number" step="0.01" value="<?= $k['bobot'] ?>" placeholder="0.00" name="bobot_nilai[]">
                                </div>
                                <div class="col-sm-2 form-group">
                                    <button class="form-control btn btn-danger" type="button" onclick="item('<?= $k['id_nilai'] ?>', '<?= $k['id_bobot'] ?>')">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>

                                <input type="hidden" name="id_nilai[]" value="<?= $k['id_nilai'] ?>">
                            </div>
                        <?php endforeach; ?>
                        <div class="text-right">
                            <button class="form-control btn btn-success add-more" type="button">
                                <i class="fa fa-fw fa-plus"></i>
                            </button>
                        </div>
                        <hr>
                        <div class="form-group text-left">
                            <a href="<?= site_url('bobot') ?>" class="btn btn-danger">
                                <i class="fa fa-fw fa-times"></i>
                                Batal
                            </a>
                            <button class="btn btn-info" type="submit">
                                <i class="fa fa-fw fa-edit"></i>
                                Ubah Data</button>
                        </div>
                    </form>

                    <div class="copy invisible">
                        <div class="row damn">
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="number" step="0.01" value="00.00" placeholder="0.00" name="min[]">
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="number" step="0.01" value="00.00" placeholder="0.00" name="max[]">
                            </div>

                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" placeholder="Nilai Kriteria" name="nilai[]">
                            </div>
                            <div class="col-sm-2 form-group">
                                <input class="form-control bobot" type="number" step="0.01" value="00.00" placeholder="0.00" name="bobot_nilai[]">
                            </div>
                            <div class="col-sm-2 form-group">
                                <button class="form-control btn btn-danger remove" type="button">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                            <input type="text" name="id_nilai[]" value="">
                        </div>
                    </div>

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


<script>
    function item(data, id) {
        var r = confirm("Yakin ingin hapus?");
        if (r == true) {
            location.href = "<?= site_url('bobot/hapus_item/" + data+"/"+ id +"') ?>";
        }
    }
</script>