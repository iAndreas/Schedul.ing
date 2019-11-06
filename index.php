	<?php
		include_once 'header.php';
		require_once "banco.php";
		require_once "sessao.php";
		GerenciadorSessao::startSession();
		$campo = isset($_POST['campo'])?$_POST['campo']:"";
		$campo3 = isset($_POST['campo3'])?$_POST['campo3']:"";
		$campo6 = isset($_POST['campo6'])?$_POST['campo6']:"";
		$tb_laboratorio = "laboratorio";
		$view_ag_lab = 'agenda_lab';
		$tb_agendamento = "agendamento";
		$tb_laboratorio_has_agendamento = "laboratorio_has_agendamento";
		$pesquisa = isset($_POST['pesquisa'])?$_POST['pesquisa']:'';
		$pesquisa3 = isset($_POST['pesquisa3'])?$_POST['pesquisa3']:'';
		$pesquisa6 = isset($_POST['pesquisa6'])?$_POST['pesquisa6']:'';

	?>
	<title>Agendamento de laboratórios</title>
	<script>
		function excluirRegistro(url) {
			if (confirm("Confirmar exclusão?")) {
				location.href = url;
			}
		}
	</script>
</head>

<body>
	<?php include_once 'scripts.php'; ?>
	<?php include_once 'navbar.php'; ?>
	<div class="container">
		<?php include_once 'laboratorio-view.php'; ?>
		<?php include_once 'agendamento-view.php'; ?>
		<?php include_once 'lab-agendamento-view.php'; ?>
	</div>
</body>
</html>