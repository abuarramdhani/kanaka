<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suratjalans extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'suratjalan')){
            redirect('dashboard', 'refresh');            
        }
        
        $this->load->model('suratjalan');
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'suratjalan');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'suratjalan');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'suratjalan');
        $data['dipos'] = Dipo::where('deleted', '0')->get();

        $this->load->blade('suratjalan.views.suratjalan.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            't_sj.id',
            't_sj.sj_no',
            't_sp.sp_no',
            'm_dipo_partner.name as dipo_name',
            'm_dipo_partner.address as dipo_address',
            'm_dipo_partner.pic',
            'm_dipo_partner.phone',
            't_sp.sp_date',
            't_sj.date_created',
        );

        $header_columns = array(
            't_sj.sj_no',
            't_sp.sp_no',
            'm_dipo_partner.name',
            'm_dipo_partner.address',
            'm_dipo_partner.pic',
            'm_dipo_partner.phone',
            't_sp.sp_date',
            't_sp.sp_date',
            't_sj.date_created',
        );

        $from = "t_sj";
        $where = "t_sj.deleted = 0";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        $join[] = array('t_sp', 't_sp.id = t_sj.sp_id', 'inner');
        $join[] = array('m_dipo_partner', 'm_dipo_partner.id = t_sp.dipo_partner_id', 'inner');

        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "t_sj.sj_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sp.sp_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sp.sp_date LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_dipo_partner.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_dipo_partner.address LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sj.date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('t_sj.id');
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
            if($this->user_profile->get_user_access('Updated', 'suratjalan')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'suratjalan')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }
        
            $row_value[] = $row->sj_no;
            $row_value[] = $row->sp_no;
            $row_value[] = $row->dipo_name;
            $row_value[] = $row->dipo_address;
            $row_value[] = $row->pic;
            $row_value[] = $row->phone;
            $row_value[] = date('d-m-Y',strtotime($row->sp_date));
            $row_value[] = date('d-m-Y',strtotime($row->sp_date));
            $row_value[] = date('d-m-Y',strtotime($row->date_created));
            $row_value[] = $btn_action;
            
            $new_aa_data[] = $row_value;
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }

    public function fetch_data_jalan() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($_GET['id']);
            $database_columns = array(
                't_sp_detail.id',
                'product_code',
                'm_product.name as product_name',
                'order_amount_in_ctn',
                'order_volume',
                'order_weight',
            );
    
            $header_columns = array(
                'id',
                'product_code',
                'product_name',
                'order_amount_in_ctn',
                'order_volume',
                'order_weight',
            );
    
            $from = "t_sp_detail";
            $where = "t_sp_detail.deleted = 0 AND sp_id =".Suratjalan::find($id)->sp_id;
            $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
            $join[] = array('t_sp', 't_sp.id = t_sp_detail.sp_id', 'inner');
            $join[] = array('t_pricelist', 't_pricelist.id = t_sp_detail.pricelist_id', 'inner');
            $join[] = array('m_product', 'm_product.id = t_pricelist.product_id', 'inner');
    
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
                $row_value[] = $row->order_volume;
                $row_value[] = $row->order_weight;
                
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
            $id_suratjalan = $this->input->post('sj_id');

            $get_suratjalan = Suratjalan::where('sj_no' , $this->input->post('sj_no'))->where('deleted', 0)->first();
            if (empty($id_suratjalan)) {
                if (!empty($get_suratjalan->sj_no)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $dipo_partner_id = $this->input->post('dipo_partner_id');
                    $sj_no = $this->input->post('sj_no');
                    $sp_id = $this->input->post('sp_id');
                    $total_order_amount_in_ctn = $this->input->post('total_order_amount_in_ctn');
                    $total_order_volume = $this->input->post('total_order_volume');
                    $total_order_weight = $this->input->post('total_order_weight');

                    $sj_data = array(
                        'sj_no'                 => $sj_no,
                        'sp_id'                 => $sp_id,
                        'total_order_amount_in_ctn'    => $total_order_amount_in_ctn,
                        'total_order_volume'    => $total_order_volume,
                        'total_order_weight'    => $total_order_weight,
                        'user_created'          => $user->id,
                        'date_created'          => date('Y-m-d'),
                        'time_created'          => date('H:i:s')
                    );

                    $save   = $this->db->insert('t_sj', $sj_data);

                    if(!empty($this->input->post('sp_detail_id'))){
                        $sp_detail_data = count($this->input->post('sp_detail_id'));
                        for($i = 0; $i < $sp_detail_data; $i++){ 
                            $dataDetail = array(
                                'order_volume'  => $this->input->post('order_volume')[$i],
                                'order_weight'  => $this->input->post('order_weight')[$i],
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
                            'SJ No'     => $sj_no,
                            'SP No'     => Suratpesanan::find($sp_id)->sp_no,
                            'Account'   => Dipo::find($dipo_partner_id)->name,
                        );
                        $message = "Add " . strtolower(lang('surat_jalan')) . " " . $sj_no . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 14);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_suratjalan)) {
                $model = Suratjalan::find($id_suratjalan);
                $dipo_partner_id = $this->input->post('dipo_partner_id');
                $sj_no = $this->input->post('sj_no');
                $sp_id = $this->input->post('sp_id');
                $total_order_amount_in_ctn = $this->input->post('total_order_amount_in_ctn');
                $total_order_volume = $this->input->post('total_order_volume');
                $total_order_weight = $this->input->post('total_order_weight');
            
                $data_old = array(
                    'SJ No'     => $model->sj_no,
                    'SP No'     => Suratpesanan::find($model->sp_id)->sp_no,
                    'Account'   => Dipo::find(Suratpesanan::find($model->sp_id)->dipo_partner_id)->name,
                );

                $dataDetail_old = array(
                    'order_volume'  => 0,
                    'order_weight'  => 0,
                    'user_modified' => $user->id,
                    'date_modified' => date('Y-m-d'),
                    'time_modified' => date('H:i:s')
                );
                $this->db->where('sp_id', $model->sp_id);
                $this->db->update('t_sp_detail', $dataDetail_old);

                $model->sj_no               = $sj_no;
                $model->sp_id               = $sp_id;
                $model->total_order_amount_in_ctn  = $total_order_amount_in_ctn;
                $model->total_order_volume  = $total_order_volume;
                $model->total_order_weight  = $total_order_weight;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();

                if(!empty($this->input->post('sp_detail_id'))){
                    $sp_detail_data = count($this->input->post('sp_detail_id'));
                    for($i = 0; $i < $sp_detail_data; $i++){ 
                        $dataDetail = array(
                            'order_volume'  => $this->input->post('order_volume')[$i],
                            'order_weight'  => $this->input->post('order_weight')[$i],
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
                        'SJ No'     => $sj_no,
                        'SP No'     => Suratpesanan::find($sp_id)->sp_no,
                        'Account'   => Dipo::find($dipo_partner_id)->name,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('surat_jalan')) . " " .  $model->sj_no . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 14);
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
            $sj_data = Suratjalan::select('t_sj.*', 't_sp.sp_no', 't_sp.sp_date', 'm_dipo_partner.id as dipo_id', 'm_dipo_partner.code as dipo_code', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.phone as dipo_phone', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.pic as dipo_pic')
                                        ->join('t_sp', 't_sp.id', '=', 't_sj.sp_id')
                                        ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                        ->where('t_sj.id', $id)
                                        ->where('t_sj.deleted', 0)->get();

            $model = array('status' => 'success', 'data' => $sj_data);
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function viewdetailsp() {
        if ($this->input->is_ajax_request()) {
            $id = (int) $this->input->get('id');
            $dataDetail = Spdetail::select('t_sp.*', 't_sp_detail.*', 't_sp_detail.id as spdetail_id', 'm_product.*')
                                    ->join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('t_pricelist', 't_pricelist.id', '=', 't_sp_detail.pricelist_id')
                                    ->join('m_product', 'm_product.id', '=', 't_pricelist.product_id')
                                    ->where('t_sp_detail.sp_id', $id)
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

    public function getspbydipo() {
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Suratpesanan::where('dipo_partner_id', $id)->where('deleted', 0)->get());
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getspbyid() {
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Suratpesanan::find($id));
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
            $model = Suratjalan::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $modelDetail = Spdetail::where('sp_id', $id)->get();
                if (!empty($modelDetail)) {
                    $dataDetail = array( 
                        'order_volume'  => 0,
                        'order_weight'  => 0,
                        'user_modified' => $user->id,
                        'date_modified' => date('Y-m-d'),
                        'time_modified' => date('H:i:s')
                    );
                    $this->db->where('sp_id', $model->sp_id);
                    $this->db->update('t_sp_detail', $dataDetail);
                }

                $data_notif = array(
                    'SJ No'     => $model->sj_no,
                    'SP No'     => Suratpesanan::find($model->sp_id)->sp_no,
                    'Account'   => Dipo::find(Suratpesanan::find($model->sp_id)->dipo_partner_id)->name,
                );
                $message = "Delete " . strtolower(lang('surat_jalan')) . " " .  $model->sj_no . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 14);
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
        $data['row'] = Suratjalan::select('t_sj.*', 't_sp.sp_no', 't_sp.sp_date', 'm_dipo_partner.id as dipo_id', 'm_dipo_partner.code as dipo_code', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.phone as dipo_phone', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.pic as dipo_pic')
                                    ->join('t_sp', 't_sp.id', '=', 't_sj.sp_id')
                                    ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                    ->where('t_sj.id', $id)
                                    ->where('t_sj.deleted', 0)->first();
        $data['datadetails'] = Spdetail::select('t_pricelist.*', 't_sp.*', 'm_product.*', 'm_product.name as product_name', 't_sp_detail.*')
                                    ->join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('t_pricelist', 't_pricelist.id', '=', 't_sp_detail.pricelist_id')
                                    ->join('m_product', 'm_product.id', '=', 't_pricelist.product_id')
                                    ->where('sp_id', $data['row']->sp_id)
                                    ->where('t_sp_detail.deleted', 0)
                                    ->where('t_sp.deleted', 0)->get();
        $html = $this->load->view('suratjalan/suratjalan/suratjalan_pdf', $data, true);
        $this->pdf_generator->generate($html, 'suratjalan pdf', $orientation='Landscape');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=suratjalan.xls");
        $id = (int) $this->input->get('id');
        $data['row'] = Suratjalan::select('t_sj.*', 't_sp.sp_no', 't_sp.sp_date', 'm_dipo_partner.id as dipo_id', 'm_dipo_partner.code as dipo_code', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.phone as dipo_phone', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.pic as dipo_pic')
                                    ->join('t_sp', 't_sp.id', '=', 't_sj.sp_id')
                                    ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                    ->where('t_sj.id', $id)
                                    ->where('t_sj.deleted', 0)->first();
        $data['datadetails'] = Spdetail::select('t_pricelist.*', 't_sp.*', 'm_product.*', 'm_product.name as product_name', 't_sp_detail.*')
                                    ->join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('t_pricelist', 't_pricelist.id', '=', 't_sp_detail.pricelist_id')
                                    ->join('m_product', 'm_product.id', '=', 't_pricelist.product_id')
                                    ->where('sp_id', $data['row']->sp_id)
                                    ->where('t_sp_detail.deleted', 0)
                                    ->where('t_sp.deleted', 0)->get();
        $this->load->view('suratjalan/suratjalan/suratjalan_pdf', $data);
    }

}
