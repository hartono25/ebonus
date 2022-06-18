<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model extends CI_Model
{

    public function menyimpan_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    function deleteData($id, $primary, $database)
    {
        $this->db->where($primary, $id);
        $this->db->delete($database);
    }

    function deleteDataPenilaian($id, $primary, $database)
    {
        $this->db->where('MONTH(tgl_penilaian)', date('m'));
        $this->db->where('YEAR(tgl_penilaian)', date('Y'));
        $this->db->where($primary, $id);
        $this->db->delete($database);
    }

    public function updateData($id, $primary, $database, $data)
    {
        $this->db->where($primary, $id);
        $this->db->update($database, $data);
    }

    public function update($data)
    {
    }

    public function deleted($id, $primary, $table)
    {
        $this->db->where($primary, $id);
        $this->db->delete($table);
    }

    public function islogin($username, $password)
    {
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        if ($user) {
            if ($user['is_active'] == '1') {
                if (password_verify($password, $user['password'])) {
                    $userdata   = [
                        'username'  => $user['username'],
                        'iduser'    => $user['id_user'],
                        'nama'      => $user['full_name'],
                        'role'      => $user['akses']
                    ];
                    $this->session->set_userdata($userdata);
                    redirect(site_url());
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password !</div>');
                    redirect(site_url('login'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This account has not been activated</div>');
                redirect(site_url('login'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username is not registered</div>');
            redirect(site_url('login'));
        }
    }


    public function nik()
    {
        $tgl = date('dmY');
        $this->db->select('RIGHT(karyawan.nik,2) as kode', FALSE);
        $this->db->where('MONTH(date_created)', date('m'));
        $this->db->order_by('nik', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('karyawan');
        if ($query->num_rows() > 0) {
            $data   = $query->row();
            $kode   = intval($data->kode) + 1;
        } else {
            $kode   = 1;
        }

        $kodemax    = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodejadi   = $tgl . $kodemax;

        return $kodejadi;
    }

    public function getkaryawan()
    {
        $this->db->select('*');
        $this->db->from('karyawan a');
        $this->db->where('a.deleted', '0');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getkaryawan_range($start, $finish)
    {
        $this->db->select('*');
        $this->db->from('karyawan a');
        $this->db->where('a.deleted', '0');
        $this->db->where('a.date_created >=', $start);
        $this->db->where('a.date_created <=', $finish);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function karyawan_by_nik($nik)
    {
        $this->db->select('*');
        $this->db->from('karyawan a');
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function karyawan_nik($nik)
    {
        $user = $this->db->get_where('penilaian_karyawan', ['nik' => $nik, 'MONTH(tgl_penilaian)' => date('m'), 'YEAR(tgl_penilaian)' => date('Y')])->num_rows();
        return $user;
    }
    // ===========================================

    public function getbobot()
    {
        $this->db->select('*');
        $this->db->from('bobot a');
        $this->db->where('a.deleted', '0');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_bobotsum()
    {
        return $this->db->query("SELECT sum(nilai_bobot) AS bobot from bobot where deleted='0'");
    }

    public function bobot_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('bobot a');
        $this->db->where('id_bobot', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function nilai_kriteria_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('nilai_kriteria a');
        $this->db->where('id_bobot', $id);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function nilai_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('nilai_kriteria a');
        $this->db->where('id_nilai', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    // =======================================================
    public function penilaian()
    {
        $this->db->select('*')
            ->from('bobot a')
            ->where('a.deleted', '0');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function penilaian_kriteria($id)
    {
        $this->db->select('*');
        $this->db->from('nilai_kriteria a');
        $this->db->where('a.id_bobot', $id);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function penilaian_karyawan($nilai, $kriteria)
    {
        $this->db->select('*');
        $this->db->from('nilai_kriteria a');
        $this->db->join('bobot b', 'b.id_bobot = a.id_bobot');
        $this->db->where('b.kriteria', $kriteria);
        // $this->db->where('a.id_bobot', $id);
        $this->db->where('a.min_value <=', $nilai);
        $this->db->where('a.max_value >=', $nilai);
        $query = $this->db->get()->row_array();
        return $query;
    }

    // ======================================================
    public function join_karyawan()
    {
        $this->db->select('*');
        $this->db->from('karyawan a');
        $this->db->join('penilaian_karyawan b', 'b.nik = a.nik');
        $this->db->where('a.deleted', '0');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_penilaian_group()
    {
        $this->db->select('*');
        $this->db->from('penilaian_karyawan a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->group_by('a.nik');
        $this->db->where('MONTH(a.tgl_penilaian)', date('m'));
        $this->db->where('YEAR(a.tgl_penilaian)', date('Y'));
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function cari_penilaian($nik)
    {
        $this->db->select('*');
        $this->db->from('penilaian a');
        $this->db->where('MONTH(a.tgl_penilaian)', date('m'));
        $this->db->where('YEAR(a.tgl_penilaian)', date('Y'));
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->num_rows();
        return $query;
    }

    public function cari_penilaian_nik($nik)
    {
        $this->db->select('*');
        $this->db->from('penilaian a');
        $this->db->where('MONTH(a.tgl_penilaian)', date('m'));
        $this->db->where('YEAR(a.tgl_penilaian)', date('Y'));
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function getpenilaian()
    {
        $this->db->select('*');
        $this->db->from('penilaian a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('MONTH(a.tgl_penilaian)', date('m'));
        $this->db->where('YEAR(a.tgl_penilaian)', date('Y'));
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function urut()
    {
        $this->db->select('*');
        $this->db->from('penilaian a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('MONTH(a.tgl_penilaian)', date('m'));
        $this->db->where('YEAR(a.tgl_penilaian)', date('Y'));
        $this->db->order_by('a.nilai_vi', 'DESC');
        $this->db->order_by('a.akumulasi_poin', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_penilaian_karyawan_laporan($nik)
    {
        $this->db->select('*');
        $this->db->from('penilaian_karyawan a');
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_penilaian_karyawan($nik)
    {
        $this->db->select('*');
        $this->db->from('penilaian_karyawan a');
        $this->db->where('a.nik', $nik);
        $this->db->where('MONTH(a.tgl_penilaian)', date('m'));
        $this->db->where('YEAR(a.tgl_penilaian)', date('Y'));
        $query = $this->db->get()->result_array();
        return $query;
    }


    // ================================================

    // For Petugas
    function kodeBonus()
    {
        $now = date('dmy');
        $this->db->select('RIGHT(bonus.kode_bonus,3) as kode', FALSE);
        $this->db->order_by('kode_bonus', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('bonus');
        if ($query->num_rows() > 0) {
            $data   = $query->row();
            $kode   = intval($data->kode) + 1;
        } else {
            $kode   = 1;
        }

        $kodemax    = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi   = "BNS" . $now . $kodemax;

        return $kodejadi;
    }

    public function getbonus()
    {
        $this->db->select('*');
        $this->db->from('bonus a');
        $this->db->join('perilaku b', 'b.nik = a.nik');
        $this->db->join('kedisiplinan c', 'c.nik = a.nik');
        $this->db->join('wawasan d', 'd.nik = a.nik');
        $this->db->join('kerjasama_tim e', 'e.nik = a.nik');
        $this->db->join('kinerja f', 'f.nik = a.nik');
        $this->db->join('karyawan g', 'g.nik = a.nik');
        $this->db->join('absensi h', 'h.nik = a.nik');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getbonus_range($start, $finish)
    {
        $this->db->select('*');
        $this->db->from('bonus a');
        $this->db->where('a.tgl_penerimaan >=', $start);
        $this->db->where('a.tgl_penerimaan <=', $finish);
        $query = $this->db->get()->result_array();
        return $query;
    }



    public function getbonusid($id)
    {
        $this->db->select('*');
        $this->db->from('bonus a');
        $this->db->where('a.kode_bonus', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function getabsensi()
    {
        $this->db->select('*');
        $this->db->from('absensi a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('MONTH(a.tgl_penilaian)', date('m'));
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function getabsensi_nik($nik)
    {
        $this->db->select('*');
        $this->db->from('absensi a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function getperilaku()
    {
        $this->db->select('*');
        $this->db->from('perilaku a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('MONTH(a.tgl_penilaian_perilaku)', date('m'));
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getperilaku_nik($nik)
    {
        $this->db->select('*');
        $this->db->from('perilaku a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function getdisiplin()
    {
        $this->db->select('*');
        $this->db->from('kedisiplinan a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('MONTH(a.tgl_penilaian_kedisiplinan)', date('m'));
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getdisiplin_nik($nik)
    {
        $this->db->select('*');
        $this->db->from('kedisiplinan a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function getwawasan()
    {
        $this->db->select('*');
        $this->db->from('wawasan a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('MONTH(a.tgl_penilaian_wawasan)', date('m'));
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getwawasan_nik($nik)
    {
        $this->db->select('*');
        $this->db->from('wawasan a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function getkerjasama()
    {
        $this->db->select('*');
        $this->db->from('kerjasama_tim a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('MONTH(a.tgl_penilaian_kerjasama)', date('m'));
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getkerjasama_nik($nik)
    {
        $this->db->select('*');
        $this->db->from('kerjasama_tim a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function getkinerja()
    {
        $this->db->select('*');
        $this->db->from('kinerja a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('MONTH(a.tgl_penilaian_kinerja)', date('m'));
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getkinerja_nik($nik)
    {
        $this->db->select('*');
        $this->db->from('kinerja a');
        $this->db->join('karyawan b', 'b.nik = a.nik');
        $this->db->where('a.nik', $nik);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function getall()
    {
        $this->db->select('*');
        $this->db->from('absensi a');
        $this->db->join('perilaku b', 'b.nik = a.nik');
        $this->db->join('kedisiplinan c', 'c.nik = a.nik');
        $this->db->join('wawasan d', 'd.nik = a.nik');
        $this->db->join('kerjasama_tim e', 'e.nik = a.nik');
        $this->db->join('kinerja f', 'f.nik = a.nik');
        $this->db->join('karyawan g', 'g.nik = a.nik');
        $this->db->where('MONTH(a.tgl_penilaian)', date('m'));
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function caripenilaian($month, $year)
    {
        # code...
    }
}
