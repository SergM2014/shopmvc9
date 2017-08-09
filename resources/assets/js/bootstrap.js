import Vue from 'vue';

import axios from 'axios';

window.$ = window.jQuery = require('jquery');
window.axios = axios;
window.Vue = Vue;

require('bootstrap-sass');
require('./components/busket.js');
require('./components/search');
require('./components/showProductPreview.js');