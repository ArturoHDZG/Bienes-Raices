'use strict';

document.addEventListener('DOMContentLoaded', function () {
  responsiveMenu();
  darkMode();
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
