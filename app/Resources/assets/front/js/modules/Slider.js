window.jQuery = require('jquery');
window.$ = require('jquery');

require('slider-pro');

class Slider
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
        this.container.find('.slider-pro' ).sliderPro({
            width: 940,
            height: 340,
            arrows: true,
            buttons: true,
            waitForLayers: true,
            thumbnailWidth: 200,
            thumbnailHeight: 100,
            thumbnailPointer: true,
            autoplay: false,
            autoScaleLayers: false,
            breakpoints: {
                500: {
                    thumbnailWidth: 120,
                    thumbnailHeight: 50
                }
            }
        });

        // // instantiate fancybox when a link is clicked
        // $( '#example2 .sp-image' ).parent( 'a' ).on( 'click', function( event ) {
        //     event.preventDefault();

        //     // check if the clicked link is also used in swiping the slider
        //     // by checking if the link has the 'sp-swiping' class attached.
        //     // if the slider is not being swiped, open the lightbox programmatically,
        //     // at the correct index
        //     if ( $( '#example2' ).hasClass( 'sp-swiping' ) === false ) {
        //         $.fancybox.open( $( '#example2 .sp-image' ).parent( 'a' ), { index: $( this ).parents( '.sp-slide' ).index() } );
        //     }
        // });
    }
}

export { Slider }
