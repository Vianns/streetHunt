class HandleConfirm
{
    /**
     * HandleConfirm.
     *
     * @param  {element} container
     * @return {void}
     */
    constructor(container)
    {
        this.container = undefined === container ? $('body') : container;
        this.bind();
    }

    bind()
    {
        this.container.find('[data-confirm]').on('click', function (e) {
            if (!confirm($(this).data('confirm'))) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();

                return false;
            }
        });
    }
}

export { HandleConfirm };
