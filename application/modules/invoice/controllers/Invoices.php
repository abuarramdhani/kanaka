<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'invoice')){
            redirect('dashboard', 'refresh');            
        }
        
        $this->load->model('invoice');
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'invoice');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'invoice');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'invoice');
        $data['dipos'] = Dipo::where('deleted', '0')->get();

        $this->load->blade('invoice.views.invoice.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            't_invoice.id',
            't_invoice.invoice_no',
            't_sj.sj_no',
            't_sp.sp_no',
            't_sp.sp_date',
            'm_dipo_partner.name as dipo_name',
            'm_dipo_partner.address as dipo_address',
            'm_dipo_partner.top as top',
            'm_dipo_partner.pic as dipo_pic',
            't_invoice.due_date',
            't_invoice.date_created',
        );

        $header_columns = array(
            't_invoice.invoice_no',
            't_sj.sj_no',
            't_sp.sp_no',
            'm_dipo_partner.name',
            'm_dipo_partner.address',
            'm_dipo_partner.top',
            'm_dipo_partner.pic',
            't_sp.sp_date',
            't_sp.sp_date',
            't_invoice.due_date',
            't_invoice.date_created',
        );

        $from = "t_invoice";
        $where = "t_invoice.deleted = 0";
        
        $user = $this->ion_auth->user()->row();
        if($user->group_id == '2'){
            $where .= " AND (t_invoice.user_created = ". $user->id . " OR tbl_dipo.dipo_id = ". $user->dipo_partner_id .")";
        }
        else if($user->group_id == '3'){
            $where .= " AND t_invoice.user_created = ". $user->id;
        }

        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        $join[] = array('t_sj', 't_sj.id = t_invoice.sj_id', 'inner');
        $join[] = array('t_sp', 't_sp.id = t_sj.sp_id', 'inner');
        $join[] = array('m_dipo_partner', 'm_dipo_partner.id = t_sp.dipo_partner_id', 'inner');
        $join[] = array('users', 't_invoice.user_created = users.id', 'left');
        if($user->group_id == '2'){
            $join[] = array('m_dipo_partner as tbl_dipo', 'users.dipo_partner_id = tbl_dipo.id', 'left');
        }

        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "t_invoice.invoice_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sj.sj_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sp.sp_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_dipo_partner.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_dipo_partner.address LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_dipo_partner.top LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_dipo_partner.pic LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sp.sp_date LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sp.sp_date LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_invoice.due_date LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_invoice.date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('t_invoice.id');
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
            $btn_action .= '<a href="javascript:void()" onclick="viewDetail(\'' . uri_encrypt($row->id) . '\')" class="btn btn-primary btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('view') . '"><i class="fa fa-eye"></i> </a>';
            if($this->user_profile->get_user_access('Updated', 'invoice')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'invoice')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }
        
            $row_value[] = $row->invoice_no;
            $row_value[] = $row->sj_no;
            $row_value[] = $row->sp_no;
            $row_value[] = $row->dipo_name;
            $row_value[] = $row->dipo_address;
            $row_value[] = $row->dipo_pic;
            $row_value[] = $row->top;
            $row_value[] = date('d-m-Y',strtotime($row->sp_date));
            $row_value[] = date('d-m-Y',strtotime($row->sp_date));
            $row_value[] = date('d-m-Y',strtotime($row->due_date));
            $row_value[] = date('d-m-Y',strtotime($row->date_created));
            $row_value[] = $btn_action;
            
            $new_aa_data[] = $row_value;
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }

    public function fetch_data_invoice() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($_GET['id']);
            $database_columns = array(
                't_sp_detail.id',
                'product_code',
                'm_product.name as product_name',
                'order_amount_in_ctn',
                'order_price_dipo_before_tax',
                'order_price_dipo_after_tax',
                'order_amount_dipo_after_tax',
            );
    
            $header_columns = array(
                'id',
                'product_code',
                'product_name',
                'order_amount_in_ctn',
                'order_price_dipo_before_tax',
                'order_price_dipo_after_tax',
                'order_amount_dipo_after_tax',
            );
    
            $from = "t_sp_detail";
            $where = "t_sp_detail.deleted = 0 AND sp_id =".Suratjalan::find(Invoice::find($id)->sj_id)->sp_id;
            $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
            $join[] = array('t_sp', 't_sp.id = t_sp_detail.sp_id', 'inner');
            $join[] = array('m_product', 'm_product.id = t_sp_detail.product_id', 'inner');
    
            $this->datatables->set_index('t_sp_detail.id');
            $this->datatables->config('database_columns', $database_columns);
            $this->datatables->config('from', $from);
            $this->datatables->config('join', $join);
            $this->datatables->config('where', $where);
            $this->datatables->config('order_by', $order_by);
            $selected_data = $this->datatables->get_select_data();
            $aa_data = $selected_data['aaData'];
            $new_aa_data = array();
            $no = 1;
            
            foreach ($aa_data as $row) {
                $row_value = array();
                
                $row_value[] = $no++;    
                $row_value[] = $row->product_code;
                $row_value[] = $row->product_name;
                $row_value[] = $row->order_amount_in_ctn;
                $row_value[] = $row->order_price_dipo_before_tax;
                $row_value[] = $row->order_price_dipo_after_tax;
                $row_value[] = $row->order_amount_dipo_after_tax;
                
                $new_aa_data[] = $row_value;
            }
            
            $selected_data['aaData'] = $new_aa_data;
            $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
    }

    public function save() {
        if ($this->input->is_ajax_request()) {
            $user = $this->ion_auth->user()->row();
            $id_invoice = $this->input->post('invoice_id');

            $get_invoice = Invoice::where('invoice_no' , $this->input->post('invoice_no'))->where('deleted', 0)->first();
            if (empty($id_invoice)) {
                if (!empty($get_invoice->invoice_no)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $dipo_partner_id = $this->input->post('dipo_partner_id');
                    $invoice_no = $this->input->post('invoice_no');
                    $sj_id = $this->input->post('sj_id');
                    $due_date = date('Y-m-d', strtotime(str_replace('/','-',$this->input->post('due_date'))));
                    $note = $this->input->post('note');
                    $total_order_amount_in_ctn = $this->input->post('total_order_amount_in_ctn');
                    $total_order_price_before_tax = $this->input->post('total_order_price_before_tax');
                    $total_order_price_after_tax = $this->input->post('total_order_price_after_tax');
                    $total_order_amount_after_tax = $this->input->post('total_order_amount_after_tax');
                    
                    $sj_data = array(
                        'invoice_no'    => $invoice_no,
                        'sj_id'         => $sj_id,
                        'due_date'      => $due_date,
                        'note'          => $note,
                        'total_order_amount_in_ctn'     => $total_order_amount_in_ctn,
                        'total_order_price_before_tax'  => $total_order_price_before_tax,
                        'total_order_price_after_tax'   => $total_order_price_after_tax,
                        'total_order_amount_after_tax'  => $total_order_amount_after_tax,
                        'user_created'  => $user->id,
                        'date_created'  => date('Y-m-d'),
                        'time_created'  => date('H:i:s')
                    );

                    $save   = $this->db->insert('t_invoice', $sj_data);

                    if(!empty($this->input->post('sp_detail_id'))){
                        $sp_detail_data = count($this->input->post('sp_detail_id'));
                        for($i = 0; $i < $sp_detail_data; $i++){ 
                            $dataDetail = array(
                                'order_price_dipo_before_tax'   => $this->input->post('order_price_before_tax')[$i],
                                'order_price_dipo_after_tax'    => $this->input->post('order_price_after_tax')[$i],
                                'order_amount_dipo_after_tax'   => $this->input->post('order_amount_after_tax')[$i],
                                'user_modified' => $user->id,
                                'date_modified' => date('Y-m-d'),
                                'time_modified' => date('H:i:s')
                            );
                            $this->db->where('id', $this->input->post('sp_detail_id')[$i]);
                            $saveDetail = $this->db->update('t_sp_detail', $dataDetail);
                        }
                    }

                    if ($save) {
                        $data_notif = array(
                            'Invoice No'    => $invoice_no,
                            'SJ No'         => Suratjalan::find($sj_id)->sj_no,
                            'SP No'         => Suratpesanan::find(Suratjalan::find($sj_id)->sp_id)->sp_no,
                            'Account'       => Dipo::find($dipo_partner_id)->name,
                            'Due Date'      => date('d-m-Y', strtotime($due_date)),
                            'Note'          => $note == '' ? '-' : $note,
                        );
                        $message = "Add " . strtolower(lang('invoice')) . " " . $invoice_no . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 15);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_invoice)) {
                $model = Invoice::find($id_invoice);
                $dipo_partner_id = $this->input->post('dipo_partner_id');
                $invoice_no = $this->input->post('invoice_no');
                $sj_id = $this->input->post('sj_id');
                $due_date = date('Y-m-d', strtotime(str_replace('/','-',$this->input->post('due_date'))));
                $note = $this->input->post('note');
                $total_order_amount_in_ctn = $this->input->post('total_order_amount_in_ctn');
                $total_order_price_before_tax = $this->input->post('total_order_price_before_tax');
                $total_order_price_after_tax = $this->input->post('total_order_price_after_tax');
                $total_order_amount_after_tax = $this->input->post('total_order_amount_after_tax');
            
                $data_old = array(
                    'Invoice No'    => $model->invoice_no,
                    'SJ No'         => Suratjalan::find($model->sj_id)->sj_no,
                    'SP No'         => Suratpesanan::find(Suratjalan::find($model->sj_id)->sp_id)->sp_no,
                    'Account'       => Dipo::find(Suratpesanan::find(Suratjalan::find($model->sj_id)->sp_id)->dipo_partner_id)->name,
                    'Due Date'      => date('d-m-Y', strtotime($model->due_date)),
                    'Note'          => $model->note == '' ? '-' : $model->note,
                );

                $dataDetail_old = array(
                    'order_price_dipo_before_tax'   => 0,
                    'order_price_dipo_after_tax'    => 0,
                    'order_amount_dipo_after_tax'   => 0,
                    'user_modified'                 => $user->id,
                    'date_modified'                 => date('Y-m-d'),
                    'time_modified'                 => date('H:i:s')
                );
                $this->db->where('sp_id', Suratjalan::find($model->sj_id)->sp_id);
                $this->db->update('t_sp_detail', $dataDetail_old);

                $model->invoice_no  = $invoice_no;
                $model->sj_id       = $sj_id;
                $model->due_date    = $due_date;
                $model->note        = $note;
                $model->total_order_amount_in_ctn   = $total_order_amount_in_ctn;
                $model->total_order_price_before_tax   = $total_order_price_before_tax;
                $model->total_order_price_after_tax   = $total_order_price_after_tax;
                $model->total_order_amount_after_tax   = $total_order_amount_after_tax;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();

                if(!empty($this->input->post('sp_detail_id'))){
                    $sp_detail_data = count($this->input->post('sp_detail_id'));
                    for($i = 0; $i < $sp_detail_data; $i++){ 
                        $dataDetail = array(
                            'order_price_dipo_before_tax'   => $this->input->post('order_price_before_tax')[$i],
                            'order_price_dipo_after_tax'    => $this->input->post('order_price_after_tax')[$i],
                            'order_amount_dipo_after_tax'   => $this->input->post('order_amount_after_tax')[$i],
                            'user_modified' => $user->id,
                            'date_modified' => date('Y-m-d'),
                            'time_modified' => date('H:i:s')
                        );
                        $this->db->where('id', $this->input->post('sp_detail_id')[$i]);
                        $saveDetail = $this->db->update('t_sp_detail', $dataDetail);
                    }
                }

                if ($update) {
                    $data_new = array(
                        'Invoice No'    => $invoice_no,
                        'SJ No'         => Suratjalan::find($sj_id)->sj_no,
                        'SP No'         => Suratpesanan::find(Suratjalan::find($sj_id)->sp_id)->sp_no,
                        'Account'       => Dipo::find($dipo_partner_id)->name,
                        'Due Date'      => date('d-m-Y', strtotime($due_date)),
                        'Note'          => $note == '' ? '-' : $note,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('invoice')) . " " .  $model->invoice_no . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 15);
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
            $sj_data = Invoice::select('t_invoice.*', 't_sj.sj_no', 't_sp.sp_no', 't_sp.sp_date', 'm_dipo_partner.id as dipo_id', 'm_dipo_partner.code as dipo_code', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.phone as dipo_phone', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.pic as dipo_pic', 'm_dipo_partner.top as dipo_top')
                                        ->join('t_sj', 't_sj.id', '=', 't_invoice.sj_id')
                                        ->join('t_sp', 't_sp.id', '=', 't_sj.sp_id')
                                        ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                        ->where('t_invoice.id', $id)
                                        ->where('t_invoice.deleted', 0)->get();

            $model = array('status' => 'success', 'data' => $sj_data);
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function viewdetailsj() {
        if ($this->input->is_ajax_request()) {
            $id = (int) $this->input->get('id');
            $dataDetail = Spdetail::select('t_sp.*', 't_sp_detail.*', 't_sp_detail.id as spdetail_id', 'm_product.*', 't_sp_detail.order_price_dipo_after_tax as price_after_tax')
                                    ->join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('t_sj', 't_sj.sp_id', '=', 't_sp.id')
                                    ->join('m_product', 'm_product.id', '=', 't_sp_detail.product_id')
                                    ->join('t_pricelist', 't_pricelist.id', '=', 't_sp_detail.pricelist_id')
                                    ->where('t_sj.id', $id)
                                    ->where('t_sp_detail.deleted', 0)
                                    ->where('t_sp.deleted', 0)
                                    ->where('t_pricelist.deleted', 0)
                                    ->where('m_product.deleted', 0)->get();
            $model = array('status' => 'success', 'dataDetail' => $dataDetail);
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getDipo() {
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Dipo::find($id));
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getsjbydipo() {
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Suratjalan::select('t_sj.*')->join('t_sp', 't_sp.id', '=', 't_sj.sp_id')->where('t_sp.dipo_partner_id', $id)->where('t_sj.deleted', 0)->where('t_sp.deleted', 0)->get());
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getsjbyid() {
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Suratjalan::select('t_sp.*')->join('t_sp', 't_sp.id', '=', 't_sj.sp_id')->where('t_sj.id', $id)->where('t_sj.deleted', 0)->where('t_sp.deleted', 0)->first());
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
            $model = Invoice::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $modelDetail = Spdetail::where('sp_id', $id)->get();
                if (!empty($modelDetail)) {
                    $dataDetail = array( 
                        'order_price_dipo_before_tax'   => 0,
                        'order_price_dipo_after_tax'    => 0,
                        'order_amount_dipo_after_tax'   => 0,
                        'user_modified'                 => $user->id,
                        'date_modified'                 => date('Y-m-d'),
                        'time_modified'                 => date('H:i:s')
                    );
                    $this->db->where('sp_id', Suratjalan::find($model->sj_id)->sp_id);
                    $this->db->update('t_sp_detail', $dataDetail);
                }

                $data_notif = array(
                    'Invoice No'    => $model->invoice_no,
                    'SJ No'         => Suratjalan::find($model->sj_id)->sj_no,
                    'SP No'         => Suratpesanan::find(Suratjalan::find($model->sj_id)->sp_id)->sp_no,
                    'Account'       => Dipo::find(Suratpesanan::find(Suratjalan::find($model->sj_id)->sp_id)->dipo_partner_id)->name,
                    'Due Date'      => date('d-m-Y', strtotime($model->due_date)),
                    'Note'          => $model->note == '' ? '-' : $model->note,
                );
                $message = "Delete " . strtolower(lang('invoice')) . " " .  $model->invoice_no . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 15);
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
        $id = (int) $this->input->get('id');
        $data['row'] = Invoice::select('t_invoice.*', 't_sj.sp_id', 't_sj.sj_no', 't_sp.sp_no', 't_sp.sp_date', 'm_dipo_partner.id as dipo_id', 'm_dipo_partner.code as dipo_code', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.phone as dipo_phone', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.pic as dipo_pic', 'm_dipo_partner.top as dipo_top')
                                    ->join('t_sj', 't_sj.id', '=', 't_invoice.sj_id')
                                    ->join('t_sp', 't_sp.id', '=', 't_sj.sp_id')
                                    ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                    ->where('t_invoice.id', $id)
                                    ->where('t_invoice.deleted', 0)->first();
        
        $data['datadetails'] = Spdetail::select('t_sp.*', 'm_product.*', 'm_product.name as product_name', 't_sp_detail.*')
                                    ->join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('m_product', 'm_product.id', '=', 't_sp_detail.product_id')
                                    ->where('sp_id', $data['row']->sp_id)
                                    ->where('t_sp_detail.deleted', 0)
                                    ->where('t_sp.deleted', 0)->get();
        $html = $this->load->view('invoice/invoice/invoice_pdf', $data, true);
        $this->pdf_generator->generate($html, 'invoice pdf', $orientation='Landscape');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=invoice.xls");
        $id = (int) $this->input->get('id');
        $data['row'] = Invoice::select('t_invoice.*', 't_sj.sp_id', 't_sj.sj_no', 't_sp.sp_no', 't_sp.sp_date', 'm_dipo_partner.id as dipo_id', 'm_dipo_partner.code as dipo_code', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.phone as dipo_phone', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.pic as dipo_pic', 'm_dipo_partner.top as dipo_top')
                                    ->join('t_sj', 't_sj.id', '=', 't_invoice.sj_id')
                                    ->join('t_sp', 't_sp.id', '=', 't_sj.sp_id')
                                    ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                    ->where('t_invoice.id', $id)
                                    ->where('t_invoice.deleted', 0)->first();

        $data['datadetails'] = Spdetail::select('t_sp.*', 'm_product.*', 'm_product.name as product_name', 't_sp_detail.*')
                                    ->join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('m_product', 'm_product.id', '=', 't_sp_detail.product_id')
                                    ->where('sp_id', $data['row']->sp_id)
                                    ->where('t_sp_detail.deleted', 0)
                                    ->where('t_sp.deleted', 0)->get();
        $this->load->view('invoice/invoice/invoice_pdf', $data);
    }

}
