/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/general/stepper.js ***!
  \**************************************************************************/


// Class definition
var KTGeneralStepperDemos = function () {
  // Private functions
  var _exampleBasic = function _exampleBasic() {
    // Stepper lement
    var element = document.querySelector("#kt_stepper_example_basic");

    // Initialize Stepper
    var stepper = new KTStepper(element);

    // Handle next step
    stepper.on("kt.stepper.next", function (stepper) {
      stepper.goNext(); // go next step
    });

    // Handle previous step
    stepper.on("kt.stepper.previous", function (stepper) {
      stepper.goPrevious(); // go previous step
    });
  };

  var _exampleVertical = function _exampleVertical() {
    // Stepper lement
    var element = document.querySelector("#kt_stepper_example_vertical");

    // Initialize Stepper
    var stepper = new KTStepper(element);

    // Handle next step
    stepper.on("kt.stepper.next", function (stepper) {
      stepper.goNext(); // go next step
    });

    // Handle previous step
    stepper.on("kt.stepper.previous", function (stepper) {
      stepper.goPrevious(); // go previous step
    });
  };

  var _exampleClickable = function _exampleClickable() {
    // Stepper lement
    var element = document.querySelector("#kt_stepper_example_clickable");

    // Initialize Stepper
    var stepper = new KTStepper(element);

    // Handle navigation click
    stepper.on("kt.stepper.click", function (stepper) {
      stepper.goTo(stepper.getClickedStepIndex()); // go to clicked step
    });
  };

  return {
    // Public Functions
    init: function init() {
      _exampleBasic();
      _exampleVertical();
      _exampleClickable();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTGeneralStepperDemos.init();
});
/******/ })()
;