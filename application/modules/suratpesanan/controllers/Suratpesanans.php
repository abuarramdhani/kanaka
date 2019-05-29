<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suratpesanans extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        $this->load->model('suratpesanan');
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'suratpesanan');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'suratpesanan');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'suratpesanan');
        $data['principles'] = Principle::where('deleted', '0')->get();
        $data['pricelists'] = Pricelist::join('m_product', 't_pricelist.product_id', '=', 'm_product.id')->where('t_pricelist.deleted', '0')->where('m_product.deleted', '0')->get();
        $data['dipos'] = Dipo::where('deleted', '0')->get();
        $this->load->blade('suratpesanan.views.suratpesanan.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            't_sp.id',
            'm_principle.code as principle_code',
            'm_principle.address as principle_address',
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
            $row_value[] = $row->principle_address;
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
                'company_before_tax_ctn',
                'company_after_tax_ctn',
            );
    
            $header_columns = array(
                'product_code',
                'product_name',
                'order_amount_in_ctn',
                'company_before_tax_ctn',
                'company_after_tax_ctn',
            );
    
            $from = "t_sp_detail";
            $where = "t_sp_detail.deleted = 0 AND sp_id =".$id;
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
            
            foreach ($aa_data as $row) {
                $row_value = array();
    
                $row_value[] = $row->product_code;
                $row_value[] = $row->product_name;
                $row_value[] = $row->order_amount_in_ctn;
                $row_value[] = $row->company_before_tax_ctn;
                $row_value[] = $row->company_after_tax_ctn;
                
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

                    $dataPesanan = array('principle_id'                 => $principle_id,
                                      'sp_no'                           => $no_sp,
                                      'dipo_partner_id'                 => $dipo_partner_id,
                                      'total_order_amount_in_ctn'       => $total_order_amount_in_ctn,
                                      'total_order_price_before_tax'    => $total_order_price_before_tax,
                                      'total_order_price_after_tax'     => $total_order_price_after_tax,
                                      'total_order_amount_after_tax'    => $total_order_amount_after_tax,
                                      'sp_date'                         => date('Y-m-d',strtotime($sp_date)),
                                      'date_created'                    => date('Y-m-d'),
                                      'time_created'                    => date('H:i:s'));

                    $save            = $this->db->insert('t_sp', $dataPesanan);
                    $id_sp           = $this->db->insert_id();

                    if(!empty($this->input->post('product_name'))){
                        $productCount = count($this->input->post('product_name'));
                        for($i = 0; $i < $productCount; $i++){ 
                            $dataDetail = array('sp_id'                  => $id_sp,
                                                'pricelist_id'           => $this->input->post('pricelist_id')[$i],
                                                'order_amount_in_ctn'    => $this->input->post('order_amount_in_ctn')[$i],
                                                'order_price_before_tax' => $this->input->post('order_price_before_tax')[$i],
                                                'order_price_after_tax'  => $this->input->post('order_price_after_tax')[$i],
                                                'order_amount_after_tax' => $this->input->post('order_amount_after_tax')[$i],
                                                'date_created'           => date('Y-m-d'),
                                                'time_created'           => date('H:i:s'));
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
                $model->sp_date                         = date('Y-m-d',strtotime($sp_date));

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();

                // if(!empty($this->input->post('product_name'))){
                //     $productCount = count($this->input->post('product_name'));
                //     for($i = 0; $i < $productCount; $i++){ 
                //         $dataDetail = array('sp_id'                  => $id_sp,
                //                             'pricelist_id'           => $this->input->post('pricelist_id')[$i],
                //                             'order_amount_in_ctn'    => $this->input->post('order_amount_in_ctn')[$i],
                //                             'order_price_before_tax' => $this->input->post('order_price_before_tax')[$i],
                //                             'order_price_after_tax'  => $this->input->post('order_price_after_tax')[$i],
                //                             'order_amount_after_tax' => $this->input->post('order_amount_after_tax')[$i],
                //                             'date_created'           => date('Y-m-d'),
                //                             'time_created'           => date('H:i:s'));
                //         $saveDetail = $this->db->insert('t_sp_detail', $dataDetail);
                //     }
                // }

                if ($update) {
                    $data_new = array(
                        'Name'            => $name,
                        'Category'        => $category_id,
                        'Product Code'    => $suratpesanan_code,
                        'Description'     => $description,
                        'Feature'         => $feature,
                        'Barcode Product' => $barcode_suratpesanan,
                        'Barcode Carton'  => $barcode_carton,
                        'Packing Size'    => $packing_size,
                        'Qty'             => $qty,
                        'Length'          => $length,
                        'Height'          => $height,
                        'Width'           => $width,
                        'Volume'          => $volume,
                        'Weight'          => $weight,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('suratpesanan')) . " " .  $model->name . " succesfully by " . $user->full_name;
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
            $dataPesanan = Suratpesanan::select('t_sp.*', 'm_principle.code as principle_code', 'm_principle.address as principle_address', 'm_principle.pic as principle_pic', 'm_principle.id as principle_id', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.address as dipo_address', 'm_dipo_partner.id as dipo_id')
                                        ->join('m_principle', 'm_principle.id', '=', 't_sp.principle_id')
                                        ->join('m_dipo_partner', 'm_dipo_partner.id', '=', 't_sp.dipo_partner_id')
                                        ->where('t_sp.id', $id)
                                        ->where('t_sp.deleted', 0)->get();
            $dataDetail = Spdetail::join('t_sp', 't_sp.id', '=', 't_sp_detail.sp_id')
                                    ->join('t_pricelist', 't_pricelist.id', '=', 't_sp_detail.pricelist_id')
                                    ->join('m_product', 'm_product.id', '=', 't_pricelist.product_id')
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
            $dataPesanan = Suratpesanan::select('t_sp.*', 'm_principle.code as principle_code', 'm_principle.address as principle_address', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.address as dipo_address')
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
            $model = Product::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Name'            => $model->name,
                    'Category'        => Category::find($category_id)->name,
                    'Product Code'    => $model->suratpesanan_code,
                    'Description'     => $model->description,
                    'Feature'         => $model->feature,
                    'Barcode Product' => $barcode_suratpesanan,
                    'Barcode Carton'  => $barcode_carton,
                    'Packing Size'    => $packing_size,
                    'Qty'             => $qty,
                    'Length'          => $length,
                    'Height'          => $height,
                    'Width'           => $width,
                    'Volume'          => $volume,
                    'Weight'          => $weight,
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

    function pdf(){
        $data['suratpesanans'] = Product::join('m_category', 't_sp.category_id', '=', 'm_category.id')->where('t_sp.deleted', 0)->where('m_category.deleted', 0)->orderBy('t_sp.id', 'DESC')->get();
        $html = $this->load->view('suratpesanan/suratpesanan/suratpesanan_pdf', $data, true);
        $this->pdf_generator->generate($html, 'suratpesanan pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=suratpesanan.xls");
        $data['suratpesanans'] = Product::join('m_category', 't_sp.category_id', '=', 'm_category.id')->where('t_sp.deleted', 0)->where('m_category.deleted', 0)->orderBy('t_sp.id', 'DESC')->get();
        $this->load->view('suratpesanan/suratpesanan/suratpesanan_pdf', $data);
    }

}
