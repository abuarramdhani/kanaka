<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Principles extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'vendor');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'vendor');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'vendor');

        $this->load->blade('principle.views.principle.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            'id',
            'code',
            'name',
            'address',
            'product',
            'brand',
            'top',
            'pic',
            'phone_office',
            'phone_personal',
            'fax',
            'email_office',
            'email_personal',
            'web',
            'date_created'
        );

        $header_columns = array(
            'code',
            'name',
            'address',
            'product',
            'brand',
            'top',
            'pic',
            'phone_office',
            'phone_personal',
            'fax',
            'email_office',
            'email_personal',
            'web',
            'date_created'
        );

        $from = "m_principle";
        $where = "deleted = 0";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "code LIKE '%" . $sSearch . "%' OR ";
            $where .= "name LIKE '%" . $sSearch . "%' OR ";
            $where .= "address LIKE '%" . $sSearch . "%' OR ";
            $where .= "product LIKE '%" . $sSearch . "%' OR ";
            $where .= "brand LIKE '%" . $sSearch . "%' OR ";
            $where .= "top LIKE '%" . $sSearch . "%' OR ";
            $where .= "pic LIKE '%" . $sSearch . "%' OR ";
            $where .= "phone_office LIKE '%" . $sSearch . "%' OR ";
            $where .= "phone_personal LIKE '%" . $sSearch . "%' OR ";
            $where .= "fax LIKE '%" . $sSearch . "%' OR ";
            $where .= "email_office LIKE '%" . $sSearch . "%' OR ";
            $where .= "email_personal LIKE '%" . $sSearch . "%' OR ";
            $where .= "web LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_principle.date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('m_principle.id');
        $this->datatables->config('database_columns', $database_columns);
        $this->datatables->config('from', $from);
        $this->datatables->config('where', $where);
        $this->datatables->config('order_by', $order_by);
        $selected_data = $this->datatables->get_select_data();
        $aa_data = $selected_data['aaData'];
        $new_aa_data = array();
        
        foreach ($aa_data as $row) {
            $row_value = array();

            $btn_action = '';
            if($this->user_profile->get_user_access('Updated', 'vendor')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'vendor')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->code;
            $row_value[] = $row->name;
            $row_value[] = $row->address;
            $row_value[] = $row->product;
            $row_value[] = $row->brand;
            $row_value[] = $row->top;
            $row_value[] = $row->pic;
            $row_value[] = $row->phone_office;
            $row_value[] = $row->phone_personal;
            $row_value[] = $row->fax;
            $row_value[] = $row->email_office;
            $row_value[] = $row->email_personal;
            $row_value[] = $row->web;
            $row_value[] = date('d-m-Y',strtotime($row->date_created));
            $row_value[] = $btn_action;
            
            $new_aa_data[] = $row_value;
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }

    public function save() {
        if ($this->input->is_ajax_request()) {
            $user = $this->ion_auth->user()->row();
            $id_principle = $this->input->post('id');
            $get_principle = Principle::where('name' , $this->input->post('name'))->where('deleted', 0)->first();
            if (empty($id_principle)) {
                if (!empty($get_principle->name)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $code = strtoupper($this->input->post('code'));
                    $name = ucwords($this->input->post('name'));
                    $address = $this->input->post('address');
                    $product = $this->input->post('product');
                    $brand = $this->input->post('brand');
                    $top = $this->input->post('top');
                    $pic = $this->input->post('pic');
                    $phone_office = $this->input->post('phone_office');
                    $phone_personal = $this->input->post('phone_personal');
                    $fax = $this->input->post('fax');
                    $email_office = $this->input->post('email_office');
                    $email_personal = $this->input->post('email_personal');
                    $web = $this->input->post('web');
                    
                    $model = new principle();
                    $model->code = $code;
                    $model->name = $name;
                    $model->address = $address;
                    $model->product = $product;
                    $model->brand = $brand;
                    $model->top = $top;
                    $model->pic = $pic;
                    $model->phone_office = $phone_office;
                    $model->phone_personal = $phone_personal;
                    $model->fax = $fax;
                    $model->email_office = $email_office;
                    $model->email_personal = $email_personal;
                    $model->web = $web;
                    
                    $model->user_created = $user->id;
                    $model->date_created = date('Y-m-d');
                    $model->time_created = date('H:i:s');
                    $save = $model->save();
                    if ($save) {
                        $data_notif = array(
                            'Code' => $code,
                            'Name' => $name,
                            'Address' => $address,
                            'Product' => $product,
                            'Brand' => $brand,
                            'TOP' => $top,
                            'PIC' => $pic,
                            'Phone Office' => $phone_office,
                            'Phone Personal' => $phone_personal,
                            'Fax' => $fax,
                            'Email Office' => $email_office,
                            'Email Persoal' => $email_personal,
                            'Web' => $web,
                        );
                        $message = "Add " . lang('principle') . " " . $name . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 10);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_principle)) {
                $model = Principle::find($id_principle);
                $code = strtoupper($this->input->post('code'));
                $name = ucwords($this->input->post('name'));
                $address = $this->input->post('address');
                $product = $this->input->post('product');
                $brand = $this->input->post('brand');
                $top = $this->input->post('top');
                $pic = $this->input->post('pic');
                $phone_office = $this->input->post('phone_office');
                $phone_personal = $this->input->post('phone_personal');
                $fax = $this->input->post('fax');
                $email_office = $this->input->post('email_office');
                $email_personal = $this->input->post('email_personal');
                $web = $this->input->post('web');
            
                $data_old = array(
                    'Code' => $code,
                    'Name' => $name,
                    'Address' => $address,
                    'Product' => $product,
                    'Brand' => $brand,
                    'TOP' => $top,
                    'PIC' => $pic,
                    'Phone Office' => $phone_office,
                    'Phone Personal' => $phone_personal,
                    'Fax' => $fax,
                    'Email Office' => $email_office,
                    'Email Persoal' => $email_personal,
                    'Web' => $web,
                );

                $model->code = $code;
                $model->name = $name;
                $model->address = $address;
                $model->product = $product;
                $model->brand = $brand;
                $model->top = $top;
                $model->pic = $pic;
                $model->phone_office = $phone_office;
                $model->phone_personal = $phone_personal;
                $model->fax = $fax;
                $model->email_office = $email_office;
                $model->email_personal = $email_personal;
                $model->web = $web;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Code' => $code,
                        'Name' => $name,
                        'Address' => $address,
                        'Product' => $product,
                        'Brand' => $brand,
                        'TOP' => $top,
                        'PIC' => $pic,
                        'Phone Office' => $phone_office,
                        'Phone Personal' => $phone_personal,
                        'Fax' => $fax,
                        'Email Office' => $email_office,
                        'Email Persoal' => $email_personal,
                        'Web' => $web,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . lang('principle') . " " .  $model->name . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 10);
                    $status = array('status' => 'success', 'message' => lang('message_save_success'));
                } else {
                    $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                }
            } else {
                $status = array('status' => 'error', 'message' => lang('message_save_failed'));
            }
            $data = $status;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    
    public function view() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $model = array('status' => 'success', 'data' => Principle::find($id));
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
            $model = Principle::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Code' => $code,
                    'Name' => $name,
                    'Address' => $address,
                    'Product' => $product,
                    'Brand' => $brand,
                    'TOP' => $top,
                    'PIC' => $pic,
                    'Phone Office' => $phone_office,
                    'Phone Personal' => $phone_personal,
                    'Fax' => $fax,
                    'Email Office' => $email_office,
                    'Email Persoal' => $email_personal,
                    'Web' => $web,
                );
                $message = "Delete " . lang('principle') . " " .  $model->name . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 10);
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

    function pdf(){
        $data['principles'] = Principle::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $html = $this->load->view('principle/principle/principle_pdf', $data, true);
        $this->pdf_generator->generate($html, 'principle pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=principle.xls");
        $data['principles'] = Principle::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $this->load->view('principle/principle/principle_pdf', $data);
    }

}
