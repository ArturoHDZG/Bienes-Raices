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
      value = parseFloat(value) / 100;
      value = value.toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 });
      priceInput.value = value;
    }
  });
}
