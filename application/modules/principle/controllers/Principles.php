<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Principles extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'vendor')){
            redirect('dashboard', 'refresh');            
        }
        
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'vendor');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'vendor');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'vendor');

        $this->load->blade('principle.views.principle.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            'id',
            'code',
            'name',
            'address',
            'product',
            'brand',
            'top',
            'pic',
            'phone_office',
            'phone_personal',
            'fax',
            'email_office',
            'email_personal',
            'web',
            'reg_disc',
            'add_disc_1',
            'add_disc_2',
            'btw_disc',
            'date_created'
        );

        $header_columns = array(
            'code',
            'name',
            'address',
            'product',
            'brand',
            'top',
            'pic',
            'phone_office',
            'phone_personal',
            'fax',
            'email_office',
            'email_personal',
            'web',
            'reg_disc',
            'add_disc_1',
            'add_disc_2',
            'btw_disc',
            'date_created'
        );

        $from = "m_principle";
        $where = "deleted = 0";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "code LIKE '%" . $sSearch . "%' OR ";
            $where .= "name LIKE '%" . $sSearch . "%' OR ";
            $where .= "address LIKE '%" . $sSearch . "%' OR ";
            $where .= "product LIKE '%" . $sSearch . "%' OR ";
            $where .= "brand LIKE '%" . $sSearch . "%' OR ";
            $where .= "top LIKE '%" . $sSearch . "%' OR ";
            $where .= "pic LIKE '%" . $sSearch . "%' OR ";
            $where .= "phone_office LIKE '%" . $sSearch . "%' OR ";
            $where .= "phone_personal LIKE '%" . $sSearch . "%' OR ";
            $where .= "fax LIKE '%" . $sSearch . "%' OR ";
            $where .= "email_office LIKE '%" . $sSearch . "%' OR ";
            $where .= "email_personal LIKE '%" . $sSearch . "%' OR ";
            $where .= "web LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_principle.date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('m_principle.id');
        $this->datatables->config('database_columns', $database_columns);
        $this->datatables->config('from', $from);
        $this->datatables->config('where', $where);
        $this->datatables->config('order_by', $order_by);
        $selected_data = $this->datatables->get_select_data();
        $aa_data = $selected_data['aaData'];
        $new_aa_data = array();
        
        foreach ($aa_data as $row) {
            $row_value = array();

            $btn_action = '';
            if($this->user_profile->get_user_access('Updated', 'vendor')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'vendor')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->code;
            $row_value[] = $row->name;
            $row_value[] = $row->address;
            $row_value[] = $row->product;
            $row_value[] = $row->brand;
            $row_value[] = $row->top;
            $row_value[] = $row->pic;
            $row_value[] = $row->phone_office;
            $row_value[] = $row->phone_personal;
            $row_value[] = $row->fax;
            $row_value[] = $row->email_office;
            $row_value[] = $row->email_personal;
            $row_value[] = $row->web;
            $row_value[] = $row->reg_disc;
            $row_value[] = $row->add_disc_1;
            $row_value[] = $row->add_disc_2;
            $row_value[] = $row->btw_disc;
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
            $id_principle = $this->input->post('id');
            $get_principle = Principle::where('code' , $this->input->post('code'))->where('deleted', 0)->first();
            if (empty($id_principle)) {
                if (!empty($get_principle->name)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $code = strtoupper($this->input->post('code'));
                    $name = ucwords($this->input->post('name'));
                    $phone_office = $this->input->post('phone_office');
                    $fax = $this->input->post('fax');
                    $email_office = $this->input->post('email_office');
                    $address = $this->input->post('address');
                    $postal_code = $this->input->post('postal_code');
                    $latitude = $this->input->post('latitude');
                    $longitude = $this->input->post('longitude');
                    $pic_operational = $this->input->post('pic_operational');
                    $pic = $this->input->post('pic');
                    $phone_personal = $this->input->post('phone_personal');
                    $pic_finance = $this->input->post('pic_finance');
                    $pic_finance_name = $this->input->post('pic_finance_name');
                    $pic_finance_phone = $this->input->post('pic_finance_phone');
                    $taxable = $this->input->post('taxable');
                    $npwp = $this->input->post('npwp');
                    $tax_name = $this->input->post('tax_name');
                    $tdp = $this->input->post('tdp');
                    $siup = $this->input->post('siup');
                    $sppkp = $this->input->post('sppkp');
                    $tax_company_name = $this->input->post('tax_company_name');
                    $tax_company_address = $this->input->post('tax_company_address');
                    $tax_payment_method = $this->input->post('tax_payment_method');
                    $top = $this->input->post('top');
                    $tax_credit_ceiling = $this->input->post('tax_credit_ceiling');
                    $account_number = $this->input->post('account_number');
                    $account_name = $this->input->post('account_name');
                    $bank_name = $this->input->post('bank_name');
                    $bank_code = $this->input->post('bank_code');
                    $account_address = $this->input->post('account_address');
                    
                    $model = new principle();
                    $model->code = $code;
                    $model->name = $name;
                    $model->phone_office = $phone_office;
                    $model->fax = $fax;
                    $model->email_office = $email_office;
                    $model->address = $address;
                    $model->postal_code = $postal_code;
                    $model->latitude = $latitude;
                    $model->longitude = $longitude;
                    $model->pic_operational = $pic_operational;
                    $model->pic = $pic;
                    $model->phone_personal = $phone_personal;
                    $model->pic_finance = $pic_finance;
                    $model->pic_finance_name = $pic_finance_name;
                    $model->pic_finance_phone = $pic_finance_phone;
                    $model->taxable = $taxable;
                    $model->npwp = $npwp;
                    $model->tax_name = $tax_name;
                    $model->tdp = $tdp;
                    $model->siup = $siup;
                    $model->sppkp = $sppkp;
                    $model->tax_company_name = $tax_company_name;
                    $model->tax_company_address = $tax_company_address;
                    $model->tax_payment_method = $tax_payment_method;
                    $model->top = $top;
                    $model->tax_credit_ceiling = $tax_credit_ceiling;
                    $model->account_number = $account_number;
                    $model->account_name = $account_name;
                    $model->bank_name = $bank_name;
                    $model->bank_code = $bank_code;
                    $model->account_address = $account_address;
                    
                    $model->user_created = $user->id;
                    $model->date_created = date('Y-m-d');
                    $model->time_created = date('H:i:s');
                    $save = $model->save();
                    if ($save) {
                        $model_code = Code::where('code', $code)->where('type', 'principal')->first();
                        $model_code->status = 1;
                        $model_code->user_modified = $user->id;
                        $model_code->date_modified = date('Y-m-d');
                        $model_code->time_modified = date('H:i:s');
                        $model_code->save();

                        $data_notif = array(
                            'Code' => $code == "" ? "-" : $code,
                            'Name' => $name == "" ? "-" : $name,
                            'Phone' => $phone_office == "" ? "-" : $phone_office,
                            'Fax' => $fax == "" ? "-" : $fax,
                            'Email' => $email_office == "" ? "-" : $email_office,
                            'Address' => $address == "" ? "-" : $address,
                            'Postal Code' => $postal_code == "" ? "-" : $postal_code,
                            'Latitude' => $latitude == "" ? "-" : $latitude,
                            'Longitude' => $longitude == "" ? "-" : $longitude,
                            'PIC Operational' => $pic_operational == "" ? "-" : $pic_operational,
                            'PIC Name' => $pic == "" ? "-" : $pic,
                            'PIC Phone' => $phone_personal == "" ? "-" : $phone_personal,
                            'PIC Finance' => $pic_finance == "" ? "-" : $pic_finance,
                            'PIC Finance Name' => $pic_finance_name == "" ? "-" : $pic_finance_name,
                            'PIC Finance Phone' => $pic_finance_phone == "" ? "-" : $pic_finance_phone,
                            'Taxable' => $taxable == "0" ? lang('no') : lang('yes'),
                            'NPWP' => $npwp == "" ? "-" : $npwp,
                            'Tax Name' => $tax_name == "" ? "-" : $tax_name,
                            'TDP' => $tdp == "" ? "-" : $tdp,
                            'SIUP' => $siup == "" ? "-" : $siup,
                            'SPPKP' => $sppkp == "" ? "-" : $sppkp,
                            'Tax Company Name' => $tax_company_name == "" ? "-" : $tax_company_name,
                            'Tax Company Address' => $tax_company_address == "" ? "-" : $tax_company_address,
                            'Tax Payment Method' => $tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $tax_payment_method)),
                            'TOP' => $top == "" ? "-" : strtoupper($top),
                            'Tax Credit Ceiling' => $tax_credit_ceiling == "" ? "-" : $tax_credit_ceiling,
                            'Account Number' => $account_number == "" ? "-" : $account_number,
                            'Account Name' => $account_name == "" ? "-" : $account_name,
                            'Bank Name' => $bank_name == "" ? "-" : $bank_name,
                            'Bank Code' => $bank_code == "" ? "-" : $bank_code,
                            'Account Address' => $account_address == "" ? "-" : $account_address,
                        );
                        $message = "Add " . lang('principle') . " " . $name . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 10);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_principle)) {
                $model = Principle::find($id_principle);
                $code = strtoupper($this->input->post('code'));
                $name = ucwords($this->input->post('name'));
                $phone_office = $this->input->post('phone_office');
                $fax = $this->input->post('fax');
                $email_office = $this->input->post('email_office');
                $address = $this->input->post('address');
                $postal_code = $this->input->post('postal_code');
                $latitude = $this->input->post('latitude');
                $longitude = $this->input->post('longitude');
                $pic_operational = $this->input->post('pic_operational');
                $pic = $this->input->post('pic');
                $phone_personal = $this->input->post('phone_personal');
                $pic_finance = $this->input->post('pic_finance');
                $pic_finance_name = $this->input->post('pic_finance_name');
                $pic_finance_phone = $this->input->post('pic_finance_phone');
                $taxable = $this->input->post('taxable');
                $npwp = $this->input->post('npwp');
                $tax_name = $this->input->post('tax_name');
                $tdp = $this->input->post('tdp');
                $siup = $this->input->post('siup');
                $sppkp = $this->input->post('sppkp');
                $tax_company_name = $this->input->post('tax_company_name');
                $tax_company_address = $this->input->post('tax_company_address');
                $tax_payment_method = $this->input->post('tax_payment_method');
                $top = $this->input->post('top');
                $tax_credit_ceiling = $this->input->post('tax_credit_ceiling');
                $account_number = $this->input->post('account_number');
                $account_name = $this->input->post('account_name');
                $bank_name = $this->input->post('bank_name');
                $bank_code = $this->input->post('bank_code');
                $account_address = $this->input->post('account_address');
            
                $data_old = array(
                    'Code' => $model->code == "" ? "-" : $model->code,
                    'Name' => $model->name == "" ? "-" : $model->name,
                    'Phone' => $model->phone_office == "" ? "-" : $model->phone_office,
                    'Fax' => $model->fax == "" ? "-" : $model->fax,
                    'Email' => $model->email_office == "" ? "-" : $model->email_office,
                    'Address' => $model->address == "" ? "-" : $model->address,
                    'Postal Code' => $model->postal_code == "" ? "-" : $model->postal_code,
                    'Latitude' => $model->latitude == "" ? "-" : $model->latitude,
                    'Longitude' => $model->longitude == "" ? "-" : $model->longitude,
                    'PIC Operational' => $model->pic_operational == "" ? "-" : $model->pic_operational,
                    'PIC Name' => $model->pic == "" ? "-" : $model->pic,
                    'PIC Phone' => $model->phone_personal == "" ? "-" : $model->phone_personal,
                    'PIC Finance' => $model->pic_finance == "" ? "-" : $model->pic_finance,
                    'PIC Finance Name' => $model->pic_finance_name == "" ? "-" : $model->pic_finance_name,
                    'PIC Finance Phone' => $model->pic_finance_phone == "" ? "-" : $model->pic_finance_phone,
                    'Taxable' => $model->taxable == "0" ? lang('no') : lang('yes'),
                    'NPWP' => $model->npwp == "" ? "-" : $model->npwp,
                    'Tax Name' => $model->tax_name == "" ? "-" : $model->tax_name,
                    'TDP' => $model->tdp == "" ? "-" : $model->tdp,
                    'SIUP' => $model->siup == "" ? "-" : $model->siup,
                    'SPPKP' => $model->sppkp == "" ? "-" : $model->sppkp,
                    'Tax Company Name' => $model->tax_company_name == "" ? "-" : $model->tax_company_name,
                    'Tax Company Address' => $model->tax_company_address == "" ? "-" : $model->tax_company_address,
                    'Tax Payment Method' => $model->tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $model->tax_payment_method)),
                    'TOP' => $model->top == "" ? "-" : strtoupper($model->top),
                    'Tax Credit Ceiling' => $model->tax_credit_ceiling == "" ? "-" : $model->tax_credit_ceiling,
                    'Account Number' => $model->account_number == "" ? "-" : $model->account_number,
                    'Account Name' => $model->account_name == "" ? "-" : $model->account_name,
                    'Bank Name' => $model->bank_name == "" ? "-" : $model->bank_name,
                    'Bank Code' => $model->bank_code == "" ? "-" : $model->bank_code,
                    'Account Address' => $model->account_address == "" ? "-" : $model->account_address,
                );

                $model->code = $code;
                $model->name = $name;
                $model->phone_office = $phone_office;
                $model->fax = $fax;
                $model->email_office = $email_office;
                $model->address = $address;
                $model->postal_code = $postal_code;
                $model->latitude = $latitude;
                $model->longitude = $longitude;
                $model->pic_operational = $pic_operational;
                $model->pic = $pic;
                $model->phone_personal = $phone_personal;
                $model->pic_finance = $pic_finance;
                $model->pic_finance_name = $pic_finance_name;
                $model->pic_finance_phone = $pic_finance_phone;
                $model->taxable = $taxable;
                $model->npwp = $npwp;
                $model->tax_name = $tax_name;
                $model->tdp = $tdp;
                $model->siup = $siup;
                $model->sppkp = $sppkp;
                $model->tax_company_name = $tax_company_name;
                $model->tax_company_address = $tax_company_address;
                $model->tax_payment_method = $tax_payment_method;
                $model->top = $top;
                $model->tax_credit_ceiling = $tax_credit_ceiling;
                $model->account_number = $account_number;
                $model->account_name = $account_name;
                $model->bank_name = $bank_name;
                $model->bank_code = $bank_code;
                $model->account_address = $account_address;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Code' => $code == "" ? "-" : $code,
                        'Name' => $name == "" ? "-" : $name,
                        'Phone' => $phone_office == "" ? "-" : $phone_office,
                        'Fax' => $fax == "" ? "-" : $fax,
                        'Email' => $email_office == "" ? "-" : $email_office,
                        'Address' => $address == "" ? "-" : $address,
                        'Postal Code' => $postal_code == "" ? "-" : $postal_code,
                        'Latitude' => $latitude == "" ? "-" : $latitude,
                        'Longitude' => $longitude == "" ? "-" : $longitude,
                        'PIC Operational' => $pic_operational == "" ? "-" : $pic_operational,
                        'PIC Name' => $pic == "" ? "-" : $pic,
                        'PIC Phone' => $phone_personal == "" ? "-" : $phone_personal,
                        'PIC Finance' => $pic_finance == "" ? "-" : $pic_finance,
                        'PIC Finance Name' => $pic_finance_name == "" ? "-" : $pic_finance_name,
                        'PIC Finance Phone' => $pic_finance_phone == "" ? "-" : $pic_finance_phone,
                        'Taxable' => $taxable == "0" ? lang('no') : lang('yes'),
                        'NPWP' => $npwp == "" ? "-" : $npwp,
                        'Tax Name' => $tax_name == "" ? "-" : $tax_name,
                        'TDP' => $tdp == "" ? "-" : $tdp,
                        'SIUP' => $siup == "" ? "-" : $siup,
                        'SPPKP' => $sppkp == "" ? "-" : $sppkp,
                        'Tax Company Name' => $tax_company_name == "" ? "-" : $tax_company_name,
                        'Tax Company Address' => $tax_company_address == "" ? "-" : $tax_company_address,
                        'Tax Payment Method' => $tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $tax_payment_method)),
                        'TOP' => $top == "" ? "-" : strtoupper($top),
                        'Tax Credit Ceiling' => $tax_credit_ceiling == "" ? "-" : $tax_credit_ceiling,
                        'Account Number' => $account_number == "" ? "-" : $account_number,
                        'Account Name' => $account_name == "" ? "-" : $account_name,
                        'Bank Name' => $bank_name == "" ? "-" : $bank_name,
                        'Bank Code' => $bank_code == "" ? "-" : $bank_code,
                        'Account Address' => $account_address == "" ? "-" : $account_address,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . lang('principle') . " " .  $model->name . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 10);
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
            $model = array('status' => 'success', 'data' => Principle::find($id));
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
            $model = Principle::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Code' => $model->code == "" ? "-" : $model->code,
                    'Name' => $model->name == "" ? "-" : $model->name,
                    'Phone' => $model->phone_office == "" ? "-" : $model->phone_office,
                    'Fax' => $model->fax == "" ? "-" : $model->fax,
                    'Email' => $model->email_office == "" ? "-" : $model->email_office,
                    'Address' => $model->address == "" ? "-" : $model->address,
                    'Postal Code' => $model->postal_code == "" ? "-" : $model->postal_code,
                    'Latitude' => $model->latitude == "" ? "-" : $model->latitude,
                    'Longitude' => $model->longitude == "" ? "-" : $model->longitude,
                    'PIC Operational' => $model->pic_operational == "" ? "-" : $model->pic_operational,
                    'PIC Name' => $model->pic == "" ? "-" : $model->pic,
                    'PIC Phone' => $model->phone_personal == "" ? "-" : $model->phone_personal,
                    'PIC Finance' => $model->pic_finance == "" ? "-" : $model->pic_finance,
                    'PIC Finance Name' => $model->pic_finance_name == "" ? "-" : $model->pic_finance_name,
                    'PIC Finance Phone' => $model->pic_finance_phone == "" ? "-" : $model->pic_finance_phone,
                    'Taxable' => $model->taxable == "0" ? lang('no') : lang('yes'),
                    'NPWP' => $model->npwp == "" ? "-" : $model->npwp,
                    'Tax Name' => $model->tax_name == "" ? "-" : $model->tax_name,
                    'TDP' => $model->tdp == "" ? "-" : $model->tdp,
                    'SIUP' => $model->siup == "" ? "-" : $model->siup,
                    'SPPKP' => $model->sppkp == "" ? "-" : $model->sppkp,
                    'Tax Company Name' => $model->tax_company_name == "" ? "-" : $model->tax_company_name,
                    'Tax Company Address' => $model->tax_company_address == "" ? "-" : $model->tax_company_address,
                    'Tax Payment Method' => $model->tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $model->tax_payment_method)),
                    'TOP' => $model->top == "" ? "-" : strtoupper($model->top),
                    'Tax Credit Ceiling' => $model->tax_credit_ceiling == "" ? "-" : $model->tax_credit_ceiling,
                    'Account Number' => $model->account_number == "" ? "-" : $model->account_number,
                    'Account Name' => $model->account_name == "" ? "-" : $model->account_name,
                    'Bank Name' => $model->bank_name == "" ? "-" : $model->bank_name,
                    'Bank Code' => $model->bank_code == "" ? "-" : $model->bank_code,
                    'Account Address' => $model->account_address == "" ? "-" : $model->account_address,
                );
                $message = "Delete " . lang('principle') . " " .  $model->name . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 10);
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
        $data['principles'] = Principle::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $data['quote'] = "";
        $html = $this->load->view('principle/principle/principle_pdf', $data, true);
        $this->pdf_generator->generate($html, 'principle pdf', $orientation='Landscape');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=principle.xls");
        $data['principles'] = Principle::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $data['quote'] = "'";
        $this->load->view('principle/principle/principle_pdf', $data);
    }

}
