'use strict';

document.addEventListener('DOMContentLoaded', function () {
  responsiveMenu();
  darkMode();
  initImageUpload();
  initDeleteEvents();
})

// Responsive navigation
function responsiveMenu() {
  const mobileMenu = document.querySelector('.header-mobile-menu');

  mobileMenu.addEventListener('click', function () {
    const navigation = document.querySelector('.navigation');
    navigation.classList.toggle('header-show-navigation');
  });
}

// Dark Mode
function darkMode() {
  const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

  // Get color scheme from localStorage
  if (localStorage.getItem('color-mode') === 'true') {
    document.body.classList.add('dark-mode');
  } else if (localStorage.getItem('color-mode') === 'false') {
    document.body.classList.remove('dark-mode');
  } else {
    // Reads user preferences
    if (preferDarkMode.matches) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  }

  // Listening for user preference changes
  preferDarkMode.addEventListener('change', function () {
    if (preferDarkMode.matches) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  });

  // Dark Mode button
  const btnDarkMode = document.querySelector('.btn-darkmode');

  btnDarkMode.addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');

    // Save manual preferences
    if (document.body.classList.contains('dark-mode')) {
      localStorage.setItem('color-mode', 'true');
    } else {
      localStorage.setItem('color-mode', 'false');
    }
  });
}

