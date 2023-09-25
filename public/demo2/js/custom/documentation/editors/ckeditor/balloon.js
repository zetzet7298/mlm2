/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***********************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/ckeditor/balloon.js ***!
  \***********************************************************************************/


// Class definition
var KTFormsCKEditorBalloon = function () {
  // Private functions
  var exampleBalloon = function exampleBalloon() {
    BalloonEditor.create(document.querySelector('#kt_docs_ckeditor_balloon')).then(function (editor) {
      console.log(editor);
    })["catch"](function (error) {
      console.error(error);
    });
  };
  return {
    // Public Functions
    init: function init() {
      exampleBalloon();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTFormsCKEditorBalloon.init();
});
/******/ })()
;