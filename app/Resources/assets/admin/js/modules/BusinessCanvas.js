class BusinessCanvas
{
    constructor()
    {
        this.bind();
    }

    bind()
    {
        var fieldCount = $('[data-field-count]').data('field-count');
        var that = this;
        $(document).on('click', '[data-add-field]', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var fieldList = $('[data-field-list]');

            var newWidget = fieldList.attr('data-prototype');
            newWidget = newWidget.replace(/__name__/g, fieldCount);
            fieldCount++;

            $(newWidget).appendTo(fieldList);
        });

        $(document).on('click', '[data-delete-field]', function(e){
            e.preventDefault();
            e.stopPropagation();

            $(this).parent().remove();
        });
    }
}

export { BusinessCanvas }
