"use strict";let step=1;const initialStep=1,finalStep=3,reservation={name:"",date:"",time:"",services:[]};function showSection(){const e=document.querySelector(".show");e&&e.classList.remove("show");const t="#step-"+step;document.querySelector(t).classList.add("show");const n=document.querySelector(".current");n&&n.classList.remove("current");document.querySelector(`[data-step="${step}"]`).classList.add("current")}function buttonsPagination(){const e=document.querySelector("#back"),t=document.querySelector("#next");1===step?(e.classList.add("hide"),t.classList.remove("hide")):3===step?(e.classList.remove("hide"),t.classList.add("hide")):(e.classList.remove("hide"),t.classList.remove("hide")),showSection()}function buttonBack(){document.querySelector("#back").addEventListener("click",(function(){step<=1||(step--,buttonsPagination())}))}function buttonNext(){document.querySelector("#next").addEventListener("click",(function(){step>=3||(step++,buttonsPagination())}))}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){step=parseInt(e.target.dataset.step),showSection(),buttonsPagination()}))})}async function apiQuery(){try{const e="http://localhost:3000/api/services",t=await fetch(e);showServices(await t.json())}catch(e){console.error(e)}}function showServices(e){e.forEach(e=>{const{id:t,name:n,price:s}=e,c=document.createElement("P");c.classList.add("service-name"),c.textContent=n;const o=document.createElement("P");o.classList.add("service-price"),o.textContent="$"+s;const a=document.createElement("DIV");a.classList.add("service"),a.dataset.serviceId=t,a.onclick=function(){selectServices(e)},a.appendChild(c),a.appendChild(o),document.querySelector("#services").appendChild(a)})}function selectServices(e){const{id:t}=e,{services:n}=reservation,s=document.querySelector(`[data-service-id='${t}']`);n.some(e=>e.id===t)?(reservation.services=n.filter(e=>e.id!==t),s.classList.remove("selected")):(reservation.services=[...n,e],s.classList.add("selected")),console.log(reservation)}function clientName(){reservation.name=document.querySelector("#name").value}function selectDate(){document.querySelector("#date").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",showAlert("error","Saturday and Sunday are not available")):reservation.date=e.target.value}))}function showAlert(e,t){if(document.querySelector(".alert"))return;const n=document.createElement("DIV");n.classList.add("alert"),n.classList.add(e),n.textContent=t;document.querySelector(".form").appendChild(n),setTimeout(()=>{n.remove()},3e3)}function startApp(){buttonsPagination(),showSection(),buttonBack(),buttonNext(),tabs(),apiQuery(),clientName(),selectDate()}document.addEventListener("DOMContentLoaded",(function(){startApp()}));