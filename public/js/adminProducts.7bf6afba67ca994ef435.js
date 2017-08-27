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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "./";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 36:
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var PopUpMenu = function () {
    function PopUpMenu(e) {
        _classCallCheck(this, PopUpMenu);

        this.x = e.pageX;
        this.y = e.pageY;

        this.screenWidth = document.body.clientWidth;
        this.screenHeight = document.body.clientHeight;
        this.target = e.target;
    }

    _createClass(PopUpMenu, [{
        key: 'drawMenu',
        value: function drawMenu() {
            var x = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 100;
            var y = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 60;


            if ( /*popupMenuSaved && */document.getElementById('popupMenu')) {
                this.popUp = document.getElementById('popupMenu');
                this.popUp.classList.remove('hidden');
            } else {

                this.popUp = document.createElement('div');
                this.popUp.className = "popup-menu";
                this.popUp.id = "popupMenu";

                document.body.insertBefore(this.popUp, document.body.firstChild);
            }

            if (this.x + x > this.screenWidth + pageXOffset) this.x = this.screenWidth + pageXOffset - x;
            if (this.y + y > this.screenHeight + pageYOffset) this.y = this.screenHeight + pageYOffset - y;

            this.popUp.style.left = this.x + "px";
            this.popUp.style.top = this.y + "px";
        }
    }, {
        key: 'fillUpMenuContent',
        value: function fillUpMenuContent(id, route) {
            var processContr = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';

            this.drawMenu();

            //console.log(popUpContr);
            var formData = new FormData();
            formData.append('id', id);
            formData.append('processContr', processContr);

            fetch(route, {
                method: 'post',
                credentials: 'same-origin',
                body: formData
            }).then(function (response) {
                return response.text();
            }).then(function (html) {
                return document.getElementById('popupMenu').innerHTML = html;
            });
        }
    }], [{
        key: 'deleteMenu',
        value: function deleteMenu() {
            if (document.getElementById('popupMenu')) {
                document.getElementById('popupMenu').remove();
            }
        }
    }, {
        key: 'hideMenu',
        value: function hideMenu() {
            if (document.getElementById('popupMenu')) {
                document.getElementById('popupMenu').classList.add('hidden');
            }
        }
    }]);

    return PopUpMenu;
}();

var Modal = function () {
    function Modal() {
        _classCallCheck(this, Modal);
    }

    _createClass(Modal, null, [{
        key: 'createBackground',
        value: function createBackground() {
            var background = document.createElement('div');
            background.className = "modal-background";
            background.id = "modalBackground";
            document.body.insertBefore(background, document.body.firstChild);
        }
    }, {
        key: 'createModalWindow',
        value: function createModalWindow(controller, formData) {
            this.createBackground();
            postAjax(controller, formData).then(function (response) {
                return response.text();
            }).then(function (html) {
                return document.getElementById('modalBackground').insertAdjacentHTML('afterBegin', html);
            });
        }
    }]);

    return Modal;
}();

document.getElementById('allProductsTable').addEventListener('click', function (e) {

    var form = new FormData();
    var productId = e.target.closest('.parent_tr').dataset.productId;
    form.append('id', productId);

    new PopUpMenu(e).fillUpMenuContent(productId, '/productsPopUpMenu');
});

/***/ }),

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(36);


/***/ })

/******/ });