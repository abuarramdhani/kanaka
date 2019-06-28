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
		$total_saldo    = 0;
		$total_hutang   = 0;
        $total_piutang  = 0;
        $total_in       = 0;
        $total_out      = 0;
        
        $row_si = Companyreport::selectRaw('SUM(difference) as nominal')
                        ->where('payment_status', '!=', 3)
                        ->where('deleted', '=', 0)
                        ->get();
        foreach($row_si as $si){
            $total_hutang = $si->nominal;
        }

        $row_so = Companyreportout::selectRaw('SUM(difference) as nominal')
                        ->where('payment_status', '!=', 3)
                        ->where('deleted', '=', 0)
                        ->get();
        foreach($row_so as $so){
            $total_piutang = $so->nominal;
        }

        $row_total_in = Jurnal::selectRaw('SUM(total) as total')->where('t_jurnal.deleted', 0)->where('t_jurnal.d_k', 'd')->get();
        foreach($row_total_in as $in){
            $total_in = $in->total;
        }

        $row_total_out = Jurnal::selectRaw('SUM(total) as total')->where('t_jurnal.deleted', 0)->where('t_jurnal.d_k', 'k')->get();
        foreach($row_total_out as $out){
            $total_out = $out->total;
        }

        $total_saldo = $total_in-$total_out;

        $data['total_saldo'] = number_format($total_saldo);
        $data['total_hutang'] = number_format($total_hutang);
        $data['total_piutang'] = number_format($total_piutang);
        $this->load->blade('dashboard.views.dashboard.page', $data);
	}
    
}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */