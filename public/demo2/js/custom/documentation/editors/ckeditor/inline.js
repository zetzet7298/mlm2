/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/ckeditor/inline.js ***!
  \**********************************************************************************/


// Class definition
var KTFormsCKEditorInline = function () {
  // Private functions
  var exampleInline = function exampleInline() {
    InlineEditor.create(document.querySelector('#kt_docs_ckeditor_inline')).then(function (editor) {
      console.log(editor);
    })["catch"](function (error) {
      console.error(error);
    });
  };
  return {
    // Public Functions
    init: function init() {
      exampleInline();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTFormsCKEditorInline.init();
});
/******/ })()
;