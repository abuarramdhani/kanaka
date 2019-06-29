<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profitlosses extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        if(!$this->user_profile->get_user_access('Availabled', 'profitloss')){
            redirect('dashboard', 'refresh');            
        }

        $this->load->library('session');

    }

    public function index() {

        $this->load->blade('profitloss.views.profitloss.page');

    }

    public function show() {
        if($this->user_profile->get_user_access('PrintUnlimited', 'profitloss')){
            if($this->input->post('period') != ''){
                $period = $this->input->post('period');
                $data['period'] = $period;

                $start_date = date($period.'-01-01');
                $end_date = date($period.'-12-31');

                $data['penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 4, 'd_k' => 'D'));
                $data['retur_penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 5, 'd_k' => 'D'));
                $data['penjualan_bersih'] = $data['penjualan'] - $data['retur_penjualan'];
 
                $data['persediaan_barang_dagang_awal'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 9, 'd_k' => 'K'));
                $data['pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 2, 'd_k' => 'K'));
                $data['beban_angkut_pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 10, 'd_k' => 'K'));
                $data['retur_pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 3, 'd_k' => 'K'));
                $data['pembelian_bersih'] = $data['pembelian'] + $data['beban_angkut_pembelian'] + $data['retur_pembelian'];
                $data['barang_siap_jual'] = $data['pembelian_bersih'];
                $data['persediaan_akhir'] = $data['persediaan_barang_dagang_awal'] + $data['barang_siap_jual'];
                $data['hpp'] = $data['persediaan_akhir'];
                $data['laba_kotor'] = $data['penjualan_bersih'] - $data['hpp'];

                $data['beban_angkut_penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 11, 'd_k' => 'K'));
                $data['beban_iklan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 12, 'd_k' => 'K'));
                $data['total_beban_penjualan'] = $data['beban_angkut_penjualan'] + $data['beban_iklan'];
                $data['beban_gaji'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 13, 'd_k' => 'K'));
                $data['beban_utilitas'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 14, 'd_k' => 'K'));
                $data['beban_sewa'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 15, 'd_k' => 'K'));
                $data['total_beban_umum_dan_administrasi'] = $data['beban_gaji'] + $data['beban_utilitas'] + $data['beban_sewa'];
                $data['total_beban_operasional'] = $data['total_beban_penjualan'] + $data['total_beban_umum_dan_administrasi'];

                $data['pendapatan_bunga'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 16, 'd_k' => 'D'));
                $data['laba_bersih'] = $data['laba_kotor'] - $data['total_beban_operasional'] + $data['pendapatan_bunga'];

                $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'profitloss');
                $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'profitloss');

                $this->load->blade('profitloss.views.profitloss.show', $data);
            }
            else{
                redirect('reports/profitloss', 'refresh');            
            }
        }
    }

    function pdf($period){
        $data['period'] = $period;

        $start_date = date($period.'-01-01');
        $end_date = date($period.'-12-31');
        
        $data['penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 4, 'd_k' => 'D'));
        $data['retur_penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 5, 'd_k' => 'D'));
        $data['penjualan_bersih'] = $data['penjualan'] - $data['retur_penjualan'];

        $data['persediaan_barang_dagang_awal'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 9, 'd_k' => 'K'));
        $data['pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 2, 'd_k' => 'K'));
        $data['beban_angkut_pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 10, 'd_k' => 'K'));
        $data['retur_pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 3, 'd_k' => 'K'));
        $data['pembelian_bersih'] = $data['pembelian'] + $data['beban_angkut_pembelian'] + $data['retur_pembelian'];
        $data['barang_siap_jual'] = $data['pembelian_bersih'];
        $data['persediaan_akhir'] = $data['persediaan_barang_dagang_awal'] + $data['barang_siap_jual'];
        $data['hpp'] = $data['persediaan_akhir'];
        $data['laba_kotor'] = $data['penjualan_bersih'] - $data['hpp'];

        $data['beban_angkut_penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 11, 'd_k' => 'K'));
        $data['beban_iklan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 12, 'd_k' => 'K'));
        $data['total_beban_penjualan'] = $data['beban_angkut_penjualan'] + $data['beban_iklan'];
        $data['beban_gaji'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 13, 'd_k' => 'K'));
        $data['beban_utilitas'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 14, 'd_k' => 'K'));
        $data['beban_sewa'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 15, 'd_k' => 'K'));
        $data['total_beban_umum_dan_administrasi'] = $data['beban_gaji'] + $data['beban_utilitas'] + $data['beban_sewa'];
        $data['total_beban_operasional'] = $data['total_beban_penjualan'] + $data['total_beban_umum_dan_administrasi'];

        $data['pendapatan_bunga'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 16, 'd_k' => 'D'));
        $data['laba_bersih'] = $data['laba_kotor'] - $data['total_beban_operasional'] + $data['pendapatan_bunga'];

        $html = $this->load->view('profitloss/profitloss/profitloss_pdf', $data, true);
        $this->pdf_generator->generate($html, 'profitloss pdf', $orientation='Portrait');
    
    }

    function excel($period){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=profitloss.xls");

        $data['period'] = $period;
        
        $start_date = date($period.'-01-01');
        $end_date = date($period.'-12-31');

        $data['penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 4, 'd_k' => 'D'));
        $data['retur_penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 5, 'd_k' => 'D'));
        $data['penjualan_bersih'] = $data['penjualan'] - $data['retur_penjualan'];

        $data['persediaan_barang_dagang_awal'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 9, 'd_k' => 'K'));
        $data['pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 2, 'd_k' => 'K'));
        $data['beban_angkut_pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 10, 'd_k' => 'K'));
        $data['retur_pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 3, 'd_k' => 'K'));
        $data['pembelian_bersih'] = $data['pembelian'] + $data['beban_angkut_pembelian'] + $data['retur_pembelian'];
        $data['barang_siap_jual'] = $data['pembelian_bersih'];
        $data['persediaan_akhir'] = $data['persediaan_barang_dagang_awal'] + $data['barang_siap_jual'];
        $data['hpp'] = $data['persediaan_akhir'];
        $data['laba_kotor'] = $data['penjualan_bersih'] - $data['hpp'];

        $data['beban_angkut_penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 11, 'd_k' => 'K'));
        $data['beban_iklan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 12, 'd_k' => 'K'));
        $data['total_beban_penjualan'] = $data['beban_angkut_penjualan'] + $data['beban_iklan'];
        $data['beban_gaji'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 13, 'd_k' => 'K'));
        $data['beban_utilitas'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 14, 'd_k' => 'K'));
        $data['beban_sewa'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 15, 'd_k' => 'K'));
        $data['total_beban_umum_dan_administrasi'] = $data['beban_gaji'] + $data['beban_utilitas'] + $data['beban_sewa'];
        $data['total_beban_operasional'] = $data['total_beban_penjualan'] + $data['total_beban_umum_dan_administrasi'];

        $data['pendapatan_bunga'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 16, 'd_k' => 'D'));
        $data['laba_bersih'] = $data['laba_kotor'] - $data['total_beban_operasional'] + $data['pendapatan_bunga'];
        
        $this->load->view('profitloss/profitloss/profitloss_pdf', $data);
    }

}
