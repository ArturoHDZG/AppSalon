'use strict';

function searchByDate() {
  const dateInput = document.querySelector('#date');

  dateInput.addEventListener('input', function (e) {
    const selectedDate = e.target.value;

    window.location = `?date=${selectedDate}`;
  });
}

function startApp() {
  searchByDate();
}

document.addEventListener('DOMContentLoaded', function () {
  startApp();
});
