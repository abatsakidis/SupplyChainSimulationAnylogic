var globalResizeId = 0;
(function ( $ ) {
    $.element;
    $.settings;
    $.markResize = {bottom:false, top:false, left:false, right:false};

    $.fn.resize = function(options) {

        $.settings = $.extend({
            bottom:true,
            top:true,
            left: true,
            right:true,
            resizeId:0
        }, options );
        $.element = this;

        if($.settings.resizeId == 0)
        {
            globalResizeId++;
            $.settings.resizeId =globalResizeId;
        }
        createSizer();
    }

    function createSizer()
    {
        var clicked = false;
        if($.settings.bottom)
        {
            $.markResize.bottom = create('div').addClass('resize-bottom').css({top:($.element.height())});
            $.element.prepend($.markResize.bottom);
            $.element.height($.element.height()+2);
            $.markResize.bottom.on({
                mousedown: function()
                {
                    $(this).addClass("resize-move");
                    $.markResize.bottom.width($.markResize.bottom.width());
                    clicked = true;
                },
                mousemove: function(e)
                {
                    if(clicked)
                    {
                        alert($(this).offset().top);
                        alert(e.clientY + ' ++ ' + event.clientY);
                    }
                },
                mouseup: function()
                {
                    $(this).removeClass("resize-move");
                    clicked = false;
                }
            })
        }
    }
    function create(tag){
        elm = document.createElement(tag.toUpperCase());
        return $(elm).addClass('scriptcaseResize-'+$.settings.resizeId);
    }
}( jQuery ));