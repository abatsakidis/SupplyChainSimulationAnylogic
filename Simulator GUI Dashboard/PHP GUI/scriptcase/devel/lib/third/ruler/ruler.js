var rulerId= 0;
(function ( $ ) {
    $.elementWidth = $(this).innerWidth();
    $.elementHeight = $(this).innerHeight();
    var settings;

    $.fn.units = {
        cm : 0.02645833333333,
        mm : 0.2645833333333,
        in : 0.01041666666667,
        pt : 0.7528125,
        px : 1
    };
    $.fn.unitNow= 1;
    $.fn.ruler = function(options) {
        settings = $.extend({
            // These are the defaults.
            elementWidth: this.innerWidth(),
            elementHeight: this.innerHeight(),
            color: "#556b2f",
            backgroundColor: "#CECECE",
            debug: false,
            cursorPosition:false,
            rulerHorizontal:true,
            rulerVertical:true,
            unit:'px',
            menu : true,
            rulerId:0
        }, options );
        if(settings.rulerId == 0)
        {
            rulerId++;
            settings.rulerId =rulerId;
        }

        $.fn.changeRuler(settings.unit);

        this.addClass('rulerWorking').css({
                                            width: settings.elementWidth,
                                            height: settings.elementHeight
                                          });

        if(settings.rulerHorizontal) this.prepend(createHorizontal());
        if(settings.rulerVertical) this.prepend(createVertical());

        if(settings.debug)
        {
            rulerDebug(settings);
        }

        if(settings.cursorPosition)
        {
            showGuide(this);
            cursorPosition(this);
        }
        if(settings.menu) createMenu(this);
        return this;
    };

    $.fn.refresh = function()
    {
        destroy();
        this.ruler(settings);
    }

    function destroy()
    {
        $('.scriptcaseRuler-'+settings.rulerId).remove();
    }

    function createMenu(t)
    {

        $(t).prepend(
            create('div').css({position: 'absolute', top:0, left:5, zIndex:99999})
                        .addClass('rulerOptions')
                        .append(create('ul')
                                    .append(create('li').attr('data-rel', 'mm').html('mm').on('click', function(){$.fn.changeRuler($(this).attr('data-rel'))}))
                                    .append(create('li').attr('data-rel', 'cm').html('cm').on('click', function(){$.fn.changeRuler($(this).attr('data-rel'))}))
                                    .append(create('li').attr('data-rel', 'in').html('in').on('click', function(){$.fn.changeRuler($(this).attr('data-rel'))}))
                                    .append(create('li').attr('data-rel', 'pt').html('pt').on('click', function(){$.fn.changeRuler($(this).attr('data-rel'))}))
                                )
                        .on('click', function(){
                                $('ul', this).toggle();
                            })
                   );
    }

    $.fn.changeRuler = function(option)
    {
        $.fn.unitNow = eval("$.fn.units."+option);
        $('.h_ruler_mark, .v_ruler_mark').each(function(i,t)
        {
            $(t).html( Math.floor($.fn.unitNow  * $(t).attr('data-px')*10)/10 );
        });
    }

    function create(tag){
        elm = document.createElement(tag.toUpperCase());
        return $(elm).addClass('scriptcaseRuler-'+rulerId);
    }

    function rulerDebug(t)
    {
        console.log(t);
    }

    function createVertical()
    {
        var vDiv = create("div")
            .addClass("ruler").addClass("v")
            .css('height', settings.elementHeight);

        for(var i=0; i <= settings.elementHeight/18; ++i)
        {
            var span = create('span');
            if(i%4 == 0 )
            {
                span.html(create('span')
                    .html(i*18)
                    .attr('data-px', i*18)
                    .attr('id', 'id_v_'+i*18)
                    .addClass('v_ruler_mark')
                    .css({
                        left: 8,
                        position: 'absolute',
                        border:'none',
                        textAlign: 'center',
                        paddingTop:0,
                        marginTop:-6
                        })
                );
            }

            if(i*2 == settings.elementHeight)
            {
                span.css({top: '-1px', position: 'relative'});
            }

            vDiv.append(span);
        }
        return vDiv;
    }

    function createHorizontal()
    {
        var hDiv = create("div")
            .addClass("ruler").addClass("h");
            //.css('width', settings.elementWidth+46);
        var ml = 15;

        for(var i=0; i <= settings.elementWidth/18; ++i)
        {
            var span = create('span');
            var verifier = i+1 >= (settings.elementWidth)/18;
            if( i%4 == 0 || verifier)
            {
                if(i*6 > 100  && ml == 15){ ml = ml - 2; }
                if(i*6 > 1000 && ml == 13){ ml = ml - 3; }

                span.html(create('span')
                    .html(i*18 )
                    .attr('data-px', i*18)
                    .attr('id', 'id_h_'+i*18)
                    .addClass('h_ruler_mark')
                    .css({position:'absolute',
                        top:1,
                        textAlign:'center',
                        border:'none',
                        padding:0,
                        marginLeft: ml+'px'})
                );
            }
            hDiv.append(span);
        }
        return hDiv;
    }

    function cursorPosition(t)
    {
        t.append(create('div').attr('id', 'ruler_div_position').addClass('followme').html("To te seguindo"));
        $(document).on('mousemove', function(e){
            $('#ruler_div_position').css({left:  e.pageX +10,top:   e.pageY +10}).html("Left: "+Math.floor((e.pageX -37)*$.fn.unitNow*10)/10 + "<br/>Top: " + Math.floor((e.pageY-33)*$.fn.unitNow*10)/10);
        });
    }
    function showGuide(t)
    {
        t.append(create('div').attr('id', 'h_guide').addClass('h_guide').addClass('guide').css({width: settings.elementWidth +70, left:0}));
        t.append(create('div').attr('id', 'v_guide').addClass('v_guide').addClass('guide').css({height: settings.elementHeight +64, top:0}));
        $(document).on('mousemove', function(e){
            $('#h_guide').css({top:   e.pageY -2});
            $('#v_guide').css({left:   e.pageX -2});
        });

        t.on("mouseover", t, function() {
            $('.guide').show();
            $('#ruler_div_position').show();
        });
        t.on("mouseout", t, function() {
            $('.guide').hide();
            $('#ruler_div_position').hide();
        });
    }

}( jQuery ));