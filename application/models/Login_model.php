<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model {
	 function __construct()
	 {
	      parent::__construct();
	      //$this->db_siad = $this->load->database('siaddb',TRUE);
	      $this->db_siad = $this->load->database('defaultsiad',TRUE);
	 }

	 public function GetMenuByUserRol($rolid)
	 {
	    $sql = "select menu_id,
                     menu_nombre,
                     menu_url,
                     menu_grupo,
                     menu_rol,
                     menu_cierre
              from tbl_sl_menu
              where menu_id in (select menu_id from tbl_sl_menu_rol where rol_id = ?) order by field (menu_id,1,2,8,3)";
	    $query = $this->db->query($sql,$rolid);

		return $query->result();
	 }

	 function LoginBD($username)
	 {
	 	$this->db_siad->where('usuario', $username);
	    return $this->db_siad->get('usuarios')->row();
	 }

	 function GetRolUsrAgenda($idusr)
	 {
	 	$this->db->where('usr_id',$idusr);
	 	return $this->db->get('tbl_sl_usr_rol')->row();
	 }

	 function GetAliadoNombre($idaliado){
	 	$this->db_siad->where('id',$idaliado);
	 	return $this->db_siad->get('empresas')->row();
	 }

	 function GetRolUsrNombre($idrol){
	 	$this->db->where('rol_id',$idrol);
	 	return $this->db->get('tbl_sl_rol')->row();
	 }
}
