'use strict';

document.addEventListener('DOMContentLoaded', function () {
  eventlisteners();
  darkMode();
})

// Responsive navigation
function eventlisteners() {
  const mobileMenu = document.querySelector('.header-mobile-menu');

  mobileMenu.addEventListener('click', responsiveNavigation);
}

function responsiveNavigation() {
  const navigation = document.querySelector('.navigation');

  navigation.classList.toggle('header-show-navigation');
}

// Dark Mode
function darkMode() {
  const btnDarkMode = document.querySelector('.btn-darkmode');

  btnDarkMode.addEventListener('click', toggleDarkMode);
}

function toggleDarkMode() {
  document.body.classList.toggle('dark-mode');
}
