<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']    = 'auth/index';
$route['login']                 = 'auth/login';
$route['registrasi']            = 'auth/registrasi';
$route['logout']                = 'auth/logout';

$route['karyawan']                  = 'karyawan/index';
$route['karyawan/tambah']           = 'karyawan/karyawan_input';
$route['karyawan/(:num)']           = 'karyawan/karyawan_edit/$1';
$route['karyawan/hapus/(:num)']     = 'karyawan/karyawan_hapus/$1';

$route['bobot']                     = 'bobot/index';
$route['bobot/tambah']              = 'bobot/bobot_input';
$route['bobot/(:num)']              = 'bobot/bobot_edit/$1';
$route['bobot/hapus/(:num)']        = 'bobot/bobot_hapus/$1';

$route['penilaian']                  = 'penilaian/index';
$route['penilaian/absensi']          = 'penilaian/absensi';
$route['penilaian/absensi/(:any)']   = 'penilaian/ubah_absensi/$1';

$route['penilaian/perilaku']          = 'penilaian/perilaku';
$route['penilaian/perilaku/(:any)']   = 'penilaian/ubah_perilaku/$1';

$route['penilaian/kedisiplinan']          = 'penilaian/kedisiplinan';
$route['penilaian/kedisiplinan/(:any)']   = 'penilaian/ubah_kedisiplinan/$1';

$route['penilaian/wawasan']          = 'penilaian/wawasan';
$route['penilaian/wawasan/(:any)']   = 'penilaian/ubah_wawasan/$1';

$route['penilaian/kerjasama']          = 'penilaian/kerjasama';
$route['penilaian/kerjasama/(:any)']   = 'penilaian/ubah_kerjasama/$1';

$route['penilaian/kinerja']          = 'penilaian/kinerja';
$route['penilaian/kinerja/(:any)']   = 'penilaian/ubah_kinerja/$1';

$route['penilaian/input']            = 'penilaian/penilaian_input';
$route['penilaian/(:num)']           = 'penilaian/penilaian_hapus/$1';

$route['seleksi']               = 'seleksi/index';
$route['penempatan/input']      = 'penempatan/penempatan_input';
$route['penempatan/generate']   = 'penempatan/generate';
$route['penempatan/(:any)']     = 'penempatan/penempatan_edit/$1';

$route['main']                  = 'karyawan/index';

$route['bonus']                 = 'bonus/index';
$route['bonus/tambah']          = 'bonus/bonus_input';
$route['bonus/(:any)']          = 'bonus/bonus_edit/$1';
$route['bonus/hapus/(:any)']    = 'bonus/bonus_hapus/$1';

$route['laporan/karyawan']      = 'laporan/karyawan';
$route['laporan/karyawan/(:any)/(:any)']       = 'laporan/cetak_karyawan/$1/$2';

$route['laporan/bonus']          = 'laporan/bonus';
$route['laporan/bonus/(:any)/(:any)']         = 'laporan/cetak_bonus/$1/$2';

$route['laporan/permintaan']       = 'laporan/lp_permintaan';
$route['laporan/penebusan_barang/(:any)/(:any)']       = 'laporan/cetak_pembayaran/$1/$2';

$route['laporan/pengecekan']         = 'laporan/lp_pengecekan';
$route['laporan/gadai/(:any)/(:any)']         = 'laporan/cetak_gadai/$1/$2';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
