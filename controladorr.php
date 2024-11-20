<?php
// Iniciar sesión
session_start();


include "moedelo/conexion.php";

// Verificar si el formulario fue enviado
if (isset($_POST["inciarsesion"])) {

    //varifico si los campos no estan vacios
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        //obtego los datos del formulrio
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["password"];

        //utilize consulta con prepared para evita una inyeccioon sql
        $stmt = $conector->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contraseña = ?");
        $stmt->bind_param("ss", $usuario, $contraseña);  // "ss" indica que ambos parámetros son strings

        //ejecuto la consulta
        $stmt->execute();

        //obtengo el resultado
        $result = $stmt->get_result();

        //varifico si se encontro los resultados
        if ($result->num_rows > 0) {
            //obtengo los datos del usuario
            $usuario_dato = $result->fetch_object();

            //almacno informacion del usuario
            $_SESSION["usuario"] = $usuario_dato->usuario;
            $_SESSION["id"] = $usuario_dato->id; 

            //redirijo a la pgina de juego
            header("Location: juego.php");
            exit();//aca me estoy asgyrando de que no se redireje mas 
        } else {
            
            echo "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
        }

        //aque ciero la declaracion
        $stmt->close();

    } else {
        // Si los campos están vacíos
        echo "<div class='alert alert-warning'>Por favor, ingrese el usuario y la contraseña.</div>";
    }
}

if (isset($_POST["registrarse"])) {
    if (!empty($_POST["id"]) && !empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $id = $_POST["id"];
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["password"];

        // Verificar si el usuario ya existe
        $stmt = $conector->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            //agurame de que me bote una alerte si el usuario ya existe
            echo "<div class='alert alert-danger'>El nombre de usuario ya está registrado.</div>";
        } else {
            //si el usuario no existe registrar nuevo
            $stmt = $conector->prepare("INSERT INTO usuarios (id, usuario, contraseña) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $id, $usuario, $contraseña);
            if ($stmt->execute()) {
                //aca me redirejiendo cuando se registre al incio  de sesion
                echo "<div class='alert alert-success'>¡Cuenta creada con éxito! Ahora puedes iniciar sesión.</div>";
                echo "<script>setTimeout(function(){ window.location.href = 'formulario.php'; }, 3000);</script>";
            } else {
                echo "<div class='alert alert-danger'>Hubo un error al registrar el usuario.</div>";
            }
            $stmt->close();
        }
    } else {
        //si algun campo esta vacio
        echo "<div class='alert alert-warning'>Por favor, complete todos los campos.</div>";
    }
}

?>


