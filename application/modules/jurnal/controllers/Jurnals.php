<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnals extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'jurnal')){
            redirect('dashboard', 'refresh');            
        }

    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'jurnal');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'jurnal');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'jurnal');
        
        $data['chartofaccounts'] = Chartofaccount::where('deleted', 0)->get();

        $this->load->blade('jurnal.views.jurnal.page', $data); 
    }

    public function fetch_data() {
        $user = $this->ion_auth->user()->row();

        $database_columns = array(
            'jurnal_date',
            'month',
            // 'reff',
            'm_chart_of_accounts.code as coa_code',
            'm_chart_of_accounts.description as coa_description',
            't_jurnal.description as jurnal_description',
            'd_k',
            // 'pic',
            'total',
            't_jurnal.date_created',
        );

        $header_columns = array(
            'jurnal_date',
            'month',
            // 'reff',
            'm_chart_of_accounts.code',
            't_jurnal.description',
            'd_k',
            // 'pic',
            'total',
            'total',
            't_jurnal.date_created',
        );

        $from = "t_jurnal";
        $where = "t_jurnal.deleted = 0 AND m_chart_of_accounts.deleted = 0";
        if($user->group_id != '1'){
            $where .= " AND t_jurnal.user_created = ". $user->id;
        }

        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');

        $join[] = array('m_chart_of_accounts', 't_jurnal.coa_id = m_chart_of_accounts.id', 'left');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }

            $where .= " AND (";
            $where .= "m_chart_of_accounts.code LIKE '%" . $sSearch . "%' OR ";
            $where .= "jurnal_date LIKE '%" . $sSearch . "%' OR ";
            $where .= "month LIKE '%" . $sSearch . "%' OR ";
            // $where .= "reff LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_jurnal.description LIKE '%" . $sSearch . "%' OR ";
            $where .= "d_k LIKE '%" . $sSearch . "%' OR ";
            // $where .= "pic LIKE '%" . $sSearch . "%' OR ";
            $where .= "total LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_jurnal.date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('t_jurnal.id');
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
            if($this->user_profile->get_user_access('Updated', 'jurnal')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'jurnal')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = date('d-m-Y',strtotime($row->jurnal_date));
            $row_value[] = $row->month;
            // $row_value[] = $row->reff;
            $row_value[] = $row->coa_code.' - '.$row->coa_description;
            $row_value[] = $row->jurnal_description;
            $row_value[] = lang($row->d_k);
            // $row_value[] = $row->pic;
            if($row->d_k == 'D'){
                $row_value[] = number_format($row->total, 0);
                $row_value[] = 0;
            }elseif($row->d_k == 'K'){
                $row_value[] = 0;
                $row_value[] = number_format($row->total, 0);
            }
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
            $id_jurnal = $this->input->post('id');
            if (empty($id_jurnal)) {
                $date = date_create($this->input->post('tanggal'));
                $jurnal_date = date_format($date,"Y-m-d");
                $month = $this->input->post('month');
                // $reff = $this->input->post('reff');
                $description = $this->input->post('keterangan');
                $d_k = $this->input->post('d_k');
                $coa_id = $this->input->post('coa_id');
                // $pic = $this->input->post('pic');
                $total = $this->input->post('total');
                
                $model = new Jurnal();
                $model->jurnal_date = $jurnal_date;
                $model->month = $month;
                // $model->reff = $reff;
                $model->description = $description;
                $model->d_k = $d_k;
                $model->coa_id = $coa_id;
                // $model->pic = $pic;
                $model->total = $total;
                
                $model->user_created = $user->id;
                $model->date_created = date('Y-m-d');
                $model->time_created = date('H:i:s');
                $save = $model->save();

                if ($save) {
                    $data_notif = array(
                        'Tanggal' => $jurnal_date,
                        'Bulan' => $month,
                        // 'Reff' => $reff,
                        'Keterangan' => $description,
                        'D/K' => $d_k,
                        'Chart Of Account' => Chartofaccount::find($coa_id)->code,
                        // 'PIC' => $pic,
                        'Total' => $total,
                    );
                    $message = "Add " . lang('jurnal') . " " . $jurnal_date . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 17);
                    $status = array('status' => 'success', 'message' => lang('message_save_success'));
                } else {
                    $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                }
            } elseif(!empty($id_jurnal)) {
                $model = Jurnal::find($id_jurnal);
                $date = date_create($this->input->post('tanggal'));
                $jurnal_date = date_format($date,"Y-m-d");
                $month = $this->input->post('month');
                // $reff = $this->input->post('reff');
                $description = $this->input->post('keterangan');
                $d_k = $this->input->post('d_k');
                $coa_id = $this->input->post('coa_id');
                // $pic = $this->input->post('pic');
                $total = $this->input->post('total');
            
                $data_old = array(
                    'Tanggal' => $model->jurnal_date,
                    'Bulan' => $model->month,
                    // 'Reff' => $model->reff,
                    'Keterangan' => $model->description,
                    'D/K' => $model->d_k,
                    'Chart Of Account' => Chartofaccount::find($model->coa_id)->code,
                    // 'PIC' => $model->pic,
                    'Total' => $model->total,
                );

                $model->jurnal_date = $jurnal_date;
                $model->month = $month;
                // $model->reff = $reff;
                $model->description = $description;
                $model->d_k = $d_k;
                $model->coa_id = $coa_id;
                // $model->pic = $pic;
                $model->total = $total;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Tanggal' => $jurnal_date,
                        'Bulan' => $month,
                        // 'Reff' => $reff,
                        'Keterangan' => $description,
                        'D/K' => $d_k,
                        'Chart Of Account' => Chartofaccount::find($coa_id)->code,
                        // 'PIC' => $pic,
                        'Total' => $total,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . lang('jurnal') . " " .  $model->jurnal_date . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 17);
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
            $model = array('status' => 'success', 'data' => Jurnal::find($id));
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
            $model = Jurnal::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Tanggal' => $model->jurnal_date,
                    'Bulan' => $model->month,
                    // 'Reff' => $model->reff,
                    'Keterangan' => $model->description,
                    'D/K' => $model->d_k,
                    'Chart Of Account' => Chartofaccount::find($model->coa_id)->code,
                    // 'PIC' => $model->pic,
                    'Total' => $model->total,
                );
                $message = "Delete " . lang('jurnal') . " " .  $model->name . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 17);
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
        $user = $this->ion_auth->user()->row();
        if($user->group_id != '1'){
            $data['jurnals'] = Jurnal::select('t_jurnal.*', 'm_chart_of_accounts.description as coa_description', 'm_chart_of_accounts.code as coa_code', 'm_chart_of_accounts.description as coa_name')->join('m_chart_of_accounts', 'm_chart_of_accounts.id', '=', 't_jurnal.coa_id')->where('t_jurnal.deleted', 0)->where('t_jurnal.user_created', $user->id)->orderBy('t_jurnal.id', 'DESC')->get();
        }
        else{
            $data['jurnals'] = Jurnal::select('t_jurnal.*', 'm_chart_of_accounts.description as coa_description', 'm_chart_of_accounts.code as coa_code', 'm_chart_of_accounts.description as coa_name')->join('m_chart_of_accounts', 'm_chart_of_accounts.id', '=', 't_jurnal.coa_id')->where('t_jurnal.deleted', 0)->orderBy('t_jurnal.id', 'DESC')->get();            
        }

        $html = $this->load->view('jurnal/jurnal/jurnal_pdf', $data, true);
        $this->pdf_generator->generate($html, 'jurnal pdf', $orientation='Landscape');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=jurnal.xls");

        $user = $this->ion_auth->user()->row();
        if($user->group_id != '1'){
            $data['jurnals'] = Jurnal::select('t_jurnal.*', 'm_chart_of_accounts.description as coa_description', 'm_chart_of_accounts.code as coa_code', 'm_chart_of_accounts.description as coa_name')->join('m_chart_of_accounts', 'm_chart_of_accounts.id', '=', 't_jurnal.coa_id')->where('t_jurnal.deleted', 0)->where('t_jurnal.user_created', $user->id)->orderBy('t_jurnal.id', 'DESC')->get();
        }
        else{
            $data['jurnals'] = Jurnal::select('t_jurnal.*', 'm_chart_of_accounts.description as coa_description', 'm_chart_of_accounts.code as coa_code', 'm_chart_of_accounts.description as coa_name')->join('m_chart_of_accounts', 'm_chart_of_accounts.id', '=', 't_jurnal.coa_id')->where('t_jurnal.deleted', 0)->orderBy('t_jurnal.id', 'DESC')->get();            
        }

        $this->load->view('jurnal/jurnal/jurnal_pdf', $data);
    }

}
