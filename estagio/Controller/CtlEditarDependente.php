<?php
    include_once '../DataAccess/DependenteDAO.php';
    include_once '../DomainModel/Dependente.php';
    
    
    if (!isset($_SESSION)) session_start();
	 $nivel_necessario = 1;
	// Verifica se não há a variavel da sessao que identifica o usuario
	if (!isset($_SESSION['usuarioNome']) OR ($_SESSION['usuarioNivel'] < $nivel_necessario)) {
 	// Destr?i a sess?o por seguran?a
	    session_destroy();
	// Redireciona o visitante de volta pro login
	    header("Location: index_.php"); exit; // mudar depois dos testes
	}
 
    $retorno = $_GET['op'];

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $dataNascimento = implode("-",array_reverse(explode("/",$_POST['dataNascimento'])));
    $sexo = $_POST['sexo'];
    
    if(isset($_GET['func'])){
        $idFuncionario = $_GET['func'];
    }else{
        $idFuncionario = $_POST['funcionario'];
    }
 
    
    $dao = new DependenteDAO();
    $dependente = new Dependente();
    
    $dependente->setId($id);
    $dependente->setDataNascimento($dataNascimento);
    $dependente->setNome($nome);
    $dependente->setSexo($sexo);
    $dependente->setIdFuncionario($idFuncionario);
    
    $dao->alterar($dependente);
    if($retorno == 1){
     echo '<script type="text/javascript"> alert("Alterado com Sucesso !"); 
         window.location="../Presentation/main.php?pagina=frmDetalharFuncionario.php&idFuncionario='. $idFuncionario .'";</script>';
    }else{
        echo '<script type="text/javascript"> alert("Alterado com Sucesso !"); 
         window.location="../Presentation/main.php?pagina=frmCadastroDependente.php";</script>';
    }

?>
