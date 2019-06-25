<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suratpesanans extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'suratpesanan')){
            redirect('dashboard', 'refresh');            
        }
        
        $this->load->model('suratpesanan');
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'suratpesanan');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'suratpesanan');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'suratpesanan');
        $data['principles'] = Principle::where('deleted', '0')->get();
        $data['pricelists'] = Product::where('deleted', '0')->get();
        $data['dipos'] = Dipo::where('deleted', '0')->get();
        $this->load->blade('suratpesanan.views.suratpesanan.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            't_sp.id',
            'm_principle.code as principle_code',
            'm_principle.name as principle_name',
            'm_principle.pic as principle_pic',
            't_sp.sp_no',
            'm_dipo_partner.name as dipo_name',
            'm_dipo_partner.address as dipo_address',
            't_sp.sp_date',
            't_sp.date_created',
        );

        $header_columns = array(
            'm_principle.code',
            'm_principle.address',
            'm_principle.pic',
            't_sp.sp_no',
            'm_dipo_partner.name',
            'm_dipo_partner.address',
            't_sp.sp_date',
            't_sp.date_created',
        );

        $from = "t_sp";
        $where = "t_sp.deleted = 0";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        $join[] = array('m_principle', 'm_principle.id = t_sp.principle_id', 'inner');
        $join[] = array('m_dipo_partner', 'm_dipo_partner.id = t_sp.dipo_partner_id', 'inner');

        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "t_sp.sp_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sp.sp_date LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('t_sp.id');
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
            if($this->user_profile->get_user_access('Updated', 'suratpesanan')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'suratpesanan')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }
        
            $row_value[] = $row->sp_no;
            $row_value[] = $row->principle_code;
            $row_value[] = $row->principle_name;
            $row_value[] = $row->principle_pic;
            $row_value[] = $row->dipo_name;
            $row_value[] = $row->dipo_address;
            $row_value[] = date('d-m-Y',strtotime($row->sp_date));
            $row_value[] = date('d-m-Y',strtotime($row->date_created));
            $row_value[] = $btn_action;
            
            $new_aa_data[] = $row_value;
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }

    public function fetch_data_pesanan() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($_GET['id']);
            $database_columns = array(
                't_sp_detail.id',
                'product_code',
                'm_product.name as product_name',
                'order_amount_in_ctn',
                'order_price_before_tax',
                'order_price_after_tax',
                'order_amount_after_tax',
            );
    
            $header_columns = array(
                'product_code',
                'product_name',
                'order_amount_in_ctn',
                'order_price_before_tax',
                'order_price_after_tax',
                'order_amount_in_ctn',
            );
    
            $from = "t_sp_detail";
            $where = "t_sp_detail.deleted = 0 AND sp_id =".$id;
            $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
            $join[] = array('t_sp', 't_sp.id = t_sp_detail.sp_id', 'inner');
            $join[] = array('m_product', 'm_product.id = t_sp_detail.product_id', 'inner');
            // $join[] = array('t_pricelist', 't_pricelist.product_id = m_product.id', 'inner');
    
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
                $row_value[] = $row->order_price_before_tax;
                $row_value[] = $row->order_price_after_tax;
                $row_value[] = $row->order_amount_after_tax;
                
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
            $id_suratpesanan = $this->input->post('sp_id');

            $get_suratpesanan = Suratpesanan::where('sp_no' , $this->input->post('no_sp'))->where('deleted', 0)->first();
            if (empty($id_suratpesanan)) {
                if (!empty($get_suratpesanan->sp_no)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $principle_id = $this->input->post('principle_id');
                    $no_sp = $this->input->post('no_sp');
                    $dipo_partner_id = $this->input->post('dipo_partner_id');
                    $sp_date = $this->input->post('sp_date');
                    $total_order_amount_in_ctn = $this->input->post('total_order_amount_in_ctn');
                    $total_order_price_before_tax = $this->input->post('total_order_price_before_tax');
                    $total_order_price_after_tax = $this->input->post('total_order_price_after_tax');
                    $total_order_amount_after_tax = $this->input->post('total_order_amount_after_tax');
                    $total_niv = $this->input->post('total_niv_add');
                    $reg_disc = $this->input->post('reg_disc_total_add');
                    $add_disc_1 = $this->input->post('add_disc_1_total_add');
                    $add_disc_2 = $this->input->post('add_disc_2_total_add');
                    $btw_disc = $this->input->post('btw_disc_total_add');

                    $dataPesanan = array('principle_id'                 => $principle_id,
                                      'sp_no'                           => $no_sp,
                                      'dipo_partner_id'                 => $dipo_partner_id,
                                      'total_order_amount_in_ctn'       => $total_order_amount_in_ctn,
                                      'total_order_price_before_tax'    => $total_order_price_before_tax,
                                      'total_order_price_after_tax'     => $total_order_price_after_tax,
                                      'total_order_amount_after_tax'    => $total_order_amount_after_tax,
                                      'total_niv'                       => $total_niv,
                                      'reg_disc_total'                  => $reg_disc,
                                      'add_disc_1_total'                => $add_disc_1,
                                      'add_disc_2_total'                => $add_disc_2,
                                      'btw_disc_total'                  => $btw_disc,
                                      'sp_date'                         => date('Y-m-d',strtotime($sp_date)),
                                      'date_created'                    => date('Y-m-d'),
                                      'time_created'                    => date('H:i:s'),
                                      'user_created'                    => $user->id);

                    $save            = $this->db->insert('t_sp', $dataPesanan);
                    $id_sp           = $this->db->insert_id();

                    if(!empty($this->input->post('product_name'))){
                        $productCount = count($this->input->post('product_name'));
                        for($i = 0; $i < $productCount; $i++){ 
                            $dataDetail = array('sp_id'                  => $id_sp,
                                                'product_id'             => $this->input->post('product_id')[$i],
                                                'order_amount_in_ctn'    => $this->input->post('order_amount_in_ctn')[$i],
                                                'order_price_before_tax' => $this->input->post('order_price_before_tax')[$i],
                                                'order_price_after_tax'  => $this->input->post('order_price_after_tax_tmp')[$i],
                                                'order_amount_after_tax' => $this->input->post('order_amount_after_tax')[$i],
                                                'date_created'           => date('Y-m-d'),
                                                'time_created'           => date('H:i:s'),
                                                'user_created'           => $user->id);
                            $saveDetail = $this->db->insert('t_sp_detail', $dataDetail);
                        }
                    }

                    if ($save) {
                        $data_notif = array(
                            'Principle'       => Principle::find($principle_id)->code,
                            'No SP'           => $no_sp,
                            'DIPO'            => Dipo::find($dipo_partner_id)->name,
                            'sp_date'         => $sp_date,
                        );
                        $message = "Add " . strtolower(lang('suratpesanan')) . " " . $no_sp . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 13);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_suratpesanan)) {
                $model = Suratpesanan::find($id_suratpesanan);
                $principle_id = $this->input->post('principle_id');
                $no_sp = $this->input->post('no_sp');
                $dipo_partner_id = $this->input->post('dipo_partner_id');
                $sp_date = $this->input->post('sp_date');
                $total_order_amount_in_ctn = $this->input->post('total_order_amount_in_ctn');
                $total_order_price_before_tax = $this->input->post('total_order_price_before_tax');
                $total_order_price_after_tax = $this->input->post('total_order_price_after_tax');
                $total_order_amount_after_tax = $this->input->post('total_order_amount_after_tax');
                $total_niv = $this->input->post('total_niv_add');
                $reg_disc = $this->input->post('reg_disc_add');
                $add_disc_1 = $this->input->post('add_disc_1_total_add');
                $add_disc_2 = $this->input->post('add_disc_2_total_add');
                $btw_disc = $this->input->post('btw_disc_total_add');
            
                $data_old = array(
                    'Principle'       => Principle::find($model->principle_id)->code,
                    'No SP'           => $model->sp_no,
                    'DIPO'            => Dipo::find($model->dipo_partner_id)->name,
                    'sp_date'         => $model->sp_date,
                );

                $model->principle_id                    = $principle_id;
                $model->sp_no                           = $no_sp;
                $model->dipo_partner_id                 = $dipo_partner_id;
                $model->total_order_amount_in_ctn       = $total_order_amount_in_ctn;
                $model->total_order_price_before_tax    = $total_order_price_before_tax;
                $model->total_order_price_after_tax     = $total_order_price_after_tax;
                $model->total_order_amount_after_tax    = $total_order_amount_after_tax;
                $model->total_niv                       = $total_niv;
                $model->reg_disc_total                  = $reg_disc;
                $model->add_disc_1_total                = $add_disc_1;
                $model->add_disc_2_total                = $add_disc_2;
                $model->btw_disc_total                  = $btw_disc;
                $model->sp_date                         = date('Y-m-d',strtotime($sp_date));

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();

                if(!empty($this->input->post('product_name'))){
                    $productCount = count($this->input->post('product_name'));
                    for($i = 0; $i < $productCount; $i++){ 
                        $get_detail = Spdetail::where('id' , $this->input->post('sp_detail_id')[$i])->where('deleted', 0)->first();
                        if (empty($get_detail)) {
                            $dataDetail = array('sp_id'                  => $id_suratpesanan,
                                                'product_id'             => $this->input->post('product_id')[$i],
                                                'order_amount_in_ctn'    => $this->input->post('order_amount_in_ctn')[$i],
                                                'order_price_before_tax' => $this->input->post('order_price_before_tax')[$i],
                                                'order_price_after_tax'  => $this->input->post('order_price_after_tax')[$i],
                                                'order_amount_after_tax' => $this->input->post('order_amount_after_tax')[$i],
                                                'date_created'           => date('Y-m-d'),
                                                'time_created'           => date('H:i:s'),
                                                'user_created'           => $user->id);
                            $saveDetail = $this->db->insert('t_sp_detail', $dataDetail);
                        }else{
                            $modelDetail                                  = Spdetail::find($this->input->post('sp_detail_id')[$i]);
                            $modelDetail->sp_id                           = $id_suratpesanan;
                            $modelDetail->product_id                      = $this->input->post('product_id')[$i];
                            $modelDetail->order_amount_in_ctn             = $this->input->post('order_amount_in_ctn')[$i];
                            $modelDetail->order_price_before_tax          = $this->input->post('order_price_before_tax')[$i];
                            $modelDetail->order_price_after_tax           = $this->input->post('order_price_after_tax_tmp')[$i];
                            $modelDetail->order_amount_after_tax          = $this->input->post('order_amount_after_tax')[$i];

                            $modelDetail->user_modified = $user->id;
                            $modelDetail->date_modified = date('Y-m-d');
                            $modelDetail->time_modified = date('H:i:s');
                            $updateDetail = $modelDetail->save();
                        }
                    }
                }

                if ($update) {
                    $data_new = array(
                        'Principle'       => Principle::find($principle_id)->code,
                        'No SP'           => $no_sp,
                        'DIPO'            => Dipo::find($dipo_partner_id)->name,
                        'sp_date'         => $sp_date,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('suratpesanan')) . " " .  $model->sp_no . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 13);
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
            $dataPesanan = Suratpesanan::select('t_sp.*','m_principle.top as metode_pembayaran', 'm_principle.code as principle_code', 'm_principle.name as principle_name', 'm_principle.pic as principle_pic', 'm_principle.id as principle_id', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.id as dipo_id','m_principle.reg_disc', 'm_principle.add_disc_1', 'm_principle.add_disc_2', 'm_principle.btw_disc')
                                        ->join('m_principle', 'm_principle.id', '=', 't_sp.principle_id')
                                        ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                        ->where('t_sp.id', $id)
                                        ->where('t_sp.deleted', 0)->get();
            $dataDetail = Spdetail::select('t_sp.*', 't_pricelist.*', 'm_product.*', 't_sp_detail.*', 't_sp_detail.id as spdetail_id')
                                    ->join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('m_product', 'm_product.id', '=', 't_sp_detail.product_id')
                                    ->join('t_pricelist', 't_pricelist.product_id', '=', 'm_product.id')
                                    ->where('t_sp_detail.sp_id', $id)
                                    ->where('t_sp_detail.deleted', 0)
                                    ->where('t_sp.deleted', 0)
                                    ->where('t_pricelist.deleted', 0)
                                    ->where('m_product.deleted', 0)->get();
            $model = array('status' => 'success', 'data' => $dataPesanan, 'dataDetail' => $dataDetail);
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function viewDetail() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $dataPesanan = Suratpesanan::select('t_sp.*', 'm_principle.top as metode_pembayaran', 'm_principle.code as principle_code', 'm_principle.name as principle_name', 'm_principle.pic as principle_pic', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.code as dipo_code', 'm_dipo_partner.address as dipo_address','m_dipo_partner.id as dipo_id','m_principle.reg_disc', 'm_principle.add_disc_1', 'm_principle.add_disc_2', 'm_principle.btw_disc')
                                        ->join('m_principle', 'm_principle.id', '=', 't_sp.principle_id')
                                        ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                        ->where('t_sp.id', $id)
                                        ->where('t_sp.deleted', 0)->get();
            $model = array('status' => 'success', 'data' => $dataPesanan);
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getPrinciple() {
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Principle::find($id));
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getPricelist() {
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Pricelist::join('m_product', 't_pricelist.product_id', '=', 'm_product.id')->where('t_pricelist.deleted', '0')->where('m_product.deleted', '0')->where('t_pricelist.id', $id)->get());
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

    public function delete() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $user = $this->ion_auth->user()->row();
            $model = Suratpesanan::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $modelDetail = Spdetail::where('sp_id', $id)->get();
                if (!empty($modelDetail)) {
                    $dataDetail = array( 
                        'deleted'       =>  1, 
                        'user_deleted'  => $user->id, 
                        'date_deleted'  => date('Y-m-d'),
                        'time_deleted'  => date('H:i:s'),
                    );
                    $this->db->where('sp_id', $id);
                    $this->db->update('t_sp_detail', $dataDetail);
                }

                $data_notif = array(
                    'Principle'       => Principle::find($model->principle_id)->code,
                    'No SP'           => $model->sp_no,
                    'DIPO'            => Dipo::find($model->dipo_partner_id)->name,
                    'sp_date'         => $model->sp_date,
                );
                $message = "Delete " . strtolower(lang('suratpesanan')) . " " .  $model->name . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 13);
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

    function getpricelistbyproduct(){
        $user = $this->ion_auth->user()->row();
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Pricelist::where('product_id',$id)->where('user_created', $user->id)->orderBy('id', 'DESC')->get(), 'product' => Product::where('id',$id)->get());
        } else {
            $model = array('status' => 'error', 'message' => lang('data_not_found'));
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function get_pricelist(){
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Pricelist::where('id',$id)->orderBy('id', 'DESC')->get());
        } else {
            $model = array('status' => 'error', 'message' => lang('data_not_found'));
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function pdf(){
        $id = (int) $this->input->get('id');
        $data['suratpesanans'] = Suratpesanan::select('t_sp.*', 'm_principle.top as principle_top', 'm_principle.code as principle_code', 'm_principle.name as principle_name', 'm_principle.pic as principle_pic', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.code as dipo_code', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.code as dipo_code', 'm_principle.reg_disc', 'm_principle.add_disc_1', 'm_principle.add_disc_2', 'm_principle.btw_disc')
                                    ->join('m_principle', 'm_principle.id', '=', 't_sp.principle_id')
                                    ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                    ->where('t_sp.id', $id)
                                    ->where('t_sp.deleted', 0)->get();
        $data['detailpesanans'] = Spdetail::select('t_sp.*', 'm_product.*', 'm_product.name as product_name', 't_sp_detail.*')
                                    ->join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('m_product', 'm_product.id', '=', 't_sp_detail.product_id')
                                    ->where('sp_id', $id)
                                    ->where('t_sp_detail.deleted', 0)
                                    ->where('t_sp.deleted', 0)->get();
        $html = $this->load->view('suratpesanan/suratpesanan/suratpesanan_pdf', $data, true);
        $this->pdf_generator->generate($html, 'suratpesanan pdf', $orientation='Landscape');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=suratpesanan.xls");
        $id = (int) $this->input->get('id');
        $data['suratpesanans'] = Suratpesanan::select('t_sp.*', 'm_principle.top as principle_top', 'm_principle.code as principle_code', 'm_principle.name as principle_name', 'm_principle.pic as principle_pic', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.code as dipo_code', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.code as dipo_code' ,'m_principle.reg_disc', 'm_principle.add_disc_1', 'm_principle.add_disc_2', 'm_principle.btw_disc')
                                    ->join('m_principle', 'm_principle.id', '=', 't_sp.principle_id')
                                    ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                    ->where('t_sp.id', $id)
                                    ->where('t_sp.deleted', 0)->get();
        $data['detailpesanans'] = Spdetail::select('t_sp.*', 'm_product.*', 'm_product.name as product_name', 't_sp_detail.*')
                                    ->join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('m_product', 'm_product.id', '=', 't_sp_detail.product_id')
                                    ->where('sp_id', $id)
                                    ->where('t_sp_detail.deleted', 0)
                                    ->where('t_sp.deleted', 0)->get();
        $this->load->view('suratpesanan/suratpesanan/suratpesanan_pdf', $data);
    }

}
