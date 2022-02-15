<?php
class Lista
{
	private $id;
	private $Producto;
	private $Cantidad;
	private $Medida;
	private $Prioridad;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}