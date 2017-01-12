import { HandleDatatableOne } from './HandleDatatableOne'

class HandleDatatable
{
    /**
     * HandleDatatable.
     *
     * @param  {element} container
     * @return {void}
     */
    constructor(container)
    {
        this.container = undefined === container ? $('body') : container;
        this.container.find('[data-table-wrapper-all]').each(function () {
            new HandleDatatableOne($(this));
        })
    }
}

export { HandleDatatable };
