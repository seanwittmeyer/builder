import 'summernote';
import 'selectize';
import 'typeahead.js';
import 'pagemap';
window.pagemap = require('pagemap');
console.log('pagemap not initialized');
import Zooming from 'zooming';
document.addEventListener('DOMContentLoaded', function() {
	const zooming = new Zooming({
		// options...
	});

	zooming.listen('.body img');
});

console.log('builder ui assets loaded, dom instances not initialized');
import 'bootstrap-fileinput/css/fileinput.css';
import 'bootstrap-fileinput/js/plugins/piexif.min.js';
import 'bootstrap-fileinput/js/plugins/sortable.min.js';
import 'bootstrap-fileinput/js/plugins/purify.min.js';
//import 'bootstrap-fileinput/themes/fa/theme.js';
