<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Chile/Continental');
class Logistica_general extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Logistica_general_model');
		$this->load->model('General_model');
		$this->load->model('Seguridad_model');
	}

	//vista del admin
	public function index(){
		if($this->session->userdata('is_logged_in')){
			$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	    $this->Seguridad_model->SessionActivo($url);

			$nom_aliado = 'EZENTIS';
			$emp_id = $this->session->userdata('ALIADORUT');//id del aliado del user logeado
			$usr_id = $this->session->userdata('ID');//id del aliado del user logeado

			$getStockAliado = $this->Logistica_general_model->getStockGeneral();
			$getIdAliado = $this->General_model->getIdAliadoByIdEmpresa('70');//para buscar stock declarado aliado
			$getNomAliado = $this->General_model->getNombreAliadoById($getIdAliado[0]->aliado_id);

			/*echo '<pre>';
			print_r($this->General_model->getIdByNombreAliado('CONSORCIO'));
			echo '</pre>';*/
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

						$busca_ali = $al_nom=='EZENTIS'?'CONSORCIO':$al_nom;

						foreach ($getEstadoEquipo as $value_es) {
							# code...
							if($al_nom == $value_es->aliado && $value_al->familia == $value_es->familia){

								$material = $this->getNomColmnMaterial($value_es->familia)[0];
								$id_ali = $this->General_model->getIdByNombreAliado($busca_ali)[0]->empresa_id;
								$qty_material_ali = $this->Logistica_general_model->getStockMaterialAliado($material, $id_ali)[0]->$material;

								/*echo '<pre>';
								print_r($this->Logistica_general_model->getStockMaterialAliado($material, $id_ali)[0]->$material);
								echo '</pre>';*/

								$array_logistica[] = array(
									'aliado' => $value_es->aliado,
									'familia' => $value_es->familia,
									'qty' => $value_al->qty,
									'stock_material' => $qty_material_ali,
									'dif_material' => $value_al->qty - $qty_material_ali,
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

			//$data['tabla_estados'] = json_encode($getEstadoEquipo);
			$data['tabla_final'] = json_encode($array_logistica);
			$data['aliado'] = json_encode($this->getAliadosBaseFinal());

	    $this->load->view('constant');
	    $this->load->view('view_header');
			$this->load->view('logistica_data/view_logistica', $data);
	    $this->load->view('view_footer');
		}else{
			redirect('index.php/login');
		}
	}

	//vista del aliado
	public function stock_aliado_dato(){

	}

	private function getAliadosBaseFinal(){
		$list_aliado = $this->Logistica_general_model->getStockListaAliado();
		return $list_aliado;
	}

	private function getNomColmnMaterial($material){
		$array_material[] = array(
			'CM' => 'material_01',
			'CM WIFI' => 'material_02',
			'CM WIFI 3.0' => 'material_03',
			'DECO BASICO' => 'material_04',
			'DECO DTA BASICO' => 'material_05',
			'DECO DTA HD' => 'material_06',
			'DECO HD' => 'material_07',
			'DECO HD FULL' => 'material_08',
			'MTA' => 'material_09',
			'MTA 4 LINEAS' => 'material_10',
			'MTA 8 LINEAS' => 'material_11',
			'MTA WIFI' => 'material_12',
			'MTA WIFI 3.0' => 'material_13'
		);

		return array_column($array_material, $material);
	}
}
