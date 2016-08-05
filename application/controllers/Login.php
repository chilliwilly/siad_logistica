<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Chile/Continental');
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Login_model');
	}
	public function index()
	{
		if($this->session->userdata('is_logged_in')){
			$this->load->view('constant');
			$this->load->view('view_header');
			$this->load->view('view_home');
			//$this->load->view('registro/view_ingreso');
			$this->load->view('view_footer');
		}else{
			$this->load->view('constant');
			$this->load->view('view_login');
		}
	}

	function CerrarSesion(){
          /*destrozamos la sesion activa y nos vamos al login de nuevo*/
          if($this->session->userdata('is_logged_in')){
              $this->session->sess_destroy();
              redirect('login');
          }
    }

	public function ValidaAcceso(){
		if(!isset($_SESSION)){
			session_start();
		}
		$Login 		= json_decode($this->input->post('LoginPost'));
		$response = array (
				"campo"     => "",
	            "error_msg" => ""
	    );
	    if($Login->UserName==""){
			$response["campo"]     = "txtUsuario";
			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button><span class='glyphicon glyphicon-user'></span>&nbsp; Debes ingresar usuario</div>";
		}else if($Login->Password==""){
			$response["campo"]     = "txtPassword";
			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='glyphicon glyphicon-asterisk'></span>&nbsp; Debes ingresar password</div>";
		}else{
			$user = $this->Login_model->LoginBD($Login->UserName);
			if(count($user) == 1){
				$crypt     = md5(base64_decode($Login->Password));//crypt($Login->Password, $user->clave);
				if($user->clave==$crypt){
					 //$tipoUser= "Administrador";
					 //if($user->TIPO==2){$tipoUser="Vendedor";}
					 $user_rol = $this->Login_model->GetRolUsrAgenda($user->id);
					 $aliado_nombre = $this->Login_model->GetAliadoNombre($user->empresa);
					 $rol_nombre = $this->Login_model->GetRolUsrNombre($user_rol->usr_rol_id);

					 $session = array(
                         'ID'           => $user->id,//USR_ID_SIAD
                         'NOMBRE'       => $user->nombres,
                         'APELLIDOS'    => $user->paterno,
                         'USRNAME'      => $user->usuario,
                         'TIPOUSUARIO'  => $user_rol->usr_rol_id,
                         'ALIADORUT'    => $user->empresa,
                         'ALIADONOMBRE' => $aliado_nombre->nombre,
                         'USRROLNOM'    => $rol_nombre->rol_descripcion,
                         'is_logged_in' => TRUE,
                         );
					$Menu = $this->Login_model->GetMenuByUserRol($user_rol->usr_rol_id);
					//$Menu = json_encode($Menu);
					$this->session->set_userdata($session);//Cargamos la sesion de datos del usuario logeado
          $_SESSION['Menu'] = $Menu;//cargamos la sesion del menu de acuerdo a los permisos
          $response["error_msg"]   = '<meta http-equiv="refresh" content="0">';
				}else{
					$response["campo"]     = "txtUsuario";
					$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='glyphicon glyphicon-remove'></span>&nbsp; Usuario o Password Invalida </div>";
				}

			}else{
				$response["campo"]     = "txtUsuario";
				$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='glyphicon glyphicon-remove'></span>&nbsp; Usuario o Password Invalida </div>";
			}
		}
		echo json_encode($response);
	}
}
