/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#image-ava').click(function () {
    $('#avatar').click();
  });
  $('body').on('change', '#avatar', function (e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append('file', $(this).prop('files')[0]);
    $.ajax({
      type: 'POST',
      url: '/upload-avatar',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function success(res) {
        $('#image-ava').attr('src', res.data.path);
        swal({
          text: res.data.msg,
          type: 'success',
          icon: 'success',
          button: true
        });
      },
      error: function error(_error) {
        console.log(_error);
      }
    });
  });
  $('.view-more').click(function () {
    var $this = $(this);
    var link = $this.data('next-link');
    var nextPage = link.slice(link, -1) + (parseInt(link.slice(-1)) + 1);
    var appendTo = $this.data('append-to');
    $.get(link).then(function (res) {
      if (res) {
        $(appendTo).append(res);
        $this.data('next-link', nextPage);
        return;
      }

      swal({
        title: 'Đã hết dữ liệu',
        type: 'warning',
        icon: 'warning'
      });
    });
  });
  var mainSliders = document.getElementsByClassName('task-noUi');

  var _iterator = _createForOfIteratorHelper(mainSliders),
      _step;

  try {
    var _loop = function _loop() {
      var item = _step.value;
      var value = $(item).data('progress');
      noUiSlider.create(item, {
        start: value,
        connect: 'lower',
        tooltips: [true],
        step: 0.5,
        range: {
          'min': 0,
          'max': 100
        }
      }).on('end', function (value, handle) {
        var id = $(item).data('task-id');
        var goal_id = window.location.pathname.slice(-1);
        $.ajax({
          url: '/tasks/' + id,
          method: 'put',
          data: {
            progress: value[0],
            goal_id: goal_id
          },
          dataType: 'json',
          success: function success(res) {
            swal({
              title: res.data.message,
              icon: 'success',
              type: 'success'
            }).then(function (e) {
              var percent = res.data.goal.progress;
              $('.progress-task-' + id).html("".concat(value, " %"));
              $('#input-task-' + id).val(value);
              updateMain(res.data);
            });
          },
          error: function error(e) {
            console.log(e);
          }
        });
      });
    };

    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      _loop();
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  ;
  $('body').on('change', '.progress-task', function () {
    var id = $(this).data('id');
    var value = $(this).val();
    var slider = document.getElementById('slider-task-' + id);
    slider.noUiSlider.set(value);
    $('.progress-task-' + id).html("".concat(value, " %"));
  });
  $('.edit-desc').click(function (e) {
    e.preventDefault();
    $(this).closest('.parent').find('.to-none').toggleClass('d-none');
  });
  $('.delete-task').click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
      title: 'Xác nhận',
      content: 'Bạn chắc muốn xóa điểm then chốt này?',
      dangerMode: true,
      buttons: true,
      icon: 'error'
    }).then(function (e) {
      if (e) {
        $.ajax({
          url: '/tasks/' + id,
          method: 'delete',
          dataTye: 'json',
          success: function success(res) {
            swal({
              title: res.data.message,
              icon: 'success',
              type: 'success'
            }).then(function (e) {
              $('#row-task-' + id).remove();
              updateMain(res.data);
            });
          }
        });
      }
    });
  });
});

function updateMain(data) {
  var sliderMain = document.getElementById('main-progress');
  sliderMain.noUiSlider.set(data.goal.progress);
  $('.total-main').html("".concat(data.goal.progress, " %"));
  $('#input-main').val(data.goal.progress);
  $('#mainStatus').replaceWith(data.statusMain);
}

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/main.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/thuongnguyen/Desktop/goal1/backend/resources/js/main.js */"./resources/js/main.js");


/***/ })

/******/ });