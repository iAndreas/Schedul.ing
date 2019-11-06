<?php
	include_once 'header.php';
	require_once 'check_login.php';
	require_once 'banco.php';
	$codigo = isset($_GET['id'])?$_GET['id']:0;
	$codigo2 = isset($_GET['id2'])?$_GET['id2']:0;
	$banco = new Banco();

	if($codigo != 0 and $codigo2!= 0) {
		$vetor = $banco->select("SELECT * FROM laboratorio_has_agendamento la where cod_laboratorio = $codigo and cod_agendamento = $codigo2");
	}
	if ($codigo2 != 0)
		$horario = $banco->select("SELECT * FROM agendamento la where la.codigo = $codigo2");
?>
	<title>Vincular Laboratório a Horário</title>
</head>
<body>
	<?php include_once 'scripts.php'; ?>
	<?php include_once 'navbar.php'; ?>
	<div class="container justify-content-center text-center">
		<div class="flex-row">
			<div class="flex-column">
				<div class="card my-5">
					<a href="index.php" class="w-25 btn btn-secondary">Voltar</a>
					<h4 class="my-5">Vincular Laboratório a Horário</h4>
					<form action="acao.php" method="post">
						<?php
							if(isset($valores[0][0])){
								echo "<input type='hidden' value='{$valores[0][0]}' name='id'>";
							}
						?>
						<div class="container align-items-center">
							<div class="flex-row">
								<div class='flex-column'>
									<div class="form-group flex-row">
											<span class="w-25">Horário a vincular:</label>
											<span><?php echo (isset($horario) && isset($horario[0])) ? date("d/m/Y H:i:s", strtotime($horario[0]['data_inicio'])).' - '.date("d/m/Y H:i:s", strtotime($horario[0]['data_fim'])) : ''; ?></span>
									</div>
									<div class="form-group flex-row">
										<div class='input-group align-items-baseline'>
											<label for="laboratorio" class="w-25">Selecione um laboratório</label>
											<?php $banco->setTabela('laboratorio'); echo $banco->geraSelect("laboratorio", $codigo, 0, 1, "laboratorio", ''); ?>
											<input type="hidden" name="alterar" value="<?php echo $codigo != 0?1:0;?>">
											<input type="hidden" name="codigo_lab_antigo" value="<?php echo $codigo; ?>">
											<input type="hidden" name="agendamento" value="<?php echo $codigo2; ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="flex-row justify-content-center">
							<button
								class="w-25 flex-row btn btn-lg btn-primary" 
								value="inserirLA" 
								name="acao" 
								type="submit">
								Vincular
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>