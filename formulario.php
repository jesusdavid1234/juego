<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_inicio</title>
    <link rel="stylesheet" href="stylo.css">
</head>
<body>
<div class="container">
        <!-- Sección de inicio de sesión -->
        <div class="form-container" id="login-form">
           
            <form action="#" method="POST">
                <h2>Iniciar secion</h2>

                <?php
                include "controlador/controladorr.php"
                ?>
            
                <div class="input-group">
                    <label for="">usuario</label>
                    <input id="usuario" type="text" name="usuario" placeholder="Ingresa tu usuario" required>
                </div>
                <div class="input-group">
                    <label for="login-password">Contraseña</label>
                    <input id="login-password" type="password" name="password" placeholder="Ingresa tu contraseña" required>
                </div>
                <button name="inciarsesion" type="submit">Iniciar sesión</button>
                <p class="switch-form">¿No tienes una cuenta? <a href="javascript:void(0);" onclick="toggleForm()">Regístrate aquí</a></p>
            </form>
        </div>
        
        <!-- Sección de registro -->
        <div class="form-container" id="register-form" style="display: none;">
            <h2>Crear cuenta</h2>
            <form action="#" method="POST">
                
                <div class="input-group">
                    <label for="">id</label>
                    <input type="text" name="id" placeholder="id" required>
                    
                    <label for="">usuario</label>
                    <input type="text" name="usuario" placeholder="user" required>
                </div>
                <div class="input-group">
                    <label for="register-password">Contraseña</label>
                    <input type="password" id="register-password" name="password" placeholder="Contraseña" required>
                </div>
                <button name="registrarse" type="submit">Registrarse</button>
                <p class="switch-form">¿Ya tienes una cuenta? <a href="javascript:void(0);" onclick="toggleForm()">Inicia sesión aquí</a></p>
            </form>
        </div>
    </div>

    <script>
        // Función para cambiar entre los formularios de login y registro
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            }
        }
    </script>
</body>
</html>


