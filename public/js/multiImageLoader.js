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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/multiImageLoader.js":
/*!******************************************!*\
  !*** ./resources/js/multiImageLoader.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("var uploadInputFirst = document.getElementById('-1');\nvar uploadImageBox = document.getElementById('show-images');\nvar uploadInputBox = document.getElementById('show-input-image-upload');\nvar index = 1;\n\nfunction readURL() {\n  if (this.files && this.files[0]) {\n    var reader = new FileReader();\n    this.className = \"d-none\";\n    var imgBox = document.createElement('div');\n    imgBox.classList = \"col-3 d-flex align-items-center\";\n    var img = document.createElement('img');\n    img.classList = \"w-100\";\n    imgBox.appendChild(img);\n    imgBox.id = index;\n    index++;\n    imgBox.addEventListener('click', deleteImage);\n    uploadImageBox.appendChild(imgBox);\n\n    reader.onload = function (e) {\n      img.src = e.target.result;\n    };\n\n    reader.readAsDataURL(this.files[0]);\n\n    if (uploadImageBox.childElementCount < 4) {\n      var input = document.createElement('input');\n      input.id = -1 * index;\n      input.type = \"file\";\n      input.value = \"\";\n      input.className = 'form-control mt-2';\n      input.name = \"image[]\";\n      input.autocomplete = \"image\";\n      input.addEventListener('change', readURL);\n      uploadInputBox.appendChild(input);\n    }\n  }\n}\n\nfunction deleteImage() {\n  document.getElementById(-1 * this.id).remove();\n  this.remove();\n}\n\nuploadInputFirst.addEventListener('change', readURL); // setInterval(function () {\n//     if (uploadInputs[uploadInputs.length - 1].value != \"\" && uploadInputs.length < 5) {\n//         let input = document.createElement('input');\n//         input.type = \"file\";\n//         input.value = \"\";\n//         input.className = 'form-control mt-2';\n//         input.name = \"image[]\";\n//         input.autocomplete = \"image\";\n//         uploadBox.appendChild(input);\n//         uploadInputs = uploadBox.querySelectorAll('input');\n//     }\n// }, 100);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvbXVsdGlJbWFnZUxvYWRlci5qcz9mMmJhIl0sIm5hbWVzIjpbInVwbG9hZElucHV0Rmlyc3QiLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwidXBsb2FkSW1hZ2VCb3giLCJ1cGxvYWRJbnB1dEJveCIsImluZGV4IiwicmVhZFVSTCIsImZpbGVzIiwicmVhZGVyIiwiRmlsZVJlYWRlciIsImNsYXNzTmFtZSIsImltZ0JveCIsImNyZWF0ZUVsZW1lbnQiLCJjbGFzc0xpc3QiLCJpbWciLCJhcHBlbmRDaGlsZCIsImlkIiwiYWRkRXZlbnRMaXN0ZW5lciIsImRlbGV0ZUltYWdlIiwib25sb2FkIiwiZSIsInNyYyIsInRhcmdldCIsInJlc3VsdCIsInJlYWRBc0RhdGFVUkwiLCJjaGlsZEVsZW1lbnRDb3VudCIsImlucHV0IiwidHlwZSIsInZhbHVlIiwibmFtZSIsImF1dG9jb21wbGV0ZSIsInJlbW92ZSJdLCJtYXBwaW5ncyI6IkFBQUEsSUFBTUEsZ0JBQWdCLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixJQUF4QixDQUF6QjtBQUNBLElBQU1DLGNBQWMsR0FBR0YsUUFBUSxDQUFDQyxjQUFULENBQXdCLGFBQXhCLENBQXZCO0FBQ0EsSUFBTUUsY0FBYyxHQUFHSCxRQUFRLENBQUNDLGNBQVQsQ0FBd0IseUJBQXhCLENBQXZCO0FBQ0EsSUFBSUcsS0FBSyxHQUFHLENBQVo7O0FBRUEsU0FBU0MsT0FBVCxHQUFtQjtBQUNmLE1BQUksS0FBS0MsS0FBTCxJQUFjLEtBQUtBLEtBQUwsQ0FBVyxDQUFYLENBQWxCLEVBQWlDO0FBQzdCLFFBQU1DLE1BQU0sR0FBRyxJQUFJQyxVQUFKLEVBQWY7QUFDQSxTQUFLQyxTQUFMLEdBQWlCLFFBQWpCO0FBQ0EsUUFBTUMsTUFBTSxHQUFHVixRQUFRLENBQUNXLGFBQVQsQ0FBdUIsS0FBdkIsQ0FBZjtBQUNBRCxVQUFNLENBQUNFLFNBQVAsR0FBbUIsaUNBQW5CO0FBRUEsUUFBTUMsR0FBRyxHQUFHYixRQUFRLENBQUNXLGFBQVQsQ0FBdUIsS0FBdkIsQ0FBWjtBQUNBRSxPQUFHLENBQUNELFNBQUosR0FBZ0IsT0FBaEI7QUFDQUYsVUFBTSxDQUFDSSxXQUFQLENBQW1CRCxHQUFuQjtBQUNBSCxVQUFNLENBQUNLLEVBQVAsR0FBWVgsS0FBWjtBQUNBQSxTQUFLO0FBRUxNLFVBQU0sQ0FBQ00sZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUNDLFdBQWpDO0FBRUFmLGtCQUFjLENBQUNZLFdBQWYsQ0FBMkJKLE1BQTNCOztBQUVBSCxVQUFNLENBQUNXLE1BQVAsR0FBZ0IsVUFBVUMsQ0FBVixFQUFhO0FBQ3pCTixTQUFHLENBQUNPLEdBQUosR0FBVUQsQ0FBQyxDQUFDRSxNQUFGLENBQVNDLE1BQW5CO0FBQ0gsS0FGRDs7QUFJQWYsVUFBTSxDQUFDZ0IsYUFBUCxDQUFxQixLQUFLakIsS0FBTCxDQUFXLENBQVgsQ0FBckI7O0FBRUEsUUFBSUosY0FBYyxDQUFDc0IsaUJBQWYsR0FBbUMsQ0FBdkMsRUFBMEM7QUFDdEMsVUFBTUMsS0FBSyxHQUFHekIsUUFBUSxDQUFDVyxhQUFULENBQXVCLE9BQXZCLENBQWQ7QUFDQWMsV0FBSyxDQUFDVixFQUFOLEdBQVcsQ0FBQyxDQUFELEdBQUtYLEtBQWhCO0FBQ0FxQixXQUFLLENBQUNDLElBQU4sR0FBYSxNQUFiO0FBQ0FELFdBQUssQ0FBQ0UsS0FBTixHQUFjLEVBQWQ7QUFDQUYsV0FBSyxDQUFDaEIsU0FBTixHQUFrQixtQkFBbEI7QUFDQWdCLFdBQUssQ0FBQ0csSUFBTixHQUFhLFNBQWI7QUFDQUgsV0FBSyxDQUFDSSxZQUFOLEdBQXFCLE9BQXJCO0FBQ0FKLFdBQUssQ0FBQ1QsZ0JBQU4sQ0FBdUIsUUFBdkIsRUFBaUNYLE9BQWpDO0FBQ0FGLG9CQUFjLENBQUNXLFdBQWYsQ0FBMkJXLEtBQTNCO0FBQ0g7QUFDSjtBQUNKOztBQUVELFNBQVNSLFdBQVQsR0FBdUI7QUFDbkJqQixVQUFRLENBQUNDLGNBQVQsQ0FBd0IsQ0FBQyxDQUFELEdBQUssS0FBS2MsRUFBbEMsRUFBc0NlLE1BQXRDO0FBQ0EsT0FBS0EsTUFBTDtBQUNIOztBQUdEL0IsZ0JBQWdCLENBQUNpQixnQkFBakIsQ0FBa0MsUUFBbEMsRUFBNENYLE9BQTVDLEUsQ0FFQTtBQUNBO0FBQ0E7QUFLQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0EiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvbXVsdGlJbWFnZUxvYWRlci5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbImNvbnN0IHVwbG9hZElucHV0Rmlyc3QgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnLTEnKTtcclxuY29uc3QgdXBsb2FkSW1hZ2VCb3ggPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc2hvdy1pbWFnZXMnKTtcclxuY29uc3QgdXBsb2FkSW5wdXRCb3ggPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc2hvdy1pbnB1dC1pbWFnZS11cGxvYWQnKTtcclxubGV0IGluZGV4ID0gMTtcclxuXHJcbmZ1bmN0aW9uIHJlYWRVUkwoKSB7XHJcbiAgICBpZiAodGhpcy5maWxlcyAmJiB0aGlzLmZpbGVzWzBdKSB7XHJcbiAgICAgICAgY29uc3QgcmVhZGVyID0gbmV3IEZpbGVSZWFkZXIoKTtcclxuICAgICAgICB0aGlzLmNsYXNzTmFtZSA9IFwiZC1ub25lXCI7XHJcbiAgICAgICAgY29uc3QgaW1nQm94ID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnZGl2Jyk7XHJcbiAgICAgICAgaW1nQm94LmNsYXNzTGlzdCA9IFwiY29sLTMgZC1mbGV4IGFsaWduLWl0ZW1zLWNlbnRlclwiO1xyXG5cclxuICAgICAgICBjb25zdCBpbWcgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdpbWcnKTtcclxuICAgICAgICBpbWcuY2xhc3NMaXN0ID0gXCJ3LTEwMFwiO1xyXG4gICAgICAgIGltZ0JveC5hcHBlbmRDaGlsZChpbWcpO1xyXG4gICAgICAgIGltZ0JveC5pZCA9IGluZGV4O1xyXG4gICAgICAgIGluZGV4Kys7XHJcblxyXG4gICAgICAgIGltZ0JveC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGRlbGV0ZUltYWdlKTtcclxuXHJcbiAgICAgICAgdXBsb2FkSW1hZ2VCb3guYXBwZW5kQ2hpbGQoaW1nQm94KTtcclxuXHJcbiAgICAgICAgcmVhZGVyLm9ubG9hZCA9IGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgICAgIGltZy5zcmMgPSBlLnRhcmdldC5yZXN1bHQ7XHJcbiAgICAgICAgfTtcclxuXHJcbiAgICAgICAgcmVhZGVyLnJlYWRBc0RhdGFVUkwodGhpcy5maWxlc1swXSk7XHJcbiAgICAgICAgXHJcbiAgICAgICAgaWYgKHVwbG9hZEltYWdlQm94LmNoaWxkRWxlbWVudENvdW50IDwgNCkgeyAgICAgICAgICAgXHJcbiAgICAgICAgICAgIGNvbnN0IGlucHV0ID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnaW5wdXQnKTtcclxuICAgICAgICAgICAgaW5wdXQuaWQgPSAtMSAqIGluZGV4O1xyXG4gICAgICAgICAgICBpbnB1dC50eXBlID0gXCJmaWxlXCI7XHJcbiAgICAgICAgICAgIGlucHV0LnZhbHVlID0gXCJcIjtcclxuICAgICAgICAgICAgaW5wdXQuY2xhc3NOYW1lID0gJ2Zvcm0tY29udHJvbCBtdC0yJztcclxuICAgICAgICAgICAgaW5wdXQubmFtZSA9IFwiaW1hZ2VbXVwiO1xyXG4gICAgICAgICAgICBpbnB1dC5hdXRvY29tcGxldGUgPSBcImltYWdlXCI7XHJcbiAgICAgICAgICAgIGlucHV0LmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIHJlYWRVUkwpO1xyXG4gICAgICAgICAgICB1cGxvYWRJbnB1dEJveC5hcHBlbmRDaGlsZChpbnB1dCk7ICAgIFxyXG4gICAgICAgIH1cclxuICAgIH1cclxufVxyXG5cclxuZnVuY3Rpb24gZGVsZXRlSW1hZ2UoKSB7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgtMSAqIHRoaXMuaWQpLnJlbW92ZSgpO1xyXG4gICAgdGhpcy5yZW1vdmUoKTtcclxufVxyXG5cclxuXHJcbnVwbG9hZElucHV0Rmlyc3QuYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgcmVhZFVSTCk7XHJcblxyXG4vLyBzZXRJbnRlcnZhbChmdW5jdGlvbiAoKSB7XHJcbi8vICAgICBpZiAodXBsb2FkSW5wdXRzW3VwbG9hZElucHV0cy5sZW5ndGggLSAxXS52YWx1ZSAhPSBcIlwiICYmIHVwbG9hZElucHV0cy5sZW5ndGggPCA1KSB7XHJcbi8vICAgICAgICAgbGV0IGlucHV0ID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnaW5wdXQnKTtcclxuICAgICAgICBcclxuICAgICAgICBcclxuXHJcblxyXG4vLyAgICAgICAgIGlucHV0LnR5cGUgPSBcImZpbGVcIjtcclxuLy8gICAgICAgICBpbnB1dC52YWx1ZSA9IFwiXCI7XHJcbi8vICAgICAgICAgaW5wdXQuY2xhc3NOYW1lID0gJ2Zvcm0tY29udHJvbCBtdC0yJztcclxuLy8gICAgICAgICBpbnB1dC5uYW1lID0gXCJpbWFnZVtdXCI7XHJcbi8vICAgICAgICAgaW5wdXQuYXV0b2NvbXBsZXRlID0gXCJpbWFnZVwiO1xyXG4vLyAgICAgICAgIHVwbG9hZEJveC5hcHBlbmRDaGlsZChpbnB1dCk7XHJcbi8vICAgICAgICAgdXBsb2FkSW5wdXRzID0gdXBsb2FkQm94LnF1ZXJ5U2VsZWN0b3JBbGwoJ2lucHV0Jyk7XHJcblxyXG4vLyAgICAgfVxyXG4vLyB9LCAxMDApO1xyXG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/multiImageLoader.js\n");

/***/ }),

/***/ 2:
/*!************************************************!*\
  !*** multi ./resources/js/multiImageLoader.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\boolean\progetto-finale\resources\js\multiImageLoader.js */"./resources/js/multiImageLoader.js");


/***/ })

/******/ });