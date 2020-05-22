import "bootstrap/dist/css/bootstrap.css";
import "./scss/app.scss";

import $ from "jquery";
import "bootstrap";
import "bootstrap-select";
import "popper.js";
import "bootstrap-fileinput";

window.$ = window.jQuery = require("jquery");
window.jQuery = $;

$(function() {
  $("#selectpicker").selectpicker();
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();
});

console.log("main.js loaded without error, maybe.");
