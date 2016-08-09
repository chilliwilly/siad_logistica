<style>
th{
  text-shadow; text-shadow: 1px 0 0 #fff,
  -1px 0 0 #fff,
  0 1px 0 #fff,
  0 -1px 0 #fff,
  1px 1px #fff,
  -1px -1px 0 #fff,
  1px -1px 0 #fff,
  -1px 1px 0 #fff;
}

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
	    <h3 class="box-title">Ajustes - Traspasos</h3>
	  </div>
	  <div class="box-body">

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_ajuste" data-toggle="tab">Ajustes</a></li>
              <li><a href="#tab_traspaso" data-toggle="tab">Traspasos</a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_ajuste">
                <div class="col-xs-12">
          				<div class="form-group col-xs-4">
          					<div class="form-group has-feedback">
          		        <label for="cbo_aliado_aju">Aliado</label>
          		        <select name="cbo_aliado_aju" id="cbo_aliado_aju" class="form-control selectpicker show-tick" data-size="10"></select>
          		      </div>
          				</div>

          				<div class="form-group col-xs-4">
          					<div class="form-group has-feedback">
          						<div class="form-group">
                          <label>Rango Fecha</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="fecha_ajuste">
                          </div>
                          <!-- /.input group -->
                        </div>
          		      </div>
          				</div>

          				<div class="form-group col-xs-4">
          					<div class="form-group has-feedback">
          						<button class="btn btn-primary">
                        <span class="glyphicon glyphicon-search"></span>
                        Filtrar
                      </button>
          					</div>
          				</div>
          			</div>

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
              <!-- /.tab-pane -->

              <div class="tab-pane" id="tab_traspaso">
                <div class="col-xs-12">
          				<div class="form-group col-xs-4">
          					<div class="form-group has-feedback">
          		        <label for="cbo_aliado_tras">Aliado</label>
          		        <select name="cbo_aliado_tras" id="cbo_aliado_tras" class="form-control selectpicker show-tick" data-size="10"></select>
          		      </div>
          				</div>

          				<div class="form-group col-xs-4">
          					<div class="form-group has-feedback">
          						<div class="form-group">
                          <label>Rango Fecha</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="fecha_traspaso">
                          </div>
                          <!-- /.input group -->
                        </div>
          		      </div>
          				</div>

          				<div class="form-group col-xs-4">
          					<div class="form-group has-feedback">
          						<button class="btn btn-primary">
                        <span class="glyphicon glyphicon-search"></span>
                        Filtrar
                      </button>
          					</div>
          				</div>
          			</div>

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
          			              echo '<td class="hiddenRow"><div class="collapse tbl_traspaso'.$num_traspaso.'">'.$value->familia.'</td>';
          			              echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_traspaso'.$num_traspaso.'">'.$value->traspaso_sale.'</td>';
          										echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_traspaso'.$num_traspaso.'">'.$value->traspaso_entra.'</td>';
          										echo '<td style="text-align: center;" class="hiddenRow"><div class="collapse tbl_traspaso'.$num_traspaso.'">'.$value->total.'</td>';
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
