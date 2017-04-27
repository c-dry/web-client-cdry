<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('person_model','person');
		$this->load->helper(['url','html','form']);
		$this->load->database();
		$this->load->library(['form_validation','session']);
	}

	public function index()
	{

		$this->load->helper('form','url');
		$this->load->helper('download');
		$this->load->view('person_view', array('error'=>' '));
	}

	public function ajax_list()
	{
		$list = $this->person->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			//$row[] = $person->id_user;
			$row[] = $person->email;
			$row[] = $person->password;
			$row[] = $person->name;
			$row[] = $person->address;
			$row[] = $person->role;

			//add html for download
			/*if($person->file_dokumen == NULL)
			{
				$row[] = '<i  href="#"><i class="glyphicon glyphicon-remove"></i> Tidak ada Berkas</i>';
			}
			else
			{
				$row[] = '<a  href="index.php/person/download/'.$person->file_dokumen.'" title="unduh" ><i class="glyphicon glyphicon-download"></i> Unduh Berkas</a>';
			}*/

			//add html for action
			$row[] = 
			'<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id_user."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>
			<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id_user."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->person->count_all(),
						"recordsFiltered" => $this->person->count_filtered(),
						"data" => $data,
				);

		echo json_encode($output);
	}

	

	public function ajax_edit($id)
	{
		$data = $this->person->get_by_id($id);
		//$data->tanggal = ($data->tanggal == '0000-00-00') ? '' : $data->tanggal; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{		
		$this->_validate();

		$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'role' => $this->input->post('role'),
			);
		$insert = $this->person->save($data);

		echo json_encode(array("status" => TRUE));
		//redirect('edit');
	}

	public function edit_data($no)
	{
		$data['data'] = $this->person->edit($no);
		$this->load->view('edit',$data);    	
	}

	/*public function unggah($no)
	{
		$data['data'] = $this->person->edit($no);
		$this->load->view('upload_success',$data);    	
	}*/

	public function ajax_update()
	{
		$this->_validate();
		$data = array(				
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'role' => $this->input->post('role'),
			);
		$this->person->update(array('id_user' => $this->input->post('id_user')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id,$namefile)
	{
		//$this->person->delete_barang_by_id($id);
		$this->person->delete_by_id($id);
		//unlink("./files/".$namefile);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('password') == '')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('name') == '')
		{
			$data['inputerror'][] = 'name';
			$data['error_string'][] = 'Name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Address is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('role') == '')
		{
			$data['inputerror'][] = 'role';
			$data['error_string'][] = 'Please select your role';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	/*
	//FILE UPLOAD

	//upload file dan delete file lama dan update database
    public function upload($no,$filelama)
    {
        //set preferences
        $data['data'] = $this->person->edit($no);
        $config['upload_path'] = realpath('files');
        $config['allowed_types'] = 'txt|pdf|doc|docx|xls|xlsx'; //type file
        $config['max_size']    = '5120'; //maksimal 5 mb
        $config['file_name']      = 'Surat-'.trim(str_replace(" ","",date('dmYHis')));
        //load upload class library
        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filename'))
        {
            // case - failure
            
            $data['success_msg'] = '<div class="alert alert-danger text-center ">' . $this->upload->display_errors(). '</strong> !</div>';
            
            $this->load->view('edit',$data);
        }
        else
        {
            // case - success
            $id_request 	= $this->input->post('id_request');
            $upload_data = $this->upload->data();
            $file_id = array(
		         		'file_dokumen' => $upload_data['file_name']
		         	);
            $this->person->insert_file($no,$file_id);
            $data['success_msg'] = '<div class="alert alert-success text-center ">Berkas <strong>' . $upload_data['file_name'] . '</strong> telah berhasil di unggah!</div>';
            $this->load->view('edit', $data);//, $data);
            unlink("./files/".$filelama);
            redirect('person/edit_data/'.$no,'refresh');
        }
    }

    //upload baru ke database
    public function upload0($no)
    {
        //set preferences
        $data['data'] = $this->person->edit($no);
        $config['upload_path'] = realpath('files');
        $config['allowed_types'] = 'txt|pdf|doc|docx|xls|xlsx';
        $config['max_size']    = '5120';
        $config['file_name']      = 'Surat-'.trim(str_replace(" ","",date('dmYHis')));
        //load upload class library
        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filename'))
        {
            // case - failure
            
            $data['success_msg'] = '<div class="alert alert-danger text-center ">' . $this->upload->display_errors(). '</strong> !</div>';
            
            $this->load->view('edit',$data);
        }
        else
        {
            // case - success
            $id_request 	= $this->input->post('id_request');
            $upload_data = $this->upload->data();
            $file_id = array(
		         		'file_dokumen' => $upload_data['file_name']
		         	);
            $this->person->insert_file($no,$file_id);
            $data['success_msg'] = '<div class="alert alert-success text-center ">Berkas <strong>' . $upload_data['file_name'] . '</strong> telah berhasil di unggah!</div>';
            $this->load->view('edit', $data);//, $data);
            //unlink("./files/".$filelama);
            //redirect('person/edit_data/'.$no,'refresh');
        }
    }

    //download file
    public function download($name)
	{
		 $this->load->helper('download'); //jika sudah diaktifkan di autoload, maka tidak perlu di tulis kembali
		 
		 $data = file_get_contents("uploads/".$name); // letak file pada aplikasi kita
		 
		 force_download($name,$data);
	}

	//delete file pada source
	public function delete_source($namefile)
	{
		unlink("./files/".$namefile);
	}
	*/
}
