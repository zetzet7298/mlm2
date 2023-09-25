/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/ckeditor/classic.js ***!
  \***********************************************************************************/


// Class definition
var KTFormsCKEditorClassic = function () {
  // Private functions
  var exampleClassic = function exampleClassic() {
    ClassicEditor.create(document.querySelector('#kt_docs_ckeditor_classic')).then(function (editor) {
      console.log(editor);
    })["catch"](function (error) {
      console.error(error);
    });
  };
  return {
    // Public Functions
    init: function init() {
      exampleClassic();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTFormsCKEditorClassic.init();
});
/******/ })()
;