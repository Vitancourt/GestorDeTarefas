<?php
class Tarefa
{
	private $id;
	private $descricao;
	private $data;
	private $feito;
  private $fk_usuario;

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function setData($data){
		$this->data = $data;
	}

	public function getData(){
		return $this->data;
	}

	public function setFeito($feito){
		$this->feito = $feito;
	}

	public function getFeito(){
		return $this->feito;
	}

  public function setFK_Usuario($fk_usuario){
    $this->fk_usuario = $fk_usuario;
  }

  public function getFK_Usuario(){
    return $this->fk_usuario;
  }

  #Verifica campos vazios
  public function verificaVazios($desc, $data){
    if(($desc == NULL) || ($data == NULL)){
      return false;
    }else{
      return true;
    }
  }

	#valida campo data
	public function verificaData($data){
		if((strlen($data)) == 10){

			$dat = explode("/","$data"); # fatia a string $dat em pedados, usando / como referência
			$d = $dat[0];
			$m = $dat[1];
			$y = $dat[2];
			$res = checkdate($m,$d,$y);
			if ($res == 1){
				$this->data = $dat[2].'-'.$dat[1].'-'.$dat[0];
				return true;
			} else {
				return false;
			}
		}else{
			return false;
		}
	}


	#Converte data para exibição
	public function converteData($data){
		$dat = explode("-","$data"); # fatia a string $dat em pedados, usando - como referência
		$this->data = $dat[2].'/'.$dat[1].'/'.$dat[0];
	}

	#insere no DB
	public function cadastrarTarefa($desc, $data, $feito, $fkUsuario){
		if(($desc != NULL) && ($data != NULL)){
			require_once("../model/Database.php");
			$DB = Database::conectar();
			$sql = "insert into tbTarefa (id, descricao, data, feito, tbUsuario_id) values (NULL, :descricao, :data, :feito, :fk)";
			$consulta = $DB->prepare($sql);

			$consulta->bindParam(':descricao', $desc, PDO::PARAM_STR);
			$consulta->bindParam(':data', $data, PDO::PARAM_STR);
			$consulta->bindParam(':feito', $feito, PDO::PARAM_STR);
			$consulta->bindParam(':fk', $fkUsuario, PDO::PARAM_STR);
			try{
				$consulta->execute();
				//echo $consulta->rowCount();
				if($consulta->rowCount() == 1){
					return true;
				}
			}catch(PDOException $e){
				echo ($e->getMessage());
				return false;
			}
		}else{
			return false;
		}
	}

	#Busca no banco de dados a partir do ID do usuário e imprime em uma tabela os não concluídos (Estado 0)
	public function verTarefas($fk_Usuario){
		if($fk_Usuario != NULL){
				require_once("../model/Database.php");
				$DB = Database::conectar();
				$sql = "select * from tbTarefa where feito= '0' and tbUsuario_id = :fk order by data asc";
				$consulta = $DB->prepare($sql);

				$consulta->bindParam(':fk', $fk_Usuario, PDO::PARAM_STR);
				try{
					$consulta->execute();
					if($consulta->rowCount() > 0){
						$linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
						foreach($linha as $row){
							$this->setId($row['id']);
							$this->setDescricao($row['descricao']);
							$this->setData($row['data']);
							$this->converteData($this->getData());
							$this->setFeito($row['feito']);
							$this->setFK_Usuario($fk_Usuario);
							$this->setDescricao(substr($this->getDescricao(), 0, 8));
							echo "
								<form action=\"../controller/modTarefas.php\" method=\"post\">
									<tr>
										<input type=\"hidden\" name=\"id\" value=\"".$this->getId()."\">
										<td>".$this->getDescricao()."..</td>
										<td>".$this->getData()."</td>
										<td><input name=\"buttonConcluir\" type=\"submit\" value=\"Concluir\" class=\"btn-group btn-group-xs\"></td>
										<td><input name=\"buttonVer\" type=\"submit\" value=\"Ver\" class=\"btn-group btn-group-xs\"></td>
										<td><input name=\"buttonEditar\" type=\"submit\" value=\"Editar\" class=\"btn-group btn-group-xs\"></td>
										<td><input name=\"buttonExcluir\" type=\"submit\" value=\"Excluir\" class=\"btn-group btn-group-xs\"></td>
									</tr>
								</form>
							";
						}
						return true;
					}
				}catch(PDOException $e){
					echo ($e->getMessage());
					return false;
				}
		}else{
			return false;
		}
	}


