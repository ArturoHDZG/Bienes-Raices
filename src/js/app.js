'use strict';

// Responsive navigation
document.addEventListener('DOMContentLoaded', function () {
  eventlisteners();
})

function eventlisteners() {
  const mobileMenu = document.querySelector('.header-mobile-menu');

  mobileMenu.addEventListener('click', responsiveNavigation);
}

function responsiveNavigation() {
  const navigation = document.querySelector('.navigation');

  navigation.classList.toggle('header-show-navigation');
}
