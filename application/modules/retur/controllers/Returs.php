<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Returs extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'retur')){
            redirect('dashboard', 'refresh');            
        }

    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'retur');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'retur');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'retur');
        
        $user = $this->ion_auth->user()->row();
        if($user->group_id == 1){
            $invoices = Invoice::where('deleted', 0)->get();
        }   
        else{
            $invoices = Invoice::where('deleted', 0)->where('user_created', $user->id)->get();            
        }     

        $data['invoices'] = $invoices;
        $data['products'] = Product::select('m_product.id', 'm_product.product_code', 'm_product.name as product_name')->where('m_product.deleted', 0)->orderBy('m_product.product_code', 'ASC')->get();
        $data['user'] = $this->ion_auth->user()->row();

        $this->load->blade('retur.views.retur.page', $data);
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
        $where = "t_sell_out_company.deleted = 0 AND t_sell_out_company.sell_type = 'retur'";
        if($user->group_id == '2'){
            $where .= " AND (t_sell_out_company.user_created = ". $user->id . " OR tbl_dipo.dipo_id = ". $user->dipo_partner_id .")";
        }
        else if($user->group_id == '3'){
            $where .= " AND t_sell_out_company.user_created = ". $user->id;
        }

        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');

        $join[] = array('m_product', 't_sell_out_company.product_id = m_product.id', 'left');
        $join[] = array('m_dipo_partner', 't_sell_out_company.customer_id = m_dipo_partner.id', 'left');
        $join[] = array('t_invoice', 't_sell_out_company.invoice_id = t_invoice.id', 'left');
        $join[] = array('users', 't_sell_out_company.user_created = users.id', 'left');
        if($user->group_id == '2'){
            $join[] = array('m_dipo_partner as tbl_dipo', 'users.dipo_partner_id = tbl_dipo.id', 'left');
        }
        
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
            // if($this->user_profile->get_user_access('Updated', 'companyreport')){
            //     $btn_action .= '<a href="javascript:void()" onclick="viewDataOut(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            // }
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
                
                $model = new Retur();
                $model->receive_date = $receive_date;
                $model->monthly_period = $monthly_period;
                $model->tax_status = $tax_status;
                $model->tax_no = $tax_no;
                $model->invoice_id = $invoice_id;
                $model->product_id = $product_id;
                $model->customer_id = $customer_id;
                $model->sell_type = "retur";
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
                    $amount = $this->input->post('amount_out');

                    for($row_detail=0;$row_detail<count($amount);$row_detail++){	
                        if($amount[$row_detail] > 0){
                            $model_detail = new Returdetail();
                            $model_detail->sell_out_id = $model->id;
                            $model_detail->amount = $amount[$row_detail];
                            $model_detail->user_created = $user->id;
                            $model_detail->date_created = date('Y-m-d');
                            $model_detail->time_created = date('H:i:s');
                            $model_detail->save();
                        }
                    }

                    $data_notif = array(
                        'Receive Date' => date('d-m-Y', strtotime($receive_date)),
                        'Monthly Period' => $monthly_period,
                        'Tax Status' => $tax_status == "0" ? lang('non_pkp') : lang('pkp'),
                        'Tax No' => $tax_no == "" ? "-" : $tax_no,
                        'Invoice No' => Invoice::find($invoice_id)->invoice_no,
                        'Product' => Product::find($product_id)->product_code . ' - '  . Product::find($product_id)->name,
                        'Ship to Delivery' => $customer_id == '' || $customer_id == '0' ? '-' : Dipo::find($customer_id)->code . ' - '  . Dipo::find($customer_id)->name,
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
                    $message = "Add " . strtolower(lang('retur')) . " " . Invoice::find($invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 18);

                    $model_jurnal = new Jurnal();
                    $model_jurnal->jurnal_date = date('Y-m-d');
                    $model_jurnal->month = date('F');
                    $model_jurnal->reff_id = $model->id;
                    $model_jurnal->description = Invoice::find($invoice_id)->invoice_no;
                    $model_jurnal->d_k = 'D';
                    $model_jurnal->coa_id = 5;
                    $model_jurnal->total = $total_value_order_in_ctn_after_tax;
                    
                    $model_jurnal->user_created = $user->id;
                    $model_jurnal->date_created = date('Y-m-d');
                    $model_jurnal->time_created = date('H:i:s');
                    $save_jurnal = $model_jurnal->save();

                    if($save_jurnal){
                        $data_notif = array(
                            'Tanggal' => date('Y-m-d'),
                            'Bulan' => date('F'),
                            'Keterangan' => Invoice::find($invoice_id)->invoice_no,
                            'D/K' => 'D',
                            'Chart Of Account' => Chartofaccount::find(5)->code,
                            'Total' => $total_value_order_in_ctn_after_tax,
                        );
                        $message = "Add " . lang('jurnal') . " " . Invoice::find($invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 17);
                    }

                    $status = array('status' => 'success', 'message' => lang('message_save_success'));
                } else {
                    $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                }
            } elseif(!empty($id_companyreport)) {
                $model = Retur::find($id_companyreport);

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
                        'Ship to Delivery' => $customer_id == '' || $customer_id == '0' ? '-' : Dipo::find($customer_id)->code . ' - '  . Dipo::find($customer_id)->name,
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
                    $message = "Update " . strtolower(lang('retur')) . " " .  Invoice::find($model->invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 18);
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
    
    public function view_out() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $model = array('status' => 'success', 'data' => Retur::find($id));
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function delete_out() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $user = $this->ion_auth->user()->row();
            $model = Retur::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $model_detail = Returdetail::where('sell_out_id', $id)->update([
                    'deleted' => 1,
                    'user_deleted' => $user->id,
                    'date_deleted' => date('Y-m-d'),
                    'time_deleted' => date('H:i:s')
                ]);

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
                $message = "Delete " . strtolower(lang('retur')) . " " .  Invoice::find($model->invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 18);

                // DELETE JURNAL
                $model_jurnal = Jurnal::where('reff_id', $id)->where('description', Invoice::find($model->invoice_id)->invoice_no)->where('coa_id', 5)->where('d_k', 'D')->where('deleted', 0)->first();
                $model_jurnal->deleted = 1;
                $model_jurnal->user_deleted = $user->id;
                $model_jurnal->date_deleted = date('Y-m-d');
                $model_jurnal->time_deleted = date('H:i:s');
                $model_jurnal->save();

                $data_notif = array(
                    'Tanggal' => $model_jurnal->jurnal_date,
                    'Bulan' => $model_jurnal->month,
                    'Keterangan' => $model_jurnal->description,
                    'D/K' => $model_jurnal->d_k,
                    'Chart Of Account' => Chartofaccount::find($model_jurnal->coa_id)->code,
                    'Total' => $model_jurnal->total,
                );
                $message = "Delete " . lang('jurnal') . " " . Invoice::find($model->invoice_id)->invoice_no . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 17);

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
        header("Content-Disposition: attachment; filename=retur.xls");

        $user = $this->ion_auth->user()->row();
        if($user->group_id == '2'){
            $data['returs'] = Retur::select(
                                    't_sell_out_company.*',
                                    't_invoice.invoice_no as invoice_no',
                                    'm_product.product_code as product_code',
                                    'm_product.name as product_name',
                                    'm_dipo_partner.code as customer_code',
                                    'm_dipo_partner.name as customer_name',
                                    'm_dipo_partner.top as top'
                                )
                                ->leftJoin('m_product', 't_sell_out_company.product_id', '=' ,'m_product.id')
                                ->leftJoin('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
                                ->leftJoin('t_invoice', 't_sell_out_company.invoice_id', '=' ,'t_invoice.id')
                                ->leftJoin('users', 't_sell_out_company.user_created', '=' ,'users.id')
                                ->leftJoin('m_dipo_partner as tbl_dipo', 'users.dipo_partner_id', '=' ,'tbl_dipo.id')
                                ->where('t_sell_out_company.deleted', 0)
                                ->where('t_sell_out_company.sell_type', 'retur')
                                ->where(function($query) use ($user){
                                    $query->where('t_sell_out_company.user_created', $user->id)
                                        ->orWhere('tbl_dipo.dipo_id', $user->dipo_partner_id);
                                })
                                ->orderBy('t_sell_out_company.id', 'DESC')
                                ->get();
        }
        else if($user->group_id == '3'){
            $data['returs'] = Retur::select(
                                    't_sell_out_company.*',
                                    't_invoice.invoice_no as invoice_no',
                                    'm_product.product_code as product_code',
                                    'm_product.name as product_name',
                                    'm_dipo_partner.code as customer_code',
                                    'm_dipo_partner.name as customer_name',
                                    'm_dipo_partner.top as top'
                                )
                                ->leftJoin('m_product', 't_sell_out_company.product_id', '=' ,'m_product.id')
                                ->leftJoin('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
                                ->leftJoin('t_invoice', 't_sell_out_company.invoice_id', '=' ,'t_invoice.id')
                                ->leftJoin('users', 't_sell_out_company.user_created', '=' ,'users.id')
                                ->where('t_sell_out_company.deleted', 0)
                                ->where('t_sell_out_company.sell_type', 'retur')
                                ->where('t_sell_out_company.user_created', $user->id)
                                ->orderBy('t_sell_out_company.id', 'DESC')
                                ->get();
        }
        else{
            $data['returs'] = Retur::select(
                                    't_sell_out_company.*',
                                    't_invoice.invoice_no as invoice_no',
                                    'm_product.product_code as product_code',
                                    'm_product.name as product_name',
                                    'm_dipo_partner.code as customer_code',
                                    'm_dipo_partner.name as customer_name',
                                    'm_dipo_partner.top as top'
                                )
                                ->leftJoin('m_product', 't_sell_out_company.product_id', '=' ,'m_product.id')
                                ->leftJoin('m_dipo_partner', 't_sell_out_company.customer_id', '=' ,'m_dipo_partner.id')
                                ->leftJoin('t_invoice', 't_sell_out_company.invoice_id', '=' ,'t_invoice.id')
                                ->leftJoin('users', 't_sell_out_company.user_created', '=' ,'users.id')
                                ->where('t_sell_out_company.deleted', 0)
                                ->where('t_sell_out_company.sell_type', 'retur')
                                ->orderBy('t_sell_out_company.id', 'DESC')
                                ->get();
        }

        $this->load->view('retur/retur/retur_pdf', $data);
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
            $user = $this->ion_auth->user()->row();
            if($user->group_id == 1){
                $pricelist = Pricelist::select('id', 'company_after_tax_ctn')->where('product_id',$id)->where('deleted',0)->orderBy('id', 'DESC')->get();
            }
            else{
                $pricelist = Pricelist::select('id', 'company_after_tax_ctn')->where('product_id',$id)->where('deleted',0)->where('user_created', $user->id)->orderBy('id', 'DESC')->get();                
            }

            $model = array('status' => 'success', 'data' => $pricelist);
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
