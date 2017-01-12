class HandlePutAction
{

    constructor(container)
    {
        this.container = undefined === container ? $('body') : container;
        this.loader = '<i class="fa fa-refresh fa-spin"></i>';
        this.actionsTypes = ['put', 'delete'];
        this.bind();
    }


    bind()
    {
        var that = this;

        $.each(this.actionsTypes, function(i, type) {
            that.container.find('[data-'+type+'-action]').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                var $button = $(this);

                $.ajax({
                    type: type,
                    url: $(this).attr('href'),
                    success: function (datas) {
                        $button.css('width', $button.outerWidth()).html(that.loader);
                        $(location).attr('href',datas.redirectUrl);
                    }
                });
            });
        });
    }

}

export { HandlePutAction };
