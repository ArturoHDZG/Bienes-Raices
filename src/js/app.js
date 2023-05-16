'use strict';

//* Responsive navigation
function responsiveMenu() {
  const mobileMenu = document.querySelector('.header-mobile-menu');

  mobileMenu.addEventListener('click', function () {
    const navigation = document.querySelector('.navigation');
    navigation.classList.toggle('header-show-navigation');
  });
}

//* Dark Mode
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

//* Format currencies input
function formatCurrencyInput() {
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
}

//* Character counter for description form
function descriptionCounter() {
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
}

//* Admin index select-type query
function adminIndexSelectTypeQuery() {
  const selectElement = document.querySelector('.type-admin');
  if (selectElement) {
    selectElement.addEventListener('change', () => {
      selectElement.form.submit();
    });
  }
}

//* Update cantons list from management
function initCantonSelect() {
  const provinceSelect = document.querySelector('#province');
  const cantonSelect = document.querySelector('#canton');

  if (provinceSelect) {
    const selectedProvinceId = provinceSelect.value;

    fetch(`get_cantons.php?province_id=${selectedProvinceId}`)
      .then(response => response.json())
      .then(data => {
        updateCantonSelect(data, cantonSelect);
        if (cantonValue && cantonSelect.querySelector(`option[value="${cantonValue}"]`)) {
          cantonSelect.value = cantonValue;
        }
      });

    provinceSelect.addEventListener('change', () => {
      const selectedProvinceId = provinceSelect.value;

      fetch(`get_cantons.php?province_id=${selectedProvinceId}`)
        .then(response => response.json())
        .then(data => {
          updateCantonSelect(data, cantonSelect);
        });
    });
  }
}

// Updates the canton select element with the given data
function updateCantonSelect(data, cantonSelect) {
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

//* Initializes the image upload functionality by adding an event listener to the file input and creating thumbnails for the selected image files
function initImageUpload() {
  const input = document.querySelector('#images');
  const container = document.querySelector('.thumbnails-container');
  const maxImages = 10;
  const counterElement = document.querySelector('#image-counter');

  if (input) {
    updateImageCounter(container, counterElement, maxImages);
    input.addEventListener('change', (event) => {
      const files = event.target.files;
      updateImageCounter(container, counterElement, maxImages, files.length);
      createThumbnails(files, container);
    });
  }
}

// Updates the image counter with the current number of images
function updateImageCounter(container, counterElement, maxImages, additionalImages = 0) {
  const numImages = container.querySelectorAll('img').length + additionalImages;
  counterElement.textContent = `${numImages} / ${maxImages}`;
  if (numImages > maxImages) {
    counterElement.style.color = 'red';
  } else {
    counterElement.style.color = 'green';
  }
}

// Creates thumbnails for the selected image files
function createThumbnails(files, container) {
  for (const file of files) {
    const div = createThumbnailDiv();
    const img = createThumbnailImg(file);
    div.appendChild(img);
    const span = createThumbnailSpan(div);
    div.appendChild(span);
    container.appendChild(div);
    readImageFile(file, img);
  }
}

// Creates a new thumbnail div element
function createThumbnailDiv() {
  const div = document.createElement('div');
  div.classList.add('thumbnail');
  return div;
}

// Creates a new thumbnail img element for the given file
function createThumbnailImg(file) {
  const img = document.createElement('img');
  img.classList.add('thumb');
  img.file = file;
  return img;
}

// Creates a new thumbnail span element for deleting the thumbnail
function createThumbnailSpan(div) {
  const span = document.createElement('span');
  span.classList.add('delete');
  span.textContent = 'x';
  span.addEventListener('click', function () {
    div.remove();
    updateImageCounter(container, counterElement, maxImages);
  });
  return span;
}

// Reads the given image file and sets the img element's src to the file's data
function readImageFile(file, img) {
  const reader = new FileReader();
  reader.onload = (function (aImg) {
    return function (e) {
      aImg.src = e.target.result;
    };
  })(img);
  reader.readAsDataURL(file);
}

//* Delete preload images from server
function initDeleteEvents() {
  const container = document.querySelector('.thumbnails-container');

  if (!container) {
    return;
  }

  const counterElement = document.querySelector('#image-counter');
  const maxImages = 10;
  const deleteElements = container.querySelectorAll('.delete');

  deleteElements.forEach(span => {

    span.addEventListener('click', function () {
      span.parentElement.remove();
      const numImages = container.querySelectorAll('img').length;
      counterElement.textContent = `${numImages} / ${maxImages}`;

      if (numImages > maxImages) {
        counterElement.style.color = 'red';
      } else {
        counterElement.style.color = 'green';
      }

      const imageName = span.previousElementSibling.src.split('/').pop();
      const input = document.querySelector('#imagesToDelete');
      input.value += `${imageName},`;
    });
  });
}

//* Gallery for add images
function initImageGallery() {
  const mainImage = document.querySelector('#main-image');
  const thumbnails = document.querySelectorAll('.thumbnail');

  if (mainImage && thumbnails.length > 0) {
    thumbnails.forEach(thumbnail => {
      thumbnail.addEventListener('click', () => {
        mainImage.src = thumbnail.src;
      });
    });
  }
}

//* DOMContentLoaded controller
document.addEventListener('DOMContentLoaded', function () {
  responsiveMenu();
  darkMode();
  formatCurrencyInput();
  descriptionCounter();
  adminIndexSelectTypeQuery();
  initCantonSelect();
  initImageUpload();
  initDeleteEvents();
  initImageGallery();
});
