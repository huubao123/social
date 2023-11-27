// JavaScript Document
(function($){
    $(document).ready(function(){
        var $window = $(window);

        // FIXED HEADER
        /*-----------------------------------------------------------------*/
            header = $('#header');
            if ($('#panel').length >0){ hPanel = $('#panel').height(); }else{ hPanel = 0; }
            if(header.hasClass('sticky')){
                h = header.height();
                afterHeader = $('<div class="afterHeader"> ');
                header.after(afterHeader.height(h))  
            }

        // TOGGLECLASS
        /*-----------------------------------------------------------------*/
            $(".toggleClass > .toggle").each(function () {
                $(this).click(function(){
                    $(this).parent().toggleClass('active');
                }); 
            }); 

        // TAB 
        /*-----------------------------------------------------------------*/
            function cttab() {   
                $("[class*='cttab'] .tab-menu > div").each(function () {
                    $(this).click(function () {
                        index = $(this).index();
                        menu = $(this).parent();
                        content = menu.parent().children('.tab-content');
                        menu.children().removeClass('active');
                        content.children().removeClass('active');
                        $(this).addClass('active');
                        content.children(':eq('+index+')').addClass('active');
                        content.children(':eq('+index+')').find('.imglazy').each(function(){
                            var src = $(this).attr('data-src');
                            $(this).attr('src', src);
                            $(this).removeClass('imglazy').addClass('imgloaded');
                        });                
                    });
                });   
            }
            cttab();

        // ACORDION 
        /*-----------------------------------------------------------------*/


        $('.box-collapse > .tab > .tab-title').each(function() {
            var btnInfo = $(this).click(function() {
                btnInfo.next().slideToggle(300);
                btnInfo.parent().toggleClass('show');
            });
        });
        $('.box-acordion > .tab > .tab-title').each(function(){
            $(this).click(function(){ 
                parent = $(this).parent();
                acordion = $(this).parent().parent();
                tab = acordion.children('.tab');
                if (parent.hasClass('show')) {
                    $(this).next().slideToggle(300);
                    parent.removeClass('show'); 
                } else {
                    //hide
                    acordion.children('.tab').children('.tab-content').slideUp(300);
                    tab.removeClass('show');
                    //show
                    $(this).next().slideDown(300);
                    parent.addClass('show');
                };
            });
        });        
        $('.box-acordion-slide > .tab > .tab-title').each(function(){
            $(this).click(function(){ 
                parent = $(this).parent();
                acordion = $(this).parent().parent();
                tab = acordion.children('.tab');
                if (parent.hasClass('show')) {
                    parent.removeClass('show'); 
                } else {
                    //hide
                    tab.removeClass('show');
                    //show
                    parent.addClass('show');
                };
            });
        });   




        // MENU MOBILE 
        /*-----------------------------------------------------------------*/
            $('.menu-btn').click(function(){
                $('body').toggleClass('showMenu'); 
            }); 

            
            $('.menu-top-header li[class*="children"]').each(function(){
                $(this).children('ul').wrap('<div class="wrapul"></div>');
            })

            wrapmb = $('.wrap-menu-mb');
            smb = wrapmb.data('style');
            wrapmb.find('li[class*="children"]').each(function(){
                var 
                li = $(this),
                idli = li.attr('id'),
                ul = li.children('ul');
                btn = $('<span>',{'class':'showsubmenu icon-2', text : '' });
                li.children('ul').children('li').children('ul').attr("data-parent",idli);
                //a.addClass('outactive').attr("data-parent",id);


                if(smb == 1){
                    btn.click(function(){
                    if(li.hasClass('parent-showsub')){
                        ul.slideUp(300,function(){
                            li.removeClass('parent-showsub');
                        });                           
                    }else{
                        ul.slideDown(300,function(){
                            li.addClass('parent-showsub');
                        });                           
                    }  
                    }); li.prepend(btn);
                }else if(smb == 2){
                    btn.click(function(){
                        li.toggleClass('activesubmenu');
                    }); li.prepend(btn);
                    var text = li.children('a').html();
                    var head = $('<div class="menu-head"><h3>'+text+'</h3><span class="back"><i class="icon-3"></i></span></div>');

                    ul.wrap('<div class="wrapul"></div>');

                    li.children('.wrapul').prepend(head);                    
                    $('.back').click(function(){
                        $(this).parent().parent().parent().removeClass('activesubmenu');
                    });  
                }else {
                    var text = li.children('a').html();
                    var head = $('<div class="menu-head"><h3>'+text+'</h3><span class="back"><i class="icon-3"></i></span></div>');

                    id = li.attr('id');
                    ulp = ul.data('parent');
                    ul.wrap('<div id="w-'+id+'" data-parent="w-'+ulp+'"  class="wrapul"></div>');
                    var wrap = li.children('.wrapul');
                    wrap.prepend(head);  
                    

                    wrapmb.append(wrap);

                    btn.click(function(){
                        id = $(this).parent().attr('id');
                        a = li.closest(".wrapul");
                        if (a.hasClass('outactive')){
                            a.removeClass('outactive').addClass('outactive2');
                        }else{
                            a.addClass('outactive');
                        }
                        wrapmb.children('#w-'+id+'').addClass('outactive');
                    }); li.prepend(btn);
                    
             
                    $('.back').click(function(){
                        pr = $(this).parent().parent();
                        id = pr.data('parent');
                        pr.removeClass('outactive');
                        a = wrapmb.children('#'+id+'');
                        if (id=='w-undefined'){
                            $('.wrapul.main').removeClass('outactive');
                        }else{
                            a.addClass('outactive').removeClass('outactive2');
                        }                        
                        
                    });  
                }   
            });    // append - prepend - after - before




        // MODAL 
        /*-----------------------------------------------------------------*/
            var getVideoUrl = function(id){
                return 'https://www.youtube.com/embed/' + id + '?rel=0&autoplay=1';
            }
            var closeVideoUrl = function(id){
                return 'https://www.youtube.com/embed/' + id + '?rel=0';
            }
            $('.btn-video-modal').each(function(){
                $(this).click(function(){
                    var b = $(this);    
                    var m = $('#videoModal');
                    var v = b.attr('data-video');     
                    m.addClass('show-video');
                    m.find('iframe').attr('src', getVideoUrl(v));
                }); 
            });   


            var showModal = function(id){
                    if($('div#'+id).hasClass('active')){
                        $('body').removeClass('show-modal');
                        $('div#'+id).removeClass('active');
                    }else{
                        $('body').addClass('show-modal');
                        $('div#'+id).addClass('active');
                    }            
            }   

            var closeModal = function(){
                $('body').removeClass('show-modal');
                $('.divmodal').removeClass('active');
                $('#videoModal').find('iframe').removeAttr('src');
                //$('#videoModal').find('iframe').attr('src', getVideoUrl(v));
            }       


            $('.btn-modal').click(function(){
                id = $(this).data('modal');
                showModal(id);
            }); 
            $('.close-modal').click(function(){
                closeModal();
            }); 


        // VIDEO
        /*-----------------------------------------------------------------*/
            function createVideo(p,vid,l){
                p.addClass('active');
                return new YT.Player(l.children().get(0), {
                    height: '900',
                    width: '1600',
                    videoId: vid,
                    playerVars: {
                        autoplay: 1,
                        controls: 0,
                        disablekb: 1,
                        hl: "ru-ru",
                        loop: 1,
                        modestbranding: 1,
                        showinfo: 0,
                        autohide: 0,
                        color: "white",
                        iv_load_policy: 3,
                        theme: "light",
                        mute: 0,
                        rel: 0
                    }                    
                });
            }
            function resv(l) {   
                var w = parseInt(l.width()),
                    h = parseInt(l.height()),
                    f = l.children('iframe'),
                    dw = f.attr("width"),
                    dh = f.attr("height");
                    if(w>h && (h/w<dh/dw)){
                        hf = (w*dh)/dw;
                        tf = -((hf - h)/2);
                        f.css({'width': "",'height': hf, 'top': tf, 'left': ""});
                    }else{
                        wf = (h*dw)/dh;
                        lf = -((wf - w)/2);
                        f.css({'width': wf,'height': "", 'top': "", 'left': lf});                    
                    }                        
            }  


            function resVideo() {    
                $(".wrapVideoBg").each(function () {
                    resv($(this));
                }); 
            }
            resVideo();
            $window.resize(function(){
                resVideo();
            });            



            if ( $(".single_item_video").length > 0) {
                var t = document.createElement("script");
                t.src = "https://www.youtube.com/iframe_api";
                var a = document.getElementsByTagName("script")[0];
                a.parentNode.insertBefore(t, a);
                var players = [];            
                $(".single_item_video").each(function() {
                    var p = $(this),
                        b = p.children('.btnvideo'),
                        l = p.children('.video'),
                        o = l.attr("data-video");
                        b.click(function() {
                            for(var i=0; i < players.length; i++){
                                players[i].pauseVideo();
                            }
                            if(l.children('iframe').length > 0){
                            }else{
                                players.push(createVideo(p,o,l));
                                resv(l);
                            }    
                        });                             

                        $(window).resize(function(){
                            resv(l);
                        });   
                })
            }  



        // EQUAL HEIGHT
        /*-----------------------------------------------------------------*/

            function followequal() {        
                $(".followHeight").each(function () {
                    var $this = $(this),
                        $equal2 = $this.find(".equal2").height();
                    $this.find(".equal1").height($equal2);
                    //$this.find(".equal1").css("min-height", $equal2);
                });    
            }        

            // equalHeight
            function equal() {
                $(".equalHeight").each(function () {
                    var $this = $(this),
                        $equal = $this.find(".equal");
                    var padding = $this.attr('data-padding');                    
                    if(!padding)   padding = 0 ;
                    if ($this.length > 0) {
                      $equal.imagesLoaded(function () {
                        equalHeight($equal, parseInt(padding));
                      });
                    }
                });    
            }        

            /* Equal Height good*/
            function equalHeight(className, padding) {
              var tempHeight = 0;
              $(className).each(function () {
                current = $(this).height();
                if (parseInt(tempHeight) < parseInt(current)) {
                  tempHeight = current;
                }
              });
              $(className).css("height", tempHeight + padding + "px");
            }



        // CLICK SCROLL
        /*-----------------------------------------------------------------*/
            // Click scroll a
            $(".scroll").on('click', function (event) {
              event.preventDefault();
              $('html,body').animate({scrollTop: 0 }, 1000);
            });
            // var test = ['.aaa','bbb'];
            // test.equal2();     

            $('.aaa,.bbb').equal2(2);   
            $('.ccc,.dddddd,.wer').equal2(35);   

            // Back-top
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('#back-top').addClass('show');
                } else {
                    $('#back-top').removeClass('show');
                }
            });
            $('#back-top').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });




        // LAZYLOAD
        /*-----------------------------------------------------------------*/
            "use strict";
            var BJLL_options = BJLL_options || {},
                BJLL = {
                    _ticking: !1,
                    check: function() {
                        if (!BJLL._ticking) {
                            BJLL._ticking = !0, void 0 === BJLL.threshold && (void 0 !== BJLL_options.threshold ? BJLL.threshold = parseInt(BJLL_options.threshold) : BJLL.threshold = 200);
                            var e = document.documentElement.clientHeight || body.clientHeight,
                                t = !1,
                                n = document.getElementsByClassName("lazy-hidden");
                            [].forEach.call(n, function(n, a, i) {
                                var s = n.getBoundingClientRect();
                                e - s.top + BJLL.threshold > 0 && (BJLL.show(n), t = !0)
                            }), BJLL._ticking = !1, t && BJLL.check()
                        }
                    },
                    show: function(e) {
                        e.className = e.className.replace(/(?:^|\s)lazy-hidden(?!\S)/g, ""), e.addEventListener("load", function() {
                            e.className += " lazy-loaded", BJLL.customEvent(e, "lazyloaded");
                            followequal();  
                        }, !1);
                        var t = e.getAttribute("data-lazy-type");
                        if ("image" == t) null != e.getAttribute("data-lazy-srcset") && e.setAttribute("srcset", e.getAttribute("data-lazy-srcset")), null != e.getAttribute("data-lazy-sizes") && e.setAttribute("sizes", e.getAttribute("data-lazy-sizes")), e.setAttribute("src", e.getAttribute("data-lazy-src"));

                        else if ("bg" == t) {
                            var n = e.getAttribute("data-lazy-src");
                            e.style.backgroundImage = 'url(' + n + ')';
                            e.className += ' lazy-loaded';
                            followequal();  
                        }
                        else if ("iframe" == t) {
                            var n = e.getAttribute("data-lazy-src"),
                                a = document.createElement("div");
                            a.innerHTML = n;
                            var i = a.firstChild;
                            e.parentNode.replaceChild(i, e);
                            followequal();  
                        }
                    },
                    customEvent: function(e, t) {
                        var n;
                        document.createEvent ? (n = document.createEvent("HTMLEvents")).initEvent(t, !0, !0) : (n = document.createEventObject()).eventType = t, n.eventName = t, document.createEvent ? e.dispatchEvent(n) : e.fireEvent("on" + n.eventType, n)
                    }
                };
            window.addEventListener("load", BJLL.check, !1), window.addEventListener("scroll", BJLL.check, !1), window.addEventListener("resize", BJLL.check, !1), document.getElementsByTagName("body").item(0).addEventListener("post-load", BJLL.check, !1);


        // RESPONSIVE
        /*-----------------------------------------------------------------*/


        
        $window.bind("load", function() {
            equal();
            followequal();   
        });        

        isRes = function(){return $window.width() > 767};
        $window.resize(function(){
            //if(isRes()){ followequal();}
            followequal();
            equal(); 
        });



        // THEME
        /*-----------------------------------------------------------------*/
        bgmg14 = $('.mg14 .row-3').innerHeight();
        $('.mg14>.bgwhite').height(bgmg14 + 320);



    }); 

})(jQuery); 

jQuery.fn.extend({
    // equalHeight
    equal2: function(padding) {
        var tempHeight = 0;
        var here = this;
        here.each(function(){
            tempHeight = tempHeight > this.offsetHeight ? tempHeight : this.offsetHeight;    //kiem chieu cao lon nhat
        }); 
        
        here.css("height", tempHeight + padding + "px");
    },
});



