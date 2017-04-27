<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model','order');
		$this->load->helper(['url','html','form']);
		$this->load->database();
		$this->load->library(['form_validation','session']);
	}

	public function index()
	{

		$this->load->helper('form','url');
		$this->load->helper('download');
		$this->load->view('order_view', array('error'=>' '));
	}

	public function ajax_list()
	{
		$list = $this->order->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $order) {
			$no++;
			$row = array();
			$row[] = $order->email;
			$row[] = $order->address;
			$row[] = $order->weight;
			$row[] = $order->price;
			$row[] = $order->date_order;
			$row[] = $order->date_end;
			$row[] = $order->status;

			$row[] =
			'<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_order('."'".$order->id_order."'".')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a>
			<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_order('."'".$order->id_order."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->order->count_all(),
						"recordsFiltered" => $this->order->count_filtered(),
						"data" => $data,
				);

		echo json_encode($output);
	}



	public function ajax_edit($id)
	{
		$data = $this->order->get_by_id($id);
		$data->date_order = ($data->date_order == '0000-00-00') ? '' : $data->date_order; // if 0000-00-00 set tu empty for datepicker compatibility
		$data->date_end = ($data->date_end == '0000-00-00') ? '' : $data->date_end; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();

		$data = array(
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
				'weight' => $this->input->post('weight'),
				'price' => $this->input->post('price'),
				'date_order' => $this->input->post('date_order'),
				'date_end' => $this->input->post('date_end'),
				'status' => $this->input->post('status'),
			);
		$insert = $this->order->save($data);

		echo json_encode(array("status" => TRUE));
		//redirect('edit');
	}

	public function edit_data($no)
	{
		$data['data'] = $this->order->edit($no);
		$this->load->view('edit',$data);
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
				'weight' => $this->input->post('weight'),
				'price' => $this->input->post('price'),
				'date_order' => $this->input->post('date_order'),
				'date_end' => $this->input->post('date_end'),
				'status' => $this->input->post('status'),
			);
		$this->order->update(array('id_order' => $this->input->post('id_order')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id,$namefile)
	{
		$this->order->delete_by_id($id);
		unlink("./files/".$namefile);
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

		if($this->input->post('date_order') == '')
		{
			$data['inputerror'][] = 'date_order';
			$data['error_string'][] = 'Order Date is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('status') == '')
		{
			$data['inputerror'][] = 'status';
			$data['error_string'][] = 'Please select status';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
