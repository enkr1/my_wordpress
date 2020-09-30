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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/app.js":
/*!********************!*\
  !*** ./src/app.js ***!
  \********************/
/*! no static exports found */
/***/ (function(module, exports) {

function minimizeNav() {
  // main-header-bar
  var elements = document.getElementsByClassName('main-header-bar');
  var requiredElement = elements[0];

  if (this.scrollY > this.innerHeight / 1.1) {
    requiredElement.style.transform = "translateY(-40%)";
    requiredElement.style.opacity = "0.8";
  } else {
    requiredElement.style.transform = "translateY(0%)";
    requiredElement.style.opacity = "1"; // document.body.classList.remove("interest-body");
    // var img = "images/interest-main-img.jpg";
    // document.body.style.background = 'url("images/interest-main-img.jpg") no-repeat center fixed';
  }
}

window.addEventListener("scroll", minimizeNav);
var colors = {
  Fire: '#F5AC7870',
  Grass: '#A7DB8D70',
  Electric: '#FAE07870',
  Water: '#9DB7F570',
  Ground: '#EBD69D70',
  Rock: '#D1C17D70',
  Fairy: '#F4BDC970',
  Poison: '#C183C170',
  Bug: '#C6D16E70',
  Dragon: '#A27DFA70',
  Dark: '#A2928870',
  Psychic: '#FA92B270',
  Flying: '#C6B7F570',
  Fighting: '#D6787370',
  Normal: '#C6C6A770',
  Ghost: '#A292BC70',
  Ice: '#BCE6E670',
  Steel: '#D1D1E070',
  Unknown: '#9DC1B770'
};
var stat_colors = {// Hp
  // Attack
  // Defense
  // Special - attack
  // Special - defense
  // Speed
};
jQuery(document).ready(function () {
  if (window.location.pathname.includes("category/blog")) {
    var hideBlogSidebar = function hideBlogSidebar() {
      document.getElementById('blog-sidebar').style.right = '-100%';
      document.getElementById('blog-sidebar-opener').style.opacity = '1';
      document.getElementById('blog-sidebar').style.zIndex = '-1';
      document.getElementById('blog-sidebar-hider').style.opacity = '0';
    };

    var openBlogSidebar = function openBlogSidebar() {
      document.getElementById('blog-sidebar').style.right = '0';
      document.getElementById('blog-sidebar-opener').style.opacity = '0';
      document.getElementById('blog-sidebar').style.zIndex = '999';
      document.getElementById('blog-sidebar-hider').style.opacity = '1';
    };

    // Blog side bar 
    document.getElementById("blog-sidebar-hider").addEventListener("click", hideBlogSidebar);
    document.getElementById("blog-sidebar-opener").addEventListener("click", openBlogSidebar);
  } else if (window.location.pathname.includes("pokemon")) {
    window.onload = function () {
      // var pokemon_type = document.getElementsByClassName('pokemon-type')[0].innerHTML;
      var pokemon_types = document.getElementsByClassName('pokemon-type');
      var pokemon_bgs = document.getElementsByClassName('pokemon');

      for (var i = 0; i < pokemon_types.length; i++) {
        // console.log(pokemon_types[i].innerHTML);
        var main_type = pokemon_types[i].innerHTML;

        if (main_type.includes(",")) {
          main_type = main_type.substring(0, main_type.indexOf(", "));
          pokemon_bgs[i].style.backgroundColor = colors[main_type];
        } else {
          pokemon_bgs[i].style.backgroundColor = colors[main_type];
        }
      }

      var stat_name = document.getElementsByClassName('stat-name');
      var stat_number = document.getElementsByClassName('stat-number');

      for (var i = 0; i < stat_name.length; i++) {
        console.log(stat_name[i].innerHTML); // var main_type = pokemon_types[i].innerHTML;
        // if (main_type.includes(",")) {
        //     main_type = main_type.substring(0, main_type.indexOf(", "));
        //     pokemon_bgs[i].style.backgroundColor = colors[main_type];
        // } else {
        //     pokemon_bgs[i].style.backgroundColor = colors[main_type];
        // }
      } // console.log(pokemon_type);
      // Pagination


      var pageNo = document.getElementById('pageNo').value;
      var noOfPokemon = document.getElementById('noOfPokemon').value;
      var prevBtn = document.getElementById("pokemon-previous");
      var nextBtn = document.getElementById("pokemon-next");

      if (pageNo <= 1 || pageNo == null) {
        prevBtn.disabled = true;
      } else if (noOfPokemon > 800) {
        nextBtn.disabled = true;
      }

      window.onload = function () {
        var container = document.getElementsByClassName("loading-process")[0];
        $('#loader').addClass('hidden');
        container.style.display = 'block';
        alert("check");
      };
    };
  } else if (window.location.pathname == '/') {// alert("home");
  }
});

/***/ }),

/***/ "./src/app.scss":
/*!**********************!*\
  !*** ./src/app.scss ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*****************************************!*\
  !*** multi ./src/app.js ./src/app.scss ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/pixium/Workspace/my_wordpress/wp-content/themes/astra-child/src/app.js */"./src/app.js");
module.exports = __webpack_require__(/*! /Users/pixium/Workspace/my_wordpress/wp-content/themes/astra-child/src/app.scss */"./src/app.scss");


/***/ })

/******/ });