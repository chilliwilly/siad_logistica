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
</style>

<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/i18n/datepicker-es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jsLoadDropdown.js"></script>

<section class="content">
	<div class="box box-default">
	  <div class="box-header with-border">
	    <h3 class="box-title">Stock Seriado HFC</h3>
	  </div>
	  <div class="box-body">
			<div class="col-xs-12">
				<div class="form-group col-xs-4">
					<div class="form-group has-feedback">
		        <label for="cbo_aliado">Aliado</label>
		        <select name="cbo_aliado" id="cbo_aliado" class="form-control selectpicker show-tick" data-size="10"></select>
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
                  <input type="text" class="form-control pull-right" id="reservation">
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
	          <th class="col-md-2" style="text-align: center; vertical-align: middle;">Stock Calculado</th>
						<th class="col-md-2" style="text-align: center;">Stock Aliado Declarado</th>
						<th class="col-md-2" style="text-align: center; vertical-align: middle;">Diferencial</th>
						<th class="col-md-2" style="text-align: center; vertical-align: middle;">Stock Inicial</th>
						<th class="col-md-2" style="text-align: center; vertical-align: middle;">Despachos</th>
						<th class="col-md-2" style="text-align: center; vertical-align: middle;">Consumo</th>
						<th class="col-md-2" style="text-align: center;">Traspaso Out</th>
						<th class="col-md-2" style="text-align: center;">Traspaso In</th>
						<th class="col-md-2" style="text-align: center; vertical-align: middle;">Ajustes</th>
	        </tr>
				</thead>
				<tbody>
	        <?php
	          if(json_decode($tabla_final)){
	            $relleno = json_decode($aliado,true);
	            //echo array_map("unserialize", array_unique(array_map("serialize", $relleno->aliado)));
	            $aliados = array_column($relleno,'aliado');
	            $ali_unico = array_unique($aliados);

	            foreach ($ali_unico as $val) {
	              # code...
								$nom_aliado = $val;
								echo '<tr>';
								echo '<th colspan="10" scope="row" bgcolor="#FA5858">'.$val.'</th>';
								echo '</tr>';

								foreach (json_decode($tabla_final) as $value) {
		              # code...
									if($nom_aliado == $value->aliado){
										echo '<tr bgcolor="#F6CECE">';
			              echo '<td>'.$value->familia.'</td>';
			              echo '<td style="text-align: center;">'.$value->qty.'</td>';
										echo '<td style="text-align: center;">'.$value->stock_material.'</td>';
										echo '<td style="text-align: center;">'.$value->dif_material.'</td>';
										echo '<td style="text-align: center;">'.$value->stock_inicial.'</td>';
										echo '<td style="text-align: center;">'.$value->despachos.'</td>';
										echo '<td style="text-align: center;">'.$value->consumos.'</td>';
										echo '<td style="text-align: center;">'.$value->traspaso_sale.'</td>';
										echo '<td style="text-align: center;">'.$value->traspaso_entra.'</td>';
										echo '<td style="text-align: center;">'.$value->ajustes.'</td>';
			              echo '</tr>';
									}
		            }
	            }
	          }
	        ?>
				</tbody>
      </table>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

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
		//Date range picker
    $('#reservation').daterangepicker({locale:{format: 'DD-MM-YYYY', separator: ' / ', firstDay: 1, applyLabel: "Aceptar",
        cancelLabel: "Cancelar", daysOfWeek: ["Dom","Lun","Mar","Mie","Jue","Vie","Sab"]}});
		//Timepicker
		$(".timepicker").timepicker({
		  showInputs: false
		});
	});
</script>
