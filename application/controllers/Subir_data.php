<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Chile/Continental');
ini_set("memory_limit",-1);
class Subir_data extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Seguridad_model');
		$this->load->model('Subir_data_model');
		$this->load->library('upload');
		$this->load->library('PHPExcel/IOFactory');
		$this->load->helper('date');
		$this->load->helper('file');
	}

	public function index(){
    if($this->session->userdata('is_logged_in')){
      $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      $this->Seguridad_model->SessionActivo($url);

      $this->load->view('constant');
      $this->load->view('view_header');
      $this->load->view('upload_data/view_upload_data',array('error' => ''));//,$data);
      $this->load->view('view_footer');
    }else{
      redirect('index.php/Login');
    }
	}

	//sube el archivo excel de sga
	function subir_sga() {
		//carga el helper
		$this->load->helper('form');
		//$this->borrar_sga();
		//Configure
		//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
		$config['upload_path'] = 'application/views/uploads/';

	    //set de extension de archivos
		$config['allowed_types'] = 'xls|xlsx|xlsb';

		//carga la libreria upload
		$this->load->library('upload', $config);
	    $this->upload->initialize($config);
	    $this->upload->set_allowed_types('*');

		//$data['upload_data'] = '';

		//if not successful, set the error message
		if (!$this->upload->do_upload('userfile')) {
			$data = array('msg' => $this->upload->display_errors());

		} else { //else, set the success message
			$data = array('msg' => "Subida Exitosa!");
      		$data['upload_data'] = $this->upload->data();
      		//$this->read_sga();
		}

		//$data['names'] = '';
		//carga nuevamente la vista de subida
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $this->Seguridad_model->SessionActivo($url);
        $this->load->view('constant');
        $this->load->view('view_header');
		$this->load->view('subir_data/view_subir_sga');//, $data);
		$this->load->view('view_footer');

	}

	//borra el archivo excel sga
	function borrar_sga(){
		delete_files('application/views/uploads/');
	}

	//inserta datos utilizados
	function insert_actual(){
		$filename = get_filenames('application/views/uploads/')[0];
		$names=array();
	    $no=0;
	    $inputFileType = 'Excel5';
	    $objReader = IOFactory::createReader($inputFileType);
	    $objPHPExcel  = $objReader->load(FCPATH.'application/views/uploads/Libro2.xls');//FCPATH.
	    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
	    $maxRow = $objWorksheet->getHighestRow();

	    //$this->Subir_data_sga_model->CleanSga();

	    for ($i = 2; $i <= 2; $i++)//$i=14; $i<=$maxRow; $i++
	    {
	        //$names[$no] = $objWorksheet->getCell('A'.$i)->getValue();
	        //$no++;
	        $GuardaRegistro = array(
				'in_proyecto'		  => $objWorksheet->getCell('A'.$i)->getValue(),
				'in_sga'			  => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('B'.$i)->getValue())->format('Y-m-d'),//date('Y-m-j',strtotime($objWorksheet->getCell('B'.$i)->getValue())),
				'in_ingreso'		  => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('C'.$i)->getValue())->format('Y-m-d'),//date('Y-m-j',strtotime($objWorksheet->getCell('C'.$i)->getValue())),
				'in_entrega'		  => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('D'.$i)->getValue())->format('Y-m-d'),//date('Y-m-j',strtotime($objWorksheet->getCell('D'.$i)->getValue())),
				'in_cliente'		  => $objWorksheet->getCell('E'.$i)->getValue(),
				'in_rut'			  => str_replace("-", "", $objWorksheet->getCell('F'.$i)->getValue()),
				'in_direccion'		  => $objWorksheet->getCell('G'.$i)->getValue(),
				'in_region'			  => $objWorksheet->getCell('H'.$i)->getValue(),
				'in_comuna'		 	  => $objWorksheet->getCell('I'.$i)->getValue(),
				'in_nombre'	 		  => $objWorksheet->getCell('J'.$i)->getValue(),
				'in_fono'	 		  => $objWorksheet->getCell('K'.$i)->getValue(),
				'in_plan_net'		  => $objWorksheet->getCell('L'.$i)->getValue(),
				'in_plan_net_adic'	  => $objWorksheet->getCell('M'.$i)->getValue(),
				'in_plan_fono'		  => $objWorksheet->getCell('N'.$i)->getValue(),
				'in_plan_fono_adic'	  => $objWorksheet->getCell('O'.$i)->getValue(),
				'in_plan_fono_adict'  => $objWorksheet->getCell('P'.$i)->getValue(),
				'in_plan_tv'		  => $objWorksheet->getCell('Q'.$i)->getValue(),
				'in_deco_basico'	  => $objWorksheet->getCell('R'.$i)->getValue(),
				'in_plan_tv_adic'	  => $objWorksheet->getCell('S'.$i)->getValue(),
				'in_plan_tv_adict'	  => $objWorksheet->getCell('T'.$i)->getValue(),
				'in_deco_hd_basico'	  => $objWorksheet->getCell('U'.$i)->getValue(),
				'in_deco_hd_full'	  => $objWorksheet->getCell('V'.$i)->getValue(),
				'in_plan_tv_pack'	  => $objWorksheet->getCell('W'.$i)->getValue(),
				'in_central_tf'	 	  => $objWorksheet->getCell('X'.$i)->getValue(),
				'in_lineas_asignadas' => $objWorksheet->getCell('Y'.$i)->getValue(),
				'in_fecha_operacion'  => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('Z'.$i)->getValue())->format('Y-m-d'),//date('Y-m-j',strtotime($objWorksheet->getCell('Z'.$i)->getValue())),
				'in_vende'	 		  => $objWorksheet->getCell('AA'.$i)->getValue(),
				'in_estado'	 		  => $objWorksheet->getCell('AB'.$i)->getValue()
				// 'sga_fechareevaluauno'	 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('AC'.$i)->getValue())),
				// 'sga_tipoeds'			 => $objWorksheet->getCell('AD'.$i)->getValue(),
				// 'sga_eds'				 => $objWorksheet->getCell('AE'.$i)->getValue(),
				// 'sga_observacion'		 => $objWorksheet->getCell('AF'.$i)->getValue(),
				// 'sga_segmentobjetivo'    => $objWorksheet->getCell('AG'.$i)->getValue(),
				// 'sga_tiempointerrupcion' => str_replace(',', '.', $objWorksheet->getCell('AH'.$i)->getValue()),
				// 'sga_campana'			 => $objWorksheet->getCell('AI'.$i)->getValue(),
				// 'sga_categoria'			 => $objWorksheet->getCell('AJ'.$i)->getValue(),
				// 'sga_rutcliente'		 => $objWorksheet->getCell('AK'.$i)->getValue(),
				// 'sga_diagnostico'		 => $objWorksheet->getCell('AL'.$i)->getValue(),
				// 'sga_problema'			 => $objWorksheet->getCell('AM'.$i)->getValue(),
				// 'sga_ppp'				 => str_replace(',', '.', $objWorksheet->getCell('AN'.$i)->getValue()),
				// 'sga_usuejecutor'		 => $objWorksheet->getCell('AO'.$i)->getValue()
			);
			//echo date('Y-m-j H:i:s',strtotime($GuardaRegistro['sga_fechaprobacion'])).'<br>';
			//echo $GuardaRegistro['sga_cliente'].'<br>';
			echo json_encode($GuardaRegistro);
			//$this->Subir_data_sga_model->InsertData($GuardaRegistro);
	    }
	}

	//inserta datos del sga a la tabla truncandola antes
	function insert_sga(){
		$filename = get_filenames('application/views/uploads/')[0];
		$names=array();
	    $no=0;
	    $inputFileType = 'Excel5';
	    $objReader = IOFactory::createReader($inputFileType);
	    $objPHPExcel  = $objReader->load(FCPATH.'application/views/uploads/'.$filename);//FCPATH.
	    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
	    $maxRow = $objWorksheet->getHighestRow();

	    $this->Subir_data_sga_model->CleanSga();

	    for ($i = 2; $i <= $maxRow; $i++)//$i=14; $i<=$maxRow; $i++
	    {
	        //$names[$no] = $objWorksheet->getCell('A'.$i)->getValue();
	        //$no++;
	        $GuardaRegistro = array(
				'sga_cliente'			 => $objWorksheet->getCell('A'.$i)->getValue(),
				'sga_proyecto'			 => $objWorksheet->getCell('B'.$i)->getValue(),
				'sga_solot'				 => $objWorksheet->getCell('C'.$i)->getValue(),
				'sga_nroincidencia'		 => $objWorksheet->getCell('D'.$i)->getValue(),
				'sga_tiposolot'			 => $objWorksheet->getCell('E'.$i)->getValue(),
				'sga_estadosot'			 => $objWorksheet->getCell('F'.$i)->getValue(),
				'sga_motivo'			 => $objWorksheet->getCell('G'.$i)->getValue(),
				'sga_servicio'			 => $objWorksheet->getCell('H'.$i)->getValue(),
				'sga_fechainicio'		 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('I'.$i)->getValue())),
				'sga_fechacompromiso'	 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('J'.$i)->getValue())),
				'sga_fechaprobacion'	 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('K'.$i)->getValue())),
				'sga_fechafin'			 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('L'.$i)->getValue())),
				'sga_fechageneracion'	 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('M'.$i)->getValue())),
				'sga_generadopor'		 => $objWorksheet->getCell('N'.$i)->getValue(),
				'sga_areasolicitante'	 => $objWorksheet->getCell('O'.$i)->getValue(),
				'sga_ingeresponsable'	 => $objWorksheet->getCell('P'.$i)->getValue(),
				'sga_areasignada'		 => $objWorksheet->getCell('Q'.$i)->getValue(),
				'sga_usuarioasignada'	 => $objWorksheet->getCell('R'.$i)->getValue(),
				'sga_prioridad'			 => $objWorksheet->getCell('S'.$i)->getValue(),
				'sga_ctaproyecto'		 => $objWorksheet->getCell('T'.$i)->getValue(),
				'sga_direccion'			 => $objWorksheet->getCell('U'.$i)->getValue(),
				'sga_nroservicio'		 => $objWorksheet->getCell('V'.$i)->getValue(),
				'sga_fechaprogfin'		 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('W'.$i)->getValue())),
				'sga_fecharealizacion'	 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('X'.$i)->getValue())),
				'sga_fechaejecutauno'	 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('Y'.$i)->getValue())),
				'sga_fechabortauno'		 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('Z'.$i)->getValue())),
				'sga_fechaeliminauno'	 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('AA'.$i)->getValue())),
				'sga_fechacierrauno'	 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('AB'.$i)->getValue())),
				'sga_fechareevaluauno'	 => date('Y-m-j H:i:s',strtotime($objWorksheet->getCell('AC'.$i)->getValue())),
				'sga_tipoeds'			 => $objWorksheet->getCell('AD'.$i)->getValue(),
				'sga_eds'				 => $objWorksheet->getCell('AE'.$i)->getValue(),
				'sga_observacion'		 => $objWorksheet->getCell('AF'.$i)->getValue(),
				'sga_segmentobjetivo'    => $objWorksheet->getCell('AG'.$i)->getValue(),
				'sga_tiempointerrupcion' => str_replace(',', '.', $objWorksheet->getCell('AH'.$i)->getValue()),
				'sga_campana'			 => $objWorksheet->getCell('AI'.$i)->getValue(),
				'sga_categoria'			 => $objWorksheet->getCell('AJ'.$i)->getValue(),
				'sga_rutcliente'		 => $objWorksheet->getCell('AK'.$i)->getValue(),
				'sga_diagnostico'		 => $objWorksheet->getCell('AL'.$i)->getValue(),
				'sga_problema'			 => $objWorksheet->getCell('AM'.$i)->getValue(),
				'sga_ppp'				 => str_replace(',', '.', $objWorksheet->getCell('AN'.$i)->getValue()),
				'sga_usuejecutor'		 => $objWorksheet->getCell('AO'.$i)->getValue()
			);
			//echo date('Y-m-j H:i:s',strtotime($GuardaRegistro['sga_fechaprobacion'])).'<br>';
			//echo $GuardaRegistro['sga_cliente'].'<br>';
			//echo json_encode($GuardaRegistro);
			$this->Subir_data_sga_model->InsertSga($GuardaRegistro);
	    }

	    //$data['names'] = $names;
	    //$data['no'] = $no;

	    //borrar esta parte y mover esta funcion a subir_sga
	    $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $this->Seguridad_model->SessionActivo($url);
        $this->load->view('constant');
        $this->load->view('view_header');
		$this->load->view('subir_data/view_subir_sga');//, $data);
		$this->load->view('view_footer');
	}

	public function do_upload()
	    {
	        $upload_path_url = base_url().'uploads/';

	        $config['upload_path'] = FCPATH.'uploads/';
	        $config['allowed_types'] = 'jpg|png';
	        $config['max_size'] = '30000';

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload()) {
	            $error = array('error' => $this->upload->display_errors());
	            $this->load->view('upload_data/view_upload_data', $error);

	        } else {
	            $data = $this->upload->data();
	            /*
	                    // to re-size for thumbnail images un-comment and set path here and in json array
	            $config = array(
	                'source_image' => $data['full_path'],
	                'new_image' => $this->$upload_path_url '/thumbs',
	                'maintain_ration' => true,
	                'width' => 80,
	                'height' => 80
	            );

	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();
	            */
	            //set the data for the json array
	            $info->name = $data['file_name'];
	                $info->size = $data['file_size'];
	            $info->type = $data['file_type'];
	                $info->url = $upload_path_url .$data['file_name'];
	            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
	            $info->thumbnail_url = $upload_path_url .$data['file_name'];
	                $info->delete_url = base_url().'upload/deleteImage/'.$data['file_name'];
	                $info->delete_type = 'DELETE';

	            //this is why we put this in the constants to pass only json data
	            if (IS_AJAX) {
	                echo json_encode(array($info));
	                //this has to be the only data returned or you will get an error.
	                //if you don't give this a json array it will give you a Empty file upload result error
	                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)

	            // so that this will still work if javascript is not enabled
	            } else {
	                $file_data['upload_data'] = $this->upload->data();
	                $this->load->view('admin/upload_success', $file_data);
	            }
	        }
	    }


	public function deleteImage($file)//gets the job done but you might want to add error checking and security
	    {
	        $success =unlink(FCPATH.'uploads/' .$file);
	        //info to see if it is doing what it is supposed to
	        $info->sucess =$success;
	        $info->path =base_url().'uploads/' .$file;
	        $info->file =is_file(FCPATH.'uploads/' .$file);

	        if (IS_AJAX) {
	            //I don't think it matters if this is set but good for error checking in the console/firebug
	            echo json_encode(array($info));
	        } else {
	            //here you will need to decide what you want to show for a successful delete
	            $file_data['delete_data'] = $file;
	            $this->load->view('admin/delete_success', $file_data);
	        }
	    }

	public function insert_ajuste(){
		$filename = get_filenames('server/php/files/')[0];
		$names=array();
    $no=0;
    $inputFileType = 'Excel5';
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel  = $objReader->load(FCPATH.'server/php/files/ajuste.xls');//FCPATH.
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $maxRow = $objWorksheet->getHighestRow();
		//$ListaAjuste = $this->Subir_data_model->ObtieneBuscaSysAjuste();
		//$FechaCarga = date('Y-m-j H:i:s');

		for ($i = 2; $i <= $maxRow; $i++)//$i=14; $i<=$maxRow; $i++
		{
			//$dato = $objWorksheet->getCell('G'.$i)->getValue();
			//if(!in_array($dato,$ListaAjuste)){
				$GuardaAjuste[] = array(
					'aju_aliado' => $objWorksheet->getCell('A'.$i)->getValue(),
					'aju_material' => $objWorksheet->getCell('B'.$i)->getValue(),
					'aju_texto_material' => $objWorksheet->getCell('C'.$i)->getValue(),
					'aju_familia' => $objWorksheet->getCell('D'.$i)->getValue(),
					'aju_serie_sap' => $objWorksheet->getCell('E'.$i)->getValue(),
					'aju_largo_serie_sap' => $objWorksheet->getCell('F'.$i)->getValue(),
					'aju_serie_busca_sys' => $objWorksheet->getCell('G'.$i)->getValue(),
					'aju_largo_serie_busca_sys' => $objWorksheet->getCell('H'.$i)->getValue(),
					'aju_qty' => $objWorksheet->getCell('I'.$i)->getValue(),
					'aju_motivo_ajuste' => $objWorksheet->getCell('J'.$i)->getValue(),
					'aju_nro_registro_ajuste' => $objWorksheet->getCell('K'.$i)->getValue(),
					'aju_fecha_ajuste' => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('L'.$i)->getValue())->format('Y-m-d'),
					'aju_valida_ajuste' => $objWorksheet->getCell('M'.$i)->getValue(),
					'aju_carga_valida' => str_replace('Ñ','N',str_replace('ñ','n',$objWorksheet->getCell('N'.$i)->getValue())),
					'aju_estado_serie_ajuste' => $objWorksheet->getCell('O'.$i)->getValue(),
					'aju_fecha_carga' => $this->getFechaCarga()
				);
			//}
		}
		/*echo '<pre>';
		print_r($GuardaAjuste);
		echo '</pre>';*/
		$this->Subir_data_model->InsertaSysAjuste($GuardaAjuste);
	}

	public function insert_autoinventario(){
		$filename = get_filenames('server/php/files/')[0];
		$names=array();
    $no=0;
    $inputFileType = 'Excel5';
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel  = $objReader->load(FCPATH.'server/php/files/autoinventario.xls');//FCPATH.
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $maxRow = $objWorksheet->getHighestRow();
		//$ListaAjuste = $this->Subir_data_model->ObtieneBuscaSysInventario();
		//$FechaCarga = date('Y-m-j H:i:s');

		for ($i = 2; $i <= $maxRow; $i++)//$i=14; $i<=$maxRow; $i++
		{
			//$dato = $objWorksheet->getCell('D'.$i)->getValue();
			//if(!in_array($dato,$ListaAjuste)){
				$GuardaAutoinventario[] = array(
					'auto_aliado' => $objWorksheet->getCell('A'.$i)->getValue(),
					'auto_serie_sap' => $objWorksheet->getCell('B'.$i)->getValue(),
					'auto_largo_serie_sap' => $objWorksheet->getCell('C'.$i)->getValue(),
					'auto_serie_busca_sys' => $objWorksheet->getCell('D'.$i)->getValue(),
					'auto_largo_serie_busca_sys' => $objWorksheet->getCell('E'.$i)->getValue(),
					'auto_qty' => $objWorksheet->getCell('F'.$i)->getValue(),
					'auto_material' => $objWorksheet->getCell('G'.$i)->getValue(),
					'auto_texto_material ' => $objWorksheet->getCell('H'.$i)->getValue(),
					'auto_familia' => $objWorksheet->getCell('I'.$i)->getValue(),
					'auto_centro' => $objWorksheet->getCell('J'.$i)->getValue(),
					'auto_almacen' => $objWorksheet->getCell('K'.$i)->getValue(),
					'auto_negocio' => $objWorksheet->getCell('L'.$i)->getValue(),
					'auto_estado_equipo' => $objWorksheet->getCell('M'.$i)->getValue(),
					'auto_ubicacion' => $objWorksheet->getCell('N'.$i)->getValue(),
					'auto_tecnico' => $objWorksheet->getCell('O'.$i)->getValue(),
					'auto_patente' => $objWorksheet->getCell('P'.$i)->getValue(),
					'auto_auditor' => str_replace('Ñ','N',str_replace('ñ','n',$objWorksheet->getCell('Q'.$i)->getValue())),
					'auto_estado_serie_autoinv' => $objWorksheet->getCell('R'.$i)->getValue(),
					'auto_observacion' => $objWorksheet->getCell('S'.$i)->getValue(),
					'auto_fecha_autoinv' => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('T'.$i)->getValue())->format('Y-m-d'),
					'auto_anio' => $objWorksheet->getCell('U'.$i)->getValue(),
					'auto_fecha_carga' => $this->getFechaCarga()
				);
			//}
		}
		/*echo '<pre>';
		print_r($GuardaAjuste);
		echo '</pre>';*/
		$this->Subir_data_model->InsertaSysAutoInventario($GuardaAutoinventario);
	}

	public function insert_despacho(){
		$filename = get_filenames('server/php/files/')[0];
		$names=array();
    $no=0;
    $inputFileType = 'Excel5';
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel  = $objReader->load(FCPATH.'server/php/files/despacho.xls');//FCPATH.
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $maxRow = $objWorksheet->getHighestRow();
		//$ListaAjuste = $this->Subir_data_model->ObtieneBuscaSysDespacho();
		//$FechaCarga = date('Y-m-j H:i:s');

		for ($i = 2; $i <= $maxRow; $i++)//$i=14; $i<=$maxRow; $i++
		{
			//$dato = $objWorksheet->getCell('M'.$i)->getValue();
			//if(!in_array($dato,$ListaAjuste)){
				$GuardaDespacho[] = array(
					'desp_material_dm' => $objWorksheet->getCell('A'.$i)->getValue(),
					'desp_centro_almacen' => $objWorksheet->getCell('B'.$i)->getValue(),
					'desp_doc_material' => $objWorksheet->getCell('B'.$i)->getValue(),
					'desp_aliado' => $objWorksheet->getCell('D'.$i)->getValue(),
					'desp_aliado_region' => $objWorksheet->getCell('E'.$i)->getValue(),
					'desp_anio' => $objWorksheet->getCell('F'.$i)->getValue(),
					'desp_centro' => $objWorksheet->getCell('G'.$i)->getValue(),
					'desp_almacen' => $objWorksheet->getCell('H'.$i)->getValue(),
					'desp_negocio' => $objWorksheet->getCell('I'.$i)->getValue(),
					'desp_material' => $objWorksheet->getCell('J'.$i)->getValue(),
					'desp_serie_sap' => $objWorksheet->getCell('K'.$i)->getValue(),
					'desp_largo_serie_sap' => $objWorksheet->getCell('L'.$i)->getValue(),
					'desp_serie_busca_sys' => $objWorksheet->getCell('M'.$i)->getValue(),
					'desp_largo_serie_busca_sys' => $objWorksheet->getCell('N'.$i)->getValue(),
					'desp_qty' => $objWorksheet->getCell('O'.$i)->getValue(),
					'desp_texto_material' => $objWorksheet->getCell('P'.$i)->getValue(),
					'desp_familia' => $objWorksheet->getCell('Q'.$i)->getValue(),
					'desp_orden_entrega' => $objWorksheet->getCell('R'.$i)->getValue(),
					'desp_fecha_despacho' => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('S'.$i)->getValue())->format('Y-m-d'),
					'desp_estado_equipo' => $objWorksheet->getCell('T'.$i)->getValue(),
					'desp_estado_serie_despacho' => $objWorksheet->getCell('U'.$i)->getValue(),
					'desp_fecha_carga' => $this->getFechaCarga()
				);
			//}
		}
		/*echo '<pre>';
		print_r($GuardaAjuste);
		echo '</pre>';*/
		$this->Subir_data_model->InsertaSysDespacho($GuardaDespacho);
	}

	public function insert_traspaso(){
		$filename = get_filenames('server/php/files/')[0];
		$names=array();
    $no=0;
    $inputFileType = 'Excel5';
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel  = $objReader->load(FCPATH.'server/php/files/traspaso.xls');//FCPATH.
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $maxRow = $objWorksheet->getHighestRow();
		//$ListaAjuste = $this->Subir_data_model->ObtieneBuscaSysTraspaso();
		//$FechaCarga = date('Y-m-j H:i:s');

		for ($i = 2; $i <= $maxRow; $i++)//$i=14; $i<=$maxRow; $i++
		{
			//$dato = $objWorksheet->getCell('G'.$i)->getValue();
			//if(!in_array($dato,$ListaAjuste)){
				$GuardaTraspaso[] = array(
					'tras_aliado' => $objWorksheet->getCell('A'.$i)->getValue(),
					'tras_material' => $objWorksheet->getCell('B'.$i)->getValue(),
					'tras_texto_material' => $objWorksheet->getCell('C'.$i)->getValue(),
					'tras_familia' => $objWorksheet->getCell('D'.$i)->getValue(),
					'tras_serie_sap' => $objWorksheet->getCell('E'.$i)->getValue(),
					'tras_largo_serie_sap' => $objWorksheet->getCell('F'.$i)->getValue(),
					'tras_serie_busca_sys' => $objWorksheet->getCell('G'.$i)->getValue(),
					'tras_largo_serie_busca_sys' => $objWorksheet->getCell('H'.$i)->getValue(),
					'tras_qty' => $objWorksheet->getCell('I'.$i)->getValue(),
					'tras_motivo_traspaso' => $objWorksheet->getCell('J'.$i)->getValue(),
					'tras_estado_equipo' => $objWorksheet->getCell('K'.$i)->getValue(),
					'tras_guia_traspaso' => $objWorksheet->getCell('L'.$i)->getValue(),
					'tras_fecha_traspaso' => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('M'.$i)->getValue())->format('Y-m-d'),
					'tras_valida_traspaso' => str_replace('Ñ','N',str_replace('ñ','n',$objWorksheet->getCell('N'.$i)->getValue())),
					'tras_cargo_valida' => $objWorksheet->getCell('O'.$i)->getValue(),
					'tras_estado_serie_traspaso' => $objWorksheet->getCell('P'.$i)->getValue(),
					'tras_fecha_carga' => $this->getFechaCarga()
				);
			//}
		}
		/*echo '<pre>';
		print_r($GuardaTraspaso);
		echo '</pre>';*/
		$this->Subir_data_model->InsertSysTraspaso($GuardaTraspaso);
	}

	private function insert_instala(){
		$filename = get_filenames('server/php/files/')[0];
		$names=array();
		$no=0;
		$inputFileType = 'Excel5';
		$objReader = IOFactory::createReader($inputFileType);
		$objPHPExcel  = $objReader->load(FCPATH.'server/php/files/equipoinstala.xls');//FCPATH.
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
		$maxRow = $objWorksheet->getHighestRow();
		//$ListaAjuste = $this->Subir_data_model->ObtieneBuscaSysTraspaso();
		//$FechaCarga = date('Y-m-j H:i:s');

		for ($i = 2; $i <= $maxRow; $i++)//$i=14; $i<=$maxRow; $i++
		{
			//$dato = $objWorksheet->getCell('G'.$i)->getValue();
			//if(!in_array($dato,$ListaAjuste)){
				$GuardaEquipo[] = array(
					'tras_aliado' => $objWorksheet->getCell('A'.$i)->getValue(),
					'tras_material' => $objWorksheet->getCell('B'.$i)->getValue(),
					'tras_texto_material' => $objWorksheet->getCell('C'.$i)->getValue(),
					'tras_familia' => $objWorksheet->getCell('D'.$i)->getValue(),
					'tras_serie_sap' => $objWorksheet->getCell('E'.$i)->getValue(),
					'tras_largo_serie_sap' => $objWorksheet->getCell('F'.$i)->getValue(),
					'tras_serie_busca_sys' => $objWorksheet->getCell('G'.$i)->getValue(),
					'tras_largo_serie_busca_sys' => $objWorksheet->getCell('H'.$i)->getValue(),
					'tras_qty' => $objWorksheet->getCell('I'.$i)->getValue(),
					'tras_motivo_traspaso' => $objWorksheet->getCell('J'.$i)->getValue(),
					'tras_estado_equipo' => $objWorksheet->getCell('K'.$i)->getValue(),
					'tras_guia_traspaso' => $objWorksheet->getCell('L'.$i)->getValue(),
					'tras_fecha_traspaso' => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('M'.$i)->getValue())->format('Y-m-d'),
					'tras_valida_traspaso' => str_replace('Ñ','N',str_replace('ñ','n',$objWorksheet->getCell('N'.$i)->getValue())),
					'tras_cargo_valida' => $objWorksheet->getCell('O'.$i)->getValue(),
					'tras_estado_serie_traspaso' => $objWorksheet->getCell('P'.$i)->getValue(),
					'tras_fecha_carga' => $this->getFechaCarga()
				);
			//}
		}
		/*echo '<pre>';
		print_r($GuardaTraspaso);
		echo '</pre>';*/
		$this->Subir_data_model->InsertSysEquipoInstala($GuardaEquipo);
	}

	public function guardaBaseFinal(){
		$filename = get_filenames('server/php/files/')[0];
		$names=array();
		$no=0;
		$inputFileType = 'Excel5';
		$objReader = IOFactory::createReader($inputFileType);
		//$objReader = new PHPExcel_Reader_Excel2007();
		$objPHPExcel  = $objReader->load(FCPATH.'server/php/files/final.xls');//FCPATH.
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
		$maxRow = $objWorksheet->getHighestRow();
		$objReader->setReadDataOnly(true);
		//$ListaAjuste = $this->Subir_data_model->ObtieneBuscaSysTraspaso();
		//$FechaCarga = date('Y-m-j H:i:s');
		echo '<pre>';
		print_r('subiendo '.$maxRow.' filas');
		echo '</pre>';
		for ($i = 2; $i <= $maxRow; $i++)//$i=14; $i<=$maxRow; $i++
		{
			//$dato = $objWorksheet->getCell('G'.$i)->getValue();
			//if(!in_array($dato,$ListaAjuste)){
				set_time_limit(60);
				$GuardaEquipo[] = array(
					'anio' => $objWorksheet->getCell('A'.$i)->getValue(),
					'centro' => $objWorksheet->getCell('B'.$i)->getValue(),
					'almacen' => $objWorksheet->getCell('C'.$i)->getValue(),
					'material' => $objWorksheet->getCell('D'.$i)->getValue(),
					'sap_sale' => $objWorksheet->getCell('E'.$i)->getValue(),
					'sap_llega' => $objWorksheet->getCell('F'.$i)->getValue(),
					'largo_sap' => strlen($objWorksheet->getCell('E'.$i)->getValue()),
					'fecha_estado_ingreso' => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('G'.$i)->getValue())->format('Y-m-d'),
					'centro_almacen' => $objWorksheet->getCell('H'.$i)->getValue(),
					'aliado' => $objWorksheet->getCell('I'.$i)->getValue(),
					'aliado_region' => $objWorksheet->getCell('J'.$i)->getValue(),
					'negocio' => $objWorksheet->getCell('K'.$i)->getValue(),
					'serie_sistema_sale' => $objWorksheet->getCell('L'.$i)->getValue(),
					'serie_sistema_llega' => $objWorksheet->getCell('M'.$i)->getValue(),
					'largo_serie_busqueda_sistema' => $objWorksheet->getCell('N'.$i)->getValue(),
					'cantidad' => $objWorksheet->getCell('O'.$i)->getValue(),
					'texto_material' => $objWorksheet->getCell('P'.$i)->getValue(),
					'familia' => $objWorksheet->getCell('Q'.$i)->getValue(),
					'orden_de_entrega' => $objWorksheet->getCell('R'.$i)->getValue(),
					'estado_equipo' => $objWorksheet->getCell('S'.$i)->getValue(),
					'estado_ingreso' => $objWorksheet->getCell('T'.$i)->getValue(),
					'estado_stock_inicial' => $objWorksheet->getCell('U'.$i)->getValue(),
					'estado_dsepachos' => $objWorksheet->getCell('V'.$i)->getValue(),
					'folio' => $objWorksheet->getCell('W'.$i)->getValue(),
					'estado_folio' => $objWorksheet->getCell('X'.$i)->getValue(),
					'tipo_trabajo' => $objWorksheet->getCell('Y'.$i)->getValue(),
					'rut' => $objWorksheet->getCell('Z'.$i)->getValue(),
					'tipo_cliente' => $objWorksheet->getCell('AA'.$i)->getValue(),
					'aliado_instalador' => $objWorksheet->getCell('AB'.$i)->getValue(),
					'fecha_actualizacion_cierre' => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('AC'.$i)->getValue())->format('Y-m-d'),
					'comuna' => $objWorksheet->getCell('AD'.$i)->getValue(),
					'region' => $objWorksheet->getCell('AE'.$i)->getValue(),
					'oferta_comercial_actual' => $objWorksheet->getCell('AF'.$i)->getValue(),
					'estatus_equipo' => $objWorksheet->getCell('AG'.$i)->getValue(),
					'estado_consumo' => $objWorksheet->getCell('AH'.$i)->getValue(),
					'motivo_traspaso' => $objWorksheet->getCell('AI'.$i)->getValue(),
					'guia_traspaso' => $objWorksheet->getCell('AJ'.$i)->getValue(),
					'fecha_traspaso' => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('AK'.$i)->getValue())->format('Y-m-d'),
					'validador_traspaso' => $objWorksheet->getCell('AL'.$i)->getValue(),
					'cargo_validador_traspaso' => $objWorksheet->getCell('AM'.$i)->getValue(),
					'estado_traspaso_sale' => $objWorksheet->getCell('AN'.$i)->getValue(),
					'estado_traspaso_entra' => $objWorksheet->getCell('AO'.$i)->getValue(),
					'motivo_ajuste' => $objWorksheet->getCell('AP'.$i)->getValue(),
					'fecha_ajuste' => PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCell('AQ'.$i)->getValue())->format('Y-m-d'),
					'nombre_validador_ajuste' => $objWorksheet->getCell('AR'.$i)->getValue(),
					'cargo_validador_ajuste' => $objWorksheet->getCell('AS'.$i)->getValue(),
					'estado_ajustes' => $objWorksheet->getCell('AT'.$i)->getValue(),
					'estado_general' => $objWorksheet->getCell('AU'.$i)->getValue()
				);
			//}
			//$this->Subir_data_model->InsertSysBaseFinal($GuardaEquipo);
		}
		echo '<pre>';
		print_r('filas subidas');
		echo '</pre>';
		$this->Subir_data_model->InsertSysBaseFinal($GuardaEquipo);
	}

	//funcion que actualiza las tablas que alimentan el master
	public function runStoredProcedureAjuste(){
		$this->Subir_data_model->UpdateSysAjuste();
	}

	public function runStoredProcedureAutoInventario(){
		$this->Subir_data_model->UpdateSysAutoInventario();
	}

	public function runStoredProcedureDespacho(){
		$this->Subir_data_model->UpdateSysDespacho();
	}

	public function runStoredProcedureTraspaso(){
		$this->Subir_data_model->UpdateSysTraspaso();
	}

	private function getFechaCarga(){
		$FechaCarga = date('Y-m-j H:i:s');
		return $FechaCarga;
	}

}
