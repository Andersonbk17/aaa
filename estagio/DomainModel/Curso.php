<?php

 class Curso{
	
	//	ATRIBUTOS
		private $id;
		private $nome;
		private $sigla;
		private $area;
		
	
		
		function __construct(){
				$this->id = 0;
				$this->nome = "";
				$this->sigla = "";
				$this->area = 0;
		}
		
	// Métodos
		
		public function setNome($nome){
				$this->nome =  addslashes($nome);
		}
		
		public function setId($id){
				$this->id = addslashes($id);
		}
		
		public function setSigla($sigla){
				$this->sigla = addslashes($sigla);
		}
		
		public function setArea($area){
				$this->area = addslashes($area);
		}
		
		public function getNome(){
				return $this->nome;
		}
		
		public function getId(){
				return $this->id;
		}
		
		public function getSigla(){
				return $this->sigla;
		}
		
		public function getArea(){
				return $this->area;
		}


 }
?>
