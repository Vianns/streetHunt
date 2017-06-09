window.$ = require("jquery");
window.jQuery = require("jquery");

require('bootstrap-sass');

import { Slider } from './modules/Slider';
import { Login } from './modules/Login';

$(document).ready( function() {
    new Slider();
    new Login();

    $('[data-toggle="tooltip"]').tooltip({ container: 'body' })

    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        input.trigger('fileselect', [numFiles, label]);
    });

    $(':file').on('fileselect', function(event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        $('[data-img-file]').attr('style', 'background-image: url(' + URL.createObjectURL(event.target.files[0]) + ')');

    });

    if ('undefined' !== typeof datepicker) {
        $('.js-datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    }
});
