//import 'bootstrap/dist/css/bootstrap.css';
import './scss/app.scss';
console.log('app scss build success.');

import $ from 'jquery';
import 'bootstrap';
import 'bootstrap-select';
import 'popper.js';
import 'bootstrap-fileinput';

window.$ = window.jQuery = require('jquery');
window.jQuery = $;
console.log('index.bundle.js successfully loaded jquery as window.$ and window.jquery');

$(function() {
	$('#selectpicker').selectpicker();
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
});
console.log('selectpicker, bootstrap tooltip+popover init success.');
