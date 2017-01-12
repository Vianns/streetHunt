import { HandleForm } from './HandleForm';
import { HandleModalCallback } from './HandleModalCallback';
import { Flash } from './Flash';
import { AutcompleterSelect2 } from './AutcompleterSelect2';

require('../vendor/selectFx');

class HandleModal
{
    /**
     * Modal.
     *
     * @param  {element} container
     * @return {void}
     */
    constructor(container)
    {
        this.$container = undefined === container ? $('body') : container;

        this.$modal = $('[data-the-modal]');
        this.$modalClose = this.$modal.find('[data-modal-close]');
        this.$modalLoader = this.$modal.find('[data-modal-loader]');
        this.$modalContent = this.$modal.find('[data-modal-content]');

        this.bind();
    }

    bind()
    {
        var that = this;

        this.$container.find('[data-add-modal]').on('click', function (e) {
            e.preventDefault();

            that.$modalContent.attr('class', 'modal-dialog');

            var classToAdd = $(this).data('add-modal');

            if ('' != classToAdd) {
                that.$modalContent.addClass(classToAdd);
            }

            that.$modalContent.hide();
            that.$modalLoader.show();
            that.$modal.modal('show');

            $.ajax($(this).attr('href'), {
                dataType: 'html'
            })
            .done(function (response) {
                that.$modalLoader.fadeOut('normal', function () {
                    that.parseResponse(response);
                });
            });
        });

        this.$modalClose.on('click', function(e)
        {
            that.$modal.modal('hide');
        });
    }

    parseResponse(response)
    {
        var that = this,
            $response = $(response),
            $form = $response.find('[data-modal-response-form]'),
            $formClassic = $response.find('[data-modal-response-form-classic]'),
            $toHide = $response.find('[data-modal-response-tohide]'),
            $close = $response.find('[data-modal-response-close]'),
            $valid = $response.find('[data-modal-response-valid]');

        $close.on('click', function(e) {
            e.preventDefault();

            that.$modal.modal('hide');
        });

        if (0 < $form.length) {
            var callback = $form.data('modal-response-callback');

            $valid.on('click', function(e){
                e.preventDefault();
                $form.submit();
            });

            $form.on('submit', function(e) {
                e.preventDefault();

                $valid.prop('disabled', true);
                $valid.width($valid.width());
                $valid.html('<i class="fa fa-spinner fa-spin"></i>');

                $.ajax($form.attr('action'),
                {
                    data: $form.serialize(),
                    type: 'post',
                })
                .done(function (response, state, xhr) {
                    var contentType = xhr.getResponseHeader('content-type');

                    if (contentType.indexOf('json') > -1) {
                        that.closeAfterValidation(callback, response);
                        return;
                    }

                    var $response = $(response),
                        hasToClose = 0 == $response.find('.has-error').length;

                    if (hasToClose) {
                        that.closeAfterValidation(callback, response);
                    }

                    that.parseResponse(response);
                })
                .error(function () {
                    that.$modal.modal('hide');
                    new Flash().fireGenericError();
                });
            });
        } else if (0 < $formClassic.length) {
            $valid.on('click', function (e) {
                e.preventDefault();
                $formClassic.submit();
            });
        }

        $toHide.remove();

        this.bindModalElements($response);

        this.$modalContent
            .html($response)
            .fadeIn('normal');
    }

    closeAfterValidation(callback, response)
    {
        this.$modal.modal('hide');

        var modalCallback = new HandleModalCallback();

        if (undefined !== callback && 'undefined' !== typeof modalCallback[callback]) {
            modalCallback[callback](response);
        }
    }

    bindModalElements(response)
    {
        new HandleForm(response);
        new AutcompleterSelect2(response);
    }
}

export { HandleModal };
