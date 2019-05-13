<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
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
            'id',
            'name',
            'category_id',
            'sku',
            'view_total',
            'description',
            'feature',
            'date_created',
        );

        $header_columns = array(
            'name',
            'category_id',
            'sku',
            'view_total',
            'description',
            'feature',
            'date_created',
        );

        $from = "m_product";
        $where = "deleted = 0";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "name LIKE '%" . $sSearch . "%' OR ";
            $where .= "category_id LIKE '%" . $sSearch . "%' OR ";
            $where .= "sku LIKE '%" . $sSearch . "%' OR ";
            $where .= "description LIKE '%" . $sSearch . "%' OR ";
            $where .= "feature LIKE '%" . $sSearch . "%' OR ";
            $where .= "date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('id');
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
            if($this->user_profile->get_user_access('Updated', 'product')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'product')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->name;
            $row_value[] = $row->category_id;
            $row_value[] = $row->sku;
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
                if (!empty($get_product->name)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $name = ucwords($this->input->post('name'));
                    $category_id = $this->input->post('category_id');
                    $sku = $this->input->post('sku');
                    $description = $this->input->post('description');
                    $feature = $this->input->post('feature');
                    
                    $model = new Product();
                    $model->name = $name;
                    $model->category_id = $category_id;
                    $model->sku = $sku;
                    $model->description = $description;
                    $model->feature = $feature;
                    
                    $model->user_created = $user->id;
                    $model->date_created = date('Y-m-d');
                    $model->time_created = date('H:i:s');
                    $save = $model->save();
                    if ($save) {
                        $data_notif = array(
                            'Name' => $name,
                            'Category' => $category_id,
                            'SKU' => $sku,
                            'Description' => $description,
                            'Feature' => $feature,
                        );
                        $message = "Add " . strtolower(lang('product')) . " " . $name . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 6);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_product)) {
                $model = Product::find($id_product);
                $name = ucwords($this->input->post('name'));
                $category_id = $this->input->post('category_id');
                $sku = $this->input->post('sku');
                $description = $this->input->post('description');
                $feature = $this->input->post('feature');
            
                $data_old = array(
                    'Name' => $model->name,
                    'Category' => $model->category_id,
                    'SKU' => $model->sku,
                    'Description' => $model->description,
                    'Feature' => $model->feature,
                );

                $model->name = $name;
                $model->category_id = $category_id;
                $model->sku = $sku;
                $model->description = $description;
                $model->feature = $feature;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Name' => $name,
                        'Category' => $category_id,
                        'SKU' => $sku,
                        'Description' => $description,
                        'Feature' => $feature,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('product')) . " " .  $model->name . " succesfully by " . $user->full_name;
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
            $model = array('status' => 'success', 'data' => Product::find($id));
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
                    'Name' => $model->name,
                    'Category' => $model->category_id,
                    'SKU' => $model->sku,
                    'Description' => $model->description,
                    'Feature' => $model->feature,
                );
                $message = "Delete " . strtolower(lang('product')) . " " .  $model->name . " succesfully by " . $user->full_name;
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
        $data['products'] = Product::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $html = $this->load->view('product/product/product_pdf', $data, true);
        $this->pdf_generator->generate($html, 'product pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=product.xls");
        $data['products'] = Product::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $this->load->view('product/product/product_pdf', $data);
    }

}
