<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_model','barang');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('edit');
	}

	public function ajax_list($idd)
	{

		$list = $this->barang->get_datatables($idd);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->nama_barang;
			$row[] = $person->jumlah_barang;
			$row[] = $person->satuan_barang;
			$row[] = $person->keterangan_barang;
//			$row[] = $person->dob;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id_barang."'".')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id_barang."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';

		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->barang->count_all(),
						"recordsFiltered" => $this->barang->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->barang->get_by_id($id);
		//$data->tanggal = ($data->tanggal == '0000-00-00') ? '' : $data->tanggal; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function insert_detail() //reski
	{
		$id_request 		= $this->input->post('id_request');
		$nama_barang 		= $this->input->post('nama_barang');
		$keterangan_barang	= $this->input->post('keterangan_barang');
		$jumlah_barang 		= $this->input->post('jumlah_barang');
		$satuan_barang 		= $this->input->post('satuan_barang');

		$databarang = array(
			'id_request'       		=> $id_request,
			'nama_barang'			=> $nama_barang,
			'keterangan_barang'		=> $keterangan_barang,
			'jumlah_barang'			=> $jumlah_barang,
			'satuan_barang'			=> $satuan_barang
			);
		$this->load->model('person_model');
		$this->person_model->add($databarang);
		redirect('person');
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'unit_permintaan' => $this->input->post('unit_permintaan'),
				'nomor_dokumen_pendukung' => $this->input->post('nomor_dokumen_pendukung'),
				'tanggal' => $this->input->post('tanggal'),
				'status' => $this->input->post('status'),
				//'dob' => $this->input->post('dob'),
			);
		$insert = $this->person->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_barang()
	{
		$this->_validate();
		$data = array(
				'id_request' => $this->input->post('id_request'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah_barang' => $this->input->post('jumlah_barang'),
				'satuan_barang' => $this->input->post('satuan_barang'),
				'keterangan_barang' => $this->input->post('keterangan_barang'),

				//'dob' => $this->input->post('dob'),
			);
		$insert = $this->barang->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function edit_data($no)
	{
		$data['data'] = $this->barang->edit($no);
		$this->load->view('edit',$data);
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'id_request' => $this->input->post('id_request'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah_barang' => $this->input->post('jumlah_barang'),
				'satuan_barang' => $this->input->post('satuan_barang'),
				'keterangan_barang' => $this->input->post('keterangan_barang'),
			);
		$this->barang->update(array('id_barang' => $this->input->post('id_barang')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->barang->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('id_request') == '')
		{
			$data['inputerror'][] = 'id_request';
			$data['error_string'][] = 'ID Request is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_barang') == '')
		{
			$data['inputerror'][] = 'nama_barang';
			$data['error_string'][] = 'Nama Barang is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('jumlah_barang') == '')
		{
			$data['inputerror'][] = 'jumlah_barang';
			$data['error_string'][] = 'Jumlah Barang is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('satuan_barang') == '')
		{
			$data['inputerror'][] = 'satuan_barang';
			$data['error_string'][] = 'Satuan Barang is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('keterangan_barang') == '')
		{
			$data['inputerror'][] = 'keterangan_barang';
			$data['error_string'][] = 'keterangan Barang is required';
			$data['status'] = FALSE;
		}

		/*if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}*/

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
