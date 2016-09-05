<style>
/*th{
  text-shadow; text-shadow: 1px 0 0 #fff,
  -1px 0 0 #fff,
  0 1px 0 #fff,
  0 -1px 0 #fff,
  1px 1px #fff,
  -1px -1px 0 #fff,
  1px -1px 0 #fff,
  -1px 1px 0 #fff;
}*/

.hiddenRow {
  padding: 0 !important;
}
</style>

<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-select.min.css"/>
<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo base_url();?>js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jsLoadDropdown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/i18n/datepicker-es.js"></script>

<section class="content">
	<div class="box box-default">
	  <div class="box-header with-border">
	    <h3 class="box-title">Detalle Stock</h3>
	  </div>
	  <div class="box-body">

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_ajuste" data-toggle="tab">Ajustes</a></li>
              <li><a href="#tab_traspaso" data-toggle="tab">Traspasos</a></li>
              <li><a href="#tab_despacho" data-toggle="tab">Despacho</a></li>
              <li><a href="#tab_consumo" data-toggle="tab">Consumo</a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_ajuste">
                <table class="table table-inverse table-bordered table-hover">
                  <thead>
          	        <tr bgcolor="#FE2E2E">
          	          <th class="col-md-2" style="text-align: center; vertical-align: middle;">Aliado/Equipos</th>
          	          <th class="col-md-2" style="text-align: center; vertical-align: middle;">Devolucion</th>
          						<th class="col-md-2" style="text-align: center; vertical-align: middle;">No Entregado</th>
          						<th class="col-md-2" style="text-align: center; vertical-align: middle;">Total</th>
          	        </tr>
          				</thead>
                  <tbody>
                    <?php
                      if(json_decode($total_ajuste)){
                        $relleno = json_decode($aliado,true);
          	            //echo array_map("unserialize", array_unique(array_map("serialize", $relleno->aliado)));
          	            $aliados = array_column($relleno,'aliado');
          	            $ali_unico = array_unique($aliados);
                        $num_ajuste = 1;

          	            foreach ($ali_unico as $val) {
          	              # code...
          								$nom_aliado = $val;
          								echo '<tr>';
          								echo '<th colspan="10" scope="row" bgcolor="#FA5858" data-toggle="collapse" data-target=".tbl_ajuste'.$num_ajuste.'">'.$val.'</th>';
          								echo '</tr>';

                          foreach (json_decode($total_ajuste) as $value) {
          		              # code...
          									if($nom_aliado == $value->aliado){
          										echo '<tr bgcolor="#F6CECE">';
          			              echo '<td class="hiddenRow"><div class="collapse tbl_ajuste'.$num_ajuste.'">'.$value->familia.'</div></td>';
          			              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_ajuste'.$num_ajuste.'">'.$value->devolucion.'</div></td>';
          										echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_ajuste'.$num_ajuste.'">'.$value->no_entregado.'</div></td>';
          										echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_ajuste'.$num_ajuste.'">'.$value->total.'</div></td>';
          			              echo '</tr>';
          									}
          		            }
                          $num_ajuste++;
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>

              <div class="tab-pane" id="tab_traspaso">
                <table class="table table-inverse table-bordered table-hover">
                  <thead>
          	        <tr bgcolor="#FE2E2E">
          	          <th class="col-md-2" style="text-align: center; vertical-align: middle;">Aliado/Equipos</th>
          	          <th class="col-md-2" style="text-align: center; vertical-align: middle;">Traspaso Sale</th>
          						<th class="col-md-2" style="text-align: center; vertical-align: middle;">Traspaso Entra</th>
          						<th class="col-md-2" style="text-align: center; vertical-align: middle;">Total</th>
          	        </tr>
          				</thead>
                  <tbody>
                    <?php
                      if(json_decode($total_traspaso)){
                        $relleno = json_decode($aliado,true);
          	            //echo array_map("unserialize", array_unique(array_map("serialize", $relleno->aliado)));
          	            $aliados = array_column($relleno,'aliado');
          	            $ali_unico = array_unique($aliados);
                        $num_traspaso = 1;

          	            foreach ($ali_unico as $val) {
          	              # code...
          								$nom_aliado = $val;
          								echo '<tr>';
          								echo '<th colspan="10" scope="row" bgcolor="#FA5858" data-toggle="collapse" data-target=".tbl_traspaso'.$num_traspaso.'">'.$val.'</th>';
          								echo '</tr>';

                          foreach (json_decode($total_traspaso) as $value) {
          		              # code...
          									if($nom_aliado == $value->aliado){
          										echo '<tr bgcolor="#F6CECE">';
          			              echo '<td class="hiddenRow"><div class="collapse tbl_traspaso'.$num_traspaso.'">'.$value->familia.'</div></td>';
          			              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_traspaso'.$num_traspaso.'">'.$value->traspaso_sale.'</div></td>';
          										echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_traspaso'.$num_traspaso.'">'.$value->traspaso_entra.'</div></td>';
          										echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_traspaso'.$num_traspaso.'">'.$value->total.'</div></td>';
          			              echo '</tr>';
          									}
          		            }
                          $num_traspaso++;
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>

              <div class="tab-pane" id="tab_despacho">
                <table class="table table-inverse table-bordered table-hover">
                  <thead>
                    <tr bgcolor="#FE2E2E">
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">Aliado Region/Familia</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">CM</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">CM WIFI</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">CM WIFI 3.0</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO BASICO</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO DTA BASICO</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO DTA HD</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO HD</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO HD FULL</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA 4 LINEAS</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA 8 LINEAS</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA WIFI</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA WIFI 3.0</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(json_decode($total_despacho)){
                        $relleno = json_decode($aliado,true);
                        //echo array_map("unserialize", array_unique(array_map("serialize", $relleno->aliado)));
                        $aliados = array_column($relleno,'aliado');
                        $ali_unico = array_unique($aliados);
                        $num_despacho = 1;

                        foreach ($ali_unico as $val) {
                          # code...
                          $nom_aliado = $val;
                          echo '<tr>';
                          echo '<th colspan="15" scope="row" bgcolor="#FA5858" data-toggle="collapse" data-target=".tbl_despacho'.$num_despacho.'">'.$val.'</th>';
                          echo '</tr>';

                          foreach (json_decode($total_despacho) as $value) {
                            # code...
                            if($nom_aliado == $value->aliado){
                              echo '<tr bgcolor="#F6CECE">';
                              echo '<td class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->aliado_region.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->CM.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->CM_WIFI.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->CM_WIFI_3_0.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->DECO_BASICO.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->DECO_DTA_BASICO.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->DECO_DTA_HD.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->DECO_HD.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->DECO_HD_FULL.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->MTA.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->MTA_4_LINEAS.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->MTA_8_LINEAS.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->MTA_WIFI.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->MTA_WIFI_3_0.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_despacho'.$num_despacho.'">'.$value->total.'</div></td>';
                              echo '</tr>';
                            }
                          }
                          $num_despacho++;
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>

              <div class="tab-pane" id="tab_consumo">
                <table class="table table-inverse table-bordered table-hover">
                  <thead>
                    <tr bgcolor="#FE2E2E">
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">Tipo Trabajo/Familia</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">CM</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">CM WIFI</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">CM WIFI 3.0</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO BASICO</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO DTA BASICO</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO DTA HD</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO HD</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">DECO HD FULL</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA 4 LINEAS</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA 8 LINEAS</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA WIFI</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">MTA WIFI 3.0</th>
                      <th class="col-md-2" style="text-align: center; vertical-align: middle;">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(json_decode($total_consumo)){
                        $relleno = json_decode($aliado,true);
                        //echo array_map("unserialize", array_unique(array_map("serialize", $relleno->aliado)));
                        $aliados = array_column($relleno,'aliado');
                        $ali_unico = array_unique($aliados);
                        $num_consumo = 1;

                        foreach ($ali_unico as $val) {
                          # code...
                          $nom_aliado = $val;
                          echo '<tr>';
                          echo '<th colspan="15" scope="row" bgcolor="#FA5858" data-toggle="collapse" data-target=".tbl_consumo'.$num_consumo.'">'.$val.'</th>';
                          echo '</tr>';

                          foreach (json_decode($total_consumo) as $value) {
                            # code...
                            if($nom_aliado == $value->aliado){
                              echo '<tr bgcolor="#F6CECE">';
                              echo '<td class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->tipo_trabajo.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->CM.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->CM_WIFI.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->CM_WIFI_3_0.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->DECO_BASICO.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->DECO_DTA_BASICO.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->DECO_DTA_HD.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->DECO_HD.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->DECO_HD_FULL.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->MTA.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->MTA_4_LINEAS.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->MTA_8_LINEAS.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->MTA_WIFI.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->MTA_WIFI_3_0.'</div></td>';
                              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_consumo'.$num_consumo.'">'.$value->total.'</div></td>';
                              echo '</tr>';
                            }
                          }
                          $num_consumo++;
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		//$('.selector').datepicker($.datepicker.regional[ "es" ]);
		//$.datepicker.setDefaults($.datepicker.regional['es']);
		//Datemask dd/mm/yyyy
		$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		//Datemask2 mm/dd/yyyy
		$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
		//Money Euro
		$("[data-mask]").inputmask();
		//Date picker
    $('#datepicker_desde').datepicker({
      autoclose: true
    });
		//Date range picker ajuste
    $('#fecha_ajuste').daterangepicker({locale:{format: 'DD-MM-YYYY', separator: ' / ', firstDay: 1, applyLabel: "Aceptar",
        cancelLabel: "Cancelar", daysOfWeek: ["Dom","Lun","Mar","Mie","Jue","Vie","Sab"], setDate: ''}});
    //Date range picker traspaso
    $('#fecha_traspaso').daterangepicker({locale:{format: 'DD-MM-YYYY', separator: ' / ', firstDay: 1, applyLabel: "Aceptar",
        cancelLabel: "Cancelar", daysOfWeek: ["Dom","Lun","Mar","Mie","Jue","Vie","Sab"], setDate: ''}});
	});

  $('.collapse').on('show.bs.collapse', function () {
    $('.collapse.in').collapse('hide');
  });
</script>
