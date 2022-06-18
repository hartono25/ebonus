<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <style type="text/css">
        .st_total {
            font-size: 9pt;
            font-weight: bold;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .style6 {
            color: #000000;
            font-size: 9pt;
            font-weight: normal;
            font-family: Arial;
        }

        .style6b {
            color: #000000;
            font-size: 9pt;
            font-weight: bold;
            font-family: Arial;
        }

        .style9 {
            color: #000000;
            font-size: 9pt;
            font-weight: normal;
            font-family: Arial;
        }

        .style9b {
            color: #000000;
            font-size: 9pt;
            font-weight: bold;
            font-family: Arial;
        }

        .style10 {
            color: #000000;
            font-size: 11pt;
            font-weight: normal;
            font-family: Arial;
        }

        .style10b {
            color: #000000;
            font-size: 11pt;
            font-weight: bold;
            font-family: Arial;
        }

        .border {
            border: solid #000 2px;
        }

        .garis {
            border-bottom: solid #000 2px;
        }

        .garis_bawah {
            border-bottom: solid #000 2px;
        }

        .garis_atas {
            border-top: solid #000 2px;
        }

        .garis_kiri {
            border-left: solid #000 2px;
        }

        .garis_kanan {
            border-right: solid #000 2px;
        }
    </style>
</head>

<body>
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="7">
                <div align="center">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="left" class="" colspan="2">
                                <h1>PT. GALAYA TOUR AND TRAVEL</h1>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" class="garis">
                                <div align="left" class="style6">
                                    Jl. Pintu Kecil No. 57c Kota Tua Jakarta Barat<br />
                                </div>
                            </td>
                            <td align="right" class="garis">
                                <h3>LAPORAN DATA PENERIMAAN BONUS</h3>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <br>

    <table width="90%" border="0" align="center" cellpadding="0px" cellspacing="0px">

        <tr>
            <td>
                <div align="center">
                    <table width="100%" border="0" cellspacing="0px" cellpadding="0px">

                        <tr style="text-align: center;">
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah" style="padding: 10px;">No.</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">Tanggal</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">Kode</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">NIK</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">NAMA</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">JUMLAH BONUS</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">ABSENSI</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">PERILAKU</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">KEDISIPLINAN</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">WAWASAN</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">KERJASAMA TIM</th>
                            <th class="style10b garis_kiri garis_atas garis_kanan garis_bawah">KINERJA</th>
                        </tr>

                        <?php
                        $no = 1;
                        foreach ($data as $p) :
                            $nilai = $this->Model->get_penilaian_karyawan_laporan($p['nik']);
                        ?>
                            <tr>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $no ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= date('d F Y', strtotime($p['tgl_penerimaan'])); ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $p['kode_bonus']; ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $p['nik']; ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $p['nama_karyawan']; ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= 'Rp ' . number_format($p['jml_bonus']); ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $p['keterangan']; ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $p['keterangan_perilaku']; ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $p['keterangan_disiplin']; ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $p['keterangan_wawasan']; ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $p['keterangan_kerjasama']; ?>
                                </td>
                                <td style="text-align: center; padding: 10px;" class="style9 garis_kiri garis_kanan">
                                    <?= $p['keterangan_kinerja']; ?>
                                </td>

                            </tr>
                        <?php
                            $no++;
                        endforeach;
                        ?>
                        <tr class="garis_atas">
                            <td colspan="12">
                                <hr>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>

    </table>
    <br>

</body>

</html>