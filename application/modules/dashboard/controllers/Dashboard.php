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

        $data['total_saldo'] = number_format($total_saldo);
        $data['total_hutang'] = number_format($total_hutang);
        $data['total_piutang'] = number_format($total_piutang);
        $this->load->blade('dashboard.views.dashboard.page', $data);
	}
    
}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */