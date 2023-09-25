/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!******************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/quill/basic.js ***!
  \******************************************************************************/


// Class definition
var KTFormsQuillBasic = function () {
  // Private functions
  var exampleBasic = function exampleBasic() {
    var quill = new Quill('#kt_docs_quill_basic', {
      modules: {
        toolbar: [[{
          header: [1, 2, false]
        }], ['bold', 'italic', 'underline'], ['image', 'code-block']]
      },
      placeholder: 'Type your text here...',
      theme: 'snow' // or 'bubble'
    });
  };

  return {
    // Public Functions
    init: function init() {
      exampleBasic();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTFormsQuillBasic.init();
});
/******/ })()
;