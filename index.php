<?php
require_once 'lista.entidad.php';
require_once 'lista.model.php';

// Logica
$alm = new Lista();
$model = new ListadoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('id',              $_REQUEST['id']);
			$alm->__SET('Producto',          $_REQUEST['Producto']);
			$alm->__SET('Cantidad',        $_REQUEST['Cantidad']);
			$alm->__SET('Medida',            $_REQUEST['Medida']);
			$alm->__SET('Prioridad', $_REQUEST['Prioridad']);

			$model->Actualizar($alm);
			header('Location: index.php');
			break;

		case 'registrar':
			$alm->__SET('Producto',          $_REQUEST['Producto']);
			$alm->__SET('Cantidad',        $_REQUEST['Cantidad']);
			$alm->__SET('Medida',            $_REQUEST['Medida']);
			$alm->__SET('Prioridad', $_REQUEST['Prioridad']);

			$model->Registrar($alm);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['id']);
			header('Location: index.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['id']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Lista de Compras</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Georama:wght@200;400&display=swap" rel="stylesheet">


	</head>
    <body>
    <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
    <div class="jumbotron text-center">
    <iframe src="https://embed.lottiefiles.com/animation/51570"></iframe>

    <h1>Lista de Compras 🥩🧀🍎🥕🥦🍤</h1>
    </div>

    <div class="col-sm-4"></div></div>
        <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 form">
       
                <form action="?action=<?php echo $alm->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="id" value="<?php echo $alm->__GET('id'); ?>" />
                    
                    <table class="lista">
                        <tr>
                            <th>PRODUCTO</th>
                            <td><input type="text" name="Producto" value="<?php echo $alm->__GET('Producto'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th>CANTIDAD</th>
                            <td><input type="text" name="Cantidad" value="<?php echo $alm->__GET('Cantidad'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th>MEDIDA</th>
                            <td>
                                <select name="Medida"  style="width:100%;">
                                    <option value="1" <?php echo $alm->__GET('Medida') == 1 ? 'selected' : ''; ?>>KG</option>
                                    <option value="2" <?php echo $alm->__GET('Medida') == 2 ? 'selected' : ''; ?>>UNIDAD</option>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>PRIORIDAD</th>
                            <td>
                                <select name="Prioridad" style="width:100%;">
                                    <option value="1" <?php echo $alm->__GET('Prioridad') == 1 ? 'selected' : ''; ?>>Alta</option>
                                    <option value="2" <?php echo $alm->__GET('Prioridad') == 2 ? 'selected' : ''; ?>>Baja</option>

                                </select>
                            </td>
                        </tr>
        
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Agregar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal fondo lista">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Medida</th>
                            <th>Prioridad</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Producto'); ?></td>
                            <td><?php echo $r->__GET('Cantidad'); ?></td>
                            <td><?php echo $r->__GET('Medida')== 1 ? 'KG' : 'UNIDAD'; ?></td>
                            <td><?php echo $r->__GET('Prioridad') == 1 ? 'ALTA' : 'BAJA'; ?></td>
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
                
            </div>
            <div class="col-sm-4"></div>
        </div> 
    </div>
   
    </body>
</html>
