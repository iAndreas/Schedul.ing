<?php 
	include_once 'header.php';
	require_once 'check_login.php';
	require_once 'banco.php';
	$tb_agendamento = "agendamento";
	$id = isset($_GET['id'])?$_GET['id']:0;
	$id2 = isset($_GET['id2'])?$_GET['id2']:0;
	$banco = new Banco();
	$valores = $banco->select("SELECT * FROM $tb_agendamento a where a.codigo = $id");
?>
	<title>Novo Agendamento de Horários</title>
</head>
<body>
	<?php include_once 'scripts.php'; ?>
	<?php include_once 'navbar.php'; ?>
	<div class="container justify-content-center text-center">
		<div class="flex-row">
			<div class="flex-column">
				<div class="card my-5">
					<a href="index.php" class="w-25 btn btn-secondary">Voltar</a>
					<h4 class="my-5">Novo agendamento</h4>
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
										<div class='input-group align-items-baseline'>
											<label for="dt-início" class="w-25">Data Início</label>
											<input class="form-control" type="datetime-local" name="dt-inicio" <?php if(isset($valores[0][2])){echo "value='".date('Y-m-d\TH:i:s', strtotime($valores[0][2]))."'}";} ?>/>
										</div>
									</div>
									<div class="form-group flex-row">
										<div class='input-group align-items-baseline'>
											<label for="dt-fim" class="w-25">Data Fim</label>
											<input class="form-control" type="datetime-local" name="dt-fim" <?php if(isset($valores[0][3])){echo "value='".date('Y-m-d\TH:i:s', strtotime($valores[0][3]))."'}";} ?>/>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="flex-row justify-content-center">
							<button
								class="w-25 flex-row btn btn-lg btn-primary" 
								value="inserirA" 
								name="acao" 
								type="submit">
								Inserir
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>