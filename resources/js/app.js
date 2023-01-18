//Import Bootstrap File
import './bootstrap';

// Import our custom CSS
import '../sass/app.scss'

import './modales';
//import '../../node_modules/jquery/dist/jquery.min.js';

//import jQuery from 'jquery';
//window.$ = jQuery;

import '../../node_modules/sweetalert2/dist/sweetalert2.min.js';


import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()



let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});

