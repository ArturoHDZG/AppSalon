'use strict';

//* Global Variables

let step = 1;
const initialStep = 1;
const finalStep = 3;

const reservation = {
  id : '',
  name: '',
  date: '',
  time: '',
  services: []
}

//* Reservations View

function showSection() {
  // Hide Previous Selected Section
  const lastSection = document.querySelector('.show')

  if (lastSection) {
    lastSection.classList.remove('show');
  }

  // Select Section from Step
  const selectorStep = `#step-${step}`;
  const section = document.querySelector(selectorStep);

  section.classList.add('show');

  // Un-highlight Previous Selected Section
  const lastTab = document.querySelector('.current');

  if (lastTab) {
    lastTab.classList.remove('current');
  }

  // Highlight Selected Section
  const tab = document.querySelector(`[data-step="${step}"]`);

  tab.classList.add('current');
}

function buttonsPagination() {
  const backPage = document.querySelector('#back');
  const nextPage = document.querySelector('#next');

  if (step === 1) {
    backPage.classList.add('hide');
    nextPage.classList.remove('hide');
  } else if (step === 3) {
    backPage.classList.remove('hide');
    nextPage.classList.add('hide');
    showSummary();
  } else {
    backPage.classList.remove('hide');
    nextPage.classList.remove('hide');
  }

  showSection();
}

function buttonBack() {
  const backSection = document.querySelector('#back');

  backSection.addEventListener('click', function () {
    if (step <= initialStep) return;
    step--;

    buttonsPagination();
  });
}

function buttonNext() {
  const nextSection = document.querySelector('#next');

  nextSection.addEventListener('click', function () {
    if (step >= finalStep) return;
    step++;

    buttonsPagination();
  });
}

function tabs() {
  const buttons = document.querySelectorAll('.tabs button');

  buttons.forEach(button => {
    button.addEventListener('click', function (e) {
      step = parseInt(e.target.dataset.step);

      // Call Dynamic Functions
      showSection();
      buttonsPagination();
    });
  });
}

//* Step 1: Services

async function apiQuery() {
  try {
    const url = '/api/services';
    const result = await fetch(url);
    const services = await result.json();
    showServices(services);
  } catch (error) {
    console.error(error);
  }
}

function showServices(services) {
  services.forEach(service => {
    const { id, name, price } = service;

    const serviceName = document.createElement('P');
    serviceName.classList.add('service-name');
    serviceName.textContent = name;

    const servicePrice = document.createElement('P');
    servicePrice.classList.add('service-price');
    servicePrice.textContent = `$${price}`;

    const serviceDiv = document.createElement('DIV');
    serviceDiv.classList.add('service');
    serviceDiv.dataset.serviceId = id;
    serviceDiv.onclick = function () {
      selectServices(service);
    }

    serviceDiv.appendChild(serviceName);
    serviceDiv.appendChild(servicePrice);

    document.querySelector('#services').appendChild(serviceDiv);
  });
}

function selectServices(service) {
  const { id } = service;
  const { services } = reservation;
  const serviceId = document.querySelector(`[data-service-id='${id}']`);

  // Check if Service is Already Selected
  if (services.some(selected => selected.id === id)) {
    // Unselect Service
    reservation.services = services.filter(selected => selected.id !== id);
    serviceId.classList.remove('selected');
  } else {
    // Select Service
    reservation.services = [ ...services, service ];
    serviceId.classList.add('selected');
  }
}

//* Step 2: Reservation Form

function clientId() {
  reservation.id = document.querySelector('#id').value;
}

function clientName() {
  reservation.name = document.querySelector('#name').value;
}

function selectDate() {
  const inputDate = document.querySelector('#date');

  inputDate.addEventListener('input', function (e) {
    const day = new Date(e.target.value).getUTCDay();

    if ([ 6, 0 ].includes(day)) {
      e.target.value = '';
      showAlert('error', 'Saturday and Sunday are not available', '.form');
    } else {
      reservation.date = e.target.value;
    }
  });
}

function selectTime() {
  const inputTime = document.querySelector('#time');

  inputTime.addEventListener('input', function (e) {
    const timeReservation = e.target.value;
    const time = timeReservation.split(':')[ 0 ];

    if (time < 10 || time > 18) {
      e.target.value = '';
      showAlert('error', 'Our Hours are from 10 a.m. to 6 p.m.', '.form');
    } else {
      reservation.time = e.target.value;
    }
  });
}

