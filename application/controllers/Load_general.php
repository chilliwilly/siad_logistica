<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Chile/Continental');
class Load_general extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Logistica_general_model');
		//$this->load->model('Seguridad_model');
	}

  public function getNombreAliado(){
    $list_aliado = $this->Logistica_general_model->getStockListaAliado();
    return json_encode($list_aliado);
  }
}
