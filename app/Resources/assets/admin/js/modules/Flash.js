class Flash
{
    constructor(element)
    {
        this.dataFlash = {};
        this.element = null;

        if (element && 0 < element.length) {
            this.element = element;
            this.dataFlash = this.element.data();
            this.build();
        }
    }

    setElement(element)
    {
        this.element = element;
    }

    setDataFlash(dataFlash)
    {
        this.dataFlash = dataFlash;
    }

    build()
    {
        var alert;

        this.btnClose = $('<span>')
            .append('<i class="fa fa-times-circle flash-close"></i>');

        alert = $('<div>')
            .addClass('alert')
            .addClass('alert-' + this.dataFlash.type)
            .addClass('animated bounceInRight')
            .html(this.dataFlash.message)
            .append(this.btnClose);

        this.element.append(alert);
        this.bind();
    };

    bind()
    {
        var that = this;
        this.btnClose.on('click', function () {
            that.destroy();
        });
        setTimeout(function () {
            that.destroy();
        }, 5000);
    };

    destroy()
    {
        var that = this;
        this.element.fadeOut(200, 'linear', function () {
            that.element.remove();
        });
    };

    fire(message, type)
    {
        var flashContainer = $('[data-flash-container]'),
            element = $('<div>').attr('data-flash', '');

        flashContainer.append(element);
        this.setElement(element);

        this.setDataFlash({
            message: message,
            type: type
        });

        this.build();

        return this;
    };
}

export { Flash };
