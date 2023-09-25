/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/tinymce/hidden.js ***!
  \*********************************************************************************/


// Class definition
var KTFormsTinyMCEHidden = function () {
  // Private functions
  var exampleHidden = function exampleHidden() {
    tinymce.init({
      selector: '#kt_docs_tinymce_hidden',
      menubar: false,
      toolbar: ['styleselect fontselect fontsizeselect', 'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify', 'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
      plugins: 'advlist autolink link image lists charmap print preview code'
    });
  };
  return {
    // Public Functions
    init: function init() {
      exampleHidden();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTFormsTinyMCEHidden.init();
});
/******/ })()
;