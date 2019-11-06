<div class="row flex-row">
	<div class="col-md-12 flex-column">
		<div class="row flex-row justify-content-between">
			<h4>Agendamentos</h4>
			<a href="cad_agendamento.php" class="btn btn-primary">Novo Agendamento</a>
		</div>
		<br/>
		<div class="flex-row">
			<form method="post">
				<div>
					<span><b>Filtros </b></span>
					<label>
						<input type="radio" value="codigo" name="campo3" class="with-gap"
							<?php if ($campo3 == "codigo"): echo "checked";?><?php endif ?>>
						<span>Codigo</span>
					</label>

					<label>
						<input type="radio" value="horario" name="campo3" class="with-gap"
							<?php if ($campo3 == "horario"): echo "checked";?><?php endif ?>>
						<span>horario</span>
					</label>

					<label>
						<input type="radio" value="dt" name="campo" class="with-gap"
							<?php if ($campo == "dt"): echo "checked";?><?php endif ?>>
						<span>Data</span>
					</label>

					<input type="text" name="pesquisa3" value="<?php echo $pesquisa3 ?>">

					<button class="btn waves-effect black" name="acao" value="ok">Enviar</button>
				</div>
			</form>
		</div>
		<div class="table-responsive">
			<table id="mytable" class="table table-bordred table-striped">
				<?php
					if ($pesquisa3 == '' or $campo3 == "") {
						$sql = "SELECT * FROM ".$tb_agendamento;
					}
					elseif ($campo3 =='codigo'){
						$sql = "SELECT * FROM ".$tb_agendamento." WHERE codigo = ".$pesquisa3." order by ".$campo3;
					}
					elseif ($campo3 =='horario'){
						$sql = "SELECT * FROM ".$tb_agendamento." WHERE horario LIKE '".$pesquisa3."%' order by ".$campo3;
					}
					elseif ($campo =='dt'){
						$sql = "SELECT * FROM ".$tb_agendamento." WHERE dt LIKE '".date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $pesquisa)))."' order by ".$campo;
					}
				?>

				<thead>

					<!-- <th><input type="checkbox" id="checkall" /></th> -->
					<th>Codigo</th>
					<th>Data Início</th>
					<th>Data Fim</th>
					<th>Atualizar</th>
					<th>Excluir</th>
					<th>Adicionar laboratorio</th>
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
												<td>
													<a
														class='btn btn-primary btn-xs' 
														href='cad_agendamento.php?id={$row[$cont][0]}'
													>
													<i class='fa fa-edit'></i>
													</a>
												</td>
												<td>
													<a 
														onclick='excluirRegistro()' 
														class='btn btn-danger btn-xs' 
														href='acao.php?tabela=".$tb_agendamento."&acao=excluir&codigo=".$row[$cont][0]."'
													>
														<i class='fa fa-trash'></i>
													</a>
												</td>
												<td><a href='cad_laboratorioAgendamento.php?id2=".$row[$cont][0]."'>Adicionar Laboratório</a></td>
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