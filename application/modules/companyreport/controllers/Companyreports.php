<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Companyreports extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'companyreport');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'companyreport');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'companyreport');
        
        $data['invoices'] = Invoice::where('deleted', 0)->get();
        $data['delivery_orders'] = Suratpesanan::where('deleted', 0)->get();
        $data['principles'] = Principle::where('deleted', 0)->get();
        $data['products'] = Product::select('m_product.id', 'm_product.product_code', 'm_product.name as product_name')->where('m_product.deleted', 0)->orderBy('m_product.product_code', 'ASC')->get();
        $data['customers'] = Dipo::select('m_dipo_partner.id', 'm_dipo_partner.code as customer_code', 'm_dipo_partner.name as customer_name')->where('m_dipo_partner.deleted', 0)->orderBy('m_dipo_partner.code', 'ASC')->get();
        $data['user'] = $this->ion_auth->user()->row();

        $this->load->blade('companyreport.views.companyreport.page', $data);
    }

    public function fetch_data() {
        $user = $this->ion_auth->user()->row();

        $database_columns = array(
            'po_date',
            'receive_date',
            'check_status',
            'monthly_period',
            'tax_status',
            'tax_no',
            't_invoice.invoice_no as invoice_no',
            't_sp.sp_no as sp_no',
            'm_principle.code as principle_code',
            'm_principle.name as principle_name',
            'm_product.product_code as product_code',
            'm_product.name as product_name',
            'm_dipo_partner.code as customer_code',
            'm_dipo_partner.name as customer_name',
            'price_hna_per_ctn_before_tax',
            'price_hna_per_ctn_after_tax',
            'total_order_in_ctn',
            'discount',
            'discount_value',
            'ppn',
            'net_price_in_ctn_before_tax',
            'net_price_in_ctn_after_tax',
            'total_value_order_in_ctn_before_tax',
            'total_value_order_in_ctn_after_tax',
            't_sell_in_company.top as top',
            'due_date_invoice',
            'payment_status',
            'payment_value',
            'difference',
            'selling_price',
            'margin_percented',
            'margin_value',
            'remark',
        );

        $header_columns = array(
            'po_date',
            'receive_date',
            'check_status',
            'monthly_period',
            'tax_status',
            'tax_no',
            'invoice_no',
            'sp_no',
            'principle_code',
            'principle_name',
            'product_code',
            'product_name',
            'customer_code',
            'customer_name',
            'price_hna_per_ctn_before_tax',
            'price_hna_per_ctn_after_tax',
            'total_order_in_ctn',
            'discount',
            'discount_value',
            'ppn',
            'net_price_in_ctn_before_tax',
            'net_price_in_ctn_after_tax',
            'total_value_order_in_ctn_before_tax',
            'total_value_order_in_ctn_after_tax',
            'top',
            'due_date_invoice',
            'aging_invoice',
            'due_date_ar',
            'payment_status',
            'payment_value',
            'difference',
            'selling_price',
            'margin_percented',
            'margin_value',
            'margin_contibution',
            'remark',
        );

        $from = "t_sell_in_company";
        $where = "t_sell_in_company.deleted = 0";
        if($user->group_id != '1'){
            $where .= " AND t_sell_in_company.user_created = ". $user->id;
        }

        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');

        $join[] = array('m_principle', 't_sell_in_company.principle_id = m_principle.id', 'left');
        $join[] = array('m_product', 't_sell_in_company.product_id = m_product.id', 'left');
        $join[] = array('m_dipo_partner', 't_sell_in_company.customer_id = m_dipo_partner.id', 'left');
        $join[] = array('t_invoice', 't_sell_in_company.invoice_id = t_invoice.id', 'left');
        $join[] = array('t_sp', 't_sell_in_company.sp_id = t_sp.id', 'left');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "po_date LIKE '%" . $sSearch . "%' OR ";
            $where .= "receive_date LIKE '%" . $sSearch . "%' OR ";
            $where .= "check_status LIKE '%" . $sSearch . "%' OR ";
            $where .= "monthly_period LIKE '%" . $sSearch . "%' OR ";
            $where .= "tax_status LIKE '%" . $sSearch . "%' OR ";
            $where .= "tax_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_invoice.invoice_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sp.sp_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "principle_code LIKE '%" . $sSearch . "%' OR ";
            $where .= "principle_name LIKE '%" . $sSearch . "%' OR ";
            $where .= "product_code LIKE '%" . $sSearch . "%' OR ";
            $where .= "product_name LIKE '%" . $sSearch . "%' OR ";
            $where .= "customer_code LIKE '%" . $sSearch . "%' OR ";
            $where .= "customer_name LIKE '%" . $sSearch . "%' OR ";
            $where .= "price_hna_per_ctn_before_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "price_hna_per_ctn_after_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "total_order_in_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "discount LIKE '%" . $sSearch . "%' OR ";
            $where .= "discount_value LIKE '%" . $sSearch . "%' OR ";
            $where .= "ppn LIKE '%" . $sSearch . "%' OR ";
            $where .= "net_price_in_ctn_before_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "net_price_in_ctn_after_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "total_value_order_in_ctn_before_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "total_value_order_in_ctn_after_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sell_in_company.top LIKE '%" . $sSearch . "%' OR ";
            $where .= "due_date_invoice LIKE '%" . $sSearch . "%' OR ";
            $where .= "payment_status LIKE '%" . $sSearch . "%' OR ";
            $where .= "payment_value LIKE '%" . $sSearch . "%' OR ";
            $where .= "difference LIKE '%" . $sSearch . "%' OR ";
            $where .= "selling_price LIKE '%" . $sSearch . "%' OR ";
            $where .= "margin_percented LIKE '%" . $sSearch . "%' OR ";
            $where .= "margin_value LIKE '%" . $sSearch . "%' OR ";
            $where .= "remark LIKE '%" . $sSearch . "%' OR ";
            $where .= "date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('t_sell_in_company.id');
        $this->datatables->config('database_columns', $database_columns);
        $this->datatables->config('from', $from);
        $this->datatables->config('join', $join);
        $this->datatables->config('where', $where);
        $this->datatables->config('order_by', $order_by);
        $selected_data = $this->datatables->get_select_data();
        $aa_data = $selected_data['aaData'];
        $new_aa_data = array();

        $indonesian_month = array( "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $total_margin_value = 0;
        foreach ($aa_data as $row) {
            $total_margin_value += $row->margin_value;
        }

        foreach ($aa_data as $row) {
            $row_value = array();

            $btn_action = '';
            if($this->user_profile->get_user_access('Updated', 'companyreport')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'companyreport')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            // $due_date_invoice = date('Y-m-d', strtotime($row->receive_date . ' + ' . $row->top . ' days'));
            $due_date_invoice = $row->due_date_invoice;
            $aging_invoice = round((strtotime($due_date_invoice) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
            $due_date_ar = $row->top - $aging_invoice;
            $margin_contibution = $row->margin_value / $total_margin_value;

            $payment_status = '-';
            if($row->payment_status == "0")
                $payment_status = lang('belum_bayar');
            else if($row->payment_status == "1")
                $payment_status = lang('cicil');
            else if($row->payment_status == "2")
                $payment_status = lang('sudah_lewat_jatuh_tempo');
            else if($row->payment_status == "3")
                $payment_status = lang('lunas');

            $row_value[] = date('d-m-Y', strtotime($row->po_date));
            $row_value[] = date('d-m-Y', strtotime($row->receive_date));
            $row_value[] = $row->check_status == "0" ? lang('no') : lang('yes');
            $row_value[] = $indonesian_month[(int) $row->monthly_period - 1];
            $row_value[] = $row->tax_status == "0" ? lang('non_pkp') : lang('pkp');
            $row_value[] = $row->tax_no == "" ? "-" : $row->tax_no;
            $row_value[] = $row->invoice_no;
            $row_value[] = $row->sp_no == "" ? "-" : $row->sp_no;
            $row_value[] = $row->sp_no == "" ? "-" : substr($row->sp_no,0,3);
            $row_value[] = $row->principle_code == "" ? "-" : $row->principle_code;
            $row_value[] = $row->principle_name == "" ? "-" : $row->principle_name;
            $row_value[] = $row->product_code;
            $row_value[] = $row->product_name;
            $row_value[] = $row->customer_code == "" ? "-" : $row->customer_code;
            $row_value[] = $row->customer_name == "" ? "-" : $row->customer_name;
            $row_value[] = number_format($row->price_hna_per_ctn_before_tax, 0);
            $row_value[] = number_format($row->price_hna_per_ctn_after_tax, 0);
            $row_value[] = number_format($row->total_order_in_ctn, 0);
            $row_value[] = number_format($row->discount, 0);
            $row_value[] = number_format($row->discount_value, 0);
            $row_value[] = number_format($row->ppn, 0);
            $row_value[] = number_format($row->net_price_in_ctn_before_tax, 0);
            $row_value[] = number_format($row->net_price_in_ctn_after_tax, 0);
            $row_value[] = number_format($row->total_value_order_in_ctn_before_tax, 0);
            $row_value[] = number_format($row->total_value_order_in_ctn_after_tax, 0);
            $row_value[] = number_format($row->top, 0);
            $row_value[] = date('d-m-Y', strtotime($due_date_invoice));
            $row_value[] = $aging_invoice;
            $row_value[] = $due_date_ar;
            $row_value[] = $payment_status;
            $row_value[] = number_format($row->payment_value, 0);
            $row_value[] = number_format($row->difference, 0);
            $row_value[] = number_format($row->selling_price, 0);
            $row_value[] = number_format($row->margin_percented, 0);
            $row_value[] = number_format($row->margin_value, 0);
            $row_value[] = $margin_contibution;
            $row_value[] = $row->remark;
            $row_value[] = $btn_action;
            
            $new_aa_data[] = $row_value;
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }

    public function fetch_data_out() {
        $user = $this->ion_auth->user()->row();

        $database_columns = array(
            'receive_date',
            'monthly_period',
            'tax_status',
            'tax_no',
            't_invoice.invoice_no as invoice_no',
            'm_product.product_code as product_code',
            'm_product.name as product_name',
            'm_dipo_partner.code as customer_code',
            'm_dipo_partner.name as customer_name',
            'price_hna_per_ctn_before_tax',
            'price_hna_per_ctn_after_tax',
            'total_order_in_ctn',
            'discount',
            'discount_value',
            'ppn',
            'net_price_in_ctn_before_tax',
            'net_price_in_ctn_after_tax',
            'total_value_order_in_ctn_before_tax',
            'total_value_order_in_ctn_after_tax',
            't_sell_out_company.top as top',
            'due_date_invoice',
            'payment_status',
            'payment_value',
            'difference',
            'remark',
        );

        $header_columns = array(
            'receive_date',
            'monthly_period',
            'tax_status',
            'tax_no',
            'invoice_no',
            'product_code',
            'product_name',
            'customer_code',
            'customer_name',
            'price_hna_per_ctn_before_tax',
            'price_hna_per_ctn_after_tax',
            'total_order_in_ctn',
            'discount',
            'discount_value',
            'ppn',
            'net_price_in_ctn_before_tax',
            'net_price_in_ctn_after_tax',
            'total_value_order_in_ctn_before_tax',
            'total_value_order_in_ctn_after_tax',
            'top',
            'due_date_invoice',
            'aging_invoice',
            'due_date_ar',
            'payment_status',
            'payment_value',
            'difference',
            'remark',
        );

        $from = "t_sell_out_company";
        $where = "t_sell_out_company.deleted = 0";
        if($user->group_id != '1'){
            $where .= " AND t_sell_out_company.user_created = ". $user->id;
        }

        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');

        $join[] = array('m_product', 't_sell_out_company.product_id = m_product.id', 'left');
        $join[] = array('m_dipo_partner', 't_sell_out_company.customer_id = m_dipo_partner.id', 'left');
        $join[] = array('t_invoice', 't_sell_out_company.invoice_id = t_invoice.id', 'left');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "receive_date LIKE '%" . $sSearch . "%' OR ";
            $where .= "monthly_period LIKE '%" . $sSearch . "%' OR ";
            $where .= "tax_status LIKE '%" . $sSearch . "%' OR ";
            $where .= "tax_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_invoice.invoice_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "product_code LIKE '%" . $sSearch . "%' OR ";
            $where .= "product_name LIKE '%" . $sSearch . "%' OR ";
            $where .= "customer_code LIKE '%" . $sSearch . "%' OR ";
            $where .= "customer_name LIKE '%" . $sSearch . "%' OR ";
            $where .= "price_hna_per_ctn_before_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "price_hna_per_ctn_after_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "total_order_in_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "discount LIKE '%" . $sSearch . "%' OR ";
            $where .= "discount_value LIKE '%" . $sSearch . "%' OR ";
            $where .= "ppn LIKE '%" . $sSearch . "%' OR ";
            $where .= "net_price_in_ctn_before_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "net_price_in_ctn_after_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "total_value_order_in_ctn_before_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "total_value_order_in_ctn_after_tax LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_sell_out_company.top LIKE '%" . $sSearch . "%' OR ";
            $where .= "due_date_invoice LIKE '%" . $sSearch . "%' OR ";
            $where .= "payment_status LIKE '%" . $sSearch . "%' OR ";
            $where .= "payment_value LIKE '%" . $sSearch . "%' OR ";
            $where .= "difference LIKE '%" . $sSearch . "%' OR ";
            $where .= "remark LIKE '%" . $sSearch . "%' OR ";
            $where .= "date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('t_sell_out_company.id');
        $this->datatables->config('database_columns', $database_columns);
        $this->datatables->config('from', $from);
        $this->datatables->config('join', $join);
        $this->datatables->config('where', $where);
        $this->datatables->config('order_by', $order_by);
        $selected_data = $this->datatables->get_select_data();
        $aa_data = $selected_data['aaData'];
        $new_aa_data = array();

        $indonesian_month = array( "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        foreach ($aa_data as $row) {
            $row_value = array();

            $btn_action = '';
            if($this->user_profile->get_user_access('Updated', 'companyreport')){
                $btn_action .= '<a href="javascript:void()" onclick="viewDataOut(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'companyreport')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteDataOut(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $aging_invoice = round((strtotime($row->due_date_invoice) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
            $due_date_ar = $row->top - $aging_invoice;

            $payment_status = '-';
            if($row->payment_status == "0")
                $payment_status = lang('belum_bayar');
            else if($row->payment_status == "1")
                $payment_status = lang('cicil');
            else if($row->payment_status == "2")
                $payment_status = lang('sudah_lewat_jatuh_tempo');
            else if($row->payment_status == "3")
                $payment_status = lang('lunas');

            $row_value[] = date('d-m-Y', strtotime($row->receive_date));
            $row_value[] = $indonesian_month[(int) $row->monthly_period - 1];
            $row_value[] = $row->tax_status == "0" ? lang('non_pkp') : lang('pkp');
            $row_value[] = $row->tax_no == "" ? "-" : $row->tax_no;
            $row_value[] = $row->invoice_no;
            $row_value[] = substr($row->invoice_no, 0, 3);
            $row_value[] = $row->product_code;
            $row_value[] = $row->product_name;
            $row_value[] = $row->customer_code;
            $row_value[] = $row->customer_name;
            $row_value[] = number_format($row->price_hna_per_ctn_before_tax, 0);
            $row_value[] = number_format($row->price_hna_per_ctn_after_tax, 0);
            $row_value[] = number_format($row->total_order_in_ctn, 0);
            $row_value[] = number_format($row->discount, 0);
            $row_value[] = number_format($row->discount_value, 0);
            $row_value[] = number_format($row->ppn, 0);
            $row_value[] = number_format($row->net_price_in_ctn_before_tax, 0);
            $row_value[] = number_format($row->net_price_in_ctn_after_tax, 0);
            $row_value[] = number_format($row->total_value_order_in_ctn_before_tax, 0);
            $row_value[] = number_format($row->total_value_order_in_ctn_after_tax, 0);
            $row_value[] = number_format($row->top, 0);
            $row_value[] = date('d-m-Y', strtotime($row->due_date_invoice));
            $row_value[] = $aging_invoice;
            $row_value[] = $due_date_ar;
            $row_value[] = $payment_status;
            $row_value[] = number_format($row->payment_value, 0);
            $row_value[] = number_format($row->difference, 0);
            $row_value[] = $row->remark;
            $row_value[] = $btn_action;
            
            $new_aa_data[] = $row_value;
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }

    public function save() {
        if ($this->input->is_ajax_request()) {
            $user = $this->ion_auth->user()->row();
            $id_companyreport = $this->input->post('id');
            if (empty($id_companyreport)) {
                $po_date = date('Y-m-d', strtotime($this->input->post('po_date')));
                $receive_date = date('Y-m-d', strtotime($this->input->post('receive_date')));
                $check_status = $this->input->post('check_status');
                $monthly_period = (int) date('m', strtotime($this->input->post('receive_date')));
                $tax_status = $this->input->post('tax_status');
                $tax_no = $this->input->post('tax_no');
                $invoice_id = $this->input->post('invoice_id');
                $sp_id = $this->input->post('sp_id');
                $principle_id = $this->input->post('principle_id');
                $product_id = $this->input->post('product_id');
                $customer_id = $this->input->post('customer_id');
                $price_hna_per_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('price_hna_per_ctn_before_tax')));
                $price_hna_per_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('price_hna_per_ctn_after_tax')));
                $total_order_in_ctn = $this->input->post('total_order_in_ctn');
                $discount = str_replace('_', '', str_replace(',', '', $this->input->post('discount')));
                $discount_value = str_replace('_', '', str_replace(',', '', $this->input->post('discount_value')));
                $ppn = str_replace('_', '', str_replace(',', '', $this->input->post('ppn')));
                $net_price_in_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('net_price_in_ctn_before_tax')));
                $net_price_in_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('net_price_in_ctn_after_tax_tmp')));
                $total_value_order_in_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('total_value_order_in_ctn_before_tax')));
                $total_value_order_in_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('total_value_order_in_ctn_after_tax')));
                $top = $this->input->post('top');
                $due_date_invoice = date('Y-m-d', strtotime($receive_date . ' + ' . (int) $top . ' days'));
                $payment_status = $this->input->post('payment_status');
                $payment_value = str_replace('_', '', str_replace(',', '', $this->input->post('payment_value')));
                $difference = str_replace('_', '', str_replace(',', '', $this->input->post('difference')));
                $selling_price = str_replace('_', '', str_replace(',', '', $this->input->post('selling_price')));
                $margin_percented = str_replace('_', '', str_replace(',', '', $this->input->post('margin_percented')));
                $margin_value = str_replace('_', '', str_replace(',', '', $this->input->post('margin_value')));
                $remark = $this->input->post('remark');
                
                $model = new Companyreport();
                $model->po_date = $po_date;
                $model->receive_date = $receive_date;
                $model->check_status = $check_status;
                $model->monthly_period = $monthly_period;
                $model->tax_status = $tax_status;
                $model->tax_no = $tax_no;
                $model->invoice_id = $invoice_id;
                $model->sp_id = $sp_id;
                $model->principle_id = $principle_id;
                $model->product_id = $product_id;
                $model->customer_id = $customer_id;
                $model->price_hna_per_ctn_before_tax = $price_hna_per_ctn_before_tax;
                $model->price_hna_per_ctn_after_tax = $price_hna_per_ctn_after_tax;
                $model->total_order_in_ctn = $total_order_in_ctn;
                $model->discount = $discount;
                $model->discount_value = $discount_value;
                $model->ppn = $ppn;
                $model->net_price_in_ctn_before_tax = $net_price_in_ctn_before_tax;
                $model->net_price_in_ctn_after_tax = $net_price_in_ctn_after_tax;
                $model->total_value_order_in_ctn_before_tax = $total_value_order_in_ctn_before_tax;
                $model->total_value_order_in_ctn_after_tax = $total_value_order_in_ctn_after_tax;
                $model->top = $top;
                $model->due_date_invoice = $due_date_invoice;
                $model->payment_status = $payment_status;
                $model->payment_value = $payment_value;
                $model->difference = $difference;
                $model->selling_price = $selling_price;
                $model->margin_percented = $margin_percented;
                $model->margin_value = $margin_value;
                $model->remark = $remark;
                
                $model->user_created = $user->id;
                $model->date_created = date('Y-m-d');
                $model->time_created = date('H:i:s');
                $save = $model->save();
                if ($save) {
                    $data_notif = array(
                        'PO Date' => date('d-m-Y', strtotime($po_date)),
                        'Receive Date' => date('d-m-Y', strtotime($receive_date)),
                        'Check Status' => $check_status == "0" ? lang('no') : lang('yes'),
                        'Monthly Period' => $monthly_period,
                        'Tax Status' => $tax_status == "0" ? lang('non_pkp') : lang('pkp'),
                        'Tax No' => $tax_no == "" ? "-" : $tax_no,
                        'Invoice No' => Invoice::find($invoice_id)->invoice_no,
                        'SP No' => $sp_id == "" ? "-" : Suratpesanan::find($sp_id)->sp_no,
                        'Principle' => $principle_id == "" ? "-" : Principle::find($principle_id)->code . ' - '  . Principle::find($principle_id)->name,
                        'Product' => Product::find($product_id)->product_code . ' - '  . Product::find($product_id)->name,
                        'Ship to Delivery' => $customer_id == '' ? '-' : Dipo::find($customer_id)->code . ' - '  . Dipo::find($customer_id)->name,
                        'Price HNA Per Ctn (Before Tax)' => $price_hna_per_ctn_before_tax,
                        'Price HNA Per Ctn (After Tax)' => $price_hna_per_ctn_after_tax,
                        'Total Order In Ctn' => $total_order_in_ctn,
                        'Discount (%)' => $discount,
                        'Discount Value' => $discount_value,
                        'PPN 10%' => $ppn,
                        'Net Price In Ctn (Before Tax)' => $net_price_in_ctn_before_tax,
                        'Net Price In Ctn (After Tax)' => $net_price_in_ctn_after_tax,
                        'Total Value Order In Ctn (Before Tax)' => $total_value_order_in_ctn_before_tax,
                        'Total Value Order In Ctn (After Tax)' => $total_value_order_in_ctn_after_tax,
                        'TOP' => $top,
                        'Due Date Invoice' => date('d-m-Y', strtotime($due_date_invoice)),
                        'Payment Status' => $payment_status == "0" ? lang('not_yet') : lang('done'),
                        'Payment Value' => $payment_value,
                        'Difference' => $difference,
                        'Selling Price' => $selling_price,
                        'Margin Percented' => $margin_percented,
                        'Margin Value' => $margin_value,
                        'Remark' => $remark
                    );
                    $message = "Add Sell In " . strtolower(lang('companyreport')) . " " . Invoice::find($invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 9);
                    $status = array('status' => 'success', 'message' => lang('message_save_success'));
                } else {
                    $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                }
            } elseif(!empty($id_companyreport)) {
                $model = Companyreport::find($id_companyreport);

                $po_date = date('Y-m-d', strtotime($this->input->post('po_date')));
                $receive_date = date('Y-m-d', strtotime($this->input->post('receive_date')));
                $check_status = $this->input->post('check_status');
                $monthly_period = (int) date('m', strtotime($this->input->post('receive_date')));
                $tax_status = $this->input->post('tax_status');
                $tax_no = $this->input->post('tax_no');
                $invoice_id = $this->input->post('invoice_id');
                $sp_id = $this->input->post('sp_id');
                $principle_id = $this->input->post('principle_id');
                $product_id = $this->input->post('product_id');
                $customer_id = $this->input->post('customer_id');
                $price_hna_per_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('price_hna_per_ctn_before_tax')));
                $price_hna_per_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('price_hna_per_ctn_after_tax')));
                $total_order_in_ctn = $this->input->post('total_order_in_ctn');
                $discount = str_replace('_', '', str_replace(',', '', $this->input->post('discount')));
                $discount_value = str_replace('_', '', str_replace(',', '', $this->input->post('discount_value')));
                $ppn = str_replace('_', '', str_replace(',', '', $this->input->post('ppn')));
                $net_price_in_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('net_price_in_ctn_before_tax')));
                $net_price_in_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('net_price_in_ctn_after_tax_tmp')));
                $total_value_order_in_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('total_value_order_in_ctn_before_tax')));
                $total_value_order_in_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('total_value_order_in_ctn_after_tax')));
                $top = $this->input->post('top');
                $due_date_invoice = date('Y-m-d', strtotime($receive_date . ' + ' . (int) $top . ' days'));
                $payment_status = $this->input->post('payment_status');
                $payment_value = str_replace('_', '', str_replace(',', '', $this->input->post('payment_value')));
                $difference = str_replace('_', '', str_replace(',', '', $this->input->post('difference')));
                $selling_price = str_replace('_', '', str_replace(',', '', $this->input->post('selling_price')));
                $margin_percented = str_replace('_', '', str_replace(',', '', $this->input->post('margin_percented')));
                $margin_value = str_replace('_', '', str_replace(',', '', $this->input->post('margin_value')));
                $remark = $this->input->post('remark');
                
                $data_old = array(
                    'PO Date' => date('d-m-Y', strtotime($model->po_date)),
                    'Receive Date' => date('d-m-Y', strtotime($model->receive_date)),
                    'Check Status' => $model->check_status == "0" ? lang('no') : lang('yes'),
                    'Monthly Period' => $model->monthly_period,
                    'Tax Status' => $model->tax_status == "0" ? lang('non_pkp') : lang('pkp'),
                    'Tax No' => $model->tax_no == "" ? "-" : $model->tax_no,
                    'Invoice No' => Invoice::find($model->invoice_id)->invoice_no,
                    'SP No' => Suratpesanan::find($model->sp_id)->sp_no,
                    'Principle' => Principle::find($model->principle_id)->code . ' - '  . Principle::find($model->principle_id)->name,
                    'Product' => Product::find($model->product_id)->product_code . ' - '  . Product::find($model->product_id)->name,
                    'Ship to Delivery' => $model->customer_id == '' ? '-' : Dipo::find($model->customer_id)->code . ' - '  . Dipo::find($model->customer_id)->name,
                    'Price HNA Per Ctn (Before Tax)' => $model->price_hna_per_ctn_before_tax,
                    'Price HNA Per Ctn (After Tax)' => $model->price_hna_per_ctn_after_tax,
                    'Total Order In Ctn' => $model->total_order_in_ctn,
                    'Discount (%)' => $model->discount,
                    'Discount Value' => $model->discount_value,
                    'PPN 10%' => $model->ppn,
                    'Net Price In Ctn (Before Tax)' => $model->net_price_in_ctn_before_tax,
                    'Net Price In Ctn (After Tax)' => $model->net_price_in_ctn_after_tax,
                    'Total Value Order In Ctn (Before Tax)' => $model->total_value_order_in_ctn_before_tax,
                    'Total Value Order In Ctn (After Tax)' => $model->total_value_order_in_ctn_after_tax,
                    'TOP' => $model->top,
                    'Due Date Invoice' => date('d-m-Y', strtotime($model->due_date_invoice)),
                    'Payment Status' => $model->payment_status == "0" ? lang('not_yet') : lang('done'),
                    'Payment Value' => $model->payment_value,
                    'Difference' => $model->difference,
                    'Selling Price' => $model->selling_price,
                    'Margin Percented' => $model->margin_percented,
                    'Margin Value' => $model->margin_value,
                    'Remark' => $model->remark
                );

                $model->po_date = $po_date;
                $model->receive_date = $receive_date;
                $model->check_status = $check_status;
                $model->monthly_period = $monthly_period;
                $model->tax_status = $tax_status;
                $model->tax_no = $tax_no;
                $model->invoice_id = $invoice_id;
                $model->sp_id = $sp_id;
                $model->principle_id = $principle_id;
                $model->product_id = $product_id;
                $model->customer_id = $customer_id;
                $model->price_hna_per_ctn_before_tax = $price_hna_per_ctn_before_tax;
                $model->price_hna_per_ctn_after_tax = $price_hna_per_ctn_after_tax;
                $model->total_order_in_ctn = $total_order_in_ctn;
                $model->discount = $discount;
                $model->discount_value = $discount_value;
                $model->ppn = $ppn;
                $model->net_price_in_ctn_before_tax = $net_price_in_ctn_before_tax;
                $model->net_price_in_ctn_after_tax = $net_price_in_ctn_after_tax;
                $model->total_value_order_in_ctn_before_tax = $total_value_order_in_ctn_before_tax;
                $model->total_value_order_in_ctn_after_tax = $total_value_order_in_ctn_after_tax;
                $model->top = $top;
                $model->due_date_invoice = $due_date_invoice;
                $model->payment_status = $payment_status;
                $model->payment_value = $payment_value;
                $model->difference = $difference;
                $model->selling_price = $selling_price;
                $model->margin_percented = $margin_percented;
                $model->margin_value = $margin_value;
                $model->remark = $remark;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'PO Date' => date('d-m-Y', strtotime($po_date)),
                        'Receive Date' => date('d-m-Y', strtotime($receive_date)),
                        'Check Status' => $check_status == "0" ? lang('no') : lang('yes'),
                        'Monthly Period' => $monthly_period,
                        'Tax Status' => $tax_status == "0" ? lang('non_pkp') : lang('pkp'),
                        'Tax No' => $tax_no == "" ? "-" : $tax_no,
                        'Invoice No' => Invoice::find($invoice_id)->invoice_no,
                        'SP No' => Suratpesanan::find($sp_id)->sp_no,
                        'Principle' => Principle::find($principle_id)->code . ' - '  . Principle::find($principle_id)->name,
                        'Product' => Product::find($product_id)->product_code . ' - '  . Product::find($product_id)->name,
                        'Ship to Delivery' => $customer_id == '' ? '-' : Dipo::find($customer_id)->code . ' - '  . Dipo::find($customer_id)->name,
                        'Price HNA Per Ctn (Before Tax)' => $price_hna_per_ctn_before_tax,
                        'Price HNA Per Ctn (After Tax)' => $price_hna_per_ctn_after_tax,
                        'Total Order In Ctn' => $total_order_in_ctn,
                        'Discount (%)' => $discount,
                        'Discount Value' => $discount_value,
                        'PPN 10%' => $ppn,
                        'Net Price In Ctn (Before Tax)' => $net_price_in_ctn_before_tax,
                        'Net Price In Ctn (After Tax)' => $net_price_in_ctn_after_tax,
                        'Total Value Order In Ctn (Before Tax)' => $total_value_order_in_ctn_before_tax,
                        'Total Value Order In Ctn (After Tax)' => $total_value_order_in_ctn_after_tax,
                        'TOP' => $top,
                        'Due Date Invoice' => date('d-m-Y', strtotime($due_date_invoice)),
                        'Payment Status' => $payment_status == "0" ? lang('not_yet') : lang('done'),
                        'Payment Value' => $payment_value,
                        'Difference' => $difference,
                        'Selling Price' => $selling_price,
                        'Margin Percented' => $margin_percented,
                        'Margin Value' => $margin_value,
                        'Remark' => $remark
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update Sell In " . strtolower(lang('companyreport')) . " " .  Invoice::find($model->invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 9);
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
    
    public function save_out() {
        if ($this->input->is_ajax_request()) {
            $user = $this->ion_auth->user()->row();
            $id_companyreport = $this->input->post('id_out');
            if (empty($id_companyreport)) {
                $receive_date = date('Y-m-d', strtotime($this->input->post('receive_date_out')));
                $monthly_period = (int) date('m', strtotime($this->input->post('receive_date_out')));
                $tax_status = $this->input->post('tax_status_out');
                $tax_no = $this->input->post('tax_no_out');
                $invoice_id = $this->input->post('invoice_id_out');
                $product_id = $this->input->post('product_id_out');
                $customer_id = $this->input->post('customer_id_out');
                $price_hna_per_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('price_hna_per_ctn_before_tax_out')));
                $price_hna_per_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('price_hna_per_ctn_after_tax_out')));
                $total_order_in_ctn = $this->input->post('total_order_in_ctn_out');
                $discount = str_replace('_', '', str_replace(',', '', $this->input->post('discount_out')));
                $discount_value = str_replace('_', '', str_replace(',', '', $this->input->post('discount_value_out')));
                $ppn = str_replace('_', '', str_replace(',', '', $this->input->post('ppn_out')));
                $net_price_in_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('net_price_in_ctn_before_tax_out')));
                $net_price_in_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('net_price_in_ctn_after_tax_out_tmp')));
                $total_value_order_in_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('total_value_order_in_ctn_before_tax_out')));
                $total_value_order_in_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('total_value_order_in_ctn_after_tax_out')));
                $top = $this->input->post('top_out');
                $due_date_invoice = date('Y-m-d', strtotime($receive_date . ' + ' . (int) $top . ' days'));
                $payment_status = $this->input->post('payment_status_out');
                $payment_value = str_replace('_', '', str_replace(',', '', $this->input->post('payment_value_out')));
                $difference = str_replace('_', '', str_replace(',', '', $this->input->post('difference_out')));
                $remark = $this->input->post('remark_out');
                
                $model = new Companyreportout();
                $model->receive_date = $receive_date;
                $model->monthly_period = $monthly_period;
                $model->tax_status = $tax_status;
                $model->tax_no = $tax_no;
                $model->invoice_id = $invoice_id;
                $model->product_id = $product_id;
                $model->customer_id = $customer_id;
                $model->price_hna_per_ctn_before_tax = $price_hna_per_ctn_before_tax;
                $model->price_hna_per_ctn_after_tax = $price_hna_per_ctn_after_tax;
                $model->total_order_in_ctn = $total_order_in_ctn;
                $model->discount = $discount;
                $model->discount_value = $discount_value;
                $model->ppn = $ppn;
                $model->net_price_in_ctn_before_tax = $net_price_in_ctn_before_tax;
                $model->net_price_in_ctn_after_tax = $net_price_in_ctn_after_tax;
                $model->total_value_order_in_ctn_before_tax = $total_value_order_in_ctn_before_tax;
                $model->total_value_order_in_ctn_after_tax = $total_value_order_in_ctn_after_tax;
                $model->top = $top;
                $model->due_date_invoice = $due_date_invoice;
                $model->payment_status = $payment_status;
                $model->payment_value = $payment_value;
                $model->difference = $difference;
                $model->remark = $remark;
                
                $model->user_created = $user->id;
                $model->date_created = date('Y-m-d');
                $model->time_created = date('H:i:s');
                $save = $model->save();
                if ($save) {
                    $data_notif = array(
                        'Receive Date' => date('d-m-Y', strtotime($receive_date)),
                        'Monthly Period' => $monthly_period,
                        'Tax Status' => $tax_status == "0" ? lang('non_pkp') : lang('pkp'),
                        'Tax No' => $tax_no == "" ? "-" : $tax_no,
                        'Invoice No' => Invoice::find($invoice_id)->invoice_no,
                        'Product' => Product::find($product_id)->product_code . ' - '  . Product::find($product_id)->name,
                        'Ship to Delivery' => $customer_id == '' ? '-' : Dipo::find($customer_id)->code . ' - '  . Dipo::find($customer_id)->name,
                        'Price HNA Per Ctn (Before Tax)' => $price_hna_per_ctn_before_tax,
                        'Price HNA Per Ctn (After Tax)' => $price_hna_per_ctn_after_tax,
                        'Total Order In Ctn' => $total_order_in_ctn,
                        'Discount (%)' => $discount,
                        'Discount Value' => $discount_value,
                        'PPN 10%' => $ppn,
                        'Net Price In Ctn (Before Tax)' => $net_price_in_ctn_before_tax,
                        'Net Price In Ctn (After Tax)' => $net_price_in_ctn_after_tax,
                        'Total Value Order In Ctn (Before Tax)' => $total_value_order_in_ctn_before_tax,
                        'Total Value Order In Ctn (After Tax)' => $total_value_order_in_ctn_after_tax,
                        'TOP' => $top,
                        'Due Date Invoice' => date('d-m-Y', strtotime($due_date_invoice)),
                        'Payment Status' => $payment_status == "0" ? lang('not_yet') : lang('done'),
                        'Payment Value' => $payment_value,
                        'Difference' => $difference,
                        'Remark' => $remark
                    );
                    $message = "Add Sell Out " . strtolower(lang('companyreport')) . " " . Invoice::find($invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 12);
                    $status = array('status' => 'success', 'message' => lang('message_save_success'));
                } else {
                    $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                }
            } elseif(!empty($id_companyreport)) {
                $model = Companyreportout::find($id_companyreport);

                $receive_date = date('Y-m-d', strtotime($this->input->post('receive_date_out')));
                $monthly_period = (int) date('m', strtotime($this->input->post('receive_date_out')));
                $tax_status = $this->input->post('tax_status_out');
                $tax_no = $this->input->post('tax_no_out');
                $invoice_id = $this->input->post('invoice_id_out');
                $product_id = $this->input->post('product_id_out');
                $customer_id = $this->input->post('customer_id_out');
                $price_hna_per_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('price_hna_per_ctn_before_tax_out')));
                $price_hna_per_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('price_hna_per_ctn_after_tax_out')));
                $total_order_in_ctn = $this->input->post('total_order_in_ctn_out');
                $discount = str_replace('_', '', str_replace(',', '', $this->input->post('discount_out')));
                $discount_value = str_replace('_', '', str_replace(',', '', $this->input->post('discount_value_out')));
                $ppn = str_replace('_', '', str_replace(',', '', $this->input->post('ppn_out')));
                $net_price_in_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('net_price_in_ctn_before_tax_out')));
                $net_price_in_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('net_price_in_ctn_after_tax_out_tmp')));
                $total_value_order_in_ctn_before_tax = str_replace('_', '', str_replace(',', '', $this->input->post('total_value_order_in_ctn_before_tax_out')));
                $total_value_order_in_ctn_after_tax = str_replace('_', '', str_replace(',', '', $this->input->post('total_value_order_in_ctn_after_tax_out')));
                $top = $this->input->post('top_out');
                $due_date_invoice = date('Y-m-d', strtotime($receive_date . ' + ' . (int) $top . ' days'));
                $payment_status = $this->input->post('payment_status_out');
                $payment_value = str_replace('_', '', str_replace(',', '', $this->input->post('payment_value_out')));
                $difference = str_replace('_', '', str_replace(',', '', $this->input->post('difference_out')));
                $remark = $this->input->post('remark_out');
                
                $data_old = array(
                    'Receive Date' => date('d-m-Y', strtotime($model->receive_date)),
                    'Monthly Period' => $model->monthly_period,
                    'Tax Status' => $model->tax_status == "0" ? lang('non_pkp') : lang('pkp'),
                    'Tax No' => $model->tax_no == "" ? "-" : $model->tax_no,
                    'Invoice No' => Invoice::find($model->invoice_id)->invoice_no,
                    'Product' => Product::find($model->product_id)->product_code . ' - '  . Product::find($model->product_id)->name,
                    'Ship to Delivery' => $model->customer_id == '' ? '-' : Dipo::find($model->customer_id)->code . ' - '  . Dipo::find($model->customer_id)->name,
                    'Price HNA Per Ctn (Before Tax)' => $model->price_hna_per_ctn_before_tax,
                    'Price HNA Per Ctn (After Tax)' => $model->price_hna_per_ctn_after_tax,
                    'Total Order In Ctn' => $model->total_order_in_ctn,
                    'Discount (%)' => $model->discount,
                    'Discount Value' => $model->discount_value,
                    'PPN 10%' => $model->ppn,
                    'Net Price In Ctn (Before Tax)' => $model->net_price_in_ctn_before_tax,
                    'Net Price In Ctn (After Tax)' => $model->net_price_in_ctn_after_tax,
                    'Total Value Order In Ctn (Before Tax)' => $model->total_value_order_in_ctn_before_tax,
                    'Total Value Order In Ctn (After Tax)' => $model->total_value_order_in_ctn_after_tax,
                    'TOP' => $model->top,
                    'Due Date Invoice' => date('d-m-Y', strtotime($model->due_date_invoice)),
                    'Payment Status' => $model->payment_status == "0" ? lang('not_yet') : lang('done'),
                    'Payment Value' => $model->payment_value,
                    'Difference' => $model->difference,
                    'Remark' => $model->remark
                );

                $model->receive_date = $receive_date;
                $model->monthly_period = $monthly_period;
                $model->tax_status = $tax_status;
                $model->tax_no = $tax_no;
                $model->invoice_id = $invoice_id;
                $model->product_id = $product_id;
                $model->customer_id = $customer_id;
                $model->price_hna_per_ctn_before_tax = $price_hna_per_ctn_before_tax;
                $model->price_hna_per_ctn_after_tax = $price_hna_per_ctn_after_tax;
                $model->total_order_in_ctn = $total_order_in_ctn;
                $model->discount = $discount;
                $model->discount_value = $discount_value;
                $model->ppn = $ppn;
                $model->net_price_in_ctn_before_tax = $net_price_in_ctn_before_tax;
                $model->net_price_in_ctn_after_tax = $net_price_in_ctn_after_tax;
                $model->total_value_order_in_ctn_before_tax = $total_value_order_in_ctn_before_tax;
                $model->total_value_order_in_ctn_after_tax = $total_value_order_in_ctn_after_tax;
                $model->top = $top;
                $model->due_date_invoice = $due_date_invoice;
                $model->payment_status = $payment_status;
                $model->payment_value = $payment_value;
                $model->difference = $difference;
                $model->remark = $remark;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Receive Date' => date('d-m-Y', strtotime($receive_date)),
                        'Monthly Period' => $monthly_period,
                        'Tax Status' => $tax_status == "0" ? lang('non_pkp') : lang('pkp'),
                        'Tax No' => $tax_no == "" ? "-" : $tax_no,
                        'Invoice No' => Invoice::find($invoice_id)->invoice_no,
                        'Product' => Product::find($product_id)->product_code . ' - '  . Product::find($product_id)->name,
                        'Ship to Delivery' => $customer_id == '' ? '-' : Dipo::find($customer_id)->code . ' - '  . Dipo::find($customer_id)->name,
                        'Price HNA Per Ctn (Before Tax)' => $price_hna_per_ctn_before_tax,
                        'Price HNA Per Ctn (After Tax)' => $price_hna_per_ctn_after_tax,
                        'Total Order In Ctn' => $total_order_in_ctn,
                        'Discount (%)' => $discount,
                        'Discount Value' => $discount_value,
                        'PPN 10%' => $ppn,
                        'Net Price In Ctn (Before Tax)' => $net_price_in_ctn_before_tax,
                        'Net Price In Ctn (After Tax)' => $net_price_in_ctn_after_tax,
                        'Total Value Order In Ctn (Before Tax)' => $total_value_order_in_ctn_before_tax,
                        'Total Value Order In Ctn (After Tax)' => $total_value_order_in_ctn_after_tax,
                        'TOP' => $top,
                        'Due Date Invoice' => date('d-m-Y', strtotime($due_date_invoice)),
                        'Payment Status' => $payment_status == "0" ? lang('not_yet') : lang('done'),
                        'Payment Value' => $payment_value,
                        'Difference' => $difference,
                        'Remark' => $remark
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update Sell Out " . strtolower(lang('companyreport')) . " " .  Invoice::find($model->invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 12);
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
            $model = array('status' => 'success', 'data' => Companyreport::find($id));
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function view_out() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $model = array('status' => 'success', 'data' => Companyreportout::find($id));
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
            $model = Companyreport::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'PO Date' => date('d-m-Y', strtotime($model->po_date)),
                    'Receive Date' => date('d-m-Y', strtotime($model->receive_date)),
                    'Check Status' => $model->check_status == "0" ? lang('no') : lang('yes'),
                    'Monthly Period' => $model->monthly_period,
                    'Tax Status' => $model->tax_status == "0" ? lang('non_pkp') : lang('pkp'),
                    'Tax No' => $model->tax_no == "" ? "-" : $model->tax_no,
                    'Invoice No' => Invoice::find($model->invoice_id)->invoice_no,
                    'SP No' => $model->sp_id == "" ? "-" : Suratpesanan::find($model->sp_id)->sp_no,
                    'Principle' => $model->principle_id == "" ? "-" : Principle::find($model->principle_id)->code . ' - '  . Principle::find($model->principle_id)->name,
                    'Product' => Product::find($model->product_id)->product_code . ' - '  . Product::find($model->product_id)->name,
                    'Ship to Delivery' => $model->customer_id == '' ? '-' : Dipo::find($model->customer_id)->code . ' - '  . Dipo::find($model->customer_id)->name,
                    'Price HNA Per Ctn (Before Tax)' => $model->price_hna_per_ctn_before_tax,
                    'Price HNA Per Ctn (After Tax)' => $model->price_hna_per_ctn_after_tax,
                    'Total Order In Ctn' => $model->total_order_in_ctn,
                    'Discount (%)' => $model->discount,
                    'Discount Value' => $model->discount_value,
                    'PPN 10%' => $model->ppn,
                    'Net Price In Ctn (Before Tax)' => $model->net_price_in_ctn_before_tax,
                    'Net Price In Ctn (After Tax)' => $model->net_price_in_ctn_after_tax,
                    'Total Value Order In Ctn (Before Tax)' => $model->total_value_order_in_ctn_before_tax,
                    'Total Value Order In Ctn (After Tax)' => $model->total_value_order_in_ctn_after_tax,
                    'TOP' => $model->top,
                    'Due Date Invoice' => date('d-m-Y', strtotime($model->due_date_invoice)),
                    'Payment Status' => $model->payment_status == "0" ? lang('not_yet') : lang('done'),
                    'Payment Value' => $model->payment_value,
                    'Difference' => $model->difference,
                    'Selling Price' => $model->selling_price,
                    'Margin Percented' => $model->margin_percented,
                    'Margin Value' => $model->margin_value,
                    'Remark' => $model->remark
                );
                $message = "Delete Sell In " . strtolower(lang('companyreport')) . " " .  Invoice::find($model->invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 9);
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

    public function delete_out() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $user = $this->ion_auth->user()->row();
            $model = Companyreportout::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Receive Date' => date('d-m-Y', strtotime($model->receive_date)),
                    'Monthly Period' => $model->monthly_period,
                    'Tax Status' => $model->tax_status == "0" ? lang('non_pkp') : lang('pkp'),
                    'Tax No' => $model->tax_no == "" ? "-" : $model->tax_no,
                    'Invoice No' => Invoice::find($model->invoice_id)->invoice_no,
                    'Product' => Product::find($model->product_id)->product_code . ' - '  . Product::find($model->product_id)->name,
                    'Ship to Delivery' => $model->customer_id == '' ? '-' : Dipo::find($model->customer_id)->code . ' - '  . Dipo::find($model->customer_id)->name,
                    'Price HNA Per Ctn (Before Tax)' => $model->price_hna_per_ctn_before_tax,
                    'Price HNA Per Ctn (After Tax)' => $model->price_hna_per_ctn_after_tax,
                    'Total Order In Ctn' => $model->total_order_in_ctn,
                    'Discount (%)' => $model->discount,
                    'Discount Value' => $model->discount_value,
                    'PPN 10%' => $model->ppn,
                    'Net Price In Ctn (Before Tax)' => $model->net_price_in_ctn_before_tax,
                    'Net Price In Ctn (After Tax)' => $model->net_price_in_ctn_after_tax,
                    'Total Value Order In Ctn (Before Tax)' => $model->total_value_order_in_ctn_before_tax,
                    'Total Value Order In Ctn (After Tax)' => $model->total_value_order_in_ctn_after_tax,
                    'TOP' => $model->top,
                    'Due Date Invoice' => date('d-m-Y', strtotime($model->due_date_invoice)),
                    'Payment Status' => $model->payment_status == "0" ? lang('not_yet') : lang('done'),
                    'Payment Value' => $model->payment_value,
                    'Difference' => $model->difference,
                    'Remark' => $model->remark
                );
                $message = "Delete Sell Out " . strtolower(lang('companyreport')) . " " .  Invoice::find($model->invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 12);
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

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=sell_in_company.xls");

        $data['companyreports'] = Companyreport::select(
                                    't_sell_in_company.*',
                                    't_invoice.invoice_no as invoice_no',
                                    't_sp.sp_no as sp_no',
                                    'm_principle.code as principle_code',
                                    'm_principle.name as principle_name',
                                    'm_product.product_code as product_code',
                                    'm_product.name as product_name',
                                    'm_dipo_partner.code as customer_code',
                                    'm_dipo_partner.name as customer_name',
                                    'm_principle.top as top'
                                )
                                ->join('m_principle', 't_sell_in_company.principle_id', '=' ,'m_principle.id')
                                ->join('m_product', 't_sell_in_company.product_id', '=' ,'m_product.id')
                                ->join('m_dipo_partner', 't_sell_in_company.customer_id', '=' ,'m_dipo_partner.id')
                                ->join('t_invoice', 't_sell_in_company.invoice_id', '=' ,'t_invoice.id')
                                ->join('t_sp', 't_sell_in_company.sp_id', '=' ,'t_sp.id')
                                ->where('t_sell_in_company.deleted', 0)
                                ->orderBy('t_sell_in_company.id', 'DESC')
                                ->get();
        $this->load->view('companyreport/companyreport/companyreport_pdf', $data);
    }

    function excel_out(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=sell_out_company.xls");

        $data['companyreports'] = Companyreportout::select(
                                    't_sell_out_company.*',
                                    't_invoice.invoice_no as invoice_no',
                                    'm_product.product_code as product_code',
                                    'm_product.name as product_name',
                                    'm_dipo_partner.code as customer_code',
                                    'm_dipo_partner.name as customer_name',
                                    'm_dipo_partner.top as top'
                                )
                                ->join('m_product', 't_sell_out_company.product_id', '=' ,'m_product.id')
                                ->join('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
                                ->join('t_invoice', 't_sell_out_company.invoice_id', '=' ,'t_invoice.id')
                                ->where('t_sell_out_company.deleted', 0)
                                ->orderBy('t_sell_out_company.id', 'DESC')
                                ->get();
        $this->load->view('companyreport/companyreport/companyreportout_pdf', $data);
    }

    function getpricelistbyid(){
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Pricelist::find($id));
        } else {
            $model = array('status' => 'error', 'message' => lang('data_not_found'));
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function getpricelistbyproduct(){
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Pricelist::select('id', 'company_after_tax_ctn')->where('product_id',$id)->orderBy('id', 'DESC')->get());
        } else {
            $model = array('status' => 'error', 'message' => lang('data_not_found'));
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function getprinciplebyid(){
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Principle::find($id));
        } else {
            $model = array('status' => 'error', 'message' => lang('data_not_found'));
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function getcustomerbyid(){
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Dipo::find($id));
        } else {
            $model = array('status' => 'error', 'message' => lang('data_not_found'));
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

}
