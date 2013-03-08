<?php
/**
* Bin ExperienciaProfissioal
*/
final class ExperienciaProfissioal {	
	private $id;
	private $idAluno;
	private $nomeEmpresa;
	private $atividadeEmpresa;
	private $dataAdmissao;
	private $dataDemissao;
	private $funcaoExercida;
	private $atividadesExercida;
	private $salario;
	private $ordem;


	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = (int) $id;
	}

	public function getIdAluno() {
		return $this->idAluno;
	}

	public function setIdAluno($idAluno) {
		$this->idAluno = (int) $idAluno;
	}

	public function getNomeEmpresa() {
		return $this->nomeEmpresa;
	}

	public function setNomeEmpresa($nomeEmpresa) {
		$this->nomeEmpresa = $nomeEmpresa;
	}

	public function getAtividadeEmpresa() {
		return $this->atividadeEmpresa;
	}

	public function setAtividadeEmpresa($atividadeEmpresa) {
		$this->atividadeEmpresa = $atividadeEmpresa;
	}

	public function getDataAdmissao() {
		return $this->dataAdmissao;
	}

	public function setDataAdmissao($dataAdmissao) {
		$this->dataAdmissao = $dataAdmissao;
	}

	public function getDataDemissao() {
		return $this->dataDemissao;
	}

	public function setDataDemissao($dataDemissao) {
		$this->dataDemissao = $dataDemissao;
	}

	public function getFuncaoExercida() {
		return $this->funcaoExercida;
	}

	public function setFuncaoExercida($funcaoExercida) {
		$this->funcaoExercida = $funcaoExercida;
	}

	public function getAtividadesExercida() {
		return $this->atividadesExercida;
	}

	public function setAtividadesExercida($atividadesExercida) {
		$this->atividadesExercida = $atividadesExercida;
	}

	public function getSalario() {
		return $this->salario;
	}

	public function setSalario($salario) {
		$this->salario = $salario;
	}

	public function getOrdem() {
		return $this->ordem;
	}

	public function setOrdem($ordem) {
		$this->ordem = $ordem;
	}

}
?>