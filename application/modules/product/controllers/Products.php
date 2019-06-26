<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'product')){
            redirect('dashboard', 'refresh');            
        }
        
        $this->load->model('product');
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'product');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'product');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'product');
        $data['categories'] = Category::where('deleted', '0')->get();
        $this->load->blade('product.views.product.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            'm_product.id',
            'm_product.product_code',
            'm_product.name',
            'm_category.name as category_name',
            'm_product.view_total',
            'm_product.description',
            'm_product.feature',
            'm_product.barcode_product',
            'm_product.barcode_carton',
            'm_product.packing_size',
            'm_product.qty',
            'm_product.length',
            'm_product.height',
            'm_product.width',
            'm_product.volume',
            'm_product.weight',
            'm_product.date_created',
        );

        $header_columns = array(
            'm_product.product_code',
            'm_product.name',
            'm_category.name as category_name',
            'm_product.view_total',
            'm_product.description',
            'm_product.feature',
            'm_product.barcode_product',
            'm_product.barcode_carton',
            'm_product.packing_size',
            'm_product.qty',
            'm_product.length',
            'm_product.height',
            'm_product.width',
            'm_product.volume',
            'm_product.weight',
            'm_product.date_created',
        );

        $from = "m_product";
        $where = "m_product.deleted = 0";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        $join[] = array('m_category', 'm_category.id = m_product.category_id', 'inner');

        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "m_product.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_category.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.product_code LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.description LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.feature LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.barcode_product LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.barcode_carton LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.packing_size LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.qty LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.length LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.height LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.width LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.volume LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.weight LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('m_product.id');
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
            if($this->user_profile->get_user_access('Updated', 'product')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'product')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->product_code;
            $row_value[] = $row->barcode_product;
            $row_value[] = $row->barcode_carton;
            $row_value[] = $row->name;
            $row_value[] = $row->packing_size;
            $row_value[] = $row->qty;
            $row_value[] = $row->length;
            $row_value[] = $row->width;
            $row_value[] = $row->height;
            $row_value[] = $row->volume;
            $row_value[] = $row->weight;
            $row_value[] = $row->category_name;
            $row_value[] = $row->view_total;
            $row_value[] = $row->description;
            $row_value[] = $row->feature;
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
            $id_product = $this->input->post('id');
            $get_product = Product::where('name' , $this->input->post('name'))->where('deleted', 0)->first();
            if (empty($id_product)) {
                if (!empty($get_product->product_code)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $name = ucwords($this->input->post('name'));
                    $category_id = $this->input->post('category_id');
                    $product_code = $this->input->post('product_code');
                    $description = $this->input->post('description');
                    $feature = $this->input->post('feature');
                    $barcode_product = $this->input->post('barcode_product');
                    $barcode_carton = $this->input->post('barcode_carton');
                    $packing_size = $this->input->post('packing_size');
                    $qty = $this->input->post('qty');
                    $length = $this->input->post('length');
                    $height = $this->input->post('width');
                    $width = $this->input->post('height');
                    $volume = $this->input->post('volume');
                    $weight = $this->input->post('weight');
                    $cbp_per_kemasan = $this->input->post('cbp_per_kemasan');
                    $cbp_per_karton = $this->input->post('cbp_per_karton');
                    $tipe_kemasan = $this->input->post('tipe_kemasan');
                    $harga = $this->input->post('harga');
                    
                    $model = new Product();
                    $model->name = $name;
                    $model->category_id = $category_id;
                    $model->product_code = $product_code;
                    $model->description = $description;
                    $model->feature = $feature;
                    $model->barcode_product = $barcode_product;
                    $model->barcode_carton = $barcode_carton;
                    $model->packing_size = $packing_size;
                    $model->qty = $qty;
                    $model->length = $length;
                    $model->height = $height;
                    $model->width = $width;
                    $model->volume = $volume;
                    $model->weight = $weight;
                    $model->cbp_per_kemasan = $cbp_per_kemasan;
                    $model->cbp_per_karton = $cbp_per_karton;
                    $model->tipe_kemasan = $tipe_kemasan;
                    $model->harga = $harga;

                    $dataProduct = array('name'         => $name,
                                      'category_id'     => $category_id,
                                      'product_code'    => $product_code,
                                      'description'     => $description,
                                      'feature'         => $feature,
                                      'barcode_product' => $barcode_product,
                                      'barcode_carton'  => $barcode_carton,
                                      'packing_size'    => $packing_size,
                                      'qty'             => $qty,
                                      'length'          => $length,
                                      'height'          => $height,
                                      'width'           => $width,
                                      'volume'          => $volume,
                                      'weight'          => $weight,
                                      'cbp_per_kemasan' => $cbp_per_kemasan,
                                      'cbp_per_karton'  => $cbp_per_karton,
                                      'tipe_kemasan'    => $tipe_kemasan,
                                      'harga'           => $harga,
                                      'user_created'    => $user->id,
                                      'date_created'    => date('Y-m-d'),
                                      'time_created'    => date('H:i:s'));

                    $save       = $this->db->insert('m_product', $dataProduct);
                    $id_product = $this->db->insert_id();

                    if(!empty($this->input->post('price_value'))){
                        $priceCount = count($this->input->post('price_value'));
                        for($x = 0; $x < $priceCount; $x++){ 
                            $dataPrice = array('product_id'             => $id_product,
                                                    'area'                   => $this->input->post('price_area')[$x],
                                                    'description'            => $this->input->post('price_description')[$x],
                                                    'type'                   => $this->input->post('price_type')[$x],
                                                    'value'                  => $this->input->post('price_value')[$x],
                                                    'date_created'           => date('Y-m-d'),
                                                    'time_created'           => date('H:i:s'),
                                                    'user_created'           => $user->id);
                            $savePrice = $this->db->insert('m_product_price', $dataPrice);
                        }
                    }

                    if(!empty($this->input->post('brand'))){
                        $productCount = count($this->input->post('brand'));
                        for($i = 0; $i < $productCount; $i++){ 
                            if(!empty($_FILES['image_comparison']['name'][$i])){
                                $_FILES['image']['name']      = $_FILES['image_comparison']['name'][$i]; 
                                $_FILES['image']['type']      = $_FILES['image_comparison']['type'][$i]; 
                                $_FILES['image']['tmp_name']  = $_FILES['image_comparison']['tmp_name'][$i]; 
                                $_FILES['image']['error']     = $_FILES['image_comparison']['error'][$i]; 
                                $_FILES['image']['size']      = $_FILES['image_comparison']['size'][$i]; 
                                
                                $uploadPath = 'uploads/images/comparison/'; 
                                $config['upload_path'] = $uploadPath; 
                                $config['allowed_types'] = 'gif|jpg|png'; 
    
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
    
                                // Upload file to server
                                if($this->upload->do_upload('image')){
                                    // Uploaded file data
                                    $fileDataComp                       = $this->upload->data();
                                    $uploadDataComp[$i]['file_name']    = $fileDataComp['file_name'];
                                
                                    $dataComparison = array('product_id'        => $id_product,
                                                        'brand'                  => $this->input->post('brand')[$i],
                                                        // 'description'            => $this->input->post('desc_comparison')[$i],
                                                        'image'                  => $uploadDataComp[$i]['file_name'],
                                                        'packing_size'           => $this->input->post('packing_size_comp')[$i],
                                                        'qty_per_ctn'            => $this->input->post('qty_comp')[$i],
                                                        'tipe_kemasan'           => $this->input->post('tipe_kemasan_comp')[$i],
                                                        'cbp_per_kemasan'        => $this->input->post('cbp_per_kemasan_comp')[$i],
                                                        'cbp_per_karton'         => $this->input->post('cbp_per_karton_comp')[$i],
                                                        'harga'                  => $this->input->post('harga_comp')[$i],
                                                        'date_created'           => date('Y-m-d'),
                                                        'time_created'           => date('H:i:s'),
                                                        'user_created'           => $user->id);
                                    $saveComparison = $this->db->insert('m_product_comparison', $dataComparison);
                                }else{
                                    $dataComparison = array('product_id'        => $id_product,
                                                        'brand'                  => $this->input->post('brand')[$i],
                                                        // 'description'            => $this->input->post('desc_comparison')[$i],
                                                        'image'                  => 'default.png',
                                                        'packing_size'           => $this->input->post('packing_size_comp')[$i],
                                                        'qty_per_ctn'            => $this->input->post('qty_comp')[$i],
                                                        'tipe_kemasan'           => $this->input->post('tipe_kemasan_comp')[$i],
                                                        'cbp_per_kemasan'        => $this->input->post('cbp_per_kemasan_comp')[$i],
                                                        'cbp_per_karton'         => $this->input->post('cbp_per_karton_comp')[$i],
                                                        'harga'                  => $this->input->post('harga_comp')[$i],
                                                        'date_created'           => date('Y-m-d'),
                                                        'time_created'           => date('H:i:s'),
                                                        'user_created'           => $user->id);
                                    $saveComparison = $this->db->insert('m_product_comparison', $dataComparison);
                                }   
                            }
                        }
                    }

                    if(!empty($_FILES['upload_Files']['name'])){
                        $filesCount = count($_FILES['upload_Files']['name']);
                        for($i = 0; $i < $filesCount; $i++){ 
                            $_FILES['upload_File']['name']      = $_FILES['upload_Files']['name'][$i]; 
                            $_FILES['upload_File']['type']      = $_FILES['upload_Files']['type'][$i]; 
                            $_FILES['upload_File']['tmp_name']  = $_FILES['upload_Files']['tmp_name'][$i]; 
                            $_FILES['upload_File']['error']     = $_FILES['upload_Files']['error'][$i]; 
                            $_FILES['upload_File']['size']      = $_FILES['upload_Files']['size'][$i]; 
                            
                            // File upload configuration
                            $uploadPath = 'uploads/images/products/'; 
                            $config['upload_path'] = $uploadPath; 
                            $config['allowed_types'] = 'gif|jpg|png'; 

                            // Load and initialize upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            // Upload file to server
                            if($this->upload->do_upload('upload_File')){
                                // Uploaded file data
                                $fileData = $this->upload->data();
                                $uploadData[$i]['product_id']   = $id_product;
                                $uploadData[$i]['order']        = $i+1;
                                $uploadData[$i]['file_name']    = $fileData['file_name'];
                            
                                $imageModel = new ProductImage();
                                $imageModel->product_id = $id_product;
                                $imageModel->order      = $i+1;
                                $imageModel->image      = $uploadData[$i]['file_name'];
    
                                $imageModel->user_created = $user->id;
                                $imageModel->date_created = date('Y-m-d');
                                $imageModel->time_created = date('H:i:s');
                                $saveImage = $imageModel->save();
                            }
                        }
                    }

                    if ($save) {
                        $data_notif = array(
                            'Name'            => $name,
                            'Category'        => Category::find($category_id)->name,
                            'Product Code'    => $product_code,
                            'Description'     => $description,
                            'Feature'         => $feature,
                            'Barcode Product' => $barcode_product,
                            'Barcode Carton'  => $barcode_carton,
                            'Packing Size'    => $packing_size,
                            'Qty'             => $qty,
                            'Length'          => $length,
                            'Height'          => $height,
                            'Width'           => $width,
                            'Volume'          => $volume,
                            'Weight'          => $weight,
                            'Tipe Kemasan'    => $tipe_kemasan,
                            'CBP Per Kemasan' => $cbp_per_kemasan,
                            'CBP Per Karton'  => $cbp_per_karton,
                            'Harga'           => $harga,
                        );
                        $message = "Add " . strtolower(lang('product')) . " " . $name . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 4);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_product)) {
                $model = Product::find($id_product);
                $name = ucwords($this->input->post('name'));
                $category_id = $this->input->post('category_id');
                $product_code = $this->input->post('product_code');
                $description = $this->input->post('description');
                $feature = $this->input->post('feature');
                $barcode_product = $this->input->post('barcode_product');
                $barcode_carton = $this->input->post('barcode_carton');
                $packing_size = $this->input->post('packing_size');
                $qty = $this->input->post('qty');
                $weight = $this->input->post('weight');
                $length = $this->input->post('length');
                $width = $this->input->post('width');
                $height = $this->input->post('height');
                $volume = $this->input->post('volume');
                $cbp_per_kemasan = $this->input->post('cbp_per_kemasan');
                $cbp_per_karton = $this->input->post('cbp_per_karton');
                $tipe_kemasan = $this->input->post('tipe_kemasan');
                $harga = $this->input->post('harga');
            
                $data_old = array(
                    'Name'            => $model->name,
                    'Category'        => $model->category_id,
                    'Product Code'    => $model->product_code,
                    'Description'     => $model->description,
                    'Feature'         => $model->feature,
                    'Barcode Product' => $model->barcode_product,
                    'Barcode Carton'  => $model->barcode_carton,
                    'Packing Size'    => $model->packing_size,
                    'Qty'             => $model->qty,
                    'Length'          => $model->length,
                    'Height'          => $model->height,
                    'Width'           => $model->width,
                    'Volume'          => $model->volume,
                    'Weight'          => $model->weight,
                    'Tipe Kemasan'    => $model->tipe_kemasan,
                    'CBP Per Kemasan' => $model->cbp_per_kemasan,
                    'CBP Per Karton'  => $model->cbp_per_karton,
                    'Harga'           => $model->harga,
                );

                $model->name            = $name;
                $model->category_id     = $category_id;
                $model->product_code    = $product_code;
                $model->description     = $description;
                $model->feature         = $feature;
                $model->barcode_product = $barcode_product;
                $model->barcode_carton  = $barcode_carton;
                $model->packing_size    = $packing_size;
                $model->qty             = $qty;
                $model->length          = $length;
                $model->height          = $height;
                $model->width           = $width;
                $model->volume          = $volume;
                $model->weight          = $weight;
                $model->cbp_per_kemasan = $cbp_per_kemasan;
                $model->cbp_per_karton  = $cbp_per_karton;
                $model->tipe_kemasan    = $tipe_kemasan;
                $model->harga           = $harga;

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
                        $uploadPath = 'uploads/images/products/'; 
                        $config['upload_path'] = $uploadPath; 
                        $config['allowed_types'] = 'gif|jpg|png'; 

                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        // Upload file to server
                        if($this->upload->do_upload('upload_File')){
                            // Uploaded file data
                            $fileData = $this->upload->data();
                            $uploadData[$i]['product_id']   = $id_product;
                            $uploadData[$i]['order']        = $i+1;
                            $uploadData[$i]['file_name']    = $fileData['file_name'];
                        
                            $imageModel = new ProductImage();
                            $imageModel->product_id = $id_product;
                            $imageModel->order      = $i+1;
                            $imageModel->image      = $uploadData[$i]['file_name'];

                            $imageModel->user_created = $user->id;
                            $imageModel->date_created = date('Y-m-d');
                            $imageModel->time_created = date('H:i:s');
                            $saveImage = $imageModel->save();
                        }
                    }
                }

                if(!empty($this->input->post('price_value'))){
                    $priceCount = count($this->input->post('price_value'));
                    for($x = 0; $x < $priceCount; $x++){ 
                        $get_price = ProductPrice::where('id' , $this->input->post('price_id')[$x])->where('deleted', 0)->first();
                        if (empty($get_price)) {
                            $dataPrice = array('product_id'             => $id_product,
                                                'area'                   => $this->input->post('price_area')[$x],
                                                'description'            => $this->input->post('price_description')[$x],
                                                'type'                   => $this->input->post('price_type')[$x],
                                                'value'                  => $this->input->post('price_value')[$x],
                                                'date_created'           => date('Y-m-d'),
                                                'time_created'           => date('H:i:s'),
                                                'user_created'           => $user->id);
                            $savePrice = $this->db->insert('m_product_price', $dataPrice);
                        }else{
                            $modelPrice = ProductPrice::find($this->input->post('price_id')[$x]);
                            $modelPrice->area           = $this->input->post('price_area')[$x];
                            $modelPrice->description    = $this->input->post('price_description')[$x];
                            $modelPrice->type           = $this->input->post('price_type')[$x];
                            $modelPrice->value          = $this->input->post('price_value')[$x];
                            $modelPrice->user_modified  = $user->id;
                            $modelPrice->date_modified  = date('Y-m-d');
                            $modelPrice->time_modified  = date('H:i:s');
                            $updatePrice                = $modelPrice->save();
                        }
                    }
                }

                if(!empty($this->input->post('brand'))){
                    $productCount = count($this->input->post('brand'));
                    for($i = 0; $i < $productCount; $i++){ 
                        $get_comparison = ProductComparison::where('id' , $this->input->post('comparison_id')[$i])->where('deleted', 0)->first();
                        if (empty($get_comparison)) {
                            if(!empty($_FILES['image_comparison']['name'][$i])){
                                $_FILES['image']['name']      = $_FILES['image_comparison']['name'][$i]; 
                                $_FILES['image']['type']      = $_FILES['image_comparison']['type'][$i]; 
                                $_FILES['image']['tmp_name']  = $_FILES['image_comparison']['tmp_name'][$i]; 
                                $_FILES['image']['error']     = $_FILES['image_comparison']['error'][$i]; 
                                $_FILES['image']['size']      = $_FILES['image_comparison']['size'][$i]; 
                                
                                $uploadPath = 'uploads/images/comparison/'; 
                                $config['upload_path'] = $uploadPath; 
                                $config['allowed_types'] = 'gif|jpg|png'; 
    
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
    
                                // Upload file to server
                                if($this->upload->do_upload('image')){
                                    // Uploaded file data
                                    $fileDataComp                       = $this->upload->data();
                                    $uploadDataComp[$i]['file_name']    = $fileDataComp['file_name'];
                                
                                    $dataComparison = array('product_id'        => $id_product,
                                                        'brand'                  => $this->input->post('brand')[$i],
                                                        // 'description'            => $this->input->post('desc_comparison')[$i],
                                                        'image'                  => $uploadDataComp[$i]['file_name'],
                                                        'packing_size'           => $this->input->post('packing_size_comp')[$i],
                                                        'qty_per_ctn'            => $this->input->post('qty_comp')[$i],
                                                        'tipe_kemasan'           => $this->input->post('tipe_kemasan_comp')[$i],
                                                        'cbp_per_kemasan'        => $this->input->post('cbp_per_kemasan_comp')[$i],
                                                        'cbp_per_karton'         => $this->input->post('cbp_per_karton_comp')[$i],
                                                        'harga'                  => $this->input->post('harga_comp')[$i],
                                                        'date_created'           => date('Y-m-d'),
                                                        'time_created'           => date('H:i:s'),
                                                        'user_created'           => $user->id);
                                    $saveComparison = $this->db->insert('m_product_comparison', $dataComparison);
                                }else{
                                    $dataComparison = array('product_id'        => $id_product,
                                                        'brand'                  => $this->input->post('brand')[$i],
                                                        // 'description'            => $this->input->post('desc_comparison')[$i],
                                                        'image'                  => 'default.png',
                                                        'packing_size'           => $this->input->post('packing_size_comp')[$i],
                                                        'qty_per_ctn'            => $this->input->post('qty_comp')[$i],
                                                        'tipe_kemasan'           => $this->input->post('tipe_kemasan_comp')[$i],
                                                        'cbp_per_kemasan'        => $this->input->post('cbp_per_kemasan_comp')[$i],
                                                        'cbp_per_karton'         => $this->input->post('cbp_per_karton_comp')[$i],
                                                        'harga'                  => $this->input->post('harga_comp')[$i],
                                                        'date_created'           => date('Y-m-d'),
                                                        'time_created'           => date('H:i:s'),
                                                        'user_created'           => $user->id);
                                    $saveComparison = $this->db->insert('m_product_comparison', $dataComparison);
                                }   
                            }else{
                                $dataComparison = array('product_id'        => $id_product,
                                                    'brand'                  => $this->input->post('brand')[$i],
                                                    // 'description'            => $this->input->post('desc_comparison')[$i],
                                                    'image'                  => 'default.png',
                                                    'packing_size'           => $this->input->post('packing_size_comp')[$i],
                                                    'qty_per_ctn'            => $this->input->post('qty_comp')[$i],
                                                    'tipe_kemasan'           => $this->input->post('tipe_kemasan_comp')[$i],
                                                    'cbp_per_kemasan'        => $this->input->post('cbp_per_kemasan_comp')[$i],
                                                    'cbp_per_karton'         => $this->input->post('cbp_per_karton_comp')[$i],
                                                    'harga'                  => $this->input->post('harga_comp')[$i],
                                                    'date_created'           => date('Y-m-d'),
                                                    'time_created'           => date('H:i:s'),
                                                    'user_created'           => $user->id);
                                $saveComparison = $this->db->insert('m_product_comparison', $dataComparison);
                            }
                        }else{
                            if(!empty($_FILES['image_comparison']['name'][$i])){
                                $_FILES['image']['name']      = $_FILES['image_comparison']['name'][$i]; 
                                $_FILES['image']['type']      = $_FILES['image_comparison']['type'][$i]; 
                                $_FILES['image']['tmp_name']  = $_FILES['image_comparison']['tmp_name'][$i]; 
                                $_FILES['image']['error']     = $_FILES['image_comparison']['error'][$i]; 
                                $_FILES['image']['size']      = $_FILES['image_comparison']['size'][$i]; 
                                
                                $uploadPath = 'uploads/images/comparison/'; 
                                $config['upload_path'] = $uploadPath; 
                                $config['allowed_types'] = 'gif|jpg|png'; 
    
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
    
                                // Upload file to server
                                if($this->upload->do_upload('image')){
                                    // Uploaded file data
                                    $fileDataComp                       = $this->upload->data();
                                    $uploadDataComp[$i]['file_name']    = $fileDataComp['file_name'];
                                
                                    $model_comparison                   = ProductComparison::find($this->input->post('comparison_id')[$i]);
                                    $model_comparison->brand            = $this->input->post('brand')[$i];
                                    // $model_comparison->description      = $this->input->post('desc_comparison')[$i];
                                    $model_comparison->packing_size     = $this->input->post('packing_size_comp')[$i];
                                    $model_comparison->qty_per_ctn      = $this->input->post('qty_comp')[$i];
                                    $model_comparison->tipe_kemasan     = $this->input->post('tipe_kemasan_comp')[$i];
                                    $model_comparison->cbp_per_kemasan  = $this->input->post('cbp_per_kemasan_comp')[$i];
                                    $model_comparison->cbp_per_karton   = $this->input->post('cbp_per_karton_comp')[$i];
                                    $model_comparison->harga            = $this->input->post('harga_comp')[$i];
                                    $model_comparison->image            = $uploadDataComp[$i]['file_name'];
        
                                    $model_comparison->user_modified = $user->id;
                                    $model_comparison->date_modified = date('Y-m-d');
                                    $model_comparison->time_modified = date('H:i:s');
                                    $updateDetail = $model_comparison->save();
                                }else{
                                    $model_comparison                   = ProductComparison::find($this->input->post('comparison_id')[$i]);
                                    $model_comparison->brand            = $this->input->post('brand')[$i];
                                    // $model_comparison->description      = $this->input->post('desc_comparison')[$i];
                                    $model_comparison->image            = $model_comparison->image;
                                    $model_comparison->packing_size     = $this->input->post('packing_size_comp')[$i];
                                    $model_comparison->qty_per_ctn      = $this->input->post('qty_comp')[$i];
                                    $model_comparison->tipe_kemasan     = $this->input->post('tipe_kemasan_comp')[$i];
                                    $model_comparison->cbp_per_kemasan  = $this->input->post('cbp_per_kemasan_comp')[$i];
                                    $model_comparison->cbp_per_karton   = $this->input->post('cbp_per_karton_comp')[$i];
                                    $model_comparison->harga            = $this->input->post('harga_comp')[$i];
        
                                    $model_comparison->user_modified = $user->id;
                                    $model_comparison->date_modified = date('Y-m-d');
                                    $model_comparison->time_modified = date('H:i:s');
                                    $updateDetail = $model_comparison->save();
                                }   
                            }else{
                                $model_comparison                   = ProductComparison::find($this->input->post('comparison_id')[$i]);
                                $model_comparison->brand            = $this->input->post('brand')[$i];
                                // $model_comparison->description      = $this->input->post('desc_comparison')[$i];
                                $model_comparison->image            = $model_comparison->image;
                                $model_comparison->packing_size     = $this->input->post('packing_size_comp')[$i];
                                $model_comparison->qty_per_ctn      = $this->input->post('qty_comp')[$i];
                                $model_comparison->tipe_kemasan     = $this->input->post('tipe_kemasan_comp')[$i];
                                $model_comparison->cbp_per_kemasan  = $this->input->post('cbp_per_kemasan_comp')[$i];
                                $model_comparison->cbp_per_karton   = $this->input->post('cbp_per_karton_comp')[$i];
                                $model_comparison->harga            = $this->input->post('harga_comp')[$i];
    
                                $model_comparison->user_modified = $user->id;
                                $model_comparison->date_modified = date('Y-m-d');
                                $model_comparison->time_modified = date('H:i:s');
                                $updateDetail = $model_comparison->save();
                            }
                        }
                    }
                }

                if ($update) {
                    $data_new = array(
                        'Name'            => $name,
                        'Category'        => $category_id,
                        'Product Code'    => $product_code,
                        'Description'     => $description,
                        'Feature'         => $feature,
                        'Barcode Product' => $barcode_product,
                        'Barcode Carton'  => $barcode_carton,
                        'Packing Size'    => $packing_size,
                        'Qty'             => $qty,
                        'Length'          => $length,
                        'Height'          => $height,
                        'Width'           => $width,
                        'Volume'          => $volume,
                        'Weight'          => $weight,
                        'Tipe Kemasan'    => $tipe_kemasan,
                        'CBP Per Kemasan' => $cbp_per_kemasan,
                        'CBP Per Karton'  => $cbp_per_karton,
                        'Harga'           => $harga,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('product')) . " " .  $model->name . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 4);
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
            $dataComparison = ProductComparison::select('m_product_comparison.*')
                                                    ->join('m_product', 'm_product.id', '=', 'm_product_comparison.product_id')
                                                    ->where('m_product_comparison.product_id', $id)
                                                    ->where('m_product_comparison.deleted', 0)
                                                    ->where('m_product.deleted', 0)->get();
            $dataPrice = ProductPrice::select('m_product_price.*')
                                            ->join('m_product', 'm_product.id', '=', 'm_product_price.product_id')
                                            ->where('m_product_price.product_id', $id)
                                            ->where('m_product_price.deleted', 0)
                                            ->where('m_product.deleted', 0)->get();
            $model = array('status' => 'success', 'data' => Product::find($id), 'image' => ProductImage::where('product_id', $id)->where('deleted', '0')->get(), 'dataComparison' => $dataComparison, 'dataPrice' => $dataPrice);
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
                    'Product Code'    => $model->product_code,
                    'Description'     => $model->description,
                    'Feature'         => $model->feature,
                    'Barcode Product' => $barcode_product,
                    'Barcode Carton'  => $barcode_carton,
                    'Packing Size'    => $packing_size,
                    'Qty'             => $qty,
                    'Length'          => $length,
                    'Height'          => $height,
                    'Width'           => $width,
                    'Volume'          => $volume,
                    'Weight'          => $weight,
                );
                $message = "Delete " . strtolower(lang('product')) . " " .  $model->name . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 4);
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

    public function deleteImage() {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->get('id');
            $user = $this->ion_auth->user()->row();
            $model = ProductImage::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Image' => $model->image,
                );
                $message = "Delete " . strtolower(lang('product')) . " " .  $model->image . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 4);
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
        $data['products'] = Product::join('m_category', 'm_product.category_id', '=', 'm_category.id')->where('m_product.deleted', 0)->where('m_category.deleted', 0)->orderBy('m_product.id', 'DESC')->get();
        $html = $this->load->view('product/product/product_pdf', $data, true);
        $this->pdf_generator->generate($html, 'product pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=product.xls");
        $data['products'] = Product::join('m_category', 'm_product.category_id', '=', 'm_category.id')->where('m_product.deleted', 0)->where('m_category.deleted', 0)->orderBy('m_product.id', 'DESC')->get();
        $this->load->view('product/product/product_pdf', $data);
    }

    function catalog(){
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'product');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'product');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'product');
        $data['catalogs'] = Product::select('m_product.*', 'm_product.id as product_id')->where('m_product.deleted', '0')->get();
        $this->load->blade('product.views.product.catalog', $data);
    }

    function salestalk(){
        $id = $this->input->get('id');

        $data['add_access'] = $this->user_profile->get_user_access('Created', 'product');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'product');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'product');
        $data['product'] = Product::where('m_product.id', $id)->where('m_product.deleted', '0')->get();
        $this->load->blade('product.views.product.sales_talk', $data);
    }

    function comparison(){
        $id = $this->input->get('id');

        $data['add_access'] = $this->user_profile->get_user_access('Created', 'product');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'product');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'product');
        $data['product'] = Product::where('m_product.id', $id)->where('m_product.deleted', '0')->get();
        $data['comparisons'] = ProductComparison::where('product_id', $id)->where('deleted', '0')->get();
        $this->load->blade('product.views.product.comparison', $data);
    }

    function price(){
        $id = $this->input->get('id');

        $data['add_access'] = $this->user_profile->get_user_access('Created', 'product');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'product');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'product');
        $data['product'] = Product::where('m_product.id', $id)->where('m_product.deleted', '0')->get();
        $data['harga_beli_pcs_jabodetabeks'] = $this->getPrice($id, 'jabodetabek', 'harga_beli_per_pcs');
        $data['harga_beli_ctn_jabodetabeks'] = $this->getPrice($id, 'jabodetabek', 'harga_beli_per_ctn');
        $data['harga_jual_pcs_jabodetabeks'] = $this->getPrice($id, 'jabodetabek', 'harga_jual_per_pcs');
        $data['harga_jual_ctn_jabodetabeks'] = $this->getPrice($id, 'jabodetabek', 'harga_jual_per_ctn');
        $data['margin_value_pcs_jabodetabeks'] = $this->getPrice($id, 'jabodetabek', 'margin_value_per_pcs');
        $data['margin_value_ctn_jabodetabeks'] = $this->getPrice($id, 'jabodetabek', 'margin_value_per_ctn');
        $data['margin_percent_pcs_jabodetabeks'] = $this->getPrice($id, 'jabodetabek', 'margin_percent_per_pcs');
        $data['margin_percent_ctn_jabodetabeks'] = $this->getPrice($id, 'jabodetabek', 'margin_percent_per_ctn');
        $data['top_jabodetabeks'] = $this->getPrice($id, 'jabodetabek', 'top');

        $data['harga_beli_pcs_nons'] = $this->getPrice($id, 'non_jabodetabek', 'harga_beli_per_pcs');
        $data['harga_beli_ctn_nons'] = $this->getPrice($id, 'non_jabodetabek', 'harga_beli_per_ctn');
        $data['harga_jual_pcs_nons'] = $this->getPrice($id, 'non_jabodetabek', 'harga_jual_per_pcs');
        $data['harga_jual_ctn_nons'] = $this->getPrice($id, 'non_jabodetabek', 'harga_jual_per_ctn');
        $data['margin_value_pcs_nons'] = $this->getPrice($id, 'non_jabodetabek', 'margin_value_per_pcs');
        $data['margin_value_ctn_nons'] = $this->getPrice($id, 'non_jabodetabek', 'margin_value_per_ctn');
        $data['margin_percent_pcs_nons'] = $this->getPrice($id, 'non_jabodetabek', 'margin_percent_per_pcs');
        $data['margin_percent_ctn_nons'] = $this->getPrice($id, 'non_jabodetabek', 'margin_percent_per_ctn');
        $data['top_nons'] = $this->getPrice($id, 'non_jabodetabek', 'top');
        $this->load->blade('product.views.product.price', $data);
    }

    public function getPrice($id, $area, $type){
        $data = ProductPrice::select('m_product_price.type', 'value')->join('m_product', 'm_product_price.product_id', '=', 'm_product.id')
                    ->where('product_id', $id)
                    ->where('area', $area)
                    ->where('m_product_price.description', $type)
                    ->where('m_product_price.deleted', '0')
                    ->where('m_product.deleted', '0')->get();

        return($data);
    }
}
