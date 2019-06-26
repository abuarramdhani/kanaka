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
            'm_dipo_partner.id',
            'm_dipo_partner.type',
            'code',
            'm_dipo_partner.name',
            'address',
            'phone',
            'email',
            'm_city.name as city_name',
            'm_district.name as subdistrict',
            // 'm_zona.name as zona_name',
            'm_dipo_partner.zona_id',
            'latitude',
            'longitude',
            'pic',
            'top',
            'm_dipo_partner.date_created',
        );

        $header_columns = array(
            'code',
            'm_dipo_partner.name',
            'address',
            'phone',
            'email',
            'city_name',
            'subdistrict',
            // 'zona_name',
            'm_dipo_partner.zona_id',
            'latitude',
            'longitude',
            'pic',
            'top',
            'm_dipo_partner.date_created',
        );

        $from = "m_dipo_partner";
        $where = "m_dipo_partner.type = 'dipo' AND m_dipo_partner.deleted = 0";
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
            $where .= "address LIKE '%" . $sSearch . "%' OR ";
            $where .= "phone LIKE '%" . $sSearch . "%' OR ";
            $where .= "email LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_city.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "subdistrict LIKE '%" . $sSearch . "%' OR ";
            // $where .= "m_zona.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "latitude LIKE '%" . $sSearch . "%' OR ";
            $where .= "longitude LIKE '%" . $sSearch . "%' OR ";
            $where .= "pic LIKE '%" . $sSearch . "%' OR ";
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
            if($this->user_profile->get_user_access('Updated', 'accountpayable')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'accountpayable')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->code;
            $row_value[] = $row->name;
            $row_value[] = $row->address;
            $row_value[] = $row->phone;
            $row_value[] = $row->email == "" ? "-" : $row->email;
            $row_value[] = $row->city_name == "" ? "-" : ucwords(strtolower($row->city_name));
            $row_value[] = $row->subdistrict == "" ? "-" : $row->subdistrict;
            // $row_value[] = $row->zona_name;
            $row_value[] = $row->zona_id == 0 ? "-" : Zona::find($row->zona_id)->name;
            $row_value[] = $row->latitude == "" ? "-" : $row->latitude;
            $row_value[] = $row->longitude == "" ? "-" : $row->longitude;
            $row_value[] = $row->pic == "" ? "-" : $row->pic;
            $row_value[] = $row->top == "" ? "-" : strtoupper($row->top);
            $row_value[] = date('d-m-Y',strtotime($row->date_created));
            $row_value[] = $btn_action;
            
            $new_aa_data[] = $row_value;
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
