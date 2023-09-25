/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!************************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/ckeditor/document.js ***!
  \************************************************************************************/


// Class definition
var KTFormsCKEditorDocument = function () {
  // Private functions
  var exampleDocument = function exampleDocument() {
    DecoupledEditor.create(document.querySelector('#kt_docs_ckeditor_document')).then(function (editor) {
      var toolbarContainer = document.querySelector('#kt_docs_ckeditor_document_toolbar');
      toolbarContainer.appendChild(editor.ui.view.toolbar.element);
    })["catch"](function (error) {
      console.error(error);
    });
  };
  return {
    // Public Functions
    init: function init() {
      exampleDocument();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTFormsCKEditorDocument.init();
});
/******/ })()
;