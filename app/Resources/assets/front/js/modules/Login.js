window.jQuery = require('jquery');
window.$ = require('jquery');

class Login
{
    constructor(autobind, container)
    {
        this.container = undefined === container ? $('body') : container;

        if (undefined === autobind) {
            autobind = true;
        }

        if (autobind) {
            this.bind();
        }
    }

    bind()
    {
        var working = false;

        this.container.find('.login-form').on('submit', function(e) {
            // e.preventDefault();

            if (working) return;
            working = true;

            var $this = $(this),
            $state = $this.find('button > .state');
            $this.addClass('loading');
            $state.html('Authenticating');
        });
    }
}

export { Login }


