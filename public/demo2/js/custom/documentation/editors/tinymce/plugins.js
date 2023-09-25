/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/tinymce/plugins.js ***!
  \**********************************************************************************/


// Class definition
var KTFormsTinyMCEPlugins = function () {
  // Private functions
  var examplePlugins = function examplePlugins() {
    tinymce.init({
      selector: '#kt_docs_tinymce_plugins',
      toolbar: 'advlist | autolink | link image | lists charmap | print preview',
      plugins: 'advlist autolink link image lists charmap print preview'
    });
  };
  return {
    // Public Functions
    init: function init() {
      examplePlugins();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTFormsTinyMCEPlugins.init();
});
/******/ })()
;