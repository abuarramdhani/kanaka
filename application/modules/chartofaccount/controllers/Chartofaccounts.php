<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Chartofaccounts extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'chartofaccount');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'chartofaccount');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'chartofaccount');
        $this->load->blade('chartofaccount.views.chartofaccount.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            'm_chart_of_accounts.id as coa_id',
            'code',
            'd_k',
            'm_chart_of_accounts.description',
            'm_chart_of_accounts.date_created',
            'sum(t_jurnal.total) as total',
        );

        $header_columns = array(
            'code',
            'm_chart_of_accounts.description',
            'm_chart_of_accounts.date_created',
        );

        $from = "m_chart_of_accounts";
        $where = "m_chart_of_accounts.deleted = 0 AND t_jurnal.deleted = 0";
        $group_by = "t_jurnal.coa_id";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        $join[] = array('t_jurnal', 't_jurnal.coa_id = m_chart_of_accounts.id', 'inner');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "code LIKE '%" . $sSearch . "%' OR ";
            $where .= "description LIKE '%" . $sSearch . "%' OR ";
            $where .= "date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('coa_id');
        $this->datatables->config('database_columns', $database_columns);
        $this->datatables->config('from', $from);
        $this->datatables->config('join', $join);
        $this->datatables->config('where', $where);
        $this->datatables->config('group_by', $group_by);
        $this->datatables->config('order_by', $order_by);
        $selected_data = $this->datatables->get_select_data();
        $aa_data = $selected_data['aaData'];
        $new_aa_data = array();
        
        foreach ($aa_data as $row) {
            $row_value = array();

            $btn_action = '';
            if($this->user_profile->get_user_access('Updated', 'chartofaccount')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->coa_id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'chartofaccount')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->coa_id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->description;
            $row_value[] = $row->code;
            if($row->d_k == 'D'){
                $row_value[] = $row->total;
                $row_value[] = 0;
            }elseif($row->d_k == 'K'){
                $row_value[] = 0;
                $row_value[] = $row->total;
            }
            $row_value[] = $row->total;
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
            $id_chartofaccount = $this->input->post('id');
            $get_chartofaccount = Chartofaccount::where('code' , $this->input->post('code'))->where('deleted', 0)->first();
            if (empty($id_chartofaccount)) {
                if (!empty($get_chartofaccount->code)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $code = ucwords($this->input->post('code'));
                    $description = $this->input->post('description');
                    
                    $model = new Chartofaccount();
                    $model->code = $code;
                    $model->description = $description;
                    
                    $model->user_created = $user->id;
                    $model->date_created = date('Y-m-d');
                    $model->time_created = date('H:i:s');
                    $save = $model->save();
                    if ($save) {
                        $data_notif = array(
                            'Code' => $code,
                            'Description' => $description,
                        );
                        $message = "Add " . strtolower(lang('chartofaccount')) . " " . $code . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 16);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_chartofaccount)) {
                $model = Chartofaccount::find($id_chartofaccount);
                $code = ucwords($this->input->post('code'));
                $description = $this->input->post('description');

                $data_old = array(
                    'Code' => $model->code,
                    'Description' => $model->description,
                );

                $model->code = $code;
                $model->description = $description;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Code' => $code,
                        'Description' => $description,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('chartofaccount')) . " " .  $model->code . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 16);
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
            $model = array('status' => 'success', 'data' => Chartofaccount::find($id));
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
            $model = Chartofaccount::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Code' => $model->code,
                    'Description' => $model->description,
                );
                $message = "Delete " . strtolower(lang('chartofaccount')) . " " .  $model->code . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 16);
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
        $data['chartofaccounts'] = Chartofaccount::select('m_chart_of_accounts.id as coa_id', 'code', 'd_k', 'm_chart_of_accounts.description', 'm_chart_of_accounts.date_created', 'sum(t_jurnal.total) as total')
                                                ->join('t_jurnal', 't_jurnal.coa_id', '=', 'm_chart_of_accounts.id')
                                                ->where('m_chart_of_accounts.deleted', 0)
                                                ->where('t_jurnal.deleted', 0)
                                                ->groupBy('t_jurnal.coa_id')
                                                ->orderBy('id', 'DESC')->get();
        $html = $this->load->view('chartofaccount/chartofaccount/chartofaccount_pdf', $data, true);
        $this->pdf_generator->generate($html, 'chartofaccount pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=chartofaccount.xls");
        // $data['chartofaccounts'] = Chartofaccount::select('m_chart_of_accounts.*', 'd_k', 'SUM(t_jurnal.total) as total')
        //                                         ->join('t_jurnal', 't_jurnal.coa_id', '=', 'm_chart_of_accounts.id')
        //                                         ->where('m_chart_of_accounts.deleted', 0)
        //                                         ->where('t_jurnal.deleted', 0)
        //                                         ->groupBy('t_jurnal.coa_id')
        //                                         ->orderBy('m_chart_of_accounts.id', 'DESC')->get();

        $this->db->select('id, SUM(total) AS total', FALSE);
        $query = $this->db->get('t_jurnal');
        print_r($query);exit;
        $this->load->view('chartofaccount/chartofaccount/chartofaccount_pdf', $data);
    }

}
