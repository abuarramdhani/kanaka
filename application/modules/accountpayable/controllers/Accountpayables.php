<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accountpayables extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'accountpayable')){
            redirect('dashboard', 'refresh');            
        }

    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'accountpayable');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'accountpayable');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'accountpayable');

        $data['cities'] = City::where('deleted', 0)->get();        
        $data['zonas'] = Zona::where('deleted', 0)->get();

        $this->load->blade('accountpayable.views.accountpayable.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            't_sell_in_company.customer_id',
            't_sell_in_company.due_date_invoice',
            't_sell_in_company.payment_status',
            'm_dipo_partner.name',
        );

        $header_columns = array(
            'm_dipo_partner.name',
        );

        $from = "t_sell_in_company";
        $where = "t_sell_in_company.deleted = 0 AND t_sell_in_company.payment_status != 3";

        $user = $this->ion_auth->user()->row();
        if($user->group_id != '1'){
            $where .= " AND t_sell_in_company.user_created = ". $user->id;
        }

        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        $group_by = array(
            't_sell_in_company.customer_id',
            'm_dipo_partner.name',
        );
        $join[] = array('m_dipo_partner', 't_sell_in_company.customer_id = m_dipo_partner.id', 'left');
        
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
            // $row_si = Companyreport::selectRaw('SUM(total_value_order_in_ctn_after_tax) as nominal')
            //             ->where('customer_id', '=', $row->id)
            //             ->where('payment_status', '!=', 3)
            //             ->where('deleted', '=', 0)
            //             ->first();
                        
            // if($row_si->nominal > 0){
                $row_value = array();
                $row_value[] = $row->name;
                $row_value[] = 0;
                $row_value[] = $row->due_date_invoice;
                $row_value[] = 0;
                $row_value[] = 0;
                $row_value[] = 0;
                $row_value[] = 0;
                $row_value[] = 0;
                
                $new_aa_data[] = $row_value;
            // }
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }
    
    function pdf(){
        $data['accountpayables'] = Dipo::select('m_dipo_partner.*')->where('m_dipo_partner.type', 'dipo')->where('m_dipo_partner.deleted', 0)->orderBy('m_dipo_partner.id', 'DESC')->get();
        $data['quote'] = "";
        $html = $this->load->view('accountpayable/accountpayable/accountpayable_pdf', $data, true);
        $this->pdf_generator->generate($html, 'account payable pdf', $orientation='Landscape');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=accountpayable.xls");
        $data['accountpayables'] = Dipo::select('m_dipo_partner.*')->where('m_dipo_partner.type', 'dipo')->where('m_dipo_partner.deleted', 0)->orderBy('m_dipo_partner.id', 'DESC')->get();
        $data['quote'] = "'";
        $this->load->view('accountpayable/accountpayable/accountpayable_pdf', $data);
    }

}
