<?php 
	require_once 'banco.php';
	require_once 'bancoNN.php';
	require_once 'sessao.php';

	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	
	$acao = isset($_POST['acao'])?$_POST['acao']:$_GET['acao'];


	switch ($acao) {
		case "excluir":
			$tabela = isset($_GET['tabela'])?$_GET['tabela']:'';
			$id = isset($_GET['codigo'])?$_GET['codigo']:0;

			$banco = new Banco();
			$banco->setTabela($tabela);
			$banco->delete($id);
			header("location:index.php");
			break;
		case "inserirL":
			$id = 0;
			if(isset($_POST['id']))
			$id = $_POST['id'];

			$numero = "";
			if(isset($_POST['numero']))
			$numero = $_POST['numero'];

			$banco = new Banco();
			$banco->setTabela("laboratorio");
			
			
			if($id != 0){
					$vetor = [$id, $numero];
					$banco->update($vetor);
					// var_dump($vetor);
			} else{
					$vetor = [null, $numero];
					$banco->inserir($vetor);
			}
			header("location:index.php");
			break;
		case "inserirA":
			$id = 0;
			if(isset($_POST['id']))
				$id = $_POST['id'];

			$horario = 0;
			if(isset($_POST['horario']))
				$horario = $_POST['horario'];

			$dt_inicio = "";
			if(isset($_POST['dt-inicio']))
				$dt_inicio = date("Y-m-d\TH:i:s", strtotime(str_replace("/", "-",$_POST['dt-inicio'])));
			
			$dt_fim = "";
			if(isset($_POST['dt-fim']))
				$dt_fim = date("Y-m-d\TH:i:s", strtotime(str_replace("/", "-",$_POST['dt-fim'])));

			$banco = new Banco();
			$banco->setTabela('agendamento');
			if($id != 0){
				$vetor = [$id, $horario, $dt_inicio, $dt_fim];
				$banco->update($vetor);
			} else{
				$vetor = [null, $horario, $dt_inicio, $dt_fim];
				$banco->inserir($vetor);
			}
			header("location:index.php");
			break;
		case "inserirLA":
			$laboratorio = isset($_POST['laboratorio'])?$_POST['laboratorio']:0;
			$agendamento = isset($_POST['agendamento'])?$_POST['agendamento']:0;

			$vetor = [$laboratorio, $agendamento, GerenciadorSessao::getLoggedUser()];

			$bancoN = new bancoNN();
			$bancoN->setTabela("laboratorio_has_agendamento");
			if($_POST['alterar'] == 1){
				$banco = new Banco();
				if ($banco->conflitoData($agendamento, $laboratorio)) {
					echo "Conflito de horários. Favor agendar outro horário.";
					exit;
				} else {
					$bancoN->update($vetor, $_POST['codigo_lab_antigo']);
					header("location:index.php?id=$laboratorio&id2=$agendamento");
				}
			}else{
				$banco = new Banco();
				if ($banco->conflitoData($agendamento, $laboratorio)) {
					echo "Conflito de horários. Favor agendar outro horário.";
					exit;
				} else {
					$bancoN->inserirN($vetor);
				}
				header("location:index.php");
			}
			break;
			case "excluirN":
				$tabela = isset($_GET['tabela'])?$_GET['tabela']:"";
				$codigo = isset($_GET['codigo'])?$_GET['codigo']:0;
				$codigo2 = isset($_GET['codigo2'])?$_GET['codigo2']:0;
				$bancoN = new bancoNN;
				$bancoN->setTabela($tabela);
				$bancoN->deleteN($codigo, $codigo2);
				header("location:index.php");
				break;
			case "Entrar":
				$banco = new Banco();
				$users = $banco->validaLogin(isset($_POST['user'])? $_POST['user'] : '', isset($_POST['password'])? $_POST['password'] : '');
				if (count($users) <= 0) {
					echo "Usuario ou senha incorretos";
    			exit;
				}

				GerenciadorSessao::logIn($users[0]);
				break;
			case 'Registrar':
				if (validateRequiredField($_POST['name']) && validateRequiredField($_POST['username']) && validateRequiredField($_POST['password'])) {
					$banco = new Banco();
					$banco->setTabela("usuario");
					$vetor = [null, $_POST['name'], $_POST['username'], $banco->geraHash($_POST['password'])];
					$banco->inserir($vetor);

					header("location:form-login.php");
				} else {
					echo "Favor preencher totos os dados!";
				}


				break;
			default:
				echo "Nada a fazer";
	}

	function validateRequiredField($field) {
		return isset($field) && !empty($field);

	}

	// if($acao == "excluir"){
	// 	$tabela = isset($_GET['tabela'])?$_GET['tabela']:'';
	// 	$id = isset($_GET['codigo'])?$_GET['codigo']:0;

	// 	$banco = new Banco();
	// 	$banco->setTabela($tabela);
	// 	$banco->delete($id);
	// 	header("location:index.php");
	// }
	
	// elseif ($acao=='inserirL') {
  //       $id = 0;
  //       if(isset($_POST['id']))
  //       $id = $_POST['id'];

  //       $numero = "";
  //       if(isset($_POST['numero']))
  //       $numero = $_POST['numero'];

  //       $banco = new Banco();
  //       $banco->setTabela("laboratorio");
        
        
  //       if($id != 0){
  //           $vetor = [$id, $numero];
  //           $banco->update($vetor);
  //           var_dump($vetor);
  //           header("location:cad_laboratorio.php?id=$id");
  //       }
  //       else{
  //           $vetor = [null, $numero];
  //           $banco->inserir($vetor);
  //           header("location:index.php");
  //       }
        
  //   }

  //   elseif($acao == "inserirA"){
  //       $id = 0;
  //       if(isset($_POST['id']))
  //       $id = $_POST['id'];

  //       $horario = "";
  //       if(isset($_POST['horario']))
  //       $horario = $_POST['horario'];

  //       $dt = "";
  //       if(isset($_POST['dt']))
  //       $dt = date("Y-m-d", strtotime(str_replace("/", "-",$_POST['dt'])));

  //       $banco = new Banco();
	// 	$banco->setTabela('agendamento');
  //       if($id != 0){
  //           $vetor = [$id, $horario, $dt];
  //           $banco->update($vetor);
  //           header("location:cad_agendamento.php?id=$id");
  //          }
  //          else{
  //            $vetor = [null, $horario, $dt];
  //           $banco->inserir($vetor);
  //           header("location:index.php");
  //          }
  //   }
   

    // elseif ($acao == "inserirLA"){
    //     $laboratorio = isset($_POST['laboratorio'])?$_POST['laboratorio']:0;
    //     $agendamento = isset($_POST['agendamento'])?$_POST['agendamento']:0;
    
    //     $vetor = [$laboratorio, $agendamento];
    
    //     $bancoN = new bancoNN();
    //     $bancoN->setTabela("laboratorio_has_agendamento");
    //     if($_POST['alterar'] == 1){
    //         $bancoN->update($vetor);
    //         header("location:cad_laboratorioAgendamento.php?id=$laboratorio&id2=$agendamento");
    //     }
    //     else{
    //         $bancoN->inserirN($vetor);
    //         header("location:index.php");
    //     }
    // }
    
    // elseif($acao == "excluirN"){
    //     $tabela = isset($_GET['tabela'])?$_GET['tabela']:"";
    //     $codigo = isset($_GET['codigo'])?$_GET['codigo']:0;
    //     $codigo2 = isset($_GET['codigo2'])?$_GET['codigo2']:0;
    //     $bancoN = new bancoNN;
    //     $bancoN->setTabela($tabela);
    //     $bancoN->deleteN($codigo, $codigo2);
    //     header("location:index.php");
    // }

?>