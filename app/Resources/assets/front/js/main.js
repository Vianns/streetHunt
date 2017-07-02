window.$ = require("jquery");
window.jQuery = require("jquery");

require('bootstrap-sass');

import { Slider } from './modules/Slider';
import { Login } from './modules/Login';

$(document).ready( function() {

    var $loadingElems = $('[data-autoload-src]').length;
    var $width = 100 / $loadingElems;
    var $totalWidth = $width;
    var $nbDone = 0;

    initModules();
    checkDone();

    $.each($('[data-autoload-src]'), function(){
        var that = $(this);

        that.append('<div class="text-center marged-top marged-bottom"><i class="fa fa-spinner fa-spin"></fa></div>');

        $.ajax({
            url: that.data('autoload-src'),
            method: 'GET',
        })
        .done(function (content) {
            let newContent = $(content);

            initModules(newContent);
            that.replaceWith(newContent);
        })
        .always(function(){
            $nbDone += 1;
            $totalWidth += $width;
            $('.progress-bar-loading--elem').css('width', $totalWidth + '%');
            checkDone();
        })
        .error(function () {
            new Flash().fireGenericError();
        });
    });

    function checkDone() {
        if ($nbDone === $loadingElems) {
            $('.progress-bar-loading').remove();
            initLastModules();
        }
    }

    function initModules(container) {
        new Slider(true, container);
        new Login(true, container);
    }

    function initLastModules() {
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
    }
});
