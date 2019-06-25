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
            if($this->input->post('start_date') != ''){
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');

                $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
                $end_date = date('Y-m-d', strtotime($this->input->post('end_date')));

                $data['penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 4, 'd_k' => 'D'));
                $data['retur_penjualan'] = $this->user_profile->get_sum_jurnal($start_date,$end_date,array('deleted' => 0, 'coa_id' => 5, 'd_k' => 'D'));
                $data['penjualan_bersih'] = $data['penjualan'] - $data['retur_penjualan'];

                $data['persediaan_barang_dagang_awal'] = 0;
                $data['pembelian'] = 0;
                $data['beban_angkut_pembelian'] = 0;
                $data['potongan_pembelian'] = 0;
                $data['retur_pembelian'] = 0;
                $data['pembelian_bersih'] = 0;
                $data['barang_siap_jual'] = 0;
                $data['persediaan_akhir'] = 0;
                $data['hpp'] = 0;
                $data['laba_kotor'] = 0;

                $data['beban_angkut_penjualan'] = 0;
                $data['beban_asuransi_toko'] = 0;
                $data['beban_iklan'] = 0;
                $data['beban_perlengkapan_toko'] = 0;
                $data['total_beban_penjualan'] = 0;
                $data['beban_gaji'] = 0;
                $data['beban_utilitas'] = 0;
                $data['beban_perlengkapan_kantor'] = 0;
                $data['beban_sewa'] = 0;
                $data['beban_penyusutan'] = 0;
                $data['total_beban_umum_dan_administrasi'] = 0;
                $data['total_beban_operasional'] = 0;
                $data['rugi_operasional'] = 0;

                $data['pendapatan_bunga'] = 0;
                $data['laba_bersih'] = 0;

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
