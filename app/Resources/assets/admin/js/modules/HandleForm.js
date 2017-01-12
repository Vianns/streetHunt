var switchery = require('../vendor/switchery.js');
var autosize = require('autosize');
var pikaday = require('pikaday');
require('select2');

class HandleForm
{
    /**
     * HandleForm.
     *
     * @param  {jQuery $(element)} container
     * @return {void}
     */
    constructor(container)
    {
        this.container = undefined === container ? $('body') : container;

        this.attachSwitchery();
        this.attachAutosize();
        this.attachDatepicker();
        this.attacheSelect2();
        this.attachTinymce();
        this.handleTabError();
    }

    /**
     * Attach Switchery behavior.
     * @see http://abpetkov.github.io/switchery/
     */
    attachSwitchery()
    {
        this.container.find('input[type=checkbox].form-control').each(function () {
            new switchery($(this)[0]);
        });
    }

    /**
     * Attach Autosize behavior.
     * @see http://www.jacklmoore.com/autosize/
     */
    attachAutosize()
    {
        autosize(this.container.find('textarea.form-control').get());
    }

    /**
     * Attach Select2
     * @see https://select2.github.io/
     */
    attacheSelect2()
    {
        let $elements = this.container
            .find('select[multiple="multiple"]')
            .not('[data-select-autocomplete]');

        $elements.each(function () {
            let opts = { 'width': '100%' };

            if ($(this).data('s2opts-tags')) {
                opts['tags'] = true;
                opts['tokenSeparators'] = [';', ',', ' '];
            }

            $(this).select2(opts);
        });;
    }

    /**
     * Attach Tinymce
     * @see https://www.tinymce.com
     * @help : Include Tinymce JS script with twig block javascriptsExternal
     */
    attachTinymce()
    {
        if ('undefined' !== typeof tinymce) {
            var langs = {
                'en': 'en',
                'fr': 'fr_FR'
            };

            var lang = undefined !== langs[$('html').attr('lang')] ? langs[$('html').attr('lang')] : langs['en'];

            tinymce.init({
                selector: '[data-tinymce]',
                language: lang,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak fullscreen",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor responsivefilemanager autoresize"
                ],
                toolbar1: "bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | preview code | fullscreen",
                image_advtab: true ,
                external_filemanager_path: "/filemanager/",
                filemanager_title: "File manager",
                filemanager_access_key: '01ec155031e70e869eeef6995b6a846db6b583a8',
                filemanager_language: 'en_EN',
                external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
            });
        }
    }

    /**
     * Attache Datepicker.
     * @see https://github.com/dbushell/Pikaday
     */
    attachDatepicker()
    {
        var that = this;

        this.container.find('input[type=date]').each(function () {
            new pikaday({
                field: $(this)[0],
                i18n: that.getDatePickerTranslation($('html').attr('lang'))
            });
        });
    }

    /**
     * Pikaday translation
     */
    getDatePickerTranslation(lang)
    {
        var dictionnary = {
            'fr': {
                'previousMonth' : 'Mois précédent',
                'nextMonth'     : 'Mois suivant',
                'months'        : ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
                'weekdays'      : ['Dimance','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                'weekdaysShort' : ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam']
            },
            'en': {
                'previousMonth' : 'Previous Month',
                'nextMonth'     : 'Next Month',
                'months'        : ['January','February','March','April','May','June','July','August','September','October','November','December'],
                'weekdays'      : ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
                'weekdaysShort' : ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']
            }
        };

        lang = undefined === lang ? 'en' : undefined === dictionnary[lang] ? 'en' : lang;

        return dictionnary[lang];
    }

    handleTabError()
    {
        var tabbedForm = $('[data-form-handle-tab]'), countErrors = 0;

        if (0 < tabbedForm.length) {
            tabbedForm.find('.tab-pane').each(function()
            {
                if (0 < $(this).find('.has-error').length) {
                    tabbedForm
                        .find('a[href="#' + $(this).attr('id') + '"]')
                        .parent('li')
                        .addClass('error');
                }
            });
        }
    }
}

export { HandleForm };
