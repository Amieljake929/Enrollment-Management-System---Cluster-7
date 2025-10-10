import './bootstrap';

// Import jQuery and expose it globally
import $ from 'jquery';
window.$ = window.jQuery = $;

// Import Bootstrap and expose it globally
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import '../css/app.css';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();
