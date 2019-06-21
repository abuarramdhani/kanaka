<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dipos extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
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
        $database_columns = array(
            'm_dipo_partner.id',
            'm_dipo_partner.type',
            'code',
            'm_dipo_partner.name',
            'address',
            'phone',
            'email',
            'm_city.name as city_name',
            'subdistrict',
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
            if($this->user_profile->get_user_access('Updated', 'dipo')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'dipo')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->code;
            $row_value[] = $row->name;
            $row_value[] = $row->address;
            $row_value[] = $row->phone;
            $row_value[] = $row->email == "" ? "-" : $row->email;
            $row_value[] = ucwords(strtolower($row->city_name));
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

    public function save() {
        if ($this->input->is_ajax_request()) {
            $user = $this->ion_auth->user()->row();
            $id_dipo = $this->input->post('id');
            $get_dipo = Dipo::where('code' , $this->input->post('code'))->where('deleted', 0)->first();
            if (empty($id_dipo)) {
                if (!empty($get_dipo->name)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $code = strtoupper($this->input->post('code'));
                    $name = ucwords($this->input->post('name'));
                    $address = $this->input->post('address');
                    $phone = $this->input->post('phone');
                    $email = $this->input->post('email');
                    $city = $this->input->post('city');
                    $subdistrict = $this->input->post('subdistrict');
                    $zona_id = $this->input->post('zona_id');
                    $latitude = $this->input->post('latitude');
                    $longitude = $this->input->post('longitude');
                    $pic = $this->input->post('pic');
                    $top = $this->input->post('top');
                    
                    $model = new Dipo();
                    $model->type = 'dipo';
                    $model->code = $code;
                    $model->name = $name;
                    $model->address = $address;
                    $model->phone = $phone;
                    $model->email = $email;
                    $model->city = $city;
                    $model->subdistrict = $subdistrict;
                    $model->zona_id = $zona_id;
                    $model->latitude = $latitude;
                    $model->longitude = $longitude;
                    $model->pic = $pic;
                    $model->top = $top;
                    
                    $model->user_created = $user->id;
                    $model->date_created = date('Y-m-d');
                    $model->time_created = date('H:i:s');
                    $save = $model->save();
                    if ($save) {
                        $data_notif = array(
                            'Code' => $code,
                            'Name' => $name,
                            'Address' => $address,
                            'Phone' => $phone,
                            'Email' => $email,
                            'City' => ucwords(strtolower(City::find($city)->name)),
                            'Subdistrict' => $subdistrict,
                            'Zona Name' => Zona::find($zona_id)->name,
                            'Latitude' => $latitude,
                            'Longitude' => $longitude,
                            'PIC' => $pic,
                            'TOP' => strtoupper($top),
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
                $name = ucwords($this->input->post('name'));
                $address = $this->input->post('address');
                $phone = $this->input->post('phone');
                $email = $this->input->post('email');
                $city = $this->input->post('city');
                $subdistrict = $this->input->post('subdistrict');
                $zona_id = $this->input->post('zona_id');
                $latitude = $this->input->post('latitude');
                $longitude = $this->input->post('longitude');
                $pic = $this->input->post('pic');
                $top = $this->input->post('top');
            
                $data_old = array(
                    'Code' => $model->code,
                    'Name' => $model->name,
                    'Address' => $model->address,
                    'Phone' => $model->phone,
                    'Email' => $model->email,
                    'City' => $model->city == "" ? "-" : ucwords(strtolower(City::find($model->city)->name)),
                    'Subdistrict' => $model->subdistrict,
                    'Zona Name' => $model->zona_id == "" ? "-" : Zona::find($model->zona_id)->name,
                    'Latitude' => $model->latitude,
                    'Longitude' => $model->longitude,
                    'PIC' => $model->pic,
                    'TOP' => strtoupper($model->top),
                );

                $model->code = $code;
                $model->name = $name;
                $model->address = $address;
                $model->phone = $phone;
                $model->email = $email;
                $model->city = $city;
                $model->subdistrict = $subdistrict;
                $model->zona_id = $zona_id;
                $model->latitude = $latitude;
                $model->longitude = $longitude;
                $model->pic = $pic;
                $model->top = $top;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();
                if ($update) {
                    $data_new = array(
                        'Code' => $code,
                        'Name' => $name,
                        'Address' => $address,
                        'Phone' => $phone,
                        'Email' => $email,
                        'City' => ucwords(strtolower(City::find($city)->name)),
                        'Subdistrict' => $subdistrict,
                        'Zona Name' => Zona::find($zona_id)->name,
                        'Latitude' => $latitude,
                        'Longitude' => $longitude,
                        'PIC' => $pic,
                        'TOP' => strtoupper($top),
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
                    'Code' => $model->code,
                    'Name' => $model->name,
                    'Address' => $model->address,
                    'Phone' => $model->phone,
                    'Email' => $model->email,
                    'City' => $model->city == "" ? "-" : ucwords(strtolower(City::find($model->city)->name)),
                    'Subdistrict' => $model->subdistrict,
                    'Zona Name' => $model->zona_id == "" ? "-" : Zona::find($model->zona_id)->name,
                    'Latitude' => $model->latitude,
                    'Longitude' => $model->longitude,
                    'PIC' => $model->pic,
                    'TOP' => strtoupper($model->top),
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
        $data['dipos'] = Dipo::select('m_dipo_partner.*')->where('m_dipo_partner.type', 'dipo')->where('m_dipo_partner.deleted', 0)->orderBy('m_dipo_partner.id', 'DESC')->get();
        $data['quote'] = "'";
        $this->load->view('dipo/dipo/dipo_pdf', $data);
    }

}
