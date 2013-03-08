<?php
/**
* Classe DAO ExperienciaProfissionalDAO
*/
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/bcoOportunidade/bcoExperienciaProfissional/experienciaProfissional.php';

class ExperienciaProfissionalDAO{
	
	function inserir($pdo, $dados){
		try {
			$sql = "INSERT INTO experiencia_profissional (
				 ID_ALUNO
				,NOME_EMPRESA
				,ATIVIDADE_EMPRESA
				,DATA_ADMISSAO
				,DATA_DEMISSAO
				,FUNCAO_EXERCIDA
				,ATIVIDADES_EXERCIDAS
				,SALARIO
				,ORDEM
			) VALUES (?,?,?,?,?,?,?,?,?)";

			$rs = $pdo->prepare($sql);
	        $dataAdmissao = Util::formataData($dados->getDataAdmissao(),'/','-','USA');
	        $dataDemissao = Util::formataData($dados->getDataDemissao(),'/','-','USA');
	        /* @var $salario float */
	        $salario = str_replace(',','.',str_replace('.','',$dados->getSalario()));

	        $count = $rs->execute(array($dados->getIdAluno()
	        						,$dados->getNomeEmpresa()
	        						,$dados->getAtividadeEmpresa()
	        						,$dataAdmissao
	        						,$dataDemissao
	        						,$dados->getFuncaoExercida()
	        						,$dados->getAtividadesExercida()
	        						,$dados->getSalario()
	        						,$dados->getOrdem()));
			if($count === false){
				$resposta['gravou'] = false;
				$resposta['mensagem'] = "Erro na gravação";
			}else{
				$resposta['gravou'] = true;
				$resposta['mensagem'] = "Gravou com sucesso.";
			}
		} catch (Exception $e) {
			$resposta['mensagem'] = $e->getMessage();
        	$resposta['gravou']   = false;
		}
		echo json_encode($resposta);
	}

	function atualizar($pdo, $dados){
		try {
			$sql = "UPDATE experiencia_profissional 
					SET
				 		 ID_ALUNO             = ?
						,NOME_EMPRESA         = ?
						,ATIVIDADE_EMPRESA    = ?
						,DATA_ADMISSAO        = ?
						,DATA_DEMISSAO        = ?
						,FUNCAO_EXERCIDA      = ?
						,ATIVIDADES_EXERCIDAS = ?
						,SALARIO              = ?
						,ORDEM                = ?
					WHERE
						ID = ?";

			$rs = $pdo->prepare($sql);
	        $dataAdmissao = Util::formataData($dados->getDataAdmissao(),'/','-','USA');
	        $dataDemissao = Util::formataData($dados->getDataDemissao(),'/','-','USA');
	        /* @var $salario float */
	        $salario = str_replace(',','.',str_replace('.','',$dados->getSalario()));

	        $count = $rs->execute(array($dados->getIdAluno()
	        						,$dados->getNomeEmpresa()
	        						,$dados->getAtividadeEmpresa()
	        						,$dataAdmissao
	        						,$dataDemissao
	        						,$dados->getFuncaoExercida()
	        						,$dados->getAtividadesExercida()
	        						,$dados->getSalario()
	        						,$dados->getOrdem()
	        						,$dados->getId()));
			if($count === false){
				$resposta['gravou'] = false;
				$resposta['mensagem'] = "Erro na gravação";
			}else{
				$resposta['gravou'] = true;
				$resposta['mensagem'] = "Gravou com sucesso.";
			}
		} catch (Exception $e) {
			$resposta['mensagem'] = $e->getMessage();
        	$resposta['gravou']   = false;
		}
		echo json_encode($resposta);
	}

	function excluir($pdo, $parametro){
		try {
			$sql = "DELETE FROM experiencia_profissional WHERE ID = ?";
			$rs = $pdo->prepare($sql);
            $count = $rs->execute(array($parametro['id']));

			if($count === false){
				$resposta['gravou'] = false;
				$resposta['mensagem'] = "Erro na gravação";
			}else{
				$resposta['gravou'] = true;
				$resposta['mensagem'] = "Gravou com sucesso.";
			}
		} catch (Exception $e) {
			$resposta['mensagem'] = $e->getMessage();
        	$resposta['gravou']   = false;
		}
		echo json_encode($resposta);
	}
	
	function pesquisar($pdo, $paramentros){

	}
}

?>