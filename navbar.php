<div class="d-flex flex-row-reverse bd-highlight">
	<?php if (GerenciadorSessao::isLoggedIn()): ?>
		<div class="p-2 bd-highlight">
			<a class="btn btn-primary" href="logout.php">Sair</a>
		</div>
		<div class="p-2 bd-highlight">
			Olá, <?php echo $_SESSION['user_name']; ?>.
		</div>
	<?php else: ?>
		<div class="p-2 bd-highlight">
			<a class="btn btn-primary" href="form-login.php">Login</a>
		</div>
		<div class="p-2 bd-highlight">
			<a class="btn btn-secondary" href="form-register.php">Registro</a>
		</div>
		<div class="p-2 bd-highlight">
			Olá, visitante.
		</div>
	<?php endif; ?>
</div>