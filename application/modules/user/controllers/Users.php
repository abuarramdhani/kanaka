<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    function login() {
        //special for loginpage
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == true) {
            if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'))) {
                $this->ion_auth->clear_login_attempts($this->input->post('username'));
                redirect('/', 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('login', 'refresh');
            }
        } else {
            $data['message'] = $this->session->flashdata('message');
            $data['form_attributes'] = array("autocomplete" => "off", 'class' => 'login-form');
            $data['username'] = array('name' => 'username',
                'class' => 'form-control placeholder-no-fix',
                'placeholder' => 'Username',
                'type' => 'text',
                'required' => 'required',
                'autofocus' => 'autofocus',
                'value' => $this->form_validation->set_value('username'),
            );
            $data['password'] = array('name' => 'password',
                'required' => 'required',
                'class' => 'form-control placeholder-no-fix',
                'placeholder' => 'Password',
            );
            $data['csrftoken_name'] = $this->security->get_csrf_token_name();
            $data['csrftoken_value'] = $this->security->get_csrf_hash();
            $data['dipos'] = Dipo::where('type', 'dipo')->where('deleted', 0)->get();
            $data['cities'] = City::where('deleted', 0)->get();
            
            $this->load->blade('user.views.login.page', $data);
        }
    }

    function logout() {
        $this->ion_auth->logout();
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('login', 'refresh');
    }


    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        $data['add_access'] = $this->user_profile->get_user_access('Created', 'users/account');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'users/account');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'users/account');
        
        $data['user'] = $this->ion_auth->user()->row();
        $data['comp_name'] = $this->config->item('comp_name');
        $data['roles'] = Group::all();
        
        $this->load->blade('user.views.user.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            'full_name',
            'username',
            'company',
            'groups.name',
            'groups.description',
            'created_date',
            'avatar',
            'users.id'
        );

        $header_columns = array(
            'full_name',
            'username',
            'company',
            'groups.name',
            'created_date',
            'avatar',
            'users.id'
        );

        $from = "users";
        $where = "active = 1";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');

        $join[] = array('groups', 'groups.id = users.group_id', 'left');

        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            $where .= " AND (full_name LIKE '%" . $sSearch . "%'" ;
            $where .= " OR username LIKE '%" . $sSearch . "%'";
            $where .= " OR company LIKE '%" . $sSearch . "%'";
            $where .= " OR groups.description LIKE '%" . $sSearch . "%'";
            $where .= " OR created_date LIKE '%" . $sSearch . "%'";
            $where .= " OR users.id LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('users.id');
        $this->datatables->config('database_columns', $database_columns);
        $this->datatables->config('from', $from);
        $this->datatables->config('join', $join);
        $this->datatables->config('where', $where);
        $this->datatables->config('order_by', $order_by);
        $selected_data = $this->datatables->get_select_data();
        $aa_data = $selected_data['aaData'];
        $new_aa_data = array();
        
        foreach ($aa_data as $row) {
            $row_value = array();

            $btn_action = '';
            if($this->user_profile->get_user_access('Created', 'users/account'))
                $btn_action .= '<a href="' . base_url() . 'master/users/usermenu/' . uri_encrypt($row->id) . '" class="btn btn-success btn-icon-only btn-circle" title="' . lang('btnusermenu') . '"><i class="glyphicon glyphicon-cog"></i></a>';
            if($this->user_profile->get_user_access('Updated', 'users/account')){
                $btn_action .= '<a onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
                $btn_action .= '<a class="btn btn-danger btn-icon-only btn-circle" title="Reset Password" onclick="reset_password(\'' . uri_encrypt($row->id) . '\')"><i class="fa fa-refresh"></i></a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'users/account')){
                if ($row->username != $this->ion_auth->user()->row()->username) {
                    $btn_action .= '<a onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
                }
            }

            $row_value[] = $row->full_name;
            $row_value[] = ucwords($row->username);
            $row_value[] = ucwords($row->company);
            if ($row->name == 'admin') {
                $group = '<span class="label label-danger">' . ucfirst($row->description) . '</span>';
            }elseif ($row->name == 'dipo') {
                $group = '<span class="label label-primary">' . ucfirst($row->description) . '</span>';
            }else{
                $group = '<span class="label label-success">' . ucfirst($row->description) . '</span>';
            }
            $row_value[] = $group;
            $row_value[] = date("d-m-Y H:i:s", strtotime($row->created_date));
            $row_value[] = '<a class="pull-left thumb-sm avatar"><img src="' . base_url() . 'assets/img/' . $row->avatar . '" class="img-circle" style="width:40%"></a>';
            $row_value[] = $btn_action;
            $new_aa_data[] = $row_value;
        }
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }

    public function save() {
        if ($this->input->is_ajax_request()) {
            $user_log = $this->ion_auth->user()->row();
            $check_exist = $this->ion_auth->email_check($this->input->post('email'));
            if ($check_exist > 0) {
                $status = array('status' => 'unique');
            } else {
                $username = $this->input->post('username');
                $group = array($this->input->post('role'));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $confirm_password = $this->input->post('confirm_password');
                if($password == $confirm_password){
                    $data = array(
                        "full_name" => $this->input->post('fullname'),
                        "company" => $this->input->post('company'),
                        "group_id" => $this->input->post('role'),
                        "dipo_partner_id" => $this->input->post('dipo_partner_id'),
                        "phone" => str_replace("_", "", $this->input->post('phone')),
                        "created_date" => date('Y-m-d H:i:s'),
                        "avatar" => 'default_avatar.jpg'
                    );
                    if ($this->ion_auth->register($username, $password, $email, $data, $group)) {
                        $data_notif = array(
                            "Full Name" => $this->input->post('fullname'),
                            "Email" => $email,
                            "Role" => Group::find($this->input->post('role'))->description,
                            "Customer" => $this->input->post('dipo_partner_id') > 0 ? Dipo::find($this->input->post('dipo_partner_id'))->name : '-',
                            "Company" => $this->input->post('company'),
                            "Phone" => str_replace("_", "", $this->input->post('phone')),
                        );
                        
                        $message = "Add " . strtolower(lang('user')) . " " . $this->input->post('fullname') . " succesfully by " . $user_log->full_name;
                        $this->activity_log->create($user_log->id, json_encode($data_notif), NULL, NULL, $message, 'C', 2);
                        $status = array('status' => 'success');
                    } else {
                        $status = array('status' => 'error');
                    }
                }
                else{
                    $status = array('status' => 'error');
                }
            }
            $data = $status;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function update(){
        if ($this->input->is_ajax_request()) {
            $id = (int) $this->input->post('user_id');
            $user_log = $this->ion_auth->user()->row();
            $user = $this->ion_auth->user($id)->row();
            $user_group = $this->ion_auth->get_users_groups($id)->row();
            $check_exist = 0;
            if ($user->email != $this->input->post('email')) {
                $check_exist = $this->ion_auth->email_check($this->input->post('email'));
            }
            if ($check_exist > 0) {
                $status = array('status' => 'unique');
            } else {
                $username = NULL;
                $group = array($this->input->post('role_id'));
                $data_old = array(
                    "Full Name" => $user->full_name,
                    "Email" => $user->email,
                    "Company" => $user->company,
                    "Phone" => str_replace("_", "", $user->phone),
                    "City" => $user->city,
                    "Address" => $user->address,
                    "Role" => Group::find($user->group_id)->description,
                    "Customer" => $user->dipo_partner_id > 0 ? Dipo::find($user->dipo_partner_id)->name : '-',
                );
                $data = array(
                    "full_name" => $this->input->post('fullname'),
                    "email" => $this->input->post('email'),
                    "company" => $this->input->post('company'),
                    "phone" => str_replace("_", "", $this->input->post('phone')),
                    "city" => $this->input->post('city'),
                    "address" => $this->input->post('address'),
                    "group_id" => $this->input->post('role_id'),
                    "dipo_partner_id" => $this->input->post('dipo_partner_id'),
                );
                if ($this->ion_auth->update($id, $data)) {
                    if ($user_group->id != $group) {
                        $this->ion_auth->remove_from_group($user_group->id, $id);
                        $this->ion_auth->add_to_group($group, $id);
                    }
                    $data_new = array(
                        "Full Name" => $this->input->post('fullname'),
                        "Email" => $this->input->post('email'),
                        "Company" => $this->input->post('company'),
                        "Phone" => str_replace("_", "", $this->input->post('phone')),
                        "City" => $this->input->post('city'),
                        "Address" => $this->input->post('address'),
                        "Role" => Group::find($this->input->post('role_id'))->description,
                        "Customer" => $this->input->post('dipo_partner_id') > 0 ? Dipo::find($this->input->post('dipo_partner_id'))->name : '-',
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('user')) . " " .  $user->full_name . " succesfully by " . $user_log->full_name;
                    $this->activity_log->create($user_log->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 2);
                    $status = array('status' => 'success');
                } else {
                    $status = array('status' => 'error');
                }
            }
        } else {
            $status = array('status' => 'error');
        }
        $data = $status;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function view() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $user = User::find($id);
            $model = array('status' => 'success', 'data' => $user);
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function delete() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $user = $this->ion_auth->user()->row();
            $user_log = $this->ion_auth->user()->row();
            $model = User::find($id);
            if (!empty($model)) {
                $model->active = 0;
                $update = $model->save();
                $data_notif = array(
                    "Status" => 'Active',
                );
                
                $message = "Delete " . strtolower(lang('user')) . " " .  $model->full_name . " succesfully by " . $user_log->full_name;
                $this->activity_log->create($user_log->id, NULL, json_encode($data_notif), NULL, $message, 'D', 2);
                
                $status = array('status' => 'success');
            } else {
                $status = array('status' => 'error');
            }
        } else {
            $status = array('status' => 'error');
        }
        $data = $status;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function reset_password() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $user = $this->ion_auth->user()->row();
            $model = User::find($id);
            if (!empty($model)) {
                $new_password = $this->config->item('password_default');
                $this->ion_auth->reset_password($model->username, $new_password);
                $status = array('status' => 'success');
            } else {
                $status = array('status' => 'error');
            }
        } else {
            $status = array('status' => 'error');
        }
        $data = $status;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function profile() {
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        // /* Provinsi */
        // $provinces = Province::all();
        // $province_options = array();
        // $province_options[''] = '-- Pilih Provinsi --';
        // if (!empty($provinces)) {
        //     foreach ($provinces as $province) {
        //         $province_options[$province->id_provinsi] = $province->nama_provinsi;
        //     }
        // }
        // $data['province_options'] = $province_options;
        // $data['province_properties'] = "class='form-control select2' id='provinsi' style='width: 100%'";

        /* City */
        // $data['cities'] = City::all();

        $this->load->blade('user.views.user.profile', array());
    }

    public function profile_save() {
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        if ($this->input->is_ajax_request()) {
            $user = $this->ion_auth->user()->row();
            $user_group = $this->ion_auth->get_users_groups($user->id)->row();
            $first_name = ucwords($this->input->post('first_name'));
            $last_name = ucwords($this->input->post('last_name'));
            
            $check_exist = 0;
            if ($user->email != $this->input->post('email')) {
                $check_exist = $this->ion_auth->email_check($this->input->post('email'));
            }
            if ($check_exist > 0) {
                $status = array('status' => 'unique');
            } else {
                $data_old = array(
                    "Username" => $user->username,
                    "First Name" => $user->first_name,
                    "Last Name" => $user->last_name,
                    "Full Name" => $user->first_name.' '.$user->last_name,
                    "Email" => $user->email,
                    "Address" => $user->address,
                    "City" => $user->city,
                    "Phone" => str_replace("_", "", $user->phone),
                );

                $data = array(
                    "username" => $this->input->post('username'),
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "full_name" => $first_name.' '.$last_name,
                    "email" => $this->input->post('email'),
                    "address" => $this->input->post('address'),
                    "city" => $this->input->post('city'),
                    "phone" => str_replace("_", "", $this->input->post('phone')),
                );

                if ($this->ion_auth->update($user->id, $data)) {
                    $data_new = array(
                        "Username" => $this->input->post('username'),
                        "First Name" => $first_name,
                        "Last Name" => $last_name,
                        "Full Name" => $first_name.' '.$last_name,
                        "Email" => $this->input->post('email'),
                        "Address" => $this->input->post('address'),
                        "City" => $this->input->post('city'),
                        "Phone" => str_replace("_", "", $this->input->post('phone')),
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('user')) . " profile " .  $user->first_name.' '.$user->last_name . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 2);
                    
                    $status = array('status' => 'success');
                } else {
                    $status = array('status' => 'error');
                }
            }
            $data = $status;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function profile_data() {
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        if ($this->input->is_ajax_request()) {
            $user = $this->ion_auth->user()->row();
            $user_group = $this->ion_auth->get_users_groups($user->id)->row();
            $model = array('status' => 'success', 'data' => $user, 'data_group' => $user_group);
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function change_password() {
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        
        $this->load->blade('user.views.user.change_password');
    }

    function change_password_save() {
        if ($this->input->is_ajax_request()) {
            $user = $this->ion_auth->user()->row();
            if ($this->input->post('new_password') != $this->input->post('retype_password')) {
                $status = array('status' => 'wrong_password');
            } else {
                if ($this->ion_auth->change_password($user->username, $this->input->post('old_password'), $this->input->post('new_password'))) {
                    $user = User::find($user->id);
                    $user->password_mobile = md5($this->input->post('new_password'));
                    $update = $user->update();

                    $status = array('status' => 'success');
                } else {
                    $status = array('status' => 'error');
                }
            }

            $data = $status;
            
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function forgot_password() {
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        if ($this->form_validation->run() == false) {
            //setup the input
//            $this->data['email'] = array('name' => 'email',
//                'id' => 'email',
//            );
            //set any errors and display the form
            $this->session->set_flashdata('message', validation_errors());
            redirect("login", 'refresh');
        } else {
            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

            if ($forgotten) { //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
            }
            redirect("login", 'refresh');
        }
    }

    function reset_password_backup($code = NULL) {
        if (!$code) {
            show_404();
        }
        $user = $this->ion_auth->forgotten_password_check($code);
        if ($user) {
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]|trim');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]|trim');
            if ($this->form_validation->run() == false) {
                if (!empty(validation_errors())) {
                    $this->session->set_flashdata('message_error', validation_errors());
                }
                $data['new_password'] = array(
                    'name' => 'new_password',
                    'required' => 'required',
                    'class' => 'form-control placeholder-no-fix',
                    'placeholder' => 'New Password',
                );
                $data['confirm_password'] = array(
                    'name' => 'confirm_password',
                    'required' => 'required',
                    'class' => 'form-control placeholder-no-fix',
                    'placeholder' => 'Confirm Password',
                );
                $data['user_id'] = $user->id;

                $data['form_attributes'] = array("autocomplete" => "off", 'class' => 'login-form');
                $data['code'] = $code;


                $data['message_error'] = $this->session->flashdata('message_error');
                $data['message_success'] = $this->session->flashdata('message_success');
                $this->load->blade('user.views.user.reset_password', $data);
            } else {
                if ($user->id != $this->input->post('user_id')) {
                    $this->ion_auth->clear_forgotten_password_code($code);
                    show_error($this->lang->line('error_csrf'));
                } else {
                    $identity = $user->email;
                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new_password'));
                    if ($change) {
                        $this->session->set_flashdata('message', 'Password Berhasil Diubah.');
                        redirect("login");
                    } else {
                        $this->session->set_flashdata('message_error', 'Password Tidak Berhasil Diubah.');
                        redirect('reset-password/' . $code);
                    }
                }
            }
        } else {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("login");
        }
    }

    public function check_code_customer() {
        if ($this->input->is_ajax_request()) {
            $get_code = Code::where('code' , $this->input->get('code'))->where('type' , $this->input->get('type'))->where('deleted', 0)->first();
            if (count($get_code) == 0) {
                $status = array('status' => 'error', 'message' => lang('code') . ' ' . lang('not_registered'));
            }
            else{
                $get_code = Code::where('code' , $this->input->get('code'))->where('type' , $this->input->get('type'))->where('status', 1)->where('deleted', 0)->first();
                if (count($get_code) > 0) {
                    $status = array('status' => 'error', 'message' => lang('code') . ' ' . lang('already_used'));
                }
                else{
                    $get_partner = Partner::where('code' , $this->input->get('code'))->where('deleted', 0)->first();
                    if (count($get_partner) > 0) {
                        $status = array('status' => 'error', 'message' => lang('already_exist'));
                    }
                    else{
                        $status = array('status' => 'success', 'message' => lang('code_is_valid'));
                    }
                }
            }
        }

        $data = $status;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_district_by_city_id() {
        if ($this->input->is_ajax_request()) {
            $get_district = District::where('city_id' , $this->input->get('city_id'))->where('deleted', 0)->orderBy('name', 'asc')->get();
            $html = '<option value="">' . lang('select_your_option') . '</option>';
            foreach($get_district as $row){
                $html .= '<option value="' . $row->id . '">' . ucwords(strtolower($row->name)) . '</option>';
            }

            $status = array('status' => 'success', 'tag_html' => $html);
        }

        $data = $status;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function register_customer() {
        if ($this->input->is_ajax_request()) {
            $get_code = Code::where('code' , $this->input->post('code'))->where('type' , $this->input->post('type'))->where('deleted', 0)->first();
            if (count($get_code) == 0) {
                $status = array('status' => 'error', 'message' => lang('code') . ' ' . lang('not_registered'));
            }
            else{
                $get_code = Code::where('code' , $this->input->post('code'))->where('type' , $this->input->post('type'))->where('status', 1)->where('deleted', 0)->first();
                if (count($get_code) > 0) {
                    $status = array('status' => 'error', 'message' => lang('code') . ' ' . lang('already_used'));
                }
                else{
                    $get_partner = Partner::where('code' , $this->input->post('code'))->where('deleted', 0)->first();
                    if (count($get_partner) > 0) {
                        $status = array('status' => 'unique', 'message' => lang('already_exist'));
                    }
                    else{
                        $code = strtoupper($this->input->post('code'));
                        $username = $this->input->post('username_customer');
                        $type = $this->input->post('type');
                        $dipo_id = $this->input->post('dipo_id');
                        $name = ucwords($this->input->post('name'));
                        $phone = $this->input->post('phone');
                        $fax = $this->input->post('fax');
                        $email = $this->input->post('email');
                        $address = $this->input->post('address');
                        $billing_address = $this->input->post('billing_address');
                        $city = $this->input->post('city');
                        $subdistrict = $this->input->post('subdistrict');
                        $postal_code = $this->input->post('postal_code');
                        $latitude = $this->input->post('latitude');
                        $longitude = $this->input->post('longitude');
                        $purchase_price_type = $this->input->post('purchase_price_type');
                        $taxable = $this->input->post('taxable');
                        $npwp = $this->input->post('npwp');
                        $tax_name = $this->input->post('tax_name');
                        $tax_invoice_address = $this->input->post('tax_invoice_address');
                        $tax_payment_method = $this->input->post('tax_payment_method');
                        $top = $this->input->post('top');
                        $tax_credit_ceiling = $this->input->post('tax_credit_ceiling');
                        $account_number = $this->input->post('account_number');
                        $account_name = $this->input->post('account_name');
                        $bank_name = $this->input->post('bank_name');
                        $bank_code = $this->input->post('bank_code');
                        $account_address = $this->input->post('account_address');
                        
                        if($type != "partner")
                            $dipo_id = 0;
                        
                        $customer_photo = '';
                        if(!empty($_FILES['customer_photo']['name'])){
                            $_FILES['file']['name']     = $_FILES['customer_photo']['name'];
                            $_FILES['file']['type']     = $_FILES['customer_photo']['type'];
                            $_FILES['file']['tmp_name'] = $_FILES['customer_photo']['tmp_name'];
                            $_FILES['file']['error']     = $_FILES['customer_photo']['error'];
                            $_FILES['file']['size']     = $_FILES['customer_photo']['size'];
                            
                            // File upload configuration
                            $uploadPath = 'uploads/images/customers/';
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                            $config['file_name'] = date('YmdHis').rand(10,99);
    
                            // Load and initialize upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            
                            // Upload file to server
                            if($this->upload->do_upload('file')){
                                // Uploaded file data
                                $fileData = $this->upload->data();
                                $customer_photo = $fileData['file_name'];
                            }
                        }
    
                        $house_photo = '';
                        if(!empty($_FILES['house_photo']['name'])){
                            $_FILES['file']['name']     = $_FILES['house_photo']['name'];
                            $_FILES['file']['type']     = $_FILES['house_photo']['type'];
                            $_FILES['file']['tmp_name'] = $_FILES['house_photo']['tmp_name'];
                            $_FILES['file']['error']     = $_FILES['house_photo']['error'];
                            $_FILES['file']['size']     = $_FILES['house_photo']['size'];
                            
                            // File upload configuration
                            $uploadPath = 'uploads/images/houses/';
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                            $config['file_name'] = date('YmdHis').rand(10,99);
    
                            // Load and initialize upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            
                            // Upload file to server
                            if($this->upload->do_upload('file')){
                                // Uploaded file data
                                $fileData = $this->upload->data();
                                $house_photo = $fileData['file_name'];
                            }
                        }
    
                        $warehouse_photo = '';
                        if(!empty($_FILES['warehouse_photo']['name'])){
                            $_FILES['file']['name']     = $_FILES['warehouse_photo']['name'];
                            $_FILES['file']['type']     = $_FILES['warehouse_photo']['type'];
                            $_FILES['file']['tmp_name'] = $_FILES['warehouse_photo']['tmp_name'];
                            $_FILES['file']['error']     = $_FILES['warehouse_photo']['error'];
                            $_FILES['file']['size']     = $_FILES['warehouse_photo']['size'];
                            
                            // File upload configuration
                            $uploadPath = 'uploads/images/warehouses/';
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                            $config['file_name'] = date('YmdHis').rand(10,99);
    
                            // Load and initialize upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            
                            // Upload file to server
                            if($this->upload->do_upload('file')){
                                // Uploaded file data
                                $fileData = $this->upload->data();
                                $warehouse_photo = $fileData['file_name'];
                            }
                        }
    
                        $model = new Partner();
                        $model->code = $code;
                        $model->type = $type;
                        $model->dipo_id = $dipo_id;
                        $model->name = $name;
                        $model->phone = $phone;
                        $model->fax = $fax;
                        $model->email = $email;
                        $model->address = $address;
                        $model->billing_address = $billing_address;
                        $model->city = $city;
                        $model->subdistrict = $subdistrict;
                        $model->postal_code = $postal_code;
                        $model->latitude = $latitude;
                        $model->longitude = $longitude;
                        $model->purchase_price_type = $purchase_price_type;
                        $model->taxable = $taxable;
                        $model->npwp = $npwp;
                        $model->tax_name = $tax_name;
                        $model->tax_invoice_address = $tax_invoice_address;
                        $model->tax_payment_method = $tax_payment_method;
                        $model->top = $top;
                        $model->tax_credit_ceiling = $tax_credit_ceiling;
                        $model->account_number = $account_number;
                        $model->account_name = $account_name;
                        $model->bank_name = $bank_name;
                        $model->bank_code = $bank_code;
                        $model->account_address = $account_address;
                        $model->customer_photo = $customer_photo;
                        $model->house_photo = $house_photo;
                        $model->warehouse_photo = $warehouse_photo;
                        
                        $model->user_created = 0;
                        $model->date_created = date('Y-m-d');
                        $model->time_created = date('H:i:s');
                        $save = $model->save();                
                        if ($save) {
                            $model_code = Code::where('code', $code)->where('type', $type)->first();
                            $model_code->status = 1;
                            $model_code->user_modified = 0;
                            $model_code->date_modified = date('Y-m-d');
                            $model_code->time_modified = date('H:i:s');
                            $model_code->save();
    
                            if($type == "dipo") {
                                $group_id = 2;
                            }
                            else if($type == "customer") {
                                $group_id = 4;
                            }
                            else {
                                $group_id = 3;                                
                            }

                            $group = array($group_id);
                            
                            $data = array(
                                "full_name" => $name,
                                "company" => 'Kanaka',
                                "group_id" => $group_id,
                                "dipo_partner_id" => $model->id,
                                "address" => $address,
                                "city" => $city,
                                "phone" => str_replace("_", "", $phone),
                                "created_date" => date('Y-m-d H:i:s'),
                                "avatar" => 'default_avatar.jpg'
                            );

                            $this->ion_auth->register($username, $code, $email, $data, $group);

                            $data_notif = array(
                                'Code' => $code == "" ? "-" : $code,
                                'Type' => $type == "" ? "-" : ucwords(str_replace('_', ' ', $type)),
                                'Name' => $name == "" ? "-" : $name,
                                'Phone' => $phone == "" ? "-" : $phone,
                                'Fax' => $fax == "" ? "-" : $fax,
                                'Email' => $email == "" ? "-" : $email,
                                'Address' => $address == "" ? "-" : $address,
                                'Billing Address' => $billing_address == "" ? "-" : $billing_address,
                                'City' => $city == "" ? "-" : ucwords(strtolower(City::find($city)->name)),
                                'District' => $subdistrict == "" ? "-" : District::find($subdistrict)->name,
                                'Postal Code' => $postal_code == "" ? "-" : $postal_code,
                                'Latitude' => $latitude == "" ? "-" : $latitude,
                                'Longitude' => $longitude == "" ? "-" : $longitude,
                                'Purchase Price Type' => $purchase_price_type == "" ? "-" : ucwords(str_replace('_', ' ', $purchase_price_type)),
                                'Taxable' => $taxable == "0" ? lang('no') : lang('yes'),
                                'NPWP' => $npwp == "" ? "-" : $npwp,
                                'Tax Name' => $tax_name == "" ? "-" : $tax_name,
                                'Tax Invoice Address' => $tax_invoice_address == "" ? "-" : $tax_invoice_address,
                                'Tax Payment Method' => $tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $tax_payment_method)),
                                'TOP' => $top == "" ? "-" : strtoupper($top),
                                'Tax Credit Ceiling' => $tax_credit_ceiling == "" ? "-" : $tax_credit_ceiling,
                                'Account Number' => $account_number == "" ? "-" : $account_number,
                                'Account Name' => $account_name == "" ? "-" : $account_name,
                                'Bank Name' => $bank_name == "" ? "-" : $bank_name,
                                'Bank Code' => $bank_code == "" ? "-" : $bank_code,
                                'Account Address' => $account_address == "" ? "-" : $account_address,
                                'Customer Photo' => $customer_photo == "" ? "-" : $customer_photo,
                                'House Photo' => $house_photo == "" ? "-" : $house_photo,
                                'Harehouse Photo' => $warehouse_photo == "" ? "-" : $warehouse_photo,
                            );
    
                            $type_log = 0;
                            if($type == 'dipo'){
                                $type_log = 6;                        
                            }
                            else{
                                $type_log = 7;
                            }
            
                            $message = "Add " . lang($type) . " " . $name . " succesfully by User from Form Register Customer";
                            $this->activity_log->create(1, json_encode($data_notif), NULL, NULL, $message, 'C', $type_log);
                            $status = array('status' => 'success', 'message' => lang('message_save_success'));
                        } else {
                            $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                        }
                    }
                }
            }

            $data = $status;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    
    public function register_principal() {
        if ($this->input->is_ajax_request()) {
            $get_code = Code::where('code' , $this->input->post('code'))->where('type' , 'principal')->where('deleted', 0)->first();
            if (count($get_code) == 0) {
                $status = array('status' => 'error', 'message' => lang('code') . ' ' . lang('not_registered'));
            }
            else{
                $get_code = Code::where('code' , $this->input->post('code'))->where('type' , 'principal')->where('status', 1)->where('deleted', 0)->first();
                if (count($get_code) > 0) {
                    $status = array('status' => 'error', 'message' => lang('code') . ' ' . lang('already_used'));
                }
                else{
                    $get_partner = Principle::where('code' , $this->input->post('code'))->where('deleted', 0)->first();
                    if (count($get_partner) > 0) {
                        $status = array('status' => 'unique', 'message' => lang('already_exist'));
                    }
                    else{
                        $code = strtoupper($this->input->post('code'));
                        $name = ucwords($this->input->post('name'));
                        $phone_office = $this->input->post('phone_office');
                        $fax = $this->input->post('fax');
                        $email_office = $this->input->post('email_office');
                        $address = $this->input->post('address');
                        $postal_code = $this->input->post('postal_code');
                        $latitude = $this->input->post('latitude');
                        $longitude = $this->input->post('longitude');
                        $pic_operational = $this->input->post('pic_operational');
                        $pic = $this->input->post('pic');
                        $phone_personal = $this->input->post('phone_personal');
                        $pic_finance = $this->input->post('pic_finance');
                        $pic_finance_name = $this->input->post('pic_finance_name');
                        $pic_finance_phone = $this->input->post('pic_finance_phone');
                        $taxable = $this->input->post('taxable');
                        $npwp = $this->input->post('npwp');
                        $tax_name = $this->input->post('tax_name');
                        $tdp = $this->input->post('tdp');
                        $siup = $this->input->post('siup');
                        $sppkp = $this->input->post('sppkp');
                        $tax_company_name = $this->input->post('tax_company_name');
                        $tax_company_address = $this->input->post('tax_company_address');
                        $tax_payment_method = $this->input->post('tax_payment_method');
                        $top = $this->input->post('top');
                        $tax_credit_ceiling = $this->input->post('tax_credit_ceiling');
                        $account_number = $this->input->post('account_number');
                        $account_name = $this->input->post('account_name');
                        $bank_name = $this->input->post('bank_name');
                        $bank_code = $this->input->post('bank_code');
                        $account_address = $this->input->post('account_address');

                        $model = new Principle();
                        $model->code = $code;
                        $model->name = $name;
                        $model->phone_office = $phone_office;
                        $model->fax = $fax;
                        $model->email_office = $email_office;
                        $model->address = $address;
                        $model->postal_code = $postal_code;
                        $model->latitude = $latitude;
                        $model->longitude = $longitude;
                        $model->pic_operational = $pic_operational;
                        $model->pic = $pic;
                        $model->phone_personal = $phone_personal;
                        $model->pic_finance = $pic_finance;
                        $model->pic_finance_name = $pic_finance_name;
                        $model->pic_finance_phone = $pic_finance_phone;
                        $model->taxable = $taxable;
                        $model->npwp = $npwp;
                        $model->tax_name = $tax_name;
                        $model->tdp = $tdp;
                        $model->siup = $siup;
                        $model->sppkp = $sppkp;
                        $model->tax_company_name = $tax_company_name;
                        $model->tax_company_address = $tax_company_address;
                        $model->tax_payment_method = $tax_payment_method;
                        $model->top = $top;
                        $model->tax_credit_ceiling = $tax_credit_ceiling;
                        $model->account_number = $account_number;
                        $model->account_name = $account_name;
                        $model->bank_name = $bank_name;
                        $model->bank_code = $bank_code;
                        $model->account_address = $account_address;
                        
                        $model->user_created = 0;
                        $model->date_created = date('Y-m-d');
                        $model->time_created = date('H:i:s');
                        $save = $model->save();                
                        if ($save) {
                            $model_code = Code::where('code', $code)->where('type', 'principal')->first();
                            $model_code->status = 1;
                            $model_code->user_modified = 0;
                            $model_code->date_modified = date('Y-m-d');
                            $model_code->time_modified = date('H:i:s');
                            $model_code->save();

                            $data_notif = array(
                                'Code' => $code == "" ? "-" : $code,
                                'Name' => $name == "" ? "-" : $name,
                                'Phone' => $phone_office == "" ? "-" : $phone_office,
                                'Fax' => $fax == "" ? "-" : $fax,
                                'Email' => $email_office == "" ? "-" : $email_office,
                                'Address' => $address == "" ? "-" : $address,
                                'Postal Code' => $postal_code == "" ? "-" : $postal_code,
                                'Latitude' => $latitude == "" ? "-" : $latitude,
                                'Longitude' => $longitude == "" ? "-" : $longitude,
                                'PIC Operational' => $pic_operational == "" ? "-" : $pic_operational,
                                'PIC Name' => $pic == "" ? "-" : $pic,
                                'PIC Phone' => $phone_personal == "" ? "-" : $phone_personal,
                                'PIC Finance' => $pic_finance == "" ? "-" : $pic_finance,
                                'PIC Finance Name' => $pic_finance_name == "" ? "-" : $pic_finance_name,
                                'PIC Finance Phone' => $pic_finance_phone == "" ? "-" : $pic_finance_phone,
                                'Taxable' => $taxable == "0" ? lang('no') : lang('yes'),
                                'NPWP' => $npwp == "" ? "-" : $npwp,
                                'Tax Name' => $tax_name == "" ? "-" : $tax_name,
                                'TDP' => $tdp == "" ? "-" : $tdp,
                                'SIUP' => $siup == "" ? "-" : $siup,
                                'SPPKP' => $sppkp == "" ? "-" : $sppkp,
                                'Tax Company Name' => $tax_company_name == "" ? "-" : $tax_company_name,
                                'Tax Company Address' => $tax_company_address == "" ? "-" : $tax_company_address,
                                'Tax Payment Method' => $tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $tax_payment_method)),
                                'TOP' => $top == "" ? "-" : strtoupper($top),
                                'Tax Credit Ceiling' => $tax_credit_ceiling == "" ? "-" : $tax_credit_ceiling,
                                'Account Number' => $account_number == "" ? "-" : $account_number,
                                'Account Name' => $account_name == "" ? "-" : $account_name,
                                'Bank Name' => $bank_name == "" ? "-" : $bank_name,
                                'Bank Code' => $bank_code == "" ? "-" : $bank_code,
                                'Account Address' => $account_address == "" ? "-" : $account_address,
                            );
            
                            $message = "Add principal " . $name . " succesfully by User from Form Register Principal";
                            $this->activity_log->create(1, json_encode($data_notif), NULL, NULL, $message, 'C', 10);
                            $status = array('status' => 'success', 'message' => lang('message_save_success'));
                        } else {
                            $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                        }
                    }
                }
            }

            $data = $status;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    
    public function get_customer_by_role() {
        if ($this->input->is_ajax_request()) {
            $type = '';
            if($this->input->get('role') == '2'){
                $type = 'dipo';
            }
            else if($this->input->get('role') == '3'){
                $type = 'partner';                
            }
            $get_customer = Dipo::where('type' , $type)->where('deleted', 0)->orderBy('name', 'asc')->get();
            $html = '<option value="">' . lang('select_your_option') . '</option>';
            foreach($get_customer as $row){
                $html .= '<option value="' . $row->id . '">' . ucwords(strtolower($row->name)) . '</option>';
            }

            $status = array('status' => 'success', 'tag_html' => $html);
        }

        $data = $status;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */