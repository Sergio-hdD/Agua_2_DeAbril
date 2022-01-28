/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import './css/style.css';

import './vendors/mdi/css/materialdesignicons.min.css';

import './vendors/css/vendor.bundle.base.css';

import $ from 'jquery';

$(document).on('mouseenter mouseleave', '.sidebar .nav-item', function(ev) {
    var body = $('body');
    var sidebarIconOnly = body.hasClass("sidebar-icon-only");
    var sidebarFixed = body.hasClass("sidebar-fixed");
    if (!('ontouchstart' in document.documentElement)) {
      if (sidebarIconOnly) {
        if (sidebarFixed) {
          if (ev.type === 'mouseenter') {
            body.removeClass('sidebar-icon-only');
          }
        } else {
          var $menuItem = $(this);
          if (ev.type === 'mouseenter') {
            $menuItem.addClass('hover-open')
          } else {
            $menuItem.removeClass('hover-open')
          }
        }
      }
    }
  });
  $('.aside-toggler').click(function(){
    $('.chat-list-wrapper').toggleClass('slide')
  });

/*
import '../scss/sb-admin-2.scss';

import '../vendor/datatables/dataTables.bootstrap4.min.css'
// import 'https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'
import '../vendor/fontawesome-free/css/all.min.css'

// start the Stimulus application
import './bootstrap';
*/

import bsCustomFileInput from 'bs-custom-file-input';

bsCustomFileInput.init();
