var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
 mix.scripts([
         './resources/assets/jquery/dist/jquery.min.js',
         './resources/assets/jqueryui/jquery-ui.min.js',
         './resources/assets/bootstrap/dist/js/bootstrap.min.js',
         './resources/assets/moment/min/moment.min.js',
         './resources/assets/fullcalendar/dist/fullcalendar.min.js',
         './resources/assets/smartadmin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js',
         './resources/assets/smartadmin/js/plugin/jquery-validate/jquery.validate.min.js',
         './resources/assets/smartadmin/js/plugin/masked-input/jquery.maskedinput.min.js',
         './resources/assets/DataTables/DataTables-1.10.8/js/jquery.dataTables.min.js',
         './resources/assets/DataTables/DataTables-1.10.8/js/dataTables.bootstrap.min.js',
         './resources/assets/DataTables/Buttons-1.0.0/js/dataTables.buttons.min.js',
         './resources/assets/DataTables/Buttons-1.0.0/js/buttons.bootstrap.min.js',
         './resources/assets/DataTables/Buttons-1.0.0/js/buttons.colVis.min.js',
         './resources/assets/DataTables/Buttons-1.0.0/js/buttons.flash.min.js',
         './resources/assets/DataTables/Buttons-1.0.0/js/buttons.print.min.js',
         './resources/assets/DataTables/ColReorder-1.2.0/js/dataTables.colReorder.min.js',
         './resources/assets/bootstrap-modal/js/bootstrap-modalmanager.js',
         './resources/assets/bootstrap-modal/js/bootstrap-modal.js',
         './resources/assets/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js',
         './resources/assets/qTip2/src/jquery.qtip.min.js',
         './resources/assets/malsup-form/jquery.form.min.js',
         './resources/assets/pioneer/contextMenu.js',
         './resources/assets/pioneer/userInteraction.js',
         './resources/assets/smartadmin/js/notification/SmartNotification.min.js',
         './resources/assets/smartadmin/js/plugin/bootstrap-slider/bootstrap-slider.min.js',
         './resources/assets/smartadmin/js/plugin/cssemotions/jquery.cssemoticons.min.js',
         './resources/assets/smartadmin/js/smart-chat-ui/smart.chat.ui.js',
         './resources/assets/smartadmin/js/smart-chat-ui/smart.chat.manager.js',
         './resources/assets/smartadmin/js/smartwidgets/jarvis.widget.min.js',
         './resources/assets/select2-4.0.0/dist/js/select2.full.min.js',
         './resources/assets/smartadmin/js/app.js',
         './resources/assets/smartadmin/js/app.config.js',
    ])
     .styles([
      './resources/assets/bootstrap/dist/css/bootstrap.min.css',
      './resources/assets/fontawesome/css/font-awesome.min.css',
      './resources/assets/fullcalendar/dist/fullcalendar.min.css',
      './resources/assets/DataTables/DataTables-1.10.8/css/dataTables.bootstrap.min.css',
      './resources/assets/DataTables/Buttons-1.0.0/css/buttons.bootstrap.min.css',
      './resources/assets/DataTables/ColReorder-1.2.0/css/colReorder.bootstrap.min.css',
      './resources/assets/select2-4.0.0/dist/css/select2.min.css',
      './resources/assets/bootstrap-modal/css/bootstrap-modal-bs3patch.css',
      './resources/assets/bootstrap-modal/css/bootstrap-modal.css',
      './resources/assets/qTip2/src/jquery.qtip.min.css',
     ])
     .sass([
         './resources/assets/sass/smartadmin-production-plugins.scss',
         './resources/assets/sass/smartadmin-production.scss',
         './resources/assets/sass/smartadmin-skins.scss',
         'app.scss'
     ]);
});
