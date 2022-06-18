<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function karyawan()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $awal = $this->input->post('start');
            $akhir = $this->input->post('end');

            if (empty($awal) and empty($akhir)) {
                $data = [
                    'data'   => $this->Model->getkaryawan(),
                    'title'     => 'Laporan Data Karyawan',
                    'awal'      => '0',
                    'akhir'     => '0'
                ];
            } else {
                $start = date('Y-m-d', strtotime($awal));
                $finish = date('Y-m-d', strtotime($akhir));
                $data = [
                    'data'   => $this->Model->getkaryawan_range($start, $finish),
                    'title'     => 'Laporan Data Karyawan',
                    'awal'      => $start,
                    'akhir'     => $finish,
                ];
            }
            $this->load->view('auth/auth_header', $data);
            $this->load->view('laporan/karyawan', $data);
            $this->load->view('auth/auth_footer');
        }
    }

    public function cetak_karyawan()
    {
        $awal = $this->uri->segment(3);
        $akhir = $this->uri->segment(4);

        if ($awal == '0' and $akhir == '0') {
            # code...
            $data = [
                'data'   => $this->Model->getkaryawan(),
                'title'     => 'laporan-karyawan.pdf'
            ];
        } else {
            # code...
            $data   = [
                'data'      => $this->Model->getkaryawan_range($awal, $akhir),
                'title'     => 'laporan-karyawan.pdf'
            ];
        }
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-karyawan.pdf";
        $this->pdf->load_view('cetak/karyawan', $data);
    }

    public function bonus()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $awal = $this->input->post('start');
            $akhir = $this->input->post('end');

            if (empty($awal) and empty($akhir)) {
                $data = [
                    'data'   => $this->Model->getbonus(),
                    'title'     => 'Laporan Data Penerimaan Bonus',
                    'kriteria'  => $this->Model->getbobot(),
                    'awal'      => '0',
                    'akhir'     => '0'
                ];
            } else {
                $start = date('Y-m-d', strtotime($awal));
                $finish = date('Y-m-d', strtotime($akhir));
                $data = [
                    'data'   => $this->Model->getbonus_range($start, $finish),
                    'title'     => 'Laporan Data Penerimaan Bonus',
                    'kriteria'  => $this->Model->getbobot(),
                    'awal'      => $start,
                    'akhir'     => $finish,
                ];
            }
            $this->load->view('auth/auth_header', $data);
            $this->load->view('laporan/bonus', $data);
            $this->load->view('auth/auth_footer');
        }
    }

    public function cetak_bonus()
    {
        $awal = $this->uri->segment(3);
        $akhir = $this->uri->segment(4);

        if ($awal == '0' and $akhir == '0') {
            # code...
            $data = [
                'data'   => $this->Model->getbonus(),
                'title'     => 'laporan-bonus.pdf',
                'kriteria'  => $this->Model->getbobot(),
            ];
        } else {
            # code...
            $data   = [
                'data'   => $this->Model->getbonus_range($awal, $akhir),
                'title'     => 'laporan-bonus.pdf',
                'kriteria'  => $this->Model->getbobot(),
            ];
        }
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-bonus.pdf";
        $this->pdf->load_view('cetak/bonus', $data);
    }

    public function lp_supplier()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $awal = $this->input->post('start');
            $akhir = $this->input->post('end');

            if (empty($awal) and empty($akhir)) {
                $data = [
                    // 'nasabah'   => $this->Model->nasabah(),
                    'title'     => 'Laporan Data Supplier',
                    'awal'      => '0',
                    'akhir'     => '0'
                ];
            } else {
                $start = date('Y-m-d', strtotime($awal));
                $finish = date('Y-m-d', strtotime($akhir));
                $data = [
                    //'nasabah'   => $this->Model->nasabah_range($start, $finish),
                    'title'     => 'Laporan Data Supplier',
                    'awal'      => $start,
                    'akhir'     => $finish,
                ];
            }
            $this->load->view('auth/auth_header', $data);
            $this->load->view('laporan/supplier', $data);
            $this->load->view('auth/auth_footer');
        }
    }

    public function cetak_nasabah()
    {
        $awal = $this->uri->segment(3);
        $akhir = $this->uri->segment(4);

        if ($awal == '0' and $akhir == '0') {
            # code...
            $data = [
                'nasabah'   => $this->Model->nasabah(),
                'title'     => 'laporan-nasabah.pdf'
            ];
        } else {
            # code...
            $data   = [
                'nasabah'   => $this->Model->nasabah_range($awal, $akhir),
                'title'     => 'laporan-nasabah.pdf'
            ];
        }
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-nasabah.pdf";
        $this->pdf->load_view('cetak/nasabah', $data);
    }

    public function lp_apar()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $awal = $this->input->post('start');
            $akhir = $this->input->post('end');

            if (empty($awal) and empty($akhir)) {
                $data = [
                    // 'nasabah'   => $this->Model->lap_antrian(),
                    // 'loket'     => $this->Model->loket(),
                    'awal'      => '0',
                    'akhir'     => '0',
                    'title'     => 'Laporan Data Barang'
                ];
            } else {
                $start = date('Y-m-d', strtotime($awal));
                $finish = date('Y-m-d', strtotime($akhir));
                $data = [
                    // 'nasabah'   => $this->Model->lap_antrian_range($start, $finish),
                    // 'loket'     => $this->Model->loket(),
                    'awal'      => $start,
                    'akhir'     => $finish,
                    'title'     => 'Laporan Data Barang'
                ];
            }
            $this->load->view('auth/auth_header', $data);
            $this->load->view('laporan/apar', $data);
            $this->load->view('auth/auth_footer');
        }
    }

    public function cetak_antrian()
    {
        $awal = $this->uri->segment(3);
        $akhir = $this->uri->segment(4);

        if ($awal == '0' and $akhir == '0') {
            # code...
            $data = [
                'nasabah'   => $this->Model->lap_antrian(),
                'loket'     => $this->Model->loket(),
                'title'     => 'laporan-antrian.pdf'
            ];
        } else {
            # code...
            $data   = [
                'nasabah'   => $this->Model->lap_antrian_range($awal, $akhir),
                'loket'     => $this->Model->loket(),
                'title'     => 'laporan-antrian.pdf'
            ];
        }
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-nasabah.pdf";
        $this->pdf->load_view('cetak/antrian', $data);
    }

    public function lp_permintaan()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $awal = $this->input->post('start');
            $akhir = $this->input->post('end');

            if (empty($awal) and empty($akhir)) {
                $data = [
                    'awal'      => '0',
                    'akhir'     => '0',
                    'title'     => 'Laporan Data Permintaan'
                ];
            } else {
                $start = date('Y-m-d', strtotime($awal));
                $finish = date('Y-m-d', strtotime($akhir));
                $data = [
                    'awal'      => $start,
                    'akhir'     => $finish,
                    'title'     => 'Laporan Data Permintaan'
                ];
            }
            $this->load->view('auth/auth_header', $data);
            $this->load->view('laporan/permintaan', $data);
            $this->load->view('auth/auth_footer');
        }
    }

    public function cetak_pembayaran()
    {
        $awal = $this->uri->segment(3);
        $akhir = $this->uri->segment(4);

        if ($awal == '0' and $akhir == '0') {
            # code...
            $data = [
                'nasabah'   => $this->Model->pembayaran(),
                'title'     => 'laporan-penebusan.pdf'
            ];
        } else {
            # code...
            $data   = [
                'nasabah'   => $this->Model->pembayaran_range($awal, $akhir),
                'title'     => 'laporan-penebusan.pdf'
            ];
        }
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-penebusan.pdf";
        $this->pdf->load_view('cetak/pembayaran', $data);
    }

    public function lp_pengecekan()
    {
        if ($this->session->userdata('username') == null) {
            echo '<script>alert("Please login first!"); location.href = "' . site_url('login') . '"</script>';
        } else {
            $awal = $this->input->post('start');
            $akhir = $this->input->post('end');

            if (empty($awal) and empty($akhir)) {
                $data = [
                    'title'     => 'Laporan Data Pengecekan',
                    'awal'      => '0',
                    'akhir'     => '0'
                ];
            } else {
                $start = date('Y-m-d', strtotime($awal));
                $finish = date('Y-m-d', strtotime($akhir));
                $data = [
                    'gadai'   => $this->Model->lap_gadai_range($start, $finish),
                    'awal'      => $start,
                    'akhir'     => $finish,
                    'title'     => 'Laporan Data Pengecekan'
                ];
            }

            $this->load->view('auth/auth_header');
            $this->load->view('laporan/pengecekan', $data);
            $this->load->view('auth/auth_footer');
        }
    }

    public function cetak_gadai()
    {
        $awal = $this->uri->segment(3);
        $akhir = $this->uri->segment(4);

        if ($awal == '0' and $akhir == '0') {
            # code...
            $data = [
                'nasabah'   => $this->Model->lap_gadai(),
                'title'     => 'laporan-gadai.pdf'
            ];
        } else {
            # code...
            $data   = [
                'nasabah'   => $this->Model->lap_gadai_range($awal, $akhir),
                'title'     => 'laporan-gadai.pdf'
            ];
        }
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-gadai.pdf";
        $this->pdf->load_view('cetak/gadai', $data);
    }
}
