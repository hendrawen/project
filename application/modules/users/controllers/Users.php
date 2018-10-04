<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    private $permit;
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->model('modeluser','user');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'language'));
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
    }

    public function index()
    {
        $data['aktif']		  ='setting';
    		$data['judul']      ='User';
    		$data['sub_judul']	='User';
        $data['users']      = $this->user->get_all();
        $data['content']    = 'user/users';
        $this->load->view('panel/dashboard',$data);
    }

    public function create_user()
    {
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' 		=> $this->input->post('first_name'),
                'last_name'  		=> $this->input->post('last_name'),
                'company'    		=> $this->input->post('company'),
                //'alamat'      		=> $this->input->post('alamat'),
                'phone'      		=> $this->input->post('phone'),
                //'jatuh_tempo'      => $this->input->post('jatuh_tempo'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Account Successfully Created</div>");
            redirect("users", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );
						$this->data['aktif']		  ='setting';
						$this->data['judul']      ='User';
						$this->data['sub_judul']	='Tambah';
						$this->data['content']    ='user/table_user_form';
						$this->_render_page('panel/dashboard', $this->data);
            //$this->_render_page('user/table_user_form', $this->data);
        }
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
