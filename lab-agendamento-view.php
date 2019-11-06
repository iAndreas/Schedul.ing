<div class="row flex-row">
	<div class="col-md-12 flex-column">
		<div class="row flex-row justify-content-between">
			<h4>Laboratórios Agendados</h4>
		</div>
		<br/>
		<div class="flex-row">
			<form method="post">
				<div>
					<span><b>Filtros </b></span>
					<label>
						<input type="radio" value="l.numero" name="campo6" class="with-gap"
							<?php if ($campo6 == "l.numero"): echo "checked";?><?php endif ?>>
						<span>laboratorio</span>
					</label>

					<label>
						<input type="radio" value="a.codigo" name="campo6" class="with-gap"
							<?php if ($campo6 == "a.codigo"): echo "checked";?><?php endif ?>>
						<span>agendamento</span>
					</label>

					<label>
						<input type="radio" value="a.horario" name="campo6" class="with-gap"
							<?php if ($campo6 == "a.horario"): echo "checked";?><?php endif ?>>
						<span>horario</span>
					</label>

					<label>
						<input type="radio" value="a.dt" name="campo6" class="with-gap"
							<?php if ($campo6 == "a.dt"): echo "checked";?><?php endif ?>>
						<span>Data</span>
					</label>

					<input type="text" name="pesquisa6" value="<?php echo $pesquisa6 ?>">

					<button class="btn waves-effect black" name="acao" value="ok">Enviar</button>
				</div>
			</form>
		</div>
		<div class="table-responsive">
			<table id="mytable" class="table table-bordred table-striped">
				<?php
					if ($pesquisa6 == '' or $campo6 == "") {
						$sql = "SELECT * FROM $view_ag_lab";
					}
					elseif ($campo6 =='l.numero'){
						$sql = "SELECT * FROM $view_ag_lab l where l.numero LIKE '".$pesquisa6."%' order by ".$campo6;
					}
					elseif ($campo6 =='a.codigo'){
						$sql = "SELECT * FROM $view_ag_lab a where a.codigo LIKE '".$pesquisa6."%' order by ".$campo6;
					}
					elseif ($campo6 =='a.horario'){
						$sql = "SELECT * FROM $view_ag_lab a where a.horario LIKE '".$pesquisa6."%' order by ".$campo6;
					}
					elseif ($campo6 =='a.dt'){
						$sql = "SELECT * FROM $view_ag_lab a where a.data_inicio LIKE '".$pesquisa6."%' or a.data_fim LIKE '".$pesquisa6."%' order by ".$campo6;
					}
		
				?>

				<thead>

					<!-- <th><input type="checkbox" id="checkall" /></th> -->
					<th>Codigo</th>
					<th>Data Início</th>
					<th>Data Fim</th>
					<th>Usuário</th>
					<th>Laboratorio</th>
					<th>Atualizar</th>
					<th>Excluir</th>
				</thead>
				<tbody>

					<?php
						$banco = new Banco();
						$row = $banco->select($sql);
						$cont = 0;
						if(is_array($row))
							while ($cont < count($row)){
								echo "<tr>
												<td>".$row[$cont][0]."</td>
												<td>".date("d/m/Y H:i:s", strtotime($row[$cont][2]))."</td>
												<td>".date("d/m/Y H:i:s", strtotime($row[$cont][3]))."</td>
												<td>".$row[$cont][4]."</td> 
												<td>".$row[$cont][5]."</td>
												<td>
													<a
														class='btn btn-primary btn-xs' 
														href='cad_laboratorioAgendamento.php?&id=".$row[$cont][6]."&id2=".$row[$cont][0]."'
													>
														<i class='fa fa-edit'></i>
													</a>
												</td>
												<td>
													<a 
														onclick='excluirRegistro()' 
														class='btn btn-danger btn-xs' 
														href='acao.php?tabela=".$tb_laboratorio_has_agendamento."&acao=excluirN&codigo=".$row[$cont][6]."&codigo2=".$row[$cont][0]."'
													>
														<i class='fa fa-trash'></i>
													</a>
												</td>
											</tr>";
								$cont++;
							}
					?>
				</tbody>

			</table>
			<!-- 
			<div class="clearfix"></div>
			<ul class="pagination pull-right">
				<li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
			</ul> 
			-->

		</div>

	</div>
</div>
<br/><br/>