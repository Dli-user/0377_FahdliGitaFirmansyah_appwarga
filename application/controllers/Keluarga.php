<?php
/**
 *
 */
class Keluarga extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Keluarga');
		$this->load->model('M_Rukuntetangga');
	}

	public function index()
	{
		$data = array('title' => 'Sistem Informasi Warga',
					  'page' => 'Data Keluarga',
					  'tabel_title' => 'Tabel Data Keluarga',
					  'data_keluarga' => $this->M_Keluarga->tampil('keluarga')->result_array());
		$this->template->load_admin('dashboard','dash_data_c1',$data);
	}

	public function anggota_keluarga()
	{
		$id = $this->uri->segment(3);
		$data = array('title' => 'Sistem Informasi Warga',
					  'page' => 'Data Keluarga',
					  'tabel_title' => 'Tabel Data Keluarga',
					  'data_kk' => $this->M_Keluarga->tampil_perid('keluarga',$id)->row_array());
		$this->template->load_admin('dashboard','dash_data_keluarga',$data);
	}

	public function tambah()
	{
		$data = array('title' => 'Sistem Informasi Warga',
					  'page' => 'Data Keluarga',
					  'tabel_title' => 'Input Data Keluarga',
					  'data_rt' => $this->M_Rukuntetangga->tampil('rt')->result_array());
		$this->template->load_admin('dashboard','dash_input_keluarga',$data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('id_rt','RT','required');
		$this->form_validation->set_rules('nomor_kk','Nomor KK','required');
		$this->form_validation->set_rules('nama_kk','Nama Kepala Keluarga','required');
		$this->form_validation->set_rules('alamat_kk','Alamat','required');
		if ($this->form_validation->run() != false) {
			$data = array('id_rt' => $this->input->post('id_rt'),
						  'nomor_kk' => $this->input->post('nomor_kk'),
						  'nama_kk' => $this->input->post('nama_kk'),
						  'alamat_kk' => $this->input->post('alamat_kk'));

			$this->M_Keluarga->simpan('keluarga', $data);
			redirect('keluarga');
		}else{
			redirect('keluarga/tambah');
		}
	}

	public function edit()
	{
		$id = $this->uri->segment(3);
		$data = array('title' => 'Sistem Informasi Warga',
					  'page' => 'Data Keluarga',
					  'tabel_title' => 'Edit Data Keluarga',
					  'data_rt' => $this->M_Rukuntetangga->tampil('rt')->result_array(),
					  'data_keluarga' => $this->M_Keluarga->tampil_relasi_perid('keluarga','rt',$id)->row_array());
		$this->template->load_admin('dashboard','dash_edit_keluarga',$data);

	}

	public function update()
	{
		$this->form_validation->set_rules('id_rt','RT','required');
		$this->form_validation->set_rules('nomor_kk','Nomor KK','required');
		$this->form_validation->set_rules('nama_kk','Nama Kepala Keluarga','required');
		$this->form_validation->set_rules('alamat_kk','Alamat','required');
		if ($this->form_validation->run() != false) {
			$where = array('id' => $this->input->post('id_kk'));
			$data = array('id_rt' => $this->input->post('id_rt'),
						  'nomor_kk' => $this->input->post('nomor_kk'),
						  'nama_kk' => $this->input->post('nama_kk'),
						  'alamat_kk' => $this->input->post('alamat_kk'));

			$this->M_Keluarga->update('keluarga', $data, $where);
			redirect('keluarga');
		}else{
			redirect('keluarga/edit');
		}
	}

	public function hapus()
	{
		$id = $this->uri->segment(3);
		$this->M_Keluarga->hapus('keluarga',$id);
		redirect('anggota_keluarga');
	}

	public function tambah_anggota_keluarga()
	{
		$id = $this->uri->segment(3);
		$data = array('title' => 'Sistem Informasi Warga',
					  'page' => 'Data Keluarga',
					  'tabel_title' => 'Input Anggota Keluarga');
		$this->template->load_admin('dashboard','dash_input_anggota',$data);	
	}

	public function simpan_anggota_keluarga()
	{
		$id = $this->uri->segment(3);
		$data = array('title' => 'Sistem Informasi Warga',
					  'page' => 'Data Keluarga',
					  'tabel_title' => 'Input Anggota Keluarga');
		$this->template->load_admin('dashboard','dash_input_anggota',$data);

		redirect('keluarga/anggota_keluarga'.$this->input->post('keluarga/anggota_keluarga'));
	}

	public function edit_anggota_keluarga()
	{
		$id = $this->uri->segment(3);
		$data = array('title' => 'Sistem Informasi Warga',
					  'page' => 'Data Keluarga',
					  'tabel_title' => 'Input Anggota Keluarga',
						'data_anggota' => 'kerjakan disini..... ');
		$this->template->load_admin('dashboard','dash_edit_anggota',$data);
	}

	public function update_anggota_keluarga()
	{
		$id = $this->uri->segment(3);
		$data = array('title' => 'Sistem Informasi Warga',
					  'page' => 'Data Keluarga',
					  'tabel_title' => 'Input Anggota Keluarga');
		$this->template->load_admin('dashboard','dash_edit_anggota',$data);

		redirect('keluarga/anggota_keluarga/'.$this->input->post('anggota_keluarga'));
	}

	public function hapus_anggota_keluarga()
	{
        $id = $this->uri->segment(3);
		$this->M_Keluarga->hapus('anggota_keluarga',$id);
		redirect('anggota_keluarga');
	}

}
