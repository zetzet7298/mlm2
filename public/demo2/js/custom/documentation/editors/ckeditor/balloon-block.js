/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*****************************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/editors/ckeditor/balloon-block.js ***!
  \*****************************************************************************************/


// Class definition
var KTFormsCKEditorBalloonBlock = function () {
  // Private functions
  var exampleBalloonBlock = function exampleBalloonBlock() {
    BalloonEditor.create(document.querySelector('#kt_docs_ckeditor_balloon_block')).then(function (editor) {
      console.log(editor);
    })["catch"](function (error) {
      console.error(error);
    });
  };
  return {
    // Public Functions
    init: function init() {
      exampleBalloonBlock();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTFormsCKEditorBalloonBlock.init();
});
/******/ })()
;