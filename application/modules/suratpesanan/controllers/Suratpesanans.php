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
            $id_suratpesanan = $this->input->post('id');
            // $get_suratpesanan = Product::where('name' , $this->input->post('name'))->where('deleted', 0)->first();
            if (empty($id_suratpesanan)) {
                // if (!empty($get_suratpesanan->name)) {
                //     $status = array('status' => 'unique', 'message' => lang('already_exist'));
                // }else{
                    
                    $principle_id = $this->input->post('principle_id');
                    $no_sp = $this->input->post('no_sp');
                    $dipo_partner_id = $this->input->post('dipo_partner_id');
                    $sp_date = $this->input->post('sp_date');

                    $dataPesanan = array('principle_id' => $principle_id,
                                      'sp_no'           => $no_sp,
                                      'dipo_partner_id' => $dipo_partner_id,
                                      'sp_date'         => date('Y-m-d',strtotime($sp_date)),
                                      'date_created'    => date('Y-m-d'),
                                      'time_created'    => date('H:i:s'));

                    $save            = $this->db->insert('t_sp', $dataPesanan);
                    $id_sp           = $this->db->insert_id();

                    if(!empty($this->input->post('product_name'))){
                        $productCount = count($this->input->post('product_name'));
                        for($i = 0; $i < $productCount; $i++){ 
                            $dataDetail = array('sp_id'               => $id_sp,
                                                'pricelist_id'        => $this->input->post('pricelist_id')[$i],
                                                'order_amount_in_ctn' => $this->input->post('order_amount_in_ctn')[$i],
                                                'date_created'        => date('Y-m-d'),
                                                'time_created'        => date('H:i:s'));
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
                // }
            } elseif(!empty($id_suratpesanan)) {
                $model = Product::find($id_suratpesanan);
                $name = ucwords($this->input->post('name'));
                $category_id = $this->input->post('category_id');
                $suratpesanan_code = $this->input->post('suratpesanan_code');
                $description = $this->input->post('description');
                $feature = $this->input->post('feature');
                $barcode_suratpesanan = $this->input->post('barcode_suratpesanan');
                $barcode_carton = $this->input->post('barcode_carton');
                $packing_size = $this->input->post('packing_size');
                $qty = $this->input->post('qty');
                $weight = $this->input->post('weight');
                $length = $this->input->post('length');
                $width = $this->input->post('width');
                $height = $this->input->post('height');
                $volume = $this->input->post('volume');
            
                $data_old = array(
                    'Name'            => $model->name,
                    'Category'        => $model->category_id,
                    'Product Code'    => $model->suratpesanan_code,
                    'Description'     => $model->description,
                    'Feature'         => $model->feature,
                    'Barcode Product' => $model->barcode_suratpesanan,
                    'Barcode Carton'  => $model->barcode_carton,
                    'Packing Size'    => $model->packing_size,
                    'Qty'             => $model->qty,
                    'Length'          => $model->length,
                    'Height'          => $model->height,
                    'Width'           => $model->width,
                    'Volume'          => $model->volume,
                    'Weight'          => $model->weight,
                );

                $model->name            = $name;
                $model->category_id     = $category_id;
                $model->suratpesanan_code             = $suratpesanan_code;
                $model->description     = $description;
                $model->feature         = $feature;
                $model->barcode_suratpesanan = $barcode_suratpesanan;
                $model->barcode_carton  = $barcode_carton;
                $model->packing_size    = $packing_size;
                $model->qty             = $qty;
                $model->length     = $length;
                $model->height     = $height;
                $model->width     = $width;
                $model->volume   = $volume;
                $model->weight          = $weight;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();

                if(!empty($_FILES['upload_Files']['name'])){
                    $filesCount = count($_FILES['upload_Files']['name']);
                    for($i = 0; $i < $filesCount; $i++){ 
                        $_FILES['upload_File']['name']      = $_FILES['upload_Files']['name'][$i]; 
                        $_FILES['upload_File']['type']      = $_FILES['upload_Files']['type'][$i]; 
                        $_FILES['upload_File']['tmp_name']  = $_FILES['upload_Files']['tmp_name'][$i]; 
                        $_FILES['upload_File']['error']     = $_FILES['upload_Files']['error'][$i]; 
                        $_FILES['upload_File']['size']      = $_FILES['upload_Files']['size'][$i]; 
                        
                        // File upload configuration
                        $uploadPath = 'uploads/images/suratpesanans/'; 
                        $config['upload_path'] = $uploadPath; 
                        $config['allowed_types'] = 'gif|jpg|png'; 

                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        // Upload file to server
                        if($this->upload->do_upload('upload_File')){
                            // Uploaded file data
                            $fileData = $this->upload->data();
                            $uploadData[$i]['suratpesanan_id']   = $id_suratpesanan;
                            $uploadData[$i]['order']        = $i+1;
                            $uploadData[$i]['file_name']    = $fileData['file_name'];
                        
                            $imageModel = new ProductImage();
                            $imageModel->suratpesanan_id = $id_suratpesanan;
                            $imageModel->order      = $i+1;
                            $imageModel->image      = $uploadData[$i]['file_name'];

                            $imageModel->user_created = $user->id;
                            $imageModel->date_created = date('Y-m-d');
                            $imageModel->time_created = date('H:i:s');
                            $saveImage = $imageModel->save();
                        }
                    }
                }

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
            $model = array('status' => 'success', 'data' => Product::find($id), 'image' => ProductImage::where('suratpesanan_id', $id)->where('deleted', '0')->get());
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
