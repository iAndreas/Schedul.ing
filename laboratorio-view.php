<div class="row flex-row mt-5">
	<div class="col-md-12 flex-column">
		<div class="row flex-row justify-content-between">
			<h4>Laboratórios</h4>
			<a href="cad_laboratorio.php" class="btn btn-primary">Cadastrar</a>
		</div>
		<br/>
		<div class="flex-row">
			<form method="post">
				<div>
					<span><b>Filtros </b></span>
					<label>
						<input type="radio" value="codigo" name="campo" class="with-gap"
							<?php if ($campo == "codigo"): echo "checked";?><?php endif ?>>
						<span>Codigo</span>
					</label>

					<label>
						<input type="radio" value="numero" name="campo" class="with-gap"
							<?php if ($campo == "numero"): echo "checked";?><?php endif ?>>
						<span>numero</span>
					</label>

					<label>
						<input type="radio" value="dt" name="campo" class="with-gap"
							<?php if ($campo == "dt"): echo "checked";?><?php endif ?>>
						<span>Data</span>
					</label>

					<input type="text" name="pesquisa" value="<?php echo $pesquisa ?>">

					<button class="btn waves-effect black" name="acao" value="ok">Enviar</button>
				</div>
			</form>
		</div>
		<div class="table-responsive">
			<table id="mytable" class="table table-bordred table-striped">
				<?php
					if ($pesquisa == '') {
						$sql = "SELECT * FROM ".$tb_laboratorio;
					}
					elseif ($campo =='codigo'){
						$sql = "SELECT * FROM ".$tb_laboratorio." WHERE codigo = ".$pesquisa." order by ".$campo;
					}
					elseif ($campo =='numero'){
						$sql = "SELECT * FROM ".$tb_laboratorio." WHERE numero LIKE '".$pesquisa."%' order by ".$campo;
					}
				?>

				<thead>

					<!-- <th><input type="checkbox" id="checkall" /></th> -->
					<th>Código</th>
					<th>Número do Laboratório</th>
					<th>Editar</th>

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
												<td>".$row[$cont][1]."</td>
												<td>
													<a
														class='btn btn-primary btn-xs' 
														href='cad_laboratorio.php?id={$row[$cont][0]}'
													>
														<i class='fa fa-edit'></i>
													</a>
												</td>
												<td>
													<a 
														onclick='excluirRegistro()' 
														class='btn btn-danger btn-xs' 
														href='acao.php?tabela=".$tb_laboratorio."&acao=excluir&codigo=".$row[$cont][0]."'
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