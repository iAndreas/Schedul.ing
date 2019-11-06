<?php include_once 'header.php';?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card my-5">
					<div>
						<h5 class="text-center"><?php echo $action['title']; ?></h5>
						<form action="acao.php" method="post">
							<?php if($action['title'] === 'Registrar'): ?>
								<div>
									<label for="name">Nome</label>
									<input type="text" id="name" class="form-control" name="name" placeholder="Nome completo" required autofocus>
								</div>
							<?php endif; ?>

							<div>
								<label for="<?php echo $action['form-username']; ?>">Usuário</label>
								<input 
									type="text" 
									id="<?php echo $action['form-username']; ?>" 
									class="form-control" 
									name="<?php echo $action['form-username']; ?>" 
									placeholder="Username" required autofocus>
							</div>
							<div>
								<label for="<?php echo $action['form-pass']; ?>">Senha</label>
								<input 
									type="<?php echo $action['form-pass']; ?>" 
									id="<?php echo $action['form-pass']; ?>" 
									name="<?php echo $action['form-pass']; ?>" 
									class="form-control" 
									placeholder="Senha" required>
							</div>
							<br/>
							<button 
								class="btn btn-lg btn-primary btn-block text-uppercase" 
								value="<?php echo $action['form-action-value']; ?>" 
								name="acao" 
								type="submit"><?php echo $action['form-action-label']; ?></button>
							<hr class="my-4">
						</form>
						<?php if($action['title'] === 'Login'): ?>
							<a href="form-register.php" class="btn btn-lg btn-google btn-block">Registro</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>