	#Busca no banco de dados a partir do ID do usuário e imprime em uma tabela os concluídos (Estado 1)
	public function verTarefasConcluidas($fk_Usuario){
		if($fk_Usuario != NULL){
				require_once("../model/Database.php");
				$DB = Database::conectar();
				$sql = "select * from tbTarefa where feito= '1' and tbUsuario_id = :fk order by data asc";
				$consulta = $DB->prepare($sql);

				$consulta->bindParam(':fk', $fk_Usuario, PDO::PARAM_STR);
				try{
					$consulta->execute();
					if($consulta->rowCount() > 0){
						$linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
						foreach($linha as $row){
							$this->setId($row['id']);
							$this->setDescricao($row['descricao']);
							$this->setData($row['data']);
							$this->converteData($this->getData());
							$this->setFeito($row['feito']);
							$this->setFK_Usuario($fk_Usuario);
							$this->setDescricao(substr($this->getDescricao(), 0, 8));
							echo "
								<form action=\"../controller/modTarefas.php\" method=\"post\">
									<tr>
										<input type=\"hidden\" name=\"id\" value=\"".$this->getId()."\">
										<td>".$this->getDescricao()."..</td>
										<td>".$this->getData()."</td>
										<td><input name=\"buttonVer\" type=\"submit\" value=\"Ver\" class=\"btn-group btn-group-xs\"></td>
									</tr>
								</form>
							";
						}
						return true;
					}
				}catch(PDOException $e){
					echo ($e->getMessage());
					return false;
				}
		}else{
			return false;
		}
	}

	#Consultar tarefa individual
	public function consultaTarefa($id){
		if($id != NULL){
				require_once("../model/Database.php");
				$DB = Database::conectar();
				$sql = "select * from tbTarefa where id = :id";
				$consulta = $DB->prepare($sql);

				$consulta->bindParam(':id', $id, PDO::PARAM_STR);
				try{
					$consulta->execute();
					if($consulta->rowCount() == 1){
						$linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
						foreach($linha as $row){
							$this->setId($row['id']);
							$this->setDescricao($row['descricao']);
							$this->setData($row['data']);
							$this->converteData($this->getData());
							$this->setFeito($row['feito']);
							if($this->getFeito() == 1){
								$this->setFeito("Sim");
							}else{
								$this->setFeito("Não");
							}
						}
						return true;
					}
				}catch(PDOException $e){
					echo ($e->getMessage());
					return false;
				}
		}else{
			return false;
		}
	}

	#Atualiza tbTarefa no campo concluido (Estado = 1)
	public function concluirTarefa($id){
		if($id != NULL){
				require_once("../model/Database.php");
				$DB = Database::conectar();
				$sql = "update tbTarefa set feito='1' where id = :id";
				$consulta = $DB->prepare($sql);

				$consulta->bindParam(':id', $id, PDO::PARAM_STR);
				try{
					$consulta->execute();
				}catch(PDOException $e){
					echo ($e->getMessage());
				}
		}
	}

	#Edita o tbTarefa de acordo com a entrada do usuario
	public function editarTarefa($id, $desc, $data){
		if(($id != NULL) && ($desc != NULL) && ($data != NULL)){
				require_once("../model/Database.php");
				$DB = Database::conectar();
				$sql = "update tbTarefa set descricao = :desc, data = :data where id = :id";
				$consulta = $DB->prepare($sql);

				$consulta->bindParam(':desc', $desc, PDO::PARAM_STR);
				$consulta->bindParam(':data', $data, PDO::PARAM_STR);
				$consulta->bindParam(':id', $id, PDO::PARAM_STR);
				try{
					$consulta->execute();
					return true;
				}catch(PDOException $e){
					echo ($e->getMessage());
					return false;
				}
		}else{
			return false;
		}
	}

	#Exclui tarefa a partir do id
	public function deletarTarefa($id){
		if(($id != NULL)){
				require_once("../model/Database.php");
				$DB = Database::conectar();
				$sql = "delete from tbTarefa where id = :id";
				$consulta = $DB->prepare($sql);

				$consulta->bindParam(':id', $id, PDO::PARAM_STR);
				try{
					$consulta->execute();
					return true;
				}catch(PDOException $e){
					echo ($e->getMessage());
					return false;
				}
		}else{
			return false;
		}
	}


}
?>
