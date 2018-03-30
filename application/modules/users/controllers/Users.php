<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
   public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('modeluser','user');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'language'));
    }

    public function index()
    {
        $data['aktif']		  ='User';
    		$data['judul']      ='Dashboard';
    		$data['sub_judul']	='User';
        $data['users']      = $this->user->get_all();
        $data['content']    = 'user/users';
        $this->load->view('administrator/dashboard',$data);
    }

    public function create()
    {

        $data['aktif']		  ='User';
    		$data['judul']      ='Dashboard';
    		$data['sub_judul']	='User';
        $data['content']    ='user/table_user_form';
        $this->load->view('administrator/dashboard',$data);
    }

    public function ajax_list()
    {
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rows) {
            $no++;
            $row = array();
            $row[] = $rows->first_name;
            $row[] = $rows->last_name;
            $row[] = $rows->username;
            $row[] = $rows->company;
            $row[] = $rows->phone;
            $row[] = $rows->email;
            $row[] = $rows->status;
            $row[] = $rows->active;

            $row[] = '<ul class="icons-list">
                        <li class="dropdown">
                        <a href="javascript:void(0)" title="aksi" href="#" class="dropdown-toggle" data-toggle="dropdown">
                             <i class="icon-menu9"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="users/auth/edit_user/'."".$rows->id."".'"><i class="icon-pencil7 text-info"></i> Change </a></li>
                            <li><a href="users/auth/activate/'."".$rows->id."".'"><i class=" icon-switch2 text-success"></i> Activate </a></li>
                            <li><a href="users/auth/deactivate/'."".$rows->id."".'" ><i class="icon-warning2 text-warning"></i> Deactivate </a></li>

                        </ul>
                    </li>
                </ul>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->user->count_all(),
                        "recordsFiltered" => $this->user->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->user->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_delete()
    {
        $this->input->post('id');
        $this->user->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->user->delete_by_id($id);
        }
        echo json_encode(array("status" => TRUE));
    }



}
