<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Chile/Continental');
class Logistica_general extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Logistica_general_model');
		$this->load->model('Seguridad_model');
	}

	public function index(){
		if($this->session->userdata('is_logged_in')){
			$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	    $this->Seguridad_model->SessionActivo($url);

			$nom_aliado = 'EZENTIS';

			$getStockAliado = $this->Logistica_general_model->getStockGeneral();
			//$getEstadoEquipo = $this->Logistica_general_model->getStockEstadoEquipo($nom_aliado);
	    /**/

			//lista de aliados de la base final
			$al_db_final = json_encode($this->getAliadosBaseFinal());
			$al_final = json_decode($al_db_final,true);
			//obtengo solo la columna aliado
			$al = array_column($al_final,'aliado');
			//selecciono aliados unicos
			$al_unico = array_unique($al);

			//recorro por aliado encontrado
			foreach ($al_unico as $value) {
				# code...
				$al_nom = $value;
				$getEstadoEquipo = $this->Logistica_general_model->getStockEstadoEquipo($al_nom);
				$getStockAliado2 = $this->Logistica_general_model->getStockGeneral2($al_nom);
				//recorro el stock aliado por aliado
				foreach ($getStockAliado2 as $value_al) {
					# code...
					if($al_nom == $value_al->aliado){
						/*echo '<pre>';
						print_r($value_al);
						echo '</pre>';*/

						foreach ($getEstadoEquipo as $value_es) {
							# code...
							if($al_nom == $value_es->aliado && $value_al->familia == $value_es->familia){
								/*echo '<pre>';
								print_r($value_es);
								echo '</pre>';*/

								$array_logistica[] = array(
									'aliado' => $value_es->aliado,
									'familia' => $value_es->familia,
									'qty' => $value_al->qty,
									'stock_inicial' => $value_es->stock_inicial,
									'despachos' => $value_es->despachos,
									'consumos' => $value_es->consumos,
									'traspaso_sale' => $value_es->traspaso_sale,
									'traspaso_entra' => $value_es->traspaso_entra,
									'ajustes' => $value_es->ajustes
								);
							}
						}
					}
				}
			}

			/*echo '<pre>';
			print_r($array_logistica);
			echo '</pre>';*/

			/*$array_logistica[] = array(
				'aliado' => 'a',
				'familia' => 'b',
				'qty' => 'c',
				'stock_inicial' => 'c',
				'despachos' => 'c',
				'consumos' => 'c',
				'traspaso_sale' => 'c',
				'traspaso_entra' => 'c',
				'ajustes' => 'c'
			);*/

			$data['tabla_general'] = json_encode($getStockAliado);
			$data['tabla_estados'] = json_encode($getEstadoEquipo);
			$data['tabla_final'] = json_encode($array_logistica);
			$data['aliado'] = json_encode($this->getAliadosBaseFinal());

	    $this->load->view('constant');
	    $this->load->view('view_header');
			$this->load->view('logistica_data/view_logistica', $data);
	    $this->load->view('view_footer');
		}else{
			redirect('index.php/Login');
		}
	}

	private function getAliadosBaseFinal(){
		$list_aliado = $this->Logistica_general_model->getStockListaAliado();
		return $list_aliado;
	}
}
