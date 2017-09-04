import Vue from 'vue';

import axios from 'axios';

import Errors from './components/helpers'


window.$ = window.jQuery = require('jquery');
window.axios = axios;
window.Vue = Vue;
window.Errors = Errors;


require('bootstrap-sass');
require('./components/busket');
require('./components/searchProduct');


