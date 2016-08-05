<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Chile/Continental');
class Load_general extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('General_logistica_model');
		$this->load->model('Seguridad_model');
	}

  public function getNombreAliado(){
    $list_aliado = $this->General_logistica_model->getStockListaAliado();
    return json_encode($list_aliado);
  }
}
