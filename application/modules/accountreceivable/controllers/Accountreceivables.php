<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accountreceivables extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'accountreceivable')){
            redirect('dashboard', 'refresh');            
        }

    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'accountreceivable');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'accountreceivable');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'accountreceivable');

        $this->load->blade('accountreceivable.views.accountreceivable.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            't_sell_out_company.customer_id as id',
            'm_dipo_partner.name',
            't_sell_out_company.payment_status',
        );

        $header_columns = array(
            'm_dipo_partner.name',
            'm_dipo_partner.name',
            't_sell_out_company.payment_status',
        );

        $from = "t_sell_out_company";
        $where = "t_sell_out_company.deleted = 0 AND t_sell_out_company.payment_status != 3 AND t_sell_out_company.customer_id > 0";

        $user = $this->ion_auth->user()->row();
        if($user->group_id != '1'){
            $where .= " AND t_sell_out_company.user_created = ". $user->id;
        }

        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        $group_by = array(
            't_sell_out_company.customer_id',
            'm_dipo_partner.name',
        );
        $join[] = array('m_dipo_partner', 't_sell_out_company.customer_id = m_dipo_partner.id', 'left');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            
            $where .= " AND (";
            $where .= "m_dipo_partner.name LIKE '%" . $sSearch . "%' OR ";
            $where .= ")";
        }

        $this->datatables->set_index('m_dipo_partner.id');
        $this->datatables->config('database_columns', $database_columns);
        $this->datatables->config('from', $from);
        $this->datatables->config('join', $join);
        $this->datatables->config('where', $where);
        $this->datatables->config('group_by', $group_by);
        $this->datatables->config('order_by', $order_by);
        $selected_data = $this->datatables->get_select_data();
        $aa_data = $selected_data['aaData'];
        $new_aa_data = array();
        
        foreach ($aa_data as $row) {
            $row_si = Companyreportout::selectRaw('SUM(difference) as nominal')
                        ->where('customer_id', '=', $row->id)
                        ->where('payment_status', '!=', 3)
                        ->where('deleted', '=', 0)
                        ->first();

            $payment_status = 'Lunas';
            if($row->payment_status == '0'){
                $payment_status = 'Belum Bayar';
            }
            else if($row->payment_status == '1'){
                $payment_status = 'Cicil';
            }
            else if($row->payment_status == '2'){
                $payment_status = 'Sudah Lewat Jatuh Tempo';
            }

            $btn_action = '';
            if($this->user_profile->get_user_access('Viewed', 'accountreceivable')){
                $btn_action .= '<a href="' . base_url() . 'reports/accountreceivable/detail/' . uri_encrypt($row->id) . '" class="btn btn-info btn-icon-only btn-circle" title="' . lang('update') . '"><i class="fa fa-eye"></i> </a>';
            }

            $row_value = array();
            $row_value[] = $row->name;
            $row_value[] = number_format($row_si->nominal, 0);
            $row_value[] = $payment_status;
            $row_value[] = $btn_action;
            
            $new_aa_data[] = $row_value;
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }
    
    function pdf(){
        $user = $this->ion_auth->user()->row();
        if($user->group_id != '1'){
            $group_by = array(
                't_sell_out_company.customer_id',
                'm_dipo_partner.name',
            );
            $data['accountreceivables'] = Companyreportout::select(
                    't_sell_out_company.customer_id as id',
                    'm_dipo_partner.name',
                    't_sell_out_company.payment_status'
            )
            ->join('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
            ->groupBy( 't_sell_out_company.customer_id', 'm_dipo_partner.name')
            ->where('t_sell_out_company.deleted', 0)
            ->where('t_sell_out_company.payment_status', '!=', 3)
            ->where('t_sell_out_company.customer_id', '>', 0)
            ->where('t_sell_out_company.user_created', $user->id)
            ->orderBy('m_dipo_partner.name', 'ASC')
            ->get();
        }
        else{
            $data['accountreceivables'] = Companyreportout::select(
                    't_sell_out_company.customer_id as id',
                    'm_dipo_partner.name',
                    't_sell_out_company.payment_status'
            )
            ->join('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
            ->groupBy( 't_sell_out_company.customer_id', 'm_dipo_partner.name')
            ->where('t_sell_out_company.deleted', 0)
            ->where('t_sell_out_company.payment_status', '!=', 3)
            ->where('t_sell_out_company.customer_id', '>', 0)
            ->orderBy('m_dipo_partner.name', 'ASC')
            ->get();
        }

        $html = $this->load->view('accountreceivable/accountreceivable/accountreceivable_pdf', $data, true);
        $this->pdf_generator->generate($html, 'account receivable pdf', $orientation='Landscape');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=accountreceivable.xls");
        
        $user = $this->ion_auth->user()->row();
        if($user->group_id != '1'){
            $data['accountreceivables'] = Companyreportout::select(
                    't_sell_out_company.customer_id as id',
                    'm_dipo_partner.name',
                    't_sell_out_company.payment_status'
            )
            ->join('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
            ->groupBy( 't_sell_out_company.customer_id', 'm_dipo_partner.name')
            ->where('t_sell_out_company.deleted', 0)
            ->where('t_sell_out_company.payment_status', '!=', 3)
            ->where('t_sell_out_company.customer_id', '>', 0)
            ->where('t_sell_out_company.user_created', $user->id)
            ->orderBy('m_dipo_partner.name', 'ASC')
            ->get();
        }
        else{
            $data['accountreceivables'] = Companyreportout::select(
                    't_sell_out_company.customer_id as id',
                    'm_dipo_partner.name',
                    't_sell_out_company.payment_status'
            )
            ->join('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
            ->groupBy( 't_sell_out_company.customer_id', 'm_dipo_partner.name')
            ->where('t_sell_out_company.deleted', 0)
            ->where('t_sell_out_company.payment_status', '!=', 3)
            ->where('t_sell_out_company.customer_id', '>', 0)
            ->orderBy('m_dipo_partner.name', 'ASC')
            ->get();
        }

        $this->load->view('accountreceivable/accountreceivable/accountreceivable_pdf', $data);
    }

    public function detail($customer_id) {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'accountreceivable');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'accountreceivable');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'accountreceivable');
        
        $data['customer_id'] = $customer_id;
        $data['customer'] = Dipo::find(uri_decrypt($customer_id));
        
        $this->load->blade('accountreceivable.views.accountreceivable.detail', $data);
    }

    public function fetch_data_detail($customer_id = "") {
        $customer_id = uri_decrypt($customer_id);
        $user = $this->ion_auth->user()->row();

        $database_columns = array(
            'm_dipo_partner.name as customer_name',
            'difference',
            't_invoice.invoice_no as invoice_no',
            'total_value_order_in_ctn_after_tax',
            'due_date_invoice',
            't_sell_out_company.top',
        );

        $header_columns = array(
            'customer_name',
            'customer_name',
            'total_value_order_in_ctn_after_tax',
            'invoice_no',
            'due_date_invoice',
            'difference',
            'difference',
            'difference',
            'difference',
        );

        $from = "t_sell_out_company";
        $where = "t_sell_out_company.deleted = 0 AND t_sell_out_company.payment_status != 3 AND t_sell_out_company.customer_id = " . $customer_id;
        if($user->group_id != '1'){
            $where .= " AND t_sell_out_company.user_created = ". $user->id;
        }

        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');

        $join[] = array('m_dipo_partner', 't_sell_out_company.customer_id = m_dipo_partner.id', 'left');
        $join[] = array('t_invoice', 't_sell_out_company.invoice_id = t_invoice.id', 'left');
        
        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "t_invoice.invoice_no LIKE '%" . $sSearch . "%' OR ";
            $where .= "customer_name LIKE '%" . $sSearch . "%' OR ";
            $where .= "due_date_invoice LIKE '%" . $sSearch . "%' OR ";
            $where .= "difference LIKE '%" . $sSearch . "%' OR ";
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

        $no = 1;
        foreach ($aa_data as $row) {
            $row_value = array();

            // $due_date_invoice = date('Y-m-d', strtotime($row->receive_date . ' + ' . $row->top . ' days'));
            $due_date_invoice = $row->due_date_invoice;
            $aging_invoice = round((strtotime($due_date_invoice) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));

            $row_value[] = $no++;
            $row_value[] = $row->customer_name == "" ? "-" : $row->customer_name;
            $row_value[] = number_format($row->total_value_order_in_ctn_after_tax, 0);
            $row_value[] = $row->invoice_no;
            $row_value[] = date('d-m-Y', strtotime($due_date_invoice));
            $row_value[] = $aging_invoice <= 30 ? number_format($row->difference, 0) : 0;
            $row_value[] = $aging_invoice >= 31 && $aging_invoice <= 60 ? number_format($row->difference, 0) : 0;
            $row_value[] = $aging_invoice >= 61 && $aging_invoice <= 90 ? number_format($row->difference, 0) : 0;
            $row_value[] = $aging_invoice >= 91 ? number_format($row->difference, 0) : 0;
            
            $new_aa_data[] = $row_value;
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }
    
    function pdf_detail($customer_id){
        $customer_id = uri_decrypt($customer_id);
        $user = $this->ion_auth->user()->row();
        if($user->group_id != '1'){
            $data['accountreceivables'] = Companyreportout::select(
                'm_dipo_partner.name as customer_name',
                'difference',
                't_invoice.invoice_no as invoice_no',
                'total_value_order_in_ctn_after_tax',
                'due_date_invoice',
                't_sell_out_company.top'
            )
            ->join('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
            ->join('t_invoice', 't_sell_out_company.invoice_id', '=' ,'t_invoice.id')
            ->where('t_sell_out_company.deleted', 0)
            ->where('t_sell_out_company.payment_status', '!=', 3)
            ->where('t_sell_out_company.customer_id', $customer_id)
            ->where('t_sell_out_company.user_created', $user->id)
            ->orderBy('m_dipo_partner.name', 'ASC')
            ->get();
        }
        else{
            $data['accountreceivables'] = Companyreportout::select(
                'm_dipo_partner.name as customer_name',
                'difference',
                't_invoice.invoice_no as invoice_no',
                'total_value_order_in_ctn_after_tax',
                'due_date_invoice',
                't_sell_out_company.top'
            )
            ->join('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
            ->join('t_invoice', 't_sell_out_company.invoice_id', '=' ,'t_invoice.id')
            ->where('t_sell_out_company.deleted', 0)
            ->where('t_sell_out_company.payment_status', '!=', 3)
            ->where('t_sell_out_company.customer_id', $customer_id)
            ->orderBy('m_dipo_partner.name', 'ASC')
            ->get();
        }

        $data['customer'] = Dipo::find($customer_id);

        $html = $this->load->view('accountreceivable/accountreceivable/accountreceivable_detail_pdf', $data, true);
        $this->pdf_generator->generate($html, 'account receivable pdf', $orientation='Landscape');
    }

    function excel_detail($customer_id){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=accountreceivable detail.xls");
        
        $customer_id = uri_decrypt($customer_id);
        $user = $this->ion_auth->user()->row();
        if($user->group_id != '1'){
            $data['accountreceivables'] = Companyreportout::select(
                'm_dipo_partner.name as customer_name',
                'difference',
                't_invoice.invoice_no as invoice_no',
                'total_value_order_in_ctn_after_tax',
                'due_date_invoice',
                't_sell_out_company.top'
            )
            ->join('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
            ->join('t_invoice', 't_sell_out_company.invoice_id', '=' ,'t_invoice.id')
            ->where('t_sell_out_company.deleted', 0)
            ->where('t_sell_out_company.payment_status', '!=', 3)
            ->where('t_sell_out_company.customer_id', $customer_id)
            ->where('t_sell_out_company.user_created', $user->id)
            ->orderBy('m_dipo_partner.name', 'ASC')
            ->get();
        }
        else{
            $data['accountreceivables'] = Companyreportout::select(
                'm_dipo_partner.name as customer_name',
                'difference',
                't_invoice.invoice_no as invoice_no',
                'total_value_order_in_ctn_after_tax',
                'due_date_invoice',
                't_sell_out_company.top'
            )
            ->join('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
            ->join('t_invoice', 't_sell_out_company.invoice_id', '=' ,'t_invoice.id')
            ->where('t_sell_out_company.deleted', 0)
            ->where('t_sell_out_company.payment_status', '!=', 3)
            ->where('t_sell_out_company.customer_id', $customer_id)
            ->orderBy('m_dipo_partner.name', 'ASC')
            ->get();
        }

        $data['customer'] = Dipo::find($customer_id);

        $this->load->view('accountreceivable/accountreceivable/accountreceivable_detail_pdf', $data);
    }

}
