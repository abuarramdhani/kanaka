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
 
                $data['persediaan_barang_dagang_awal'] = 0;
                $data['pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 2, 'd_k' => 'K'));
                $data['beban_angkut_pembelian'] = 0;
                $data['potongan_pembelian'] = 0;
                $data['retur_pembelian'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 3, 'd_k' => 'K'));
                $data['pembelian_bersih'] = $data['pembelian'] + $data['beban_angkut_pembelian'] + $data['potongan_pembelian'] + $data['retur_pembelian'];
                $data['barang_siap_jual'] = $data['pembelian_bersih'];
                $data['persediaan_akhir'] = $data['persediaan_barang_dagang_awal'] + $data['barang_siap_jual'];
                $data['hpp'] = $data['persediaan_akhir'];
                $data['laba_kotor'] = $data['penjualan_bersih'] - $data['hpp'];

                $data['beban_angkut_penjualan'] = 0;
                $data['beban_asuransi_toko'] = 0;
                $data['beban_iklan'] = 0;
                $data['beban_perlengkapan_toko'] = 0;
                $data['total_beban_penjualan'] = $data['beban_angkut_penjualan'] + $data['beban_asuransi_toko'] + $data['beban_iklan'] + $data['beban_perlengkapan_toko'];
                $data['beban_gaji'] = 0;
                $data['beban_utilitas'] = 0;
                $data['beban_perlengkapan_kantor'] = 0;
                $data['beban_sewa'] = 0;
                $data['beban_penyusutan'] = 0;
                $data['total_beban_umum_dan_administrasi'] = $data['beban_gaji'] + $data['beban_utilitas'] + $data['beban_perlengkapan_kantor'] + $data['beban_sewa'] + $data['beban_penyusutan'];
                $data['total_beban_operasional'] = $data['total_beban_penjualan'] + $data['total_beban_umum_dan_administrasi'];
                $data['rugi_operasional'] = 0;

                $data['pendapatan_bunga'] = 0;
                $data['laba_bersih'] = $data['laba_kotor'] - $data['total_beban_operasional'] - $data['rugi_operasional'] + $data['pendapatan_bunga'];

                $this->load->blade('profitloss.views.profitloss.show', $data);
            }
            else{
                redirect('reports/profitloss', 'refresh');            
            }
        }
    }

    function pdf(){
        $data['profitlosses'] = Zona::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $html = $this->load->view('profitloss/profitloss/profitloss_pdf', $data, true);
        $this->pdf_generator->generate($html, 'profitloss pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=profitloss.xls");
        $data['profitlosses'] = Zona::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $this->load->view('profitloss/profitloss/profitloss_pdf', $data);
    }

}
