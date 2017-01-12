class HandleButton
{
    /**
     * HandleForm.
     *
     * @param  {element} container
     * @return {void}
     */
    constructor(container)
    {
        this.container = undefined === container ? $('body') : container;
    }
}

export { HandleButton };
