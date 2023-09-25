/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*******************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/forms/password-meter.js ***!
  \*******************************************************************************/


// Class definition
var KTGeneralPasswordMeterDemos = function () {
  // Private functions
  var _showScore = function _showScore() {
    // Select show score button
    var showScoreButton = document.getElementById('kt_password_meter_example_show_score');

    // Get password meter instance
    var passwordMeterElement = document.querySelector("#kt_password_meter_example");
    var passwordMeter = KTPasswordMeter.getInstance(passwordMeterElement);

    // Handle show score button click
    showScoreButton.addEventListener('click', function (e) {
      // Get password score
      var score = passwordMeter.getScore();

      // Show popup confirmation 
      Swal.fire({
        text: "Current Password Score: " + score,
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
          confirmButton: "btn btn-primary"
        }
      });
    });
  };
  return {
    // Public Functions
    init: function init() {
      _showScore();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTGeneralPasswordMeterDemos.init();
});
/******/ })()
;