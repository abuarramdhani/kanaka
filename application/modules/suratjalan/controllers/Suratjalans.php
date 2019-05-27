<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suratjalans extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        $this->load->model('suratjalan');
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'suratjalan');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'suratjalan');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'suratjalan');
        $data['principles'] = Principle::where('deleted', '0')->get();
        $data['pricelists'] = Pricelist::join('m_product', 't_pricelist.product_id', '=', 'm_product.id')->where('t_pricelist.deleted', '0')->where('m_product.deleted', '0')->get();
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
        $join[] = array('m_dipo_partner', 'm_dipo_partner.id = t_sj.dipo_partner_id', 'inner');

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
            $id_suratjalan = $this->input->post('id');
            // $get_suratjalan = Product::where('name' , $this->input->post('name'))->where('deleted', 0)->first();
            if (empty($id_suratjalan)) {
                // if (!empty($get_suratjalan->name)) {
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
                        $message = "Add " . strtolower(lang('suratjalan')) . " " . $no_sp . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 13);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                // }
            } elseif(!empty($id_suratjalan)) {
                $model = Product::find($id_suratjalan);
                $name = ucwords($this->input->post('name'));
                $category_id = $this->input->post('category_id');
                $suratjalan_code = $this->input->post('suratjalan_code');
                $description = $this->input->post('description');
                $feature = $this->input->post('feature');
                $barcode_suratjalan = $this->input->post('barcode_suratjalan');
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
                    'Product Code'    => $model->suratjalan_code,
                    'Description'     => $model->description,
                    'Feature'         => $model->feature,
                    'Barcode Product' => $model->barcode_suratjalan,
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
                $model->suratjalan_code             = $suratjalan_code;
                $model->description     = $description;
                $model->feature         = $feature;
                $model->barcode_suratjalan = $barcode_suratjalan;
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
                        $uploadPath = 'uploads/images/suratjalans/'; 
                        $config['upload_path'] = $uploadPath; 
                        $config['allowed_types'] = 'gif|jpg|png'; 

                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        // Upload file to server
                        if($this->upload->do_upload('upload_File')){
                            // Uploaded file data
                            $fileData = $this->upload->data();
                            $uploadData[$i]['suratjalan_id']   = $id_suratjalan;
                            $uploadData[$i]['order']        = $i+1;
                            $uploadData[$i]['file_name']    = $fileData['file_name'];
                        
                            $imageModel = new ProductImage();
                            $imageModel->suratjalan_id = $id_suratjalan;
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
                        'Product Code'    => $suratjalan_code,
                        'Description'     => $description,
                        'Feature'         => $feature,
                        'Barcode Product' => $barcode_suratjalan,
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
                    $message = "Update " . strtolower(lang('suratjalan')) . " " .  $model->name . " succesfully by " . $user->full_name;
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
            $model = array('status' => 'success', 'data' => Product::find($id), 'image' => ProductImage::where('suratjalan_id', $id)->where('deleted', '0')->get());
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function viewDetail() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $dataPesanan = Suratjalan::select('t_sp.*', 'm_principle.code as principle_code', 'm_principle.address as principle_address', 'm_dipo_partner.name as dipo_name', 'm_dipo_partner.address as dipo_address')
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
                    'Product Code'    => $model->suratjalan_code,
                    'Description'     => $model->description,
                    'Feature'         => $model->feature,
                    'Barcode Product' => $barcode_suratjalan,
                    'Barcode Carton'  => $barcode_carton,
                    'Packing Size'    => $packing_size,
                    'Qty'             => $qty,
                    'Length'          => $length,
                    'Height'          => $height,
                    'Width'           => $width,
                    'Volume'          => $volume,
                    'Weight'          => $weight,
                );
                $message = "Delete " . strtolower(lang('suratjalan')) . " " .  $model->name . " succesfully by " . $user->full_name;
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
        $data['suratjalans'] = Product::join('m_category', 't_sp.category_id', '=', 'm_category.id')->where('t_sp.deleted', 0)->where('m_category.deleted', 0)->orderBy('t_sp.id', 'DESC')->get();
        $html = $this->load->view('suratjalan/suratjalan/suratjalan_pdf', $data, true);
        $this->pdf_generator->generate($html, 'suratjalan pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=suratjalan.xls");
        $data['suratjalans'] = Product::join('m_category', 't_sp.category_id', '=', 'm_category.id')->where('t_sp.deleted', 0)->where('m_category.deleted', 0)->orderBy('t_sp.id', 'DESC')->get();
        $this->load->view('suratjalan/suratjalan/suratjalan_pdf', $data);
    }

}