// Format currencies input
const priceInput = document.querySelector('#price');
if (priceInput) {
  priceInput.addEventListener('blur', () => {
    let value = priceInput.value;
    value = value.replace(/,/g, '');
    if (value && !isNaN(value)) {
      value = parseFloat(value);
      value = value.toLocaleString('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 });
      priceInput.value = value;
    }
  });
}

// Character counter for description form
const description = document.querySelector('#description');
if (description) {
  const counter = document.createElement('div');
  counter.classList.add('counter');
  counter.textContent = '0/50';
  description.parentNode.insertBefore(counter, description.nextSibling);

  // Actualizar contador al cargar la página
  const length = description.value.length;
  counter.textContent = `${length}/50`;
  if (length >= 50) {
    counter.style.color = 'green';
  } else {
    counter.style.color = '';
  }

  description.addEventListener('input', () => {
    const length = description.value.length;
    counter.textContent = `${length}/50`;
    if (length >= 50) {
      counter.style.color = 'green';
    } else {
      counter.style.color = '';
    }
  });
}

// Admin index select-type query
const selectElement = document.querySelector('.type-admin');
if (selectElement) {
  selectElement.addEventListener('change', () => {
    selectElement.form.submit();
  });
}

// Update cantons list from management
const provinceSelect = document.querySelector('#province');
const cantonSelect = document.querySelector('#canton');

function updateCantonSelect(data) {
  cantonSelect.innerHTML = '';

  const defaultOption = document.createElement('option');
  defaultOption.value = '0';
  defaultOption.disabled = true;
  defaultOption.selected = true;
  defaultOption.textContent = '-- Seleccionar --';
  cantonSelect.appendChild(defaultOption);

  data.forEach(canton => {
    const option = document.createElement('option');
    option.value = canton.id;
    option.textContent = canton.canton;
    cantonSelect.appendChild(option);
  });
}

if (provinceSelect) {
  document.addEventListener('DOMContentLoaded', () => {
    const selectedProvinceId = provinceSelect.value;

    fetch('get_cantons.php?province_id=' + selectedProvinceId)
      .then(response => response.json())
      .then(data => {
        updateCantonSelect(data);
        if (cantonValue && cantonSelect.querySelector(`option[value="${cantonValue}"]`)) {
          cantonSelect.value = cantonValue;
        }
      });

    provinceSelect.addEventListener('change', () => {
      const selectedProvinceId = provinceSelect.value;

      fetch('get_cantons.php?province_id=' + selectedProvinceId)
        .then(response => response.json())
        .then(data => {
          updateCantonSelect(data);
        });
    });
  });
}

function initImageUpload() {
  // Obtener referencia al input de tipo file
  const input = document.querySelector('#images');
  // Verificar si el input existe en la página
  if (input) {
    // Obtener referencia al contenedor de miniaturas
    const container = document.querySelector('.thumbnails-container');
    // Definir número máximo de imágenes permitidas
    const maxImages = 10;
    // Obtener referencia al elemento del contador de imágenes
    const counterElement = document.querySelector('#image-counter');
    // Inicializar contenido del contador
    counterElement.textContent = `0 / ${maxImages}`;
    // Contar cuántas imágenes están guardadas en la base de datos
    const numImages = container.querySelectorAll('img').length;
    // Actualizar contador
    counterElement.textContent = `${numImages} / ${maxImages}`;
    if (numImages > maxImages) {
      counterElement.style.color = 'red';
    } else {
      counterElement.style.color = 'green';
    }

    // Escuchar cambios en el input
    input.addEventListener('change', (event) => {
      // Obtener lista de archivos seleccionados
      const files = event.target.files;
      // Contar cuántas imágenes están guardadas en la base de datos
      const numImages = container.querySelectorAll('img').length;
      // Actualizar contador
      counterElement.textContent = `${numImages + files.length} / ${maxImages}`;
      if (numImages + files.length > maxImages) {
        counterElement.style.color = 'red';
      } else {
        counterElement.style.color = 'green';
      }

      // Crear un elemento img para cada archivo seleccionado
      for (const file of files) {
        // Crear elemento div
        const div = document.createElement('div');
        div.classList.add('thumbnail');
        // Crear elemento img
        const img = document.createElement('img');
        img.classList.add('thumb');
        img.file = file;
        // Agregar elemento img al div
        div.appendChild(img);

        // Crear elemento span
        const span = document.createElement('span');
        span.classList.add('delete');
        span.textContent = 'x';

        // Agregar evento click al elemento span
        span.addEventListener('click', function () {
          // Eliminar miniatura
          div.remove();

          // Actualizar contador de imágenes
          const numImages = container.querySelectorAll('img').length;
          counterElement.textContent = `${numImages} / ${maxImages}`;
          if (numImages > maxImages) {
            counterElement.style.color = 'red';
          } else {
            counterElement.style.color = 'green';
          }
        });

        // Agregar elemento span al div
        div.appendChild(span);

        // Agregar elemento div al contenedor de miniaturas
        container.appendChild(div);

        // Leer contenido del archivo y asignarlo como src del elemento img
        const reader = new FileReader();
        reader.onload = (function (aImg) { return function (e) { aImg.src = e.target.result; }; })(img);
        reader.readAsDataURL(file);
      }
    });
  }
}

// Delete preload images from server
function initDeleteEvents() {
  // Obtener referencia al contenedor de miniaturas
  const container = document.querySelector('.thumbnails-container');
  // Obtener referencia al elemento del contador de imágenes
  const counterElement = document.querySelector('#image-counter');
  // Definir número máximo de imágenes permitidas
  const maxImages = 10;
  // Obtener todos los elementos span con clase delete
  const deleteElements = container.querySelectorAll('.delete');
  // Agregar evento click a cada elemento span
  deleteElements.forEach(span => {
    span.addEventListener('click', function () {
      // Eliminar miniatura
      span.parentElement.remove();
      // Actualizar contador de imágenes
      const numImages = container.querySelectorAll('img').length;
      counterElement.textContent = `${numImages} / ${maxImages}`;
      if (numImages > maxImages) {
        counterElement.style.color = 'red';
      } else {
        counterElement.style.color = 'green';
      }
      // Obtener nombre de la imagen a eliminar
      const imageName = span.previousElementSibling.src.split('/').pop();
      // Obtener referencia al campo oculto
      const input = document.querySelector('#imagesToDelete');
      // Agregar nombre de la imagen al campo oculto
      input.value += `${imageName},`;
    });
  });
}
