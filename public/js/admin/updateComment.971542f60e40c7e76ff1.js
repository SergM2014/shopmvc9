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
/******/ 	return __webpack_require__(__webpack_require__.s = 41);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(34);

/***/ }),

/***/ 34:
/***/ (function(module, exports) {


// find repeated values in two arrays
Array.prototype.intersect = function (a) {
    return this.filter(function (i) {
        return a.indexOf(i) > -1;
    });
};

var progress = document.getElementById('imageDownloadProgress'),
    output = document.getElementById('imageDownloadOutput'),
    submit_btn = document.getElementById('downloadImageBtn'),
    reset_btn = document.getElementById('resetImageBtn'),
    delete_img_sign = document.getElementById('deleteImagePreview'),
    imageField = document.getElementById('file'),
    imageFormField = document.getElementById('imagesData');

// this background is for imageupload

function progressHandler(event) {

    var percent = Math.round(event.loaded / event.total * 100);

    progress.value = percent;
    // progress.innerText= percent+"%";
}

function completeHandler(event) {

    var response = JSON.parse(event.target.responseText);
    //output.innerHTML= response.message;

    progress.value = 0;
    // output.classList.remove('hidden');

    progress.classList.add('hidden');
    reset_btn.removeAttribute('disabled');

    //further work with many images;
    populateImagesField(response.filename);

    output.innerHTML = response.message;
}

function errorHandler(event) {

    output.innerHTML = 'Upload failed';
}

function abortHandler(event) {

    output.innerHTML = 'Upload aborted';
}

function populateImagesField(filename) {

    var imagesListArray = document.getElementById('imagesData').value;

    if (!imagesListArray) {
        imagesListArray = [];
    } else {
        imagesListArray = imagesListArray.split(',');
    }

    imagesListArray.push(filename);
    document.getElementById('imagesData').value = imagesListArray;
}

//to make previe image using file API


if (document.getElementById('file')) {
    document.getElementById('file').onchange = function () {

        if (delete_img_sign) delete_img_sign.className = 'hidden';

        var input = this;

        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('downloadImagePreview').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);

                document.getElementById('file').classList.add('hidden');

                //output.classList.add('hidden');

                reset_btn.classList.remove('hidden');

                submit_btn.classList.remove('hidden');
            } // else console.log('is not image mime type');
        } // else console.log('not isset files data or files API not supordet');
    }; //end of function

}

if (submit_btn) {
    submit_btn.onclick = function (e) {

        e.preventDefault();
        progress.classList.remove('hidden');

        var file = document.getElementById("file").files[0];

        var formdata = new FormData();

        formdata.append("file", file);

        formdata.append("ajax", true);

        var uploadUrl = "/images/uploadProductImage";

        var send_image = new XMLHttpRequest();
        send_image.upload.addEventListener("progress", progressHandler, false);
        send_image.addEventListener("load", completeHandler, false);
        send_image.addEventListener("error", errorHandler, false);
        send_image.addEventListener("abort", abortHandler, false);
        send_image.open("POST", uploadUrl);
        send_image.send(formdata);

        // document.getElementById('downloadImagePreview').setAttribute('src', '/img/nophoto.jpg');
        reset_btn.setAttribute('disabled', 'disabled');
        // reset_btn.classList.add('hidden');
        submit_btn.classList.add('hidden');

        document.getElementById('file').classList.remove('hidden');
        // document.getElementById('file').value = '';
        document.getElementById('file').classList.add('hidden');
    }; // end of submit button
}

if (reset_btn) {
    reset_btn.onclick = function (e) {
        e.preventDefault();

        document.getElementById('downloadImagePreview').setAttribute('src', '/img/nophoto.jpg');
        document.getElementById('file').classList.remove('hidden');
        var formData = new FormData();

        formData.append('ajax', true);

        if (document.getElementById('image')) formData.append('image', document.getElementById('image').value);

        fetch('/images/deleteProductImage', {
            method: "POST",
            credentials: "same-origin",
            body: formData
        }).then(function (responce) {
            return responce.json();
        }).then(function (j) {
            output.innerHTML = j.message;
            if (output.classList.contains('hidden')) {
                output.classList.remove('hidden');
            }
            imageField.value = '';
        });

        submit_btn.classList.add('hidden');
        reset_btn.classList.add('hidden');
        if (document.getElementById('image')) document.getElementById('image').value = '';
        imageFormField.value = '';
    };
}
//end of image reset

/***/ }),

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ })

/******/ });