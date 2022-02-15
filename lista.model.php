<?php
class ListadoModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=id17105048_compras', 'id17105048_root', '17NgNB*+g!(ONV14');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM listado");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Lista();

				$alm->__SET('id', $r->id);
				$alm->__SET('Producto', $r->Producto);
				$alm->__SET('Cantidad', $r->Cantidad);
				$alm->__SET('Medida', $r->Medida);
				$alm->__SET('Prioridad', $r->Prioridad);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM listado WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Lista();

			$alm->__SET('id', $r->id);
			$alm->__SET('Producto', $r->Producto);
			$alm->__SET('Cantidad', $r->Cantidad);
			$alm->__SET('Medida', $r->Medida);
			$alm->__SET('Prioridad', $r->Prioridad);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM listado WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Lista $data)
	{
		try 
		{
			$sql = "UPDATE listado SET 
						Producto          = ?, 
						Cantidad        = ?,
						Medida            = ?, 
						Prioridad = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Producto'), 
					$data->__GET('Cantidad'), 
					$data->__GET('Medida'),
					$data->__GET('Prioridad'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Lista $data)
	{
		try 
		{
		$sql = "INSERT INTO listado (Producto,Cantidad,Medida,Prioridad) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('Producto'), 
				$data->__GET('Cantidad'), 
				$data->__GET('Medida'),
				$data->__GET('Prioridad')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}