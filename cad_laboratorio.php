<?php
	include_once 'header.php';
	require_once 'check_login.php';
	require_once 'banco.php';
	$tb_laboratorio = "laboratorio";
	$id = isset($_GET['id'])?$_GET['id']:0;
	$id2 = isset($_GET['id2'])?$_GET['id2']:0;
	$banco = new Banco();
	$valores = $banco->select("SELECT * FROM $tb_laboratorio a where a.codigo = $id");
?>
	<title>Novo Laboratório</title>
</head>
<body>
	<?php include_once 'scripts.php'; ?>
	<?php include_once 'navbar.php'; ?>
	<div class="container justify-content-center text-center">
		<div class="flex-row">
			<div class="flex-column">
				<div class="card my-5">
					<a href="index.php" class="w-25 btn btn-secondary">Voltar</a>
					<h4 class="my-5">Novo Laboratório</h4>
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
											<label for="numero" class="w-25">Número do Laboratório</label>
											<input class="form-control" type="number" min="1" name="numero" id="numero" <?php if(isset($valores[0][1])){echo "value='{$valores[0][1]}'}";} ?>/>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="flex-row justify-content-center">
							<button
								class="w-25 flex-row btn btn-lg btn-primary" 
								value="inserirL" 
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