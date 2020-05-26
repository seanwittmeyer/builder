//import 'bootstrap/dist/css/bootstrap.css';
import './scss/app.scss';
require('bootstrap-select/dist/css/bootstrap-select.css');
console.log('app scss build success.');

import $ from 'jquery';
import 'popper.js';
import 'bootstrap';
import 'bootstrap-select';
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

import 'summernote/dist/summernote-bs4';
import 'summernote/dist/summernote-bs4.css';

$('.cas-summernote').summernote({
	toolbar: [
		// [groupName, [list of button]]
		['style', ['style']],
		['simple', ['bold', 'italic', 'underline', 'clear']],
		['para', ['ul', 'ol', 'paragraph']],
		['link', ['linkDialogShow']],
		['code', ['codeview']],
		['fullscreen', ['fullscreen']],
	],
});

console.log('summernote init success.');
