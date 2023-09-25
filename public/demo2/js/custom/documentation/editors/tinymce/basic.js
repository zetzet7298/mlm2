/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/tinymce/basic.js ***!
  \********************************************************************************/


// Class definition
var KTFormsTinyMCEBasic = function () {
  // Private functions
  var exampleBasic = function exampleBasic() {
    var options = {
      selector: '#kt_docs_tinymce_basic'
    };
    if (KTApp.isDarkMode()) {
      options['skin'] = 'oxide-dark';
      options['content_css'] = 'dark';
    }
    tinymce.init(options);
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
  KTFormsTinyMCEBasic.init();
});
/******/ })()
;