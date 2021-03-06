<?php

	include_once ("Conexao.php");
	include_once ("../DomainModel/Curso.php");
	
	class CursoDAO {
          
        public function Abrir($id)
        {
			$sql = sprintf("SELECT * FROM curso WHERE idCurso = %s AND status = 1",$id);
			//$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Curso();
				
				$novo->setId(stripslashes($rs['idCurso']));
				$novo->setNome(stripslashes($rs['nome']));
				$novo->setSigla(stripslashes($rs['sigla']));
                                $novo->setArea($rs['idArea']);
			
			}
			return $novo;
			
		}
		
		//Função para salvar relacionamento N para N de Disciplina Curso
		public function SalvarCampus($campus){
			$sql = sprintf("INSERT INTO curso_campus(idCurso,idCampus) VALUES(LAST_INSERT_ID(),'%s')",$campus);
			mysql_query($sql);
		}
		//-----
		public function AtualizarCampus($cam,$cur){
			$sql = sprintf("UPDATE curso_campus SET idCampus='%s' WHERE idCurso='%s'",$cam,$cur);
			mysql_query($sql);
		
		}
		
		public function ProcurarCurso($id){
			$sql = sprintf("SELECT c.idCurso,c.nome FROM disciplina_curso dc INNER JOIN disciplina d ON ( d.idDisciplina = dc.idDisciplina ) INNER JOIN curso c ON ( c.idCurso = dc.idCurso ) WHERE (d.idDisciplina =%s",$id);
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Curso();
				
				$novo->setId(stripslashes($rs['idCurso']));
				$novo->setNome(stripslashes($rs['nome']));
				$lista->append($novo);
			}
			return $lista;		
		}
		
		


        public function Inserir(Curso $obj){
					
			$sql = sprintf("INSERT INTO curso(nome,sigla,idArea,status) VALUES('%s','%s','%s',1)",$obj->getNome(),$obj->getSigla(),$obj->getArea());
			mysql_query($sql);
                     //   echo mysql_insert_id();

		}

		
		public function Apagar($id){
			$sql = sprintf("UPDATE curso SET status = 0 WHERE idCurso = %s", $id);
			
			mysql_query($sql);
		
		}
		
		public function Atualizar(Curso $obj){
			$sql = sprintf("UPDATE curso SET nome='%s', sigla='%s', idArea='%s' WHERE idCurso = %s",$obj->getNome(),$obj->getSigla(),$obj->getArea(),$obj->getId());
			
			mysql_query($sql);
		
		}
		
		public function ListarTodos(){
		
			$sql = "SELECT * FROM curso WHERE status = 1";
			$lista = new ArrayObject();
			
			$resultado = mysql_query($sql);
			while($rs = mysql_fetch_array($resultado)){
			
				$novo = new Curso();
				
				$novo->setId(stripslashes($rs['idCurso']));
				$novo->setNome(stripslashes($rs['nome']));
				$novo->setSigla(stripslashes($rs['sigla']));
				$lista->append($novo);
			}
			return $lista;
		
		}
                
                
                
                
                public function Busca(Curso $obj,$ordem){
                    $sql = sprintf("SELECT * FROM curso WHERE status = 1 ");
                    
                    $filtro = "";
                    
                               
                    
                    if($obj->getNome() != ""){
                        $filtro = sprintf("AND nome LIKE  '%s%s%s'  ORDER BY nome %s","%",$obj->getNome(),"%",$ordem);
                    }
                    
                    
                    if($obj->getId() != 0){
                        $filtro = sprintf("AND idCurso = '%d' ORDER BY idCurso %s",$obj->getId(),$ordem);
                    }
                    
                    $sql.=$filtro;
                    
                                     
                    
                        $resultado = mysql_query($sql);
			$lista = new ArrayObject();
			while($rs = mysql_fetch_array($resultado)){
				
				$n = new Curso();
				
				$n->setId(stripslashes($rs['idCurso']));
				$n->setNome(stripslashes($rs['nome']));
                                $n->setSigla(stripslashes($rs['sigla']));
                                //continua ......
                                $lista->append($n);
				
			}
			return $lista;
                        
		}
                
                
                

}




?>
