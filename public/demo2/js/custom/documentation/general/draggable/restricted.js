/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***************************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/general/draggable/restricted.js ***!
  \***************************************************************************************/


// Class definition
var KTDraggableRestricted = function () {
  // Private functions
  var exampleRestricted = function exampleRestricted() {
    var containers = document.querySelectorAll('.draggable-zone');
    var restrcitedWrapper = document.querySelector('[data-kt-draggable-level="restricted"]');
    if (containers.length === 0) {
      return false;
    }
    var droppable = new Droppable["default"](containers, {
      draggable: '.draggable',
      dropzone: '.draggable-zone',
      handle: '.draggable .draggable-handle',
      mirror: {
        //appendTo: selector,
        appendTo: 'body',
        constrainDimensions: true
      }
    });

    // Define draggable element variable for permissions level
    var droppableOrigin;

    // Handle drag start event -- more info: https://shopify.github.io/draggable/docs/class/src/Draggable/DragEvent/DragEvent.js~DragEvent.html
    droppable.on('drag:start', function (e) {
      droppableOrigin = e.originalSource.getAttribute('data-kt-draggable-level');
    });

    // Handle drag over event -- more info: https://shopify.github.io/draggable/docs/class/src/Draggable/DragEvent/DragEvent.js~DragOverEvent.html
    droppable.on('drag:over', function (e) {
      var isRestricted = e.overContainer.closest('[data-kt-draggable-level="restricted"]');
      if (isRestricted) {
        if (droppableOrigin !== 'admin') {
          restrcitedWrapper.classList.add('bg-light-danger');
        } else {
          restrcitedWrapper.classList.remove('bg-light-danger');
        }
      } else {
        restrcitedWrapper.classList.remove('bg-light-danger');
      }
    });

    // Handle drag stop event -- more info: https://shopify.github.io/draggable/docs/class/src/Draggable/DragEvent/DragEvent.js~DragStopEvent.html
    droppable.on('drag:stop', function (e) {
      // remove all draggable occupied limit
      containers.forEach(function (c) {
        c.classList.remove('draggable-dropzone--occupied');
      });

      // Remove restricted alert
      restrcitedWrapper.classList.remove('bg-light-danger');
    });

    // Handle drop event -- https://shopify.github.io/draggable/docs/class/src/Droppable/DroppableEvent/DroppableEvent.js~DroppableDroppedEvent.html
    droppable.on('droppable:dropped', function (e) {
      var isRestricted = e.dropzone.closest('[data-kt-draggable-level="restricted"]');
      // Detect if drop container is restricted
      if (isRestricted) {
        // Check if dragged element has permission level
        if (droppableOrigin !== 'admin') {
          restrcitedWrapper.classList.add('bg-light-danger');
          e.cancel();
        }
      }
    });
  };
  return {
    // Public Functions
    init: function init() {
      exampleRestricted();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTDraggableRestricted.init();
});
/******/ })()
;