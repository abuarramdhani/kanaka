<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
    }

	public function index(){
        $user = $this->ion_auth->user()->row();
		$total_saldo    = 0;
		$total_hutang   = 0;
        $total_piutang  = 0;
        $total_in       = 0;
        $total_out      = 0;
        
        $row_si = Companyreport::selectRaw('SUM(difference) as nominal')
                        ->where('payment_status', '!=', 3)
                        ->where('deleted', '=', 0);
        if($user->group_id != '1'){
            $row_si->where('user_created', '=', $user->id);
        }
        $row_si =  $row_si->get();
        foreach($row_si as $si){
            $total_hutang = $si->nominal;
        }

        $row_so = Companyreportout::selectRaw('SUM(difference) as nominal')
                        ->where('payment_status', '!=', 3)
                        ->where('deleted', '=', 0);
        if($user->group_id != '1'){
            $row_so->where('user_created', '=', $user->id);
        }
        $row_so = $row_so->get();
        foreach($row_so as $so){
            $total_piutang = $so->nominal;
        }

        $row_total_in = Jurnal::selectRaw('SUM(total) as total')
                                ->where('t_jurnal.deleted', 0)
                                ->where('t_jurnal.d_k', 'd');
        if($user->group_id != '1'){
            $row_total_in->where('user_created', '=', $user->id);
        }
        $row_total_in = $row_total_in->get();
        foreach($row_total_in as $in){
            $total_in = $in->total;
        }

        $row_total_out = Jurnal::selectRaw('SUM(total) as total')
                                ->where('t_jurnal.deleted', 0)
                                ->where('t_jurnal.d_k', 'k');
        if($user->group_id != '1'){
            $row_total_out->where('user_created', '=', $user->id);
        }
        $row_total_out = $row_total_out->get();
        foreach($row_total_out as $out){
            $total_out = $out->total;
        }

        $total_saldo = $total_in-$total_out;

        // NERACA SALDO
        if($user->group_id != '1'){
            $data['jurnals'] = $this->db->query("SELECT SUM(total) as total, t_jurnal.d_k, m_chart_of_accounts.code as coa_code, m_chart_of_accounts.description as coa_name
                                    FROM t_jurnal
                                    INNER JOIN m_chart_of_accounts ON t_jurnal.coa_id = m_chart_of_accounts.id 
                                    WHERE t_jurnal.deleted = 0
                                    AND m_chart_of_accounts.deleted = 0
                                    AND t_jurnal.user_created = $user->id
                                    GROUP BY m_chart_of_accounts.code, d_k
                                    ;")->result();
        }
        else{
            $data['jurnals'] = $this->db->query("SELECT SUM(total) as total, t_jurnal.d_k, m_chart_of_accounts.code as coa_code, m_chart_of_accounts.description as coa_name
                                    FROM t_jurnal
                                    INNER JOIN m_chart_of_accounts ON t_jurnal.coa_id = m_chart_of_accounts.id 
                                    WHERE t_jurnal.deleted = 0
                                    AND m_chart_of_accounts.deleted = 0
                                    GROUP BY m_chart_of_accounts.code, d_k
                                    ;")->result();
        }

        // STOCK      
        $data['stocks_kanaka'] = $this->get_kanaka_stock();
        $data['stocks_dipo'] = $this->get_data_stock('dipo');
        $data['stocks_mitra'] = $this->get_data_stock('partner');

        $data['user'] = $this->ion_auth->user()->row();
        $data['report_si'] = $this->grafik_si();
        $data['report_so'] = $this->grafik_so();
        $data['total_saldo'] = number_format($total_saldo);
        $data['total_hutang'] = number_format($total_hutang);
        $data['total_piutang'] = number_format($total_piutang);
        $this->load->blade('dashboard.views.dashboard.page', $data);
    }

    public function grafik_si(){
        $user = $this->ion_auth->user()->row();
        $condition = '';
        if($user->group_id != '1'){
            $condition .= " AND t_sell_in_company.user_created = '".$user->id."'";
        }

        $query = $this->db->query("SELECT sum(payment_value) as total, receive_date, m_principle.name as principle_name
                                    FROM t_sell_in_company 
                                    INNER JOIN m_principle ON t_sell_in_company.principle_id = m_principle.id
                                    WHERE t_sell_in_company.deleted = 0 
                                    $condition
                                    GROUP BY receive_date");
        
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function grafik_so(){
        $user = $this->ion_auth->user()->row();
        $condition = '';
        if($user->group_id != '1'){
            $condition .= " AND t_sell_out_company.user_created = '".$user->id."'";
        }
        $query = $this->db->query("SELECT sum(payment_value) as total, receive_date, m_dipo_partner.name as customer_name
                                    FROM t_sell_out_company 
                                    INNER JOIN m_dipo_partner ON t_sell_out_company.customer_id = m_dipo_partner.id
                                    WHERE t_sell_out_company.deleted = 0 
                                    $condition
                                    GROUP BY receive_date");
        
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function get_kanaka_stock(){
        $user = $this->ion_auth->user()->row();
        $dataSellIn = array();
        $dataSellOut = array();
        $allDataSell = array();
        
        $sell_in = $this->db->query("SELECT m_product.id as product_id, m_product.name as product_name, net_price_in_ctn_after_tax as nominal, SUM(total_order_in_ctn) as pax
                                    FROM t_sell_in_company
                                    INNER JOIN m_product ON t_sell_in_company.product_id = m_product.id
                                    WHERE customer_id = 0
                                    AND t_sell_in_company.deleted = 0
                                    GROUP BY product_id, nominal
                                ;")->result();
        $arraySellIn = json_decode(json_encode($sell_in), True);

        foreach($arraySellIn as $in){
            $dataSellIn[] = array_merge($in, array("type"=>"in"));
        }
        
        $sell_out = $this->db->query("SELECT m_product.id as product_id, m_product.name as product_name, net_price_in_ctn_after_tax as nominal, SUM(total_order_in_ctn) as pax
                                    FROM t_sell_out_company
                                    INNER JOIN m_product ON t_sell_out_company.product_id = m_product.id
                                    INNER JOIN users ON t_sell_out_company.user_created = users.id
                                    WHERE t_sell_out_company.deleted = 0
                                    AND users.group_id = 1
                                    GROUP BY product_id, nominal
                                ;")->result();
        $arraySellOut = json_decode(json_encode($sell_out), True);

        foreach($arraySellOut as $out){
            $dataSellOut[] = array_merge($out, array("type"=>"out"));
        }

        $allDataSell = array_merge($allDataSell, $dataSellIn, $dataSellOut);

        $vc_array_product_id = [];
        $vc_array_nominal = [];
        $vc_array_type = [];
        foreach ($allDataSell as $key => $row){
            $vc_array_product_id[$key] = $row['product_id'];
            $vc_array_nominal[$key] = $row['nominal'];
            $vc_array_type[$key] = $row['type'];
        }
        array_multisort($vc_array_product_id, SORT_ASC, $vc_array_nominal, SORT_ASC, $vc_array_type, SORT_ASC, $allDataSell);

        $result_data_sell = array();
        $result = array();
        $product_id_tmp = '';
        $pax_tmp = 0;
        $nominal_tmp = 0;

        $totalData = count($allDataSell);

        for($i = 0; $i < $totalData; $i++){
            $product_id_data = $allDataSell[$i]['product_id'];
            $product_name_data = $allDataSell[$i]['product_name'];
            $nominal_data = $allDataSell[$i]['nominal'];
            $pax_data = $allDataSell[$i]['pax'];
            $type_data = $allDataSell[$i]['type'];
            
            $pax_tmp = 0;
            $nominal_tmp = 0;
            $x = 0; 

            for($j = 0; $j < $totalData; $j++){
            
                if($product_id_data == $allDataSell[$j]['product_id'] && $nominal_data == $allDataSell[$j]['nominal']){
                    if($pax_tmp == 0 && $nominal_tmp == 0){
                        $pax_tmp = $allDataSell[$j]['pax'];
                        $nominal_tmp = $allDataSell[$j]['nominal'];
                    }else{
                        $pax_tmp = $pax_tmp - $allDataSell[$j]['pax'];
                        $nominal_tmp = $nominal_tmp * $pax_tmp;  
                    }
                    $x++;
                }
                
            }

            if($type_data == 'out'){
                $real_nominal =  0-$nominal_tmp;
                $real_pax =  0-$pax_tmp;
            }else{
                $real_nominal =  $nominal_tmp;
                $real_pax =  $pax_tmp;
            }
            $result_data_sell_tmp = array('product_id' => $product_id_data, 
                                        'product_name' => $product_name_data,
                                        'nominal' => $real_nominal,
                                        'pax' => $real_pax,
                                        'type' => $type_data);
            array_push($result_data_sell,$result_data_sell_tmp);

            $i += ($x-1);
        } 
        
        $data_sell_arr = array();
        $result_arr = array();
        $product_id_arr_tmp = '';
        $pax_arr_tmp = 0;
        $nominal_arr_tmp = 0;

        $totalDataArr = count($result_data_sell);

        for($i = 0; $i < $totalDataArr; $i++){
            $product_id_arr = $result_data_sell[$i]['product_id'];
            $product_name_arr = $result_data_sell[$i]['product_name'];
            $nominal_arr = $result_data_sell[$i]['nominal'];
            $pax_arr = $result_data_sell[$i]['pax'];
            $type_arr = $result_data_sell[$i]['type'];
            
            $pax_arr_tmp = 0;
            $nominal_arr_tmp = 0;
            $x = 0; 

            for($j = 0; $j < $totalDataArr; $j++){
            
                if($product_id_arr == $result_data_sell[$j]['product_id']){
                    if($pax_arr_tmp == 0 && $nominal_arr_tmp == 0){
                        $pax_arr_tmp = $result_data_sell[$j]['pax'];
                        $nominal_arr_tmp = $result_data_sell[$j]['nominal'];
                    }else{
                        $pax_arr_tmp = $pax_arr_tmp + $result_data_sell[$j]['pax'];
                        $nominal_arr_tmp = $nominal_arr_tmp + $result_data_sell[$j]['nominal'];
                    }
                    $x++;
                }
                
            }

            $data_sell_arr_tmp = array('product_id' => $product_id_arr, 
                                        'product_name' => $product_name_arr,
                                        'nominal' => $nominal_arr_tmp,
                                        'pax' => $pax_arr_tmp,
                                        'type' => $type_arr);
            array_push($data_sell_arr,$data_sell_arr_tmp);

            $i += ($x-1);
        }

        return $data_sell_arr;
    }

    public function get_data_stock($type){
        $user = $this->ion_auth->user()->row();
        $dataSellIn = array();
        $dataSellOut = array();
        $allDataSell = array();
        
        if($user->group_id != '1'){
            $sell_in = $this->db->query("SELECT m_product.id as product_id, m_dipo_partner.id as customer_id, m_product.name as product_name, m_dipo_partner.name as customer_name, net_price_in_ctn_after_tax as nominal, SUM(total_order_in_ctn) as pax
                                   FROM t_sell_in_company
                                   INNER JOIN m_product ON t_sell_in_company.product_id = m_product.id
                                   INNER JOIN m_dipo_partner ON t_sell_in_company.customer_id = m_dipo_partner.id
                                   WHERE t_sell_in_company.deleted = 0
                                   AND m_dipo_partner.type = '$type'
                                   AND t_sell_in_company.user_created = $user->id
                                   GROUP BY product_id, customer_id, nominal
                                 ;")->result();
        }else{
            $sell_in = $this->db->query("SELECT m_product.id as product_id, m_dipo_partner.id as customer_id, m_product.name as product_name, m_dipo_partner.name as customer_name, net_price_in_ctn_after_tax as nominal, SUM(total_order_in_ctn) as pax
                                   FROM t_sell_in_company
                                   INNER JOIN m_product ON t_sell_in_company.product_id = m_product.id
                                   INNER JOIN m_dipo_partner ON t_sell_in_company.customer_id = m_dipo_partner.id
                                   WHERE t_sell_in_company.deleted = 0
                                   AND m_dipo_partner.type = '$type'
                                   GROUP BY product_id, customer_id, nominal
                                 ;")->result();
        }
        $arraySellIn = json_decode(json_encode($sell_in), True);

        foreach($arraySellIn as $in){
            $dataSellIn[] = array_merge($in, array("type"=>"in"));
        }
        
        if($user->group_id != '1'){
            $sell_out = $this->db->query("SELECT m_product.id as product_id, m_dipo_partner.id as customer_id, m_product.name as product_name, m_dipo_partner.name as customer_name, net_price_in_ctn_after_tax as nominal, SUM(total_order_in_ctn) as pax
                                   FROM t_sell_out_company
                                   INNER JOIN m_product ON t_sell_out_company.product_id = m_product.id
                                   INNER JOIN users ON t_sell_out_company.user_created = users.id
                                   INNER JOIN m_dipo_partner ON users.dipo_partner_id = m_dipo_partner.id
                                   WHERE t_sell_out_company.deleted = 0
                                   AND m_dipo_partner.type = '$type'
                                   AND t_sell_out_company.user_created = $user->id
                                   GROUP BY product_id, customer_id, nominal
                                 ;")->result();
        }else{
            $sell_out = $this->db->query("SELECT m_product.id as product_id, m_dipo_partner.id as customer_id, m_product.name as product_name, m_dipo_partner.name as customer_name, net_price_in_ctn_after_tax as nominal, SUM(total_order_in_ctn) as pax
                                   FROM t_sell_out_company
                                   INNER JOIN m_product ON t_sell_out_company.product_id = m_product.id
                                   INNER JOIN users ON t_sell_out_company.user_created = users.id
                                   INNER JOIN m_dipo_partner ON users.dipo_partner_id = m_dipo_partner.id
                                   WHERE t_sell_out_company.deleted = 0
                                   AND m_dipo_partner.type = '$type'
                                   GROUP BY product_id, customer_id, nominal
                                 ;")->result();
        }
        
        $arraySellOut = json_decode(json_encode($sell_out), True);

        foreach($arraySellOut as $out){
            $dataSellOut[] = array_merge($out, array("type"=>"out"));
        }

        $allDataSell = array_merge($allDataSell, $dataSellIn, $dataSellOut);

        $vc_array_product_id = [];
        $vc_array_customer_id = [];
        $vc_array_nominal = [];
        $vc_array_type = [];
        foreach ($allDataSell as $key => $row){
            $vc_array_product_id[$key] = $row['product_id'];
            $vc_array_customer_id[$key] = $row['customer_id'];
            $vc_array_nominal[$key] = $row['nominal'];
            $vc_array_type[$key] = $row['type'];
        }
        array_multisort($vc_array_product_id, SORT_ASC, $vc_array_customer_id, SORT_ASC, $vc_array_nominal, SORT_ASC, $vc_array_type, SORT_ASC, $allDataSell);

        $result_data_sell = array();
        $result = array();
        $product_id_tmp = '';
        $customer_id_tmp = '';
        $pax_tmp = 0;
        $nominal_tmp = 0;

        $totalData = count($allDataSell);

        for($i = 0; $i < $totalData; $i++){
            $product_id_data = $allDataSell[$i]['product_id'];
            $customer_id_data = $allDataSell[$i]['customer_id'];
            $product_name_data = $allDataSell[$i]['product_name'];
            $customer_name_data = $allDataSell[$i]['customer_name'];
            $nominal_data = $allDataSell[$i]['nominal'];
            $pax_data = $allDataSell[$i]['pax'];
            $type_data = $allDataSell[$i]['type'];
            
            $pax_tmp = 0;
            $nominal_tmp = 0;
            $x = 0; 

            for($j = 0; $j < $totalData; $j++){
            
                if($product_id_data == $allDataSell[$j]['product_id'] && $customer_id_data == $allDataSell[$j]['customer_id'] && $nominal_data == $allDataSell[$j]['nominal']){
                    if($pax_tmp == 0 && $nominal_tmp == 0){
                        $pax_tmp = $allDataSell[$j]['pax'];
                        $nominal_tmp = $allDataSell[$j]['nominal'];
                    }else{
                        $pax_tmp = $pax_tmp - $allDataSell[$j]['pax'];
                        $nominal_tmp = $nominal_tmp * $pax_tmp;  
                    }
                    $x++;
                }
                
            }

            if($type_data == 'out'){
                $real_nominal =  0-$nominal_tmp;
                $real_pax =  0-$pax_tmp;
            }else{
                $real_nominal =  $nominal_tmp;
                $real_pax =  $pax_tmp;
            }
            $result_data_sell_tmp = array('product_id' => $product_id_data, 
                                        'customer_id' => $customer_id_data,
                                        'product_name' => $product_name_data,
                                        'customer_name' => $customer_name_data,
                                        'nominal' => $real_nominal,
                                        'pax' => $real_pax,
                                        'type' => $type_data);
            array_push($result_data_sell,$result_data_sell_tmp);

            $i += ($x-1);
        }
        
        $data_sell_arr = array();
        $result_arr = array();
        $product_id_arr_tmp = '';
        $customer_id_arr_tmp = '';
        $pax_arr_tmp = 0;
        $nominal_arr_tmp = 0;

        $totalDataArr = count($result_data_sell);

        for($i = 0; $i < $totalDataArr; $i++){
            $product_id_arr = $result_data_sell[$i]['product_id'];
            $customer_id_arr = $result_data_sell[$i]['customer_id'];
            $product_name_arr = $result_data_sell[$i]['product_name'];
            $customer_name_arr = $result_data_sell[$i]['customer_name'];
            $nominal_arr = $result_data_sell[$i]['nominal'];
            $pax_arr = $result_data_sell[$i]['pax'];
            $type_arr = $result_data_sell[$i]['type'];
            
            $pax_arr_tmp = 0;
            $nominal_arr_tmp = 0;
            $x = 0; 

            for($j = 0; $j < $totalDataArr; $j++){
            
                if($product_id_arr == $result_data_sell[$j]['product_id'] && $customer_id_arr == $result_data_sell[$j]['customer_id']){
                    if($pax_arr_tmp == 0 && $nominal_arr_tmp == 0){
                        $pax_arr_tmp = $result_data_sell[$j]['pax'];
                        $nominal_arr_tmp = $result_data_sell[$j]['nominal'];
                    }else{
                        $pax_arr_tmp = $pax_arr_tmp + $result_data_sell[$j]['pax'];
                        $nominal_arr_tmp = $nominal_arr_tmp + $result_data_sell[$j]['nominal'];
                    }
                    $x++;
                }
                
            }

            $data_sell_arr_tmp = array('product_id' => $product_id_arr, 
                                        'customer_id' => $customer_id_arr,
                                        'product_name' => $product_name_arr,
                                        'customer_name' => $customer_name_arr,
                                        'nominal' => $nominal_arr_tmp,
                                        'pax' => $pax_arr_tmp,
                                        'type' => $type_arr);
            array_push($data_sell_arr,$data_sell_arr_tmp);

            $i += ($x-1);
        }

        $totalDataResult = count($data_sell_arr);
        $arr_customer_id_result = array();
        for($i = 0; $i < $totalDataResult; $i++){
            $product_id_result = $data_sell_arr[$i]['product_id'];
            $customer_id_result = $data_sell_arr[$i]['customer_id'];
            $product_name_result = $data_sell_arr[$i]['product_name'];
            $customer_name_result = $data_sell_arr[$i]['customer_name'];
            $nominal_result = $data_sell_arr[$i]['nominal'];
            $pax_result = $data_sell_arr[$i]['pax'];
            
            if(!array_search($customer_id_result,$arr_customer_id_result)){
                array_push($arr_customer_id_result, $customer_id_result);

                $pax_result_tmp = 0;
                $nominal_result_tmp = 0;
                $x = 0; 

                $total_data_customer = 1;
                $arr_customer_id_result_2 = array();
                for($k = 0; $k < $totalDataResult; $k++){
                    if($customer_id_result == $data_sell_arr[$k]['customer_id']){
                        $total_data_customer += 1;
                    }
                }
                
                $data_product = array();
                    for($j = 0; $j < $totalDataResult; $j++){
                        $product_id_result_tmp = $data_sell_arr[$j]['product_id'];
                        $product_name_result_tmp = $data_sell_arr[$j]['product_name'];
                        $nominal_result_tmp = $data_sell_arr[$j]['nominal'];
                        $pax_result_tmp = $data_sell_arr[$j]['pax'];
                        
                        if($customer_id_result == $data_sell_arr[$j]['customer_id']){
                            $x++;

                            $data_product_tmp = array(
                                'product_id' => $product_id_result_tmp,
                                'product_name' => $product_name_result_tmp,
                                'nominal' => $nominal_result_tmp,
                                'pax' => $pax_result_tmp
                            );
            
                            array_push($data_product, $data_product_tmp);
                        }
                        
                    }
        
                $result_data_sell_tmp = array( 
                                            'customer_id' => $customer_id_result,
                                            'customer_name' => $customer_name_result,
                                            'data_product' => $data_product,
                                        );
                array_push($result,$result_data_sell_tmp);
            }
            $i += ($x-1);
        }

        return $result;
    }

}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */