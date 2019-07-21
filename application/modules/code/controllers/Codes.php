<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Codes extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        
        if(!$this->user_profile->get_user_access('Availabled', 'code')){
            redirect('dashboard', 'refresh');            
        }

    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'code');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'code');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'code');
        $this->load->blade('code.views.code.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            'id',
            'code',
            'username',
            'type',
            'status',
            'date_created',
        );

        $header_columns = array(
            'code',
            'username',
            'type',
            'status',
            'date_created',
        );

        $from = "m_code";
        $where = "deleted = 0";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "code LIKE '%" . $sSearch . "%' OR ";
            $where .= "username LIKE '%" . $sSearch . "%' OR ";
            $where .= "type LIKE '%" . $sSearch . "%' OR ";
            $where .= "status LIKE '%" . $sSearch . "%' OR ";
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
            if($this->user_profile->get_user_access('Updated', 'code')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'code')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->code;
            $row_value[] = $row->username;
            $row_value[] = ucwords($row->type);
            $row_value[] = $row->status == 0 ? lang('available') : lang('not_available');
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
            $id_code = $this->input->post('id');
            $get_code = Code::where('code' , $this->input->post('code'))->where('deleted', 0)->first();
            if (empty($id_code)) {
                if (!empty($get_code->name)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $code = $this->input->post('code');
                    $username = $this->input->post('username');
                    $type = $this->input->post('type');
                    $status = $this->input->post('status');
                    
                    $model = new Code();
                    $model->code = $code;
                    $model->username = $username;
                    $model->type = $type;
                    $model->status = $status;
                    
                    $model->user_created = $user->id;
                    $model->date_created = date('Y-m-d');
                    $model->time_created = date('H:i:s');
                    $save = $model->save();
                    if ($save) {
                        $data_notif = array(
                            'Code' => $code,
                            'Username' => $username,
                            'Type' => ucwords($type),
                            'Status' => $status == 0 ? lang('available') : lang('not_available'),
                        );
                        $message = "Add " . strtolower(lang('code')) . " " . $code . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 19);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_code)) {
                $model = Code::find($id_code);
                $code = $this->input->post('code');
                $username = $this->input->post('username');
                $type = $this->input->post('type');
                $status = $this->input->post('status');

                $data_old = array(
                    'Code' => $model->code,
                    'Username' => $model->username,
                    'Type' => ucwords($model->type),
                    'Status' => $model->status == 0 ? lang('available') : lang('not_available'),
                );

                $model->code = $code;
                $model->username = $username;
                $model->type = $type;
                $model->status = $status;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Code' => $code,
                        'Username' => $username,
                        'Type' => ucwords($type),
                        'Status' => $status == 0 ? lang('available') : lang('not_available'),
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('code')) . " " .  $model->code . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 19);
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
            $model = array('status' => 'success', 'data' => Code::find($id));
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
            $model = Code::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Code' => $model->code,
                    'Username' => $model->username,
                    'Type' => ucwords($model->type),
                    'Status' => $model->status == 0 ? lang('available') : lang('not_available'),
                );
                $message = "Delete " . strtolower(lang('code')) . " " .  $model->code . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 19);
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
        $data['codes'] = Code::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $html = $this->load->view('code/code/code_pdf', $data, true);
        $this->pdf_generator->generate($html, 'code pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=code.xls");
        $data['codes'] = Code::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $this->load->view('code/code/code_pdf', $data);
    }

}
