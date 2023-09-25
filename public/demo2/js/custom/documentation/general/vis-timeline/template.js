/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!****************************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/general/vis-timeline/template.js ***!
  \****************************************************************************************/


// Class definition
var KTVisTimelineTemplate = function () {
  // Template data --- handlebars is used as the template for this demo. For more info: https://handlebarsjs.com/
  var data = "<table class=\"score\">\n        <tr>\n            <td colspan=\"3\" class=\"description\">\n                {{ description }}\n            </td>\n        </tr>\n        <tr>\n            <td>{{ player1 }}</td>\n        <th>\n            {{ score1 }} - {{ score2 }}\n        </th>\n            <td>{{ player2 }}</td>\n        </tr>\n        <tr>\n            <td>\n                <img\n                src=\"https://flagpedia.net/data/flags/mini/{{abbr1}}.png\"\n                width=\"31\"\n                height=\"20\"\n                alt=\"{{abbr1}}\"\n                />\n            </td>\n        <th></th>\n            <td>\n                <img\n                src=\"https://flagpedia.net/data/flags/mini/{{abbr2}}.png\"\n                width=\"31\"\n                height=\"20\"\n                alt=\"{{abbr2}}\"\n                />\n            </td>\n        </tr>\n    </table>";

  // Private functions
  var exampleTemplate = function exampleTemplate() {
    // create a handlebars template --- For more info: https://handlebarsjs.com/
    var template = Handlebars.compile(data);

    // DOM element where the Timeline will be attached
    var container = document.getElementById("kt_docs_vistimeline_template");

    // Create a DataSet (allows two way data-binding)
    var items = new vis.DataSet([
    // round of 16
    {
      player1: "Brazil",
      abbr1: "br",
      score1: "1 (3)",
      player2: "Chile",
      abbr2: "cl",
      score2: "1 (2)",
      description: "round of 16",
      start: "2014-06-28T13:00:00"
    }, {
      player1: "Colombia",
      abbr1: "co",
      score1: 2,
      player2: "Uruguay",
      abbr2: "uy",
      score2: 0,
      description: "round of 16",
      start: "2014-06-28T17:00:00"
    }, {
      player1: "Netherlands",
      abbr1: "nl",
      score1: 2,
      player2: "Mexico",
      abbr2: "mx",
      score2: 1,
      description: "round of 16",
      start: "2014-06-29T13:00:00"
    }, {
      player1: "Costa Rica",
      abbr1: "cr",
      score1: "1 (5)",
      player2: "Greece",
      abbr2: "gr",
      score2: "1 (3)",
      description: "round of 16",
      start: "2014-06-29T17:00:00"
    }, {
      player1: "France",
      abbr1: "fr",
      score1: 2,
      player2: "Nigeria",
      abbr2: "ng",
      score2: 0,
      description: "round of 16",
      start: "2014-06-30T13:00:00"
    }, {
      player1: "Germany",
      abbr1: "de",
      score1: 2,
      player2: "Algeria",
      abbr2: "dz",
      score2: 1,
      description: "round of 16",
      start: "2014-06-30T17:00:00"
    }, {
      player1: "Argentina",
      abbr1: "ar",
      score1: 1,
      player2: "Switzerland",
      abbr2: "ch",
      score2: 0,
      description: "round of 16",
      start: "2014-07-01T13:00:00"
    }, {
      player1: "Belgium",
      abbr1: "be",
      score1: 2,
      player2: "USA",
      abbr2: "us",
      score2: 1,
      description: "round of 16",
      start: "2014-07-01T17:00:00"
    },
    // quarter-finals
    {
      player1: "France",
      abbr1: "fr",
      score1: 0,
      player2: "Germany",
      abbr2: "de",
      score2: 1,
      description: "quarter-finals",
      start: "2014-07-04T13:00:00"
    }, {
      player1: "Brazil",
      abbr1: "br",
      score1: 2,
      player2: "Colombia",
      abbr2: "co",
      score2: 1,
      description: "quarter-finals",
      start: "2014-07-04T17:00:00"
    }, {
      player1: "Argentina",
      abbr1: "ar",
      score1: 1,
      player2: "Belgium",
      abbr2: "be",
      score2: 0,
      description: "quarter-finals",
      start: "2014-07-05T13:00:00"
    }, {
      player1: "Netherlands",
      abbr1: "nl",
      score1: "0 (4)",
      player2: "Costa Rica",
      abbr2: "cr",
      score2: "0 (3)",
      description: "quarter-finals",
      start: "2014-07-05T17:00:00"
    },
    // semi-finals
    {
      player1: "Brazil",
      abbr1: "br",
      score1: 1,
      player2: "Germany",
      abbr2: "de",
      score2: 7,
      description: "semi-finals",
      start: "2014-07-08T17:00:00"
    }, {
      player1: "Netherlands",
      abbr1: "nl",
      score1: "0 (2)",
      player2: "Argentina",
      abbr2: "ar",
      score2: "0 (4)",
      description: "semi-finals",
      start: "2014-07-09T17:00:00"
    },
    // final
    {
      player1: "Germany",
      score1: 1,
      abbr1: "de",
      player2: "Argentina",
      abbr2: "ar",
      score2: 0,
      description: "final",
      start: "2014-07-13T16:00:00"
    }]);

    // Configuration for the Timeline
    var options = {
      // specify a template for the items
      template: template
    };

    // Create a Timeline
    var timeline = new vis.Timeline(container, items, options);
  };
  return {
    // Public Functions
    init: function init() {
      exampleTemplate();
    }
  };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  KTVisTimelineTemplate.init();
});
/******/ })()
;