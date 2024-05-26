const estudianteRadio = document.getElementById('estudiante');
const restauranteRadio = document.getElementById('restaurante');
const estudianteDiv = document.querySelector('.user.est');
const restauranteDiv = document.querySelector('.user.rest');

estudianteRadio.addEventListener('change', () => {
    if (estudianteRadio.checked) {
        estudianteDiv.classList.add('checked');
        restauranteDiv.classList.remove('checked');
    }
});

restauranteRadio.addEventListener('change', () => {
    if (restauranteRadio.checked) {
        restauranteDiv.classList.add('checked');
        estudianteDiv.classList.remove('checked');
    }
});