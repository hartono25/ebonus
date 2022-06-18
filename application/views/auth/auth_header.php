<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0"> -->
    <title>EB | <?= $title; ?></title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?= base_url('template/html/dist') ?>/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url('template/html/dist') ?>/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url('template/html/dist') ?>/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="<?= base_url('template/html/dist') ?>/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?= base_url('template/html/dist') ?>/assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    <!-- DataTables -->
    <!-- Custom styles for this page -->
    <link href="<?= base_url('template/html/dist') ?>/assets/vendors/DataTables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('template/datepicker/css/datepicker.css') ?>">

    <style>
        #nilai {
            text-align: right;
        }
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand bg-dark">
                <a class="link" href="index.html">
                    <span class="brand">
                        <span class="brand-tip"><i class=""></i>E-BONUS</span>
                    </span>
                    <span class="brand-mini">EB</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <li>
                        <form class="navbar-search" action="javascript:;">
                            <div class="rel">
                                <span class="search-icon"><i class="ti-search"></i></span>
                                <input class="form-control" placeholder="Search here...">
                            </div>
                        </form>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="<?= base_url('template/html/dist') ?>/assets/img/admin-avatar.png" />
                            <span></span><?= $this->session->userdata('nama'); ?><i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?= site_url('logout') ?>"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar bg-dark" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <!-- <div>
                        <img src="<?= base_url('template/html/dist') ?>/assets/img/admin-avatar.png" width="45px" />
                    </div> -->
                    <div class="admin-info">
                        <!-- <div class="font-strong">James Brown</div> -->
                        <!-- <small><?= $this->session->userdata('nama'); ?></small> -->
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <!-- <li>
                        <a class="active" href="<?= site_url('dashboard') ?>"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li> -->
                    <?php if ($this->session->userdata('role') == '0') : ?>
                        <li class="heading">Data Master</li>

                        <li>
                            <a href="<?= site_url('karyawan') ?>"><i class="sidebar-item-icon fa fa-users"></i>
                                <span class="nav-label">Data Karyawan</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url('bobot') ?>"><i class="sidebar-item-icon fa fa-barcode"></i>
                                <span class="nav-label">Bobot Kriteria</span>
                            </a>
                        </li>

                    <?php endif; ?>

                    <li class="heading">Data Transaksi</li>

                    <!-- <li>
                        <a href="<?= site_url('penilaian') ?>"><i class="sidebar-item-icon fa fa-calculator"></i>
                            <span class="nav-label">Penilaian Karyawan</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="javascript:;">
                            <i class="sidebar-item-icon fa fa-calculator"></i>
                            <span class="nav-label">Penilaian Karyawan</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="<?= site_url('penilaian/absensi') ?>">
                                    <small>ABSENSI</small></a>
                            </li>
                            <li>
                                <a href="<?= site_url('penilaian/perilaku') ?>">
                                    <small>PERILAKU</small></a>
                            </li>
                            <li>
                                <a href="<?= site_url('penilaian/kedisiplinan') ?>">
                                    <small>KEDISIPLINAN</small></a>
                            </li>
                            <li>
                                <a href="<?= site_url('penilaian/wawasan') ?>">
                                    <small>WAWASAN</small></a>
                            </li>
                            <li>
                                <a href="<?= site_url('penilaian/kerjasama') ?>">
                                    <small>KERJASAMA TIM</small></a>
                            </li>
                            <li>
                                <a href="<?= site_url('penilaian/kinerja') ?>">
                                    <small>KINERJA</small></a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?= site_url('seleksi') ?>"><i class="sidebar-item-icon fa fa-filter"></i>
                            <span class="nav-label">Hasil Seleksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('bonus') ?>"><i class="sidebar-item-icon fa fa-money"></i>
                            <span class="nav-label">Penerimaan Bonus</span>
                        </a>
                    </li>


                    <li class="heading">Data Laporan</li>
                    <li>
                        <a href="<?= site_url('laporan/karyawan') ?>"><i class="sidebar-item-icon fa fa-line-chart"></i>
                            <span class="nav-label">Lap. Data Karyawan</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('laporan/bonus') ?>"><i class="sidebar-item-icon fa fa-line-chart"></i>
                            <span class="nav-label">Lap. Penerimaan Bonus</span>
                        </a>
                    </li>

                    <li class="heading">Tools</li>
                    <li>
                        <a href="<?= site_url('logout') ?>"><i class="sidebar-item-icon fa fa-power-off"></i>
                            <span class="nav-label">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">