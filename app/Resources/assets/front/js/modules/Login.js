window.jQuery = require('jquery');
window.$ = require('jquery');

class Login
{
    constructor(autobind)
    {
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

        $('.login-form').on('submit', function(e) {
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


