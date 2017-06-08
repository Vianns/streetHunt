window.$ = require('jquery');
window.jQuery = require('jquery');

require('bootstrap-sass');
require('../libs/js/dynatable/dynatable.js');

$(document).ready(function(){

    $(".open-right").click(function(e){
        $("#wrapper").toggleClass("open-right-sidebar");
  	     e.stopPropagation();
  	     $("body").trigger("resize");
    });

    $(".open-left").click(function(e){
        e.stopPropagation();
        $("#wrapper").toggleClass("enlarged");
        $("#wrapper").addClass("forced");

        if ($("#wrapper").hasClass("enlarged")){
            $("body").addClass("small-left");
            $(".left ul").removeAttr("style");
        } else {
            $("body").removeClass("small-left");
            $(".subdrop").siblings("ul:first").show();
        }

        $("body").trigger("resize");
    });

    $("#sidebar-menu a").on('click',function(e){
        if(!$("#wrapper").hasClass("enlarged")){

            if($(this).parent().hasClass("has_sub")) {
                e.preventDefault();
            }

            if(!$(this).hasClass("subdrop")) {
                // hide any open menus and remove all other classes
                $("ul",$(this).parents("ul:first")).slideUp(350);
                $("a",$(this).parents("ul:first")).removeClass("subdrop");
                $("#sidebar-menu .pull-right i").removeClass("fa-angle-up").addClass("fa-angle-down");

                // open our new menu and add the open class
                $(this).next("ul").slideDown(350);
                $(this).addClass("subdrop");
                $(".pull-right i",$(this).parents(".has_sub:last")).removeClass("fa-angle-down").addClass("fa-angle-up");
                $(".pull-right i",$(this).siblings("ul")).removeClass("fa-angle-up").addClass("fa-angle-down");
            } else if ($(this).hasClass("subdrop")) {
                $(this).removeClass("subdrop");
                $(this).next("ul").slideUp(350);
                $(".pull-right i",$(this).parent()).removeClass("fa-angle-up").addClass("fa-angle-down");
                //$(".pull-right i",$(this).parents("ul:eq(1)")).removeClass("fa-chevron-down").addClass("fa-chevron-left");
            }
        }
    });

    // NAVIGATION HIGHLIGHT & OPEN PARENT
    $("#sidebar-menu ul li.has_sub a.active").parents("li:last").children("a:first").addClass("active").trigger("click");

    $('[data-dynatable]').dynatable();

    tinymce.init({
        selector: '[data-tinymce]',
        language: 'fr_FR',
        plugins: [
            "code",
            "advlist autolink link image lists charmap print preview hr anchor pagebreak fullscreen",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager autoresize"
        ],
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
        toolbar1: "bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | preview code | fullscreen",
        image_advtab: true ,
        external_filemanager_path: "/filemanager/",
        filemanager_title: "File manager",
        filemanager_access_key: '01ec155031e70e869eeef6995b6a846db6b583a8',
        filemanager_language: 'en_EN',
        external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
    });
});
