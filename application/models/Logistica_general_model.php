<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logistica_general_model extends CI_Model {
  function __construct()
  {
    parent::__construct();
  }

  function getStockGeneral(){
    $sql = "select
            aliado,
            familia,
            count(*) as qty
            from tbl_sl_base_final
            where estado_general = 'STOCK ALIADO'
            and aliado = 'EZENTIS'
            group by familia,aliado
            order by aliado,familia";
    $query = $this->db->query($sql);
		return $query->result();
  }

  function getStockGeneral2($nom_aliado){
    $sql = "select
            aliado,
            familia,
            count(*) as qty
            from tbl_sl_base_final
            where estado_general = 'STOCK ALIADO'
            and aliado = ?
            group by familia,aliado
            order by aliado,familia";
    $query = $this->db->query($sql,array($nom_aliado));
		return $query->result();
  }

  function getStockEstadoEquipo($nom_aliado){
    $sql = "select
            aliado,
            familia,
            sum(
            case
            	when estado_stock_inicial != '' then 1
            	else 0
            end
            ) as stock_inicial,
            sum(
            case
            	when estado_dsepachos != '' then 1
            	else 0
            end
            ) as despachos,
            sum(
            case
            	when estado_consumo != '' then 1
            	else 0
            end
            ) as consumos,
            sum(
            case
            	when estado_traspaso_sale != '' then 1
            	else 0
            end
            ) as traspaso_sale,
            sum(
            case
            	when estado_traspaso_entra != '' then 1
            	else 0
            end
            ) as traspaso_entra,
            sum(
            case
            	when estado_ajustes != '' then 1
            	else 0
            end
            ) as ajustes
            from tbl_sl_base_final
            where estado_equipo = 'NUEVO'
            and aliado = ?
            group by familia
            order by aliado, familia";
    $query = $this->db->query($sql,array($nom_aliado));
		return $query->result();
  }

  function getStockListaAliado(){
    $sql = "select distinct aliado from tbl_sl_base_final order by aliado";
    $query = $this->db->query($sql);
    return $query->result();
  }
}
