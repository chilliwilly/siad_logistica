<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subir_data_model extends CI_Model {
  function __construct()
  {
    parent::__construct();
    //$this->db_siad = $this->load->database('siaddb',TRUE);
    //$this->db_siad = $this->load->database('defaultsiad',TRUE);
  }

  function ObtieneBuscaSysAjuste(){
  	$this->db->select('aju_serie_busca_sys');
    $this->db->from('tbl_sl_ajuste');
    $this->db->order_by('aju_serie_busca_sys');
   	return $this->db->get()->result_array();
  }

  function ObtieneBuscaSysInventario(){
    $this->db->select('auto_serie_busca_sys');
    $this->db->from('tbl_sl_autoinventario');
    $this->db->order_by('auto_serie_busca_sys');
   	return $this->db->get()->result_array();
  }

  function ObtieneBuscaSysDespacho(){
    $this->db->select('desp_serie_busca_sys');
    $this->db->from('tbl_sl_despacho');
    $this->db->order_by('desp_serie_busca_sys');
   	return $this->db->get()->result_array();
  }

  function ObtieneBuscaSysTraspaso(){
    $this->db->select('tras_serie_busca_sys');
    $this->db->from('tbl_sl_traspaso');
    $this->db->order_by('tras_serie_busca_sys');
   	return $this->db->get()->result_array();
  }

  function InsertaSysAjuste($data){
    $this->db->truncate('tbl_sl_ajuste_tmp');
    $this->db->insert_batch('tbl_sl_ajuste_tmp',$data);
  }

  function InsertaSysAutoInventario($data){
    $this->db->truncate('tbl_sl_autoinventario_tmp');
    $this->db->insert_batch('tbl_sl_autoinventario_tmp',$data);
  }

  function InsertaSysDespacho($data){
    $this->db->truncate('tbl_sl_despacho_tmp');
    $this->db->insert_batch('tbl_sl_despacho_tmp',$data);
  }

  function InsertSysTraspaso($data){
    $this->db->truncate('tbl_sl_traspaso_tmp');
    $this->db->insert_batch('tbl_sl_traspaso_tmp',$data);
  }

  function InsertSysEquipoInstala($data){
    $this->db->truncate('tbl_sl_equipo_instala_tmp');
    $this->db->insert_batch('tbl_sl_equipo_instala_tmp',$data);
  }

  function InsertSysBaseFinal($data){
    $this->db->insert_batch('tbl_sl_base_final',$data);
  }

  function UpdateSysAjuste(){
    $call_procedure ="CALL sp_sl_update_ajuste()";
    $query = $this->db->query($call_procedure);
    //return $query->result();
  }

  function UpdateSysAutoInventario(){
    $call_procedure ="CALL sp_sl_update_autoinventario()";
    $query = $this->db->query($call_procedure);
    //return $query->result();
  }

  function UpdateSysDespacho(){
    $call_procedure ="CALL sp_sl_update_despacho()";
    $query = $this->db->query($call_procedure);
    //return $query->result();
  }

  function UpdateSysTraspaso(){
    $call_procedure ="CALL sp_sl_update_traspaso()";
    $query = $this->db->query($call_procedure);
    //return $query->result();
  }

}
