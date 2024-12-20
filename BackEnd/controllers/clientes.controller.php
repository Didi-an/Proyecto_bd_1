<?php
class ClientesController {

    public function crearCliente($nombre, $direccion, $noTelefono, $sexo, $ingresosAnuales) {
        // Crear instancia del modelo
        $clienteModel = new ClientesModel();

        // Llamar al método del modelo para crear el cliente
        $response = $clienteModel::crearCliente($nombre, $direccion, $noTelefono, $sexo, $ingresosAnuales);

        // Verificar si la respuesta está vacía o si hubo un error
        if (isset($response['status']) && $response['status'] !== 200) {
            // Error en la creación del cliente
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            // Cliente creado exitosamente
            echo json_encode([
                "status" => 200,
                "data" => $response['data'] ?? null
            ], JSON_PRETTY_PRINT);
        }

        return;
    }

    public function readAll(){
        $clienteModel = new ClientesModel();
        // Llamando método para hacer la lectura en la tabla de Empleado
        $clientes = Utf8Convert::utf8_convert($clienteModel::readAll());

        if(empty($clientes)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay clientes almacenados en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$clientes
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function actualizarCliente($idCliente, $campos){

        $datos = 
        $json = array(
            "idCliente" => $idCliente,
            "nombre" => !empty($campos['nombre']) ? $campos['nombre'] : null,
            "direccion" => !empty($campos['direccion']) ? $campos['direccion'] : null,
            "sexo" => !empty($campos['sexo']) ? $campos['sexo'] : null,
            "noTelefono" => !empty($campos['noTelefono']) ? $campos['noTelefono'] : null,
            "ingresosAnuales" => !empty($campos['ingresosAnuales']) ? $campos['ingresosAnuales'] : null
        );
        
        $clienteModel = new ClientesModel();
        $clienteModel::actualizarCliente($datos);
    }

    public function eliminarClientePorID($idCliente){
        // Crear instancia del modelo de clientes
        $clienteModel = new ClientesModel();
        
        // Intentar eliminar el cliente
        $response = $clienteModel::eliminarClientePorID($idCliente);
    
        // Comprobamos si la eliminación fue exitosa
        if ($response === false) { // Cambié a 'false', asumiendo que el modelo devuelve false si no se encuentra el cliente
            // Cliente no encontrado
            $json = array(
                "status" => 404,
                "detalle" => "No existe el cliente con el ID: $idCliente"
            );
            echo json_encode($json, true);
            return;
        } else {
            // Cliente eliminado correctamente
            $json = array(
                "status" => 200,
                "detalle" => "Cliente con ID: $idCliente ha sido eliminado correctamente"
            );
            echo json_encode($json, true);
            return;
        }
    }
    
}
