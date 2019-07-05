<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dipos extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'dipo')){
            redirect('dashboard', 'refresh');            
        }

    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'dipo');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'dipo');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'dipo');

        $data['cities'] = City::where('deleted', 0)->get();        
        $data['zonas'] = Zona::where('deleted', 0)->get();

        $this->load->blade('dipo.views.dipo.page', $data);
    }

    public function fetch_data() {
        $user = $this->ion_auth->user()->row();

        $database_columns = array(
            'm_dipo_partner.id',
            'm_dipo_partner.type',
            'code',
            'm_dipo_partner.name',
            'pic',
            'address',
            'phone',
            'email',
            'm_city.name as city_name',
            'm_district.name as subdistrict_name',
            // 'm_zona.name as zona_name',
            // 'm_dipo_partner.zona_id',
            'latitude',
            'longitude',
            // 'pic',
            'top',
            'm_dipo_partner.date_created',
        );

        $header_columns = array(
            'code',
            'm_dipo_partner.name',
            'pic',
            'address',
            'phone',
            'email',
            'city_name',
            'subdistrict_name',
            // 'zona_name',
            // 'm_dipo_partner.zona_id',
            'latitude',
            'longitude',
            // 'pic',
            'top',
            'm_dipo_partner.date_created',
        );

        $from = "m_dipo_partner";
        $where = "m_dipo_partner.type = 'dipo' AND m_dipo_partner.deleted = 0";
        if($user->group_id != '1'){
            $where .= " AND m_dipo_partner.user_created = ". $user->id;
        }

        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');

        $join[] = array('m_city', 'm_city.id = m_dipo_partner.city', 'left');
        $join[] = array('m_district', 'm_district.id = m_dipo_partner.subdistrict', 'left');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            
            $where .= " AND (";
            $where .= "code LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_dipo_partner.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "pic LIKE '%" . $sSearch . "%' OR ";
            $where .= "address LIKE '%" . $sSearch . "%' OR ";
            $where .= "phone LIKE '%" . $sSearch . "%' OR ";
            $where .= "email LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_city.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_district.name LIKE '%" . $sSearch . "%' OR ";
            // $where .= "m_zona.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "latitude LIKE '%" . $sSearch . "%' OR ";
            $where .= "longitude LIKE '%" . $sSearch . "%' OR ";
            // $where .= "pic LIKE '%" . $sSearch . "%' OR ";
            $where .= "top LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_dipo_partner.date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('m_dipo_partner.id');
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
            if($this->user_profile->get_user_access('Updated', 'dipo')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'dipo')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->code;
            $row_value[] = $row->name;
            $row_value[] = $row->pic;
            $row_value[] = $row->address;
            $row_value[] = $row->phone;
            $row_value[] = $row->email == "" ? "-" : $row->email;
            $row_value[] = $row->city_name == "" ? "-" : ucwords(strtolower($row->city_name));
            $row_value[] = $row->subdistrict_name == "" ? "-" : $row->subdistrict_name;
            // $row_value[] = $row->zona_name;
            // $row_value[] = $row->zona_id == 0 ? "-" : Zona::find($row->zona_id)->name;
            $row_value[] = $row->latitude == "" ? "-" : $row->latitude;
            $row_value[] = $row->longitude == "" ? "-" : $row->longitude;
            // $row_value[] = $row->pic == "" ? "-" : $row->pic;
            $row_value[] = $row->top == "" ? "-" : strtoupper($row->top);
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
            $id_dipo = $this->input->post('id');
            $get_dipo = Dipo::where('code', $this->input->post('code'))->where('deleted', 0)->first();
            if (empty($id_dipo)) {
                if (!empty($get_dipo->name)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $code = strtoupper($this->input->post('code'));
                    $type = 'dipo';
                    $username = $this->input->post('username');
                    $name = ucwords($this->input->post('name'));
                    $pic = ucwords($this->input->post('pic'));
                    $phone = $this->input->post('phone');
                    $fax = $this->input->post('fax');
                    $email = $this->input->post('email');
                    $address = $this->input->post('address');
                    $billing_address = $this->input->post('billing_address');
                    $city = $this->input->post('city');
                    $subdistrict = $this->input->post('subdistrict');
                    $postal_code = $this->input->post('postal_code');
                    $latitude = $this->input->post('latitude');
                    $longitude = $this->input->post('longitude');
                    $purchase_price_type = $this->input->post('purchase_price_type');
                    $taxable = $this->input->post('taxable');
                    $npwp = $this->input->post('npwp');
                    $tax_name = $this->input->post('tax_name');
                    $tax_invoice_address = $this->input->post('tax_invoice_address');
                    $tax_payment_method = $this->input->post('tax_payment_method');
                    $top = $this->input->post('top');
                    $tax_credit_ceiling = $this->input->post('tax_credit_ceiling');
                    $account_number = $this->input->post('account_number');
                    $account_name = $this->input->post('account_name');
                    $bank_name = $this->input->post('bank_name');
                    $bank_code = $this->input->post('bank_code');
                    $account_address = $this->input->post('account_address');
                    $guarantee_form = $this->input->post('guarantee_form');
                    $guarantee_receipt = $this->input->post('guarantee_receipt');
                    $safety_box = $this->input->post('safety_box');

                    $guarantee_photo = '';
                    if(!empty($_FILES['guarantee_photo']['name'])){
                        $_FILES['file']['name']     = $_FILES['guarantee_photo']['name'];
                        $_FILES['file']['type']     = $_FILES['guarantee_photo']['type'];
                        $_FILES['file']['tmp_name'] = $_FILES['guarantee_photo']['tmp_name'];
                        $_FILES['file']['error']     = $_FILES['guarantee_photo']['error'];
                        $_FILES['file']['size']     = $_FILES['guarantee_photo']['size'];
                        
                        // File upload configuration
                        $uploadPath = 'uploads/images/guarantees/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['file_name'] = date('YmdHis').rand(10,99);

                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        
                        // Upload file to server
                        if($this->upload->do_upload('file')){
                            // Uploaded file data
                            $fileData = $this->upload->data();
                            $guarantee_photo = $fileData['file_name'];
                        }
                    }

                    $customer_photo = '';
                    if(!empty($_FILES['customer_photo']['name'])){
                        $_FILES['file']['name']     = $_FILES['customer_photo']['name'];
                        $_FILES['file']['type']     = $_FILES['customer_photo']['type'];
                        $_FILES['file']['tmp_name'] = $_FILES['customer_photo']['tmp_name'];
                        $_FILES['file']['error']     = $_FILES['customer_photo']['error'];
                        $_FILES['file']['size']     = $_FILES['customer_photo']['size'];
                        
                        // File upload configuration
                        $uploadPath = 'uploads/images/customers/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['file_name'] = date('YmdHis').rand(10,99);

                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        
                        // Upload file to server
                        if($this->upload->do_upload('file')){
                            // Uploaded file data
                            $fileData = $this->upload->data();
                            $customer_photo = $fileData['file_name'];
                        }
                    }

                    $house_photo = '';
                    if(!empty($_FILES['house_photo']['name'])){
                        $_FILES['file']['name']     = $_FILES['house_photo']['name'];
                        $_FILES['file']['type']     = $_FILES['house_photo']['type'];
                        $_FILES['file']['tmp_name'] = $_FILES['house_photo']['tmp_name'];
                        $_FILES['file']['error']     = $_FILES['house_photo']['error'];
                        $_FILES['file']['size']     = $_FILES['house_photo']['size'];
                        
                        // File upload configuration
                        $uploadPath = 'uploads/images/houses/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['file_name'] = date('YmdHis').rand(10,99);

                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        
                        // Upload file to server
                        if($this->upload->do_upload('file')){
                            // Uploaded file data
                            $fileData = $this->upload->data();
                            $house_photo = $fileData['file_name'];
                        }
                    }

                    $warehouse_photo = '';
                    if(!empty($_FILES['warehouse_photo']['name'])){
                        $_FILES['file']['name']     = $_FILES['warehouse_photo']['name'];
                        $_FILES['file']['type']     = $_FILES['warehouse_photo']['type'];
                        $_FILES['file']['tmp_name'] = $_FILES['warehouse_photo']['tmp_name'];
                        $_FILES['file']['error']     = $_FILES['warehouse_photo']['error'];
                        $_FILES['file']['size']     = $_FILES['warehouse_photo']['size'];
                        
                        // File upload configuration
                        $uploadPath = 'uploads/images/warehouses/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['file_name'] = date('YmdHis').rand(10,99);

                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        
                        // Upload file to server
                        if($this->upload->do_upload('file')){
                            // Uploaded file data
                            $fileData = $this->upload->data();
                            $warehouse_photo = $fileData['file_name'];
                        }
                    }

                    $model = new Dipo();
                    $model->type = $type;
                    $model->code = $code;
                    $model->name = $name;
                    $model->pic = $pic;
                    $model->phone = $phone;
                    $model->fax = $fax;
                    $model->email = $email;
                    $model->address = $address;
                    $model->billing_address = $billing_address;
                    $model->city = $city;
                    $model->subdistrict = $subdistrict;
                    $model->postal_code = $postal_code;
                    $model->latitude = $latitude;
                    $model->longitude = $longitude;
                    $model->purchase_price_type = $purchase_price_type;
                    $model->taxable = $taxable;
                    $model->npwp = $npwp;
                    $model->tax_name = $tax_name;
                    $model->tax_invoice_address = $tax_invoice_address;
                    $model->tax_payment_method = $tax_payment_method;
                    $model->top = $top;
                    $model->tax_credit_ceiling = $tax_credit_ceiling;
                    $model->account_number = $account_number;
                    $model->account_name = $account_name;
                    $model->bank_name = $bank_name;
                    $model->bank_code = $bank_code;
                    $model->account_address = $account_address;
                    $model->guarantee_form = $guarantee_form;
                    $model->guarantee_receipt = $guarantee_receipt;
                    $model->safety_box = $safety_box;
                    $model->guarantee_photo = $guarantee_photo;
                    $model->customer_photo = $customer_photo;
                    $model->house_photo = $house_photo;
                    $model->warehouse_photo = $warehouse_photo;
                    
                    $model->user_created = $user->id;
                    $model->date_created = date('Y-m-d');
                    $model->time_created = date('H:i:s');
                    $save = $model->save();
                    if ($save) {
                        $model_code = Code::where('code', $code)->where('username', $username)->where('type', $type)->first();
                        $model_code->status = 1;
                        $model_code->user_modified = $user->id;
                        $model_code->date_modified = date('Y-m-d');
                        $model_code->time_modified = date('H:i:s');
                        $model_code->save();

                        // CREATE USER
                        if($type == "dipo") {
                            $group_id = 2;
                        }
                        else if($type == "customer") {
                            $group_id = 4;
                        }
                        else {
                            $group_id = 3;                                
                        }

                        $group = array($group_id);
                        
                        $data = array(
                            "full_name" => $name,
                            "company" => 'Kanaka',
                            "group_id" => $group_id,
                            "dipo_partner_id" => $model->id,
                            "address" => $address,
                            "city" => $city,
                            "phone" => str_replace("_", "", $phone),
                            "created_date" => date('Y-m-d H:i:s'),
                            "avatar" => 'default_avatar.jpg'
                        );

                        $this->ion_auth->register($username, $code, $email, $data, $group);

                        $data_notif = array(
                            'Code' => $code == "" ? "-" : $code,
                            'Type' => $type == "" ? "-" : ucwords(str_replace('_', ' ', $type)),
                            'Name' => $name == "" ? "-" : $name,
                            'PIC Name' => $pic == "" ? "-" : $pic,
                            'Phone' => $phone == "" ? "-" : $phone,
                            'Fax' => $fax == "" ? "-" : $fax,
                            'Email' => $email == "" ? "-" : $email,
                            'Address' => $address == "" ? "-" : $address,
                            'Billing Address' => $billing_address == "" ? "-" : $billing_address,
                            'City' => $city == "" ? "-" : ucwords(strtolower(City::find($city)->name)),
                            'District' => $subdistrict == "" ? "-" : District::find($subdistrict)->name,
                            'Postal Code' => $postal_code == "" ? "-" : $postal_code,
                            'Latitude' => $latitude == "" ? "-" : $latitude,
                            'Longitude' => $longitude == "" ? "-" : $longitude,
                            'Purchase Price Type' => $purchase_price_type == "" ? "-" : ucwords(str_replace('_', ' ', $purchase_price_type)),
                            'Taxable' => $taxable == "0" ? lang('no') : lang('yes'),
                            'NPWP' => $npwp == "" ? "-" : $npwp,
                            'Tax Name' => $tax_name == "" ? "-" : $tax_name,
                            'Tax Invoice Address' => $tax_invoice_address == "" ? "-" : $tax_invoice_address,
                            'Tax Payment Method' => $tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $tax_payment_method)),
                            'TOP' => $top == "" ? "-" : strtoupper($top),
                            'Tax Credit Ceiling' => $tax_credit_ceiling == "" ? "-" : $tax_credit_ceiling,
                            'Account Number' => $account_number == "" ? "-" : $account_number,
                            'Account Name' => $account_name == "" ? "-" : $account_name,
                            'Bank Name' => $bank_name == "" ? "-" : $bank_name,
                            'Bank Code' => $bank_code == "" ? "-" : $bank_code,
                            'Account Address' => $account_address == "" ? "-" : $account_address,
                            'Guarantee Form' => $guarantee_form == "" ? "-" : $guarantee_form,
                            'Guarantee Receipt' => $guarantee_receipt == "" ? "-" : $guarantee_receipt,
                            'Safety Box' => $safety_box == "" ? "-" : $safety_box,
                            'Guarantee Photo' => $guarantee_photo == "" ? "-" : $guarantee_photo,
                            'Customer Photo' => $customer_photo == "" ? "-" : $customer_photo,
                            'House Photo' => $house_photo == "" ? "-" : $house_photo,
                            'Warehouse Photo' => $warehouse_photo == "" ? "-" : $warehouse_photo,
                        );
                        $message = "Add " . lang('dipo') . " " . $name . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 6);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_dipo)) {
                $model = Dipo::find($id_dipo);
                $code = strtoupper($this->input->post('code'));
                $type = 'dipo';
                $name = ucwords($this->input->post('name'));
                $pic = ucwords($this->input->post('pic'));
                $phone = $this->input->post('phone');
                $fax = $this->input->post('fax');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $billing_address = $this->input->post('billing_address');
                $city = $this->input->post('city');
                $subdistrict = $this->input->post('subdistrict');
                $postal_code = $this->input->post('postal_code');
                $latitude = $this->input->post('latitude');
                $longitude = $this->input->post('longitude');
                $purchase_price_type = $this->input->post('purchase_price_type');
                $taxable = $this->input->post('taxable');
                $npwp = $this->input->post('npwp');
                $tax_name = $this->input->post('tax_name');
                $tax_invoice_address = $this->input->post('tax_invoice_address');
                $tax_payment_method = $this->input->post('tax_payment_method');
                $top = $this->input->post('top');
                $tax_credit_ceiling = $this->input->post('tax_credit_ceiling');
                $account_number = $this->input->post('account_number');
                $account_name = $this->input->post('account_name');
                $bank_name = $this->input->post('bank_name');
                $bank_code = $this->input->post('bank_code');
                $account_address = $this->input->post('account_address');
                $guarantee_form = $this->input->post('guarantee_form');
                $guarantee_receipt = $this->input->post('guarantee_receipt');
                $safety_box = $this->input->post('safety_box');
            
                $guarantee_photo = $model->guarantee_photo;
                if(!empty($_FILES['guarantee_photo']['name'])){
                    $_FILES['file']['name']     = $_FILES['guarantee_photo']['name'];
                    $_FILES['file']['type']     = $_FILES['guarantee_photo']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['guarantee_photo']['tmp_name'];
                    $_FILES['file']['error']     = $_FILES['guarantee_photo']['error'];
                    $_FILES['file']['size']     = $_FILES['guarantee_photo']['size'];
                    
                    // File upload configuration
                    $uploadPath = 'uploads/images/guarantees/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = date('YmdHis').rand(10,99);

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    // Upload file to server
                    if($this->upload->do_upload('file')){
                        // Uploaded file data
                        $fileData = $this->upload->data();
                        $guarantee_photo = $fileData['file_name'];
                    }
                }

                $customer_photo = $model->customer_photo;
                if(!empty($_FILES['customer_photo']['name'])){
                    $_FILES['file']['name']     = $_FILES['customer_photo']['name'];
                    $_FILES['file']['type']     = $_FILES['customer_photo']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['customer_photo']['tmp_name'];
                    $_FILES['file']['error']     = $_FILES['customer_photo']['error'];
                    $_FILES['file']['size']     = $_FILES['customer_photo']['size'];
                    
                    // File upload configuration
                    $uploadPath = 'uploads/images/customers/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = date('YmdHis').rand(10,99);

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    // Upload file to server
                    if($this->upload->do_upload('file')){
                        // Uploaded file data
                        $fileData = $this->upload->data();
                        $customer_photo = $fileData['file_name'];
                    }
                }

                $house_photo = $model->house_photo;
                if(!empty($_FILES['house_photo']['name'])){
                    $_FILES['file']['name']     = $_FILES['house_photo']['name'];
                    $_FILES['file']['type']     = $_FILES['house_photo']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['house_photo']['tmp_name'];
                    $_FILES['file']['error']     = $_FILES['house_photo']['error'];
                    $_FILES['file']['size']     = $_FILES['house_photo']['size'];
                    
                    // File upload configuration
                    $uploadPath = 'uploads/images/houses/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = date('YmdHis').rand(10,99);

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    // Upload file to server
                    if($this->upload->do_upload('file')){
                        // Uploaded file data
                        $fileData = $this->upload->data();
                        $house_photo = $fileData['file_name'];
                    }
                }

                $warehouse_photo = $model->warehouse_photo;
                if(!empty($_FILES['warehouse_photo']['name'])){
                    $_FILES['file']['name']     = $_FILES['warehouse_photo']['name'];
                    $_FILES['file']['type']     = $_FILES['warehouse_photo']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['warehouse_photo']['tmp_name'];
                    $_FILES['file']['error']     = $_FILES['warehouse_photo']['error'];
                    $_FILES['file']['size']     = $_FILES['warehouse_photo']['size'];
                    
                    // File upload configuration
                    $uploadPath = 'uploads/images/warehouses/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = date('YmdHis').rand(10,99);

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    // Upload file to server
                    if($this->upload->do_upload('file')){
                        // Uploaded file data
                        $fileData = $this->upload->data();
                        $warehouse_photo = $fileData['file_name'];
                    }
                }

                $data_old = array(
                    'Code' => $model->code == "" ? "-" : $model->code,
                    'Type' => $model->type == "" ? "-" : ucwords(str_replace('_', ' ', $model->type)),
                    'Name' => $model->name == "" ? "-" : $model->name,
                    'PIC Name' => $model->pic == "" ? "-" : $model->pic,
                    'Phone' => $model->phone == "" ? "-" : $model->phone,
                    'Fax' => $model->fax == "" ? "-" : $model->fax,
                    'Email' => $model->email == "" ? "-" : $model->email,
                    'Address' => $model->address == "" ? "-" : $model->address,
                    'Billing Address' => $model->billing_address == "" ? "-" : $model->billing_address,
                    'City' => $model->city == "" ? "-" : ucwords(strtolower(City::find($model->city)->name)),
                    'District' => $model->subdistrict == "" ? "-" : District::find($model->subdistrict)->name,
                    'Postal Code' => $model->postal_code == "" ? "-" : $model->postal_code,
                    'Latitude' => $model->latitude == "" ? "-" : $model->latitude,
                    'Longitude' => $model->longitude == "" ? "-" : $model->longitude,
                    'Purchase Price Type' => $model->purchase_price_type == "" ? "-" : ucwords(str_replace('_', ' ', $model->purchase_price_type)),
                    'Taxable' => $model->taxable == "0" ? lang('no') : lang('yes'),
                    'NPWP' => $model->npwp == "" ? "-" : $model->npwp,
                    'Tax Name' => $model->tax_name == "" ? "-" : $model->tax_name,
                    'Tax Invoice Address' => $model->tax_invoice_address == "" ? "-" : $model->tax_invoice_address,
                    'Tax Payment Method' => $model->tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $model->tax_payment_method)),
                    'TOP' => $model->top == "" ? "-" : strtoupper($model->top),
                    'Tax Credit Ceiling' => $model->tax_credit_ceiling == "" ? "-" : $model->tax_credit_ceiling,
                    'Account Number' => $model->account_number == "" ? "-" : $model->account_number,
                    'Account Name' => $model->account_name == "" ? "-" : $model->account_name,
                    'Bank Name' => $model->bank_name == "" ? "-" : $model->bank_name,
                    'Bank Code' => $model->bank_code == "" ? "-" : $model->bank_code,
                    'Account Address' => $model->account_address == "" ? "-" : $model->account_address,
                    'Guarantee Form' => $model->guarantee_form == "" ? "-" : $model->guarantee_form,
                    'Guarantee Receipt' => $model->guarantee_receipt == "" ? "-" : $model->guarantee_receipt,
                    'Safety Box' => $model->safety_box == "" ? "-" : $model->safety_box,
                    'Guarantee Photo' => $model->guarantee_photo == "" ? "-" : $model->guarantee_photo,
                    'Customer Photo' => $model->customer_photo == "" ? "-" : $model->customer_photo,
                    'House Photo' => $model->house_photo == "" ? "-" : $model->house_photo,
                    'Warehouse Photo' => $model->warehouse_photo == "" ? "-" : $model->warehouse_photo,
                );

                $model->code = $code;
                $model->name = $name;
                $model->pic = $pic;
                $model->phone = $phone;
                $model->fax = $fax;
                $model->email = $email;
                $model->address = $address;
                $model->billing_address = $billing_address;
                $model->city = $city;
                $model->subdistrict = $subdistrict;
                $model->postal_code = $postal_code;
                $model->latitude = $latitude;
                $model->longitude = $longitude;
                $model->purchase_price_type = $purchase_price_type;
                $model->taxable = $taxable;
                $model->npwp = $npwp;
                $model->tax_name = $tax_name;
                $model->tax_invoice_address = $tax_invoice_address;
                $model->tax_payment_method = $tax_payment_method;
                $model->top = $top;
                $model->tax_credit_ceiling = $tax_credit_ceiling;
                $model->account_number = $account_number;
                $model->account_name = $account_name;
                $model->bank_name = $bank_name;
                $model->bank_code = $bank_code;
                $model->account_address = $account_address;
                $model->guarantee_form = $guarantee_form;
                $model->guarantee_receipt = $guarantee_receipt;
                $model->safety_box = $safety_box;
                $model->guarantee_photo = $guarantee_photo;
                $model->customer_photo = $customer_photo;
                $model->house_photo = $house_photo;
                $model->warehouse_photo = $warehouse_photo;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Code' => $code == "" ? "-" : $code,
                        'Type' => $type == "" ? "-" : ucwords(str_replace('_', ' ', $type)),
                        'Name' => $name == "" ? "-" : $name,
                        'PIC Name' => $pic == "" ? "-" : $pic,
                        'Phone' => $phone == "" ? "-" : $phone,
                        'Fax' => $fax == "" ? "-" : $fax,
                        'Email' => $email == "" ? "-" : $email,
                        'Address' => $address == "" ? "-" : $address,
                        'Billing Address' => $billing_address == "" ? "-" : $billing_address,
                        'City' => $city == "" ? "-" : ucwords(strtolower(City::find($city)->name)),
                        'District' => $subdistrict == "" ? "-" : District::find($subdistrict)->name,
                        'Postal Code' => $postal_code == "" ? "-" : $postal_code,
                        'Latitude' => $latitude == "" ? "-" : $latitude,
                        'Longitude' => $longitude == "" ? "-" : $longitude,
                        'Purchase Price Type' => $purchase_price_type == "" ? "-" : ucwords(str_replace('_', ' ', $purchase_price_type)),
                        'Taxable' => $taxable == "0" ? lang('no') : lang('yes'),
                        'NPWP' => $npwp == "" ? "-" : $npwp,
                        'Tax Name' => $tax_name == "" ? "-" : $tax_name,
                        'Tax Invoice Address' => $tax_invoice_address == "" ? "-" : $tax_invoice_address,
                        'Tax Payment Method' => $tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $tax_payment_method)),
                        'TOP' => $top == "" ? "-" : strtoupper($top),
                        'Tax Credit Ceiling' => $tax_credit_ceiling == "" ? "-" : $tax_credit_ceiling,
                        'Account Number' => $account_number == "" ? "-" : $account_number,
                        'Account Name' => $account_name == "" ? "-" : $account_name,
                        'Bank Name' => $bank_name == "" ? "-" : $bank_name,
                        'Bank Code' => $bank_code == "" ? "-" : $bank_code,
                        'Account Address' => $account_address == "" ? "-" : $account_address,
                        'Guarantee Form' => $guarantee_form == "" ? "-" : $guarantee_form,
                        'Guarantee Receipt' => $guarantee_receipt == "" ? "-" : $guarantee_receipt,
                        'Safety Box' => $safety_box == "" ? "-" : $safety_box,
                        'Guarantee Photo' => $guarantee_photo == "" ? "-" : $guarantee_photo,
                        'Customer Photo' => $customer_photo == "" ? "-" : $customer_photo,
                        'House Photo' => $house_photo == "" ? "-" : $house_photo,
                        'Warehouse Photo' => $warehouse_photo == "" ? "-" : $warehouse_photo,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . lang('dipo') . " " .  $model->name . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 6);
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
            $model = Dipo::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Code' => $model->code == "" ? "-" : $model->code,
                    'Type' => $model->type == "" ? "-" : ucwords(str_replace('_', ' ', $model->type)),
                    'Name' => $model->name == "" ? "-" : $model->name,
                    'PIC Name' => $model->pic == "" ? "-" : $model->pic,
                    'Phone' => $model->phone == "" ? "-" : $model->phone,
                    'Fax' => $model->fax == "" ? "-" : $model->fax,
                    'Email' => $model->email == "" ? "-" : $model->email,
                    'Address' => $model->address == "" ? "-" : $model->address,
                    'Billing Address' => $model->billing_address == "" ? "-" : $model->billing_address,
                    'City' => $model->city == "" ? "-" : ucwords(strtolower(City::find($model->city)->name)),
                    'District' => $model->subdistrict == "" ? "-" : District::find($model->subdistrict)->name,
                    'Postal Code' => $model->postal_code == "" ? "-" : $model->postal_code,
                    'Latitude' => $model->latitude == "" ? "-" : $model->latitude,
                    'Longitude' => $model->longitude == "" ? "-" : $model->longitude,
                    'Purchase Price Type' => $model->purchase_price_type == "" ? "-" : ucwords(str_replace('_', ' ', $model->purchase_price_type)),
                    'Taxable' => $model->taxable == "0" ? lang('no') : lang('yes'),
                    'NPWP' => $model->npwp == "" ? "-" : $model->npwp,
                    'Tax Name' => $model->tax_name == "" ? "-" : $model->tax_name,
                    'Tax Invoice Address' => $model->tax_invoice_address == "" ? "-" : $model->tax_invoice_address,
                    'Tax Payment Method' => $model->tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $model->tax_payment_method)),
                    'TOP' => $model->top == "" ? "-" : strtoupper($model->top),
                    'Tax Credit Ceiling' => $model->tax_credit_ceiling == "" ? "-" : $model->tax_credit_ceiling,
                    'Account Number' => $model->account_number == "" ? "-" : $model->account_number,
                    'Account Name' => $model->account_name == "" ? "-" : $model->account_name,
                    'Bank Name' => $model->bank_name == "" ? "-" : $model->bank_name,
                    'Bank Code' => $model->bank_code == "" ? "-" : $model->bank_code,
                    'Account Address' => $model->account_address == "" ? "-" : $model->account_address,
                    'Guarantee Form' => $model->guarantee_form == "" ? "-" : $model->guarantee_form,
                    'Guarantee Receipt' => $model->guarantee_receipt == "" ? "-" : $model->guarantee_receipt,
                    'Safety Box' => $model->safety_box == "" ? "-" : $model->safety_box,
                    'Guarantee Photo' => $model->guarantee_photo == "" ? "-" : $model->guarantee_photo,
                    'Customer Photo' => $model->customer_photo == "" ? "-" : $model->customer_photo,
                    'House Photo' => $model->house_photo == "" ? "-" : $model->house_photo,
                    'Warehouse Photo' => $model->warehouse_photo == "" ? "-" : $model->warehouse_photo,
                );
                $message = "Delete " . lang('dipo') . " " .  $model->name . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 6);
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
        $data['dipos'] = Dipo::select('m_dipo_partner.*')->where('m_dipo_partner.type', 'dipo')->where('m_dipo_partner.deleted', 0)->orderBy('m_dipo_partner.id', 'DESC')->get();
        $data['quote'] = "";
        $html = $this->load->view('dipo/dipo/dipo_pdf', $data, true);
        $this->pdf_generator->generate($html, 'dipo pdf', $orientation='Landscape');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=dipo.xls");

        $user = $this->ion_auth->user()->row();
        if($user->group_id != '1'){
            $data['dipos'] = Dipo::select('m_dipo_partner.*')->where('m_dipo_partner.type', 'dipo')->where('m_dipo_partner.user_created', $user->id)->where('m_dipo_partner.deleted', 0)->orderBy('m_dipo_partner.id', 'DESC')->get();
        }
        else{
            $data['dipos'] = Dipo::select('m_dipo_partner.*')->where('m_dipo_partner.type', 'dipo')->where('m_dipo_partner.deleted', 0)->orderBy('m_dipo_partner.id', 'DESC')->get();
        }

        $data['quote'] = "'";
        $this->load->view('dipo/dipo/dipo_pdf', $data);
    }

}
