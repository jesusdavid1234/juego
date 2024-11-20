class Jugador {
    constructor(nombre) {
        this.nombre = nombre; 
        this.eleccion = null;  
        this.imagen = '';      
    }

    //metodo para asignar la elección y la imagen
    elegir(opcion) { 
        this.eleccion = opcion;
        this.imagen = `img/${opcion}.png`; 
    }
}

class Juego {
    constructor() {
        this.opciones = ['piedra', 'papel', 'tijera'];//opciones del juego
        this.jugador = new Jugador('jugador'); //instancia del jugador
        this.computadora = new Jugador('computadora'); //instancia de la computadora
    }

    //metodo para elegir aleatoriamente para la computadora
    eleccionComputadora() {
        const eleccionAleatoria = this.opciones[Math.floor(Math.random() * this.opciones.length)];
        this.computadora.elegir(eleccionAleatoria);
    }

    //metodo para determinar el ganador
    ganador() {
        const jugador = this.jugador.eleccion;
        const computadora = this.computadora.eleccion;

        if (jugador === computadora) {
            return 'Empate';
        }

        if (
            (jugador === 'piedra' && computadora === 'tijera') ||
            (jugador === 'papel' && computadora === 'piedra') ||
            (jugador === 'tijera' && computadora === 'papel')
        ) {
            return 'Ganaste';
        } else {
            return 'Perdiste';
        }
    }

    //metodo para ejecutar el juego se pasa la opción del jugador
    ejecutar(opcionJugador) {
        this.jugador.elegir(opcionJugador);//el jugador elige una opción
        this.eleccionComputadora(); //la computadora elige aleatoriamente
        return this.ganador(); //retorna el resultado del juego
    }
}

//instancia del juego
const juego = new Juego();

//función para iniciar el juego cuando el jugador hace una elección
document.getElementById('piedra').addEventListener('click', () => iniciarJuego('piedra'));
document.getElementById('papel').addEventListener('click', () => iniciarJuego('papel'));
document.getElementById('tijera').addEventListener('click', () => iniciarJuego('tijera'));

//funcion que inicia el juego mostrando el resultado
function iniciarJuego(eleccionJugador) {
    const resultado = juego.ejecutar(eleccionJugador); // Ejecutamos el juego
    mostrarResultado(resultado); // Mostramos el resultado
    actualizarElecciones(); // Actualizamos las elecciones de jugador y computadora
}

//funcion para mostrar el resultado
function mostrarResultado(resultado) {
    const resultDiv = document.getElementById('resultado');
    resultDiv.innerHTML = `<p>Resultado: ${resultado}</p>`;
}

//aque me va permitir actualizar las imagenes y elleciones
function actualizarElecciones() {
    //actualizar la ellecion del jugador
    document.getElementById('eleccion-jugador').innerHTML = `<img src="${juego.jugador.imagen}" alt="${juego.jugador.eleccion}">`;
    //actualizar la eleccion de la computadors
    document.getElementById('eleccion-computadora').innerHTML = `<img src="${juego.computadora.imagen}" alt="${juego.computadora.eleccion}">`;
}

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