//* Step 3: Summary Information

function showSummary() {
  const summary = document.querySelector('.content-summary');

  // Clear Previous Data
  while (summary.firstChild) {
    summary.removeChild(summary.firstChild);
  }

  if (Object.values(reservation).includes('') || reservation.services.length === 0) {
    showAlert('error', 'Please Complete all the reservation information', '.content-summary', false);
    return;
  }

  // Scripting Summary
  const { name, date, time, services } = reservation;

  // Show Service Heading
  const headingServices = document.createElement('H3');
  headingServices.textContent = 'Summary Services';
  summary.appendChild(headingServices);

  // Show Selected Services
  services.forEach(service => {
    const { name, price } = service;

    const containerService = document.createElement('DIV');
    containerService.classList.add('service-container');

    const nameService = document.createElement('P');
    nameService.textContent = name;

    const priceService = document.createElement('P');
    priceService.innerHTML = `<span>Price:</span> $${price}`;

    containerService.appendChild(nameService);
    containerService.appendChild(priceService);

    summary.appendChild(containerService);
  });

  // Show Reservation Heading
  const headingReservation = document.createElement('H3');
  headingReservation.textContent = 'Reservation Details';
  summary.appendChild(headingReservation);

  // Show Reservation Details
  const clientName = document.createElement('P');
  clientName.innerHTML = `<span>Name:</span> ${name}`;
  summary.appendChild(clientName);

  // Format Date
  const dateObject = new Date(date);
  const month = dateObject.getMonth();
  const day = dateObject.getDate() + 2;
  const year = dateObject.getFullYear();

  const dateUTC = new Date(Date.UTC(year, month, day));
  const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  const formatDate = dateUTC.toLocaleDateString('en-US', dateOptions);

  const dateReservation = document.createElement('P');
  dateReservation.innerHTML = `<span>Date:</span> ${formatDate}`;
  summary.appendChild(dateReservation);

  const timeReservation = document.createElement('P');
  timeReservation.innerHTML = `<span>Time:</span> ${time} hours`;
  summary.appendChild(timeReservation);

  // Button to Make a Reservation
  const buttonReservation = document.createElement('BUTTON');
  buttonReservation.classList.add('button');
  buttonReservation.textContent = 'Make Reservation';
  buttonReservation.onclick = makeReservation;
  summary.appendChild(buttonReservation);
}

async function makeReservation() {
  const { id, date, time, services } = reservation;
  const idServices = services.map(service => service.id);

  const data = new FormData();
  data.append('date', date);
  data.append('time', time);
  data.append('usersId', id);
  data.append('services', idServices);

  try {
    const url = '/api/reservations';

    const answer = await fetch(url, {
      method: 'POST',
      body: data
    });

    const result = await answer.json();

    if (result.result) {
      Swal.fire({
        icon: 'success',
        title: 'Confirmed Reservation',
        text: 'Thank you for choosing our services!',
        button: 'OK'
      }).then(() => {
        window.location.reload();
      });
    }
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Reservation Failed',
      text: 'There was an error, please try again',
    });
  }


}

function showAlert(type, message, property, remove = true) {
  // Prevents more than one Alert
  const previousAlert = document.querySelector('.alert');
  if (previousAlert) {
    previousAlert.remove();
  }

  // Scripting Alert
  const alert = document.createElement('DIV');
  alert.classList.add('alert');
  alert.classList.add(type);
  alert.textContent = message;

  const reference = document.querySelector(property);
  reference.appendChild(alert);

  // 4 Seconds to Remove Alert Message
  if (remove) {
    setTimeout(() => {
      alert.remove();
    }, 4000);
  }
}

function startApp() {
  buttonsPagination();  // Add/Remove Pagination Buttons
  showSection();        // Show/Hide Selected Section
  buttonBack();         // Use Button to Navigate to Back Page
  buttonNext();         // Use Button to Navigate to Next Page
  tabs();               // Change Selected Section Function
  apiQuery();           // Show Services
  clientId();           // Saves Client's ID in Reservation
  clientName();         // Saves Client's Name in Reservation
  selectDate();         // Saves Selected Date in Reservation
  selectTime();         // Saves Selected Time in Reservation
  showSummary();        // Show Reservation Summary
}

document.addEventListener('DOMContentLoaded', function () {
  startApp();
});
