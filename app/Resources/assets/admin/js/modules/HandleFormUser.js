class HandleFormUser
{
    /**
     * HandleFormUser.
     *
     * @param  {jQuery $(element)} container
     * @return {void}
     */
    constructor(container)
    {
        this.container = undefined === container ? $('body') : container;

        this.authorities = $('[data-piloted-authorities]');
        this.rolesSelect = this.container.find('[data-user-roles] select');

        if (this.authorities.hasClass('hidden')) {
            this.authorities.hide().removeClass('hidden');
        }

        this.toggleAuthorities();
        this.bind();
    }

    bind()
    {
        var that = this;

        this.rolesSelect.on('change', function() {
            that.toggleAuthorities();
        });
    }

    toggleAuthorities()
    {
        var roles = [];

        this.rolesSelect.find('option:selected').each(function () {
            roles.push($(this).data('value'));
        });

        if (-1 !== $.inArray(this.authorities.data('piloted-authorities'), roles)) {
            this.authorities.fadeIn();
        } else {
            this.authorities.fadeOut();
            this.authorities.find('select').val('').trigger('change');
        }
    }
}

export { HandleFormUser };
