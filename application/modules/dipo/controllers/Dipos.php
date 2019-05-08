<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dipos extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'dipo');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'dipo');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'dipo');
        $this->load->blade('dipo.views.dipo.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            'id',
            'name',
            'address',
            'phone',
            'email',
            'city',
            'subdistrict',
            'latitude',
            'longitude',
            'date_created',
        );

        $header_columns = array(
            'name',
            'address',
            'phone',
            'email',
            'city',
            'subdistrict',
            'date_created',
        );

        $from = "m_dipo";
        $where = "deleted = 0";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "name LIKE '%" . $sSearch . "%' OR ";
            $where .= "address LIKE '%" . $sSearch . "%' OR ";
            $where .= "phone LIKE '%" . $sSearch . "%' OR ";
            $where .= "email LIKE '%" . $sSearch . "%' OR ";
            $where .= "city LIKE '%" . $sSearch . "%' OR ";
            $where .= "subdistrict LIKE '%" . $sSearch . "%' OR ";
            $where .= "date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('id');
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
            if($this->user_profile->get_user_access('Updated', 'dipo')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'dipo')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->name;
            $row_value[] = $row->address;
            $row_value[] = $row->phone;
            $row_value[] = $row->email;
            $row_value[] = $row->city;
            $row_value[] = $row->subdistrict;
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
            $id_dipo = $this->input->post('id');
            $get_dipo = Dipo::where('name' , $this->input->post('name'))->where('deleted', 0)->first();
            if (empty($id_dipo)) {
                if (!empty($get_dipo->name)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $name = ucwords($this->input->post('name'));
                    $address = $this->input->post('address');
                    $phone = $this->input->post('phone');
                    $email = $this->input->post('email');
                    $city = $this->input->post('city');
                    $subdistrict = $this->input->post('subdistrict');
                    $latitude = $this->input->post('latitude');
                    $longitude = $this->input->post('longitude');
                    
                    $model = new Dipo();
                    $model->name = $name;
                    $model->address = $address;
                    $model->phone = $phone;
                    $model->email = $email;
                    $model->city = $city;
                    $model->subdistrict = $subdistrict;
                    $model->latitude = $latitude;
                    $model->longitude = $longitude;
                    
                    $model->user_created = $user->id;
                    $model->date_created = date('Y-m-d');
                    $model->time_created = date('H:i:s');
                    $save = $model->save();
                    if ($save) {
                        $data_notif = array(
                            'Name' => $name,
                            'Address' => $address,
                            'Phone' => $phone,
                            'Email' => $email,
                            'City' => $city,
                            'Subdistrict' => $subdistrict,
                            'Latitude' => $latitude,
                            'Longitude' => $longitude,
                        );
                        $message = "Add " . strtolower(lang('dipo')) . " " . $name . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 6);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_dipo)) {
                $model = Dipo::find($id_dipo);
                $name = ucwords($this->input->post('name'));
                $address = $this->input->post('address');
                $phone = $this->input->post('phone');
                $email = $this->input->post('email');
                $city = $this->input->post('city');
                $subdistrict = $this->input->post('subdistrict');
                $latitude = $this->input->post('latitude');
                $longitude = $this->input->post('longitude');
            
                $data_old = array(
                    'Name' => $model->name,
                    'Address' => $model->address,
                    'Phone' => $model->phone,
                    'Email' => $model->email,
                    'City' => $model->city,
                    'Subdistrict' => $model->subdistrict,
                    'Latitude' => $model->latitude,
                    'Longitude' => $model->longitude,
                );

                $model->name = $name;
                $model->address = $address;
                $model->phone = $phone;
                $model->email = $email;
                $model->city = $city;
                $model->subdistrict = $subdistrict;
                $model->latitude = $latitude;
                $model->longitude = $longitude;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Name' => $name,
                        'Address' => $address,
                        'Phone' => $phone,
                        'Email' => $email,
                        'City' => $city,
                        'Subdistrict' => $subdistrict,
                        'Latitude' => $latitude,
                        'Longitude' => $longitude,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('dipo')) . " " .  $model->name . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 6);
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
            $model = array('status' => 'success', 'data' => Dipo::find($id));
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
            $model = Dipo::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Name' => $model->name,
                    'Address' => $model->address,
                    'Phone' => $model->phone,
                    'Email' => $model->email,
                    'City' => $model->city,
                    'Subdistrict' => $model->subdistrict,
                    'Latitude' => $model->latitude,
                    'Longitude' => $model->longitude,
                );
                $message = "Delete " . strtolower(lang('dipo')) . " " .  $model->name . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 6);
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
        $data['dipos'] = Dipo::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $html = $this->load->view('dipo/dipo/dipo_pdf', $data, true);
        $this->pdf_generator->generate($html, 'dipo pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=dipo.xls");
        $data['dipos'] = Dipo::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $this->load->view('dipo/dipo/dipo_pdf', $data);
    }

}
