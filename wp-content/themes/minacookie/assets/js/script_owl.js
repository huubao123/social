

(function ($) {
    $(document).ready(function () {
        // Responsive OWL    
        function ResOwlSlider() {
            $(".OwlSlider.owl-carousel").each(function () {
                var $slider = $(this);
                var responsive =  $slider.attr('data-res');
                var margin =  $slider.attr('data-margin');    
                var autospeed = $slider.attr('data-autospeed'); 
                var dataout = $slider.attr('data-out'); 
                var datain = $slider.attr('data-in'); 

                if(!responsive) { responsive = '1,1,1,1,1'; }
                responsive = responsive.split(',');
                if(!margin) { margin = '0,0,0,0,0'; }
                margin = margin.split(',');

                //console.log(dataout);
                $slider.imagesLoaded(function(){    
                    $slider.owlCarousel({
                        navText: ["<i class='icon-161'></i>","<i class='icon-171'></i>"],
                        nav:($slider.hasClass('s-nav') ? true : false),
                        dots:($slider.hasClass('s-dots') ? true : false),
                        loop: $slider.hasClass('s-loop') ? true : false,
                        autoplay: $slider.hasClass('s-auto') ? true : false,
                        autoplayHoverPause:true,
                        autoplayTimeout: (autospeed ? parseInt(autospeed) : 5000),
                        center: $slider.hasClass('s-center') ? true : false,
                        autoWidth: ($slider.hasClass('s-width') ? true : false),
                        autoHeight: ($slider.hasClass('s-height') ? true : false),
                        lazyLoad:($slider.hasClass('s-lazy') ? true : false),
                        video:($slider.hasClass('s-video') ? true : false),
                        animateOut: dataout,
                        animateIn: datain,       

                        responsive:{
                            0:{
                                margin: parseInt(margin[4]),
                                items:parseInt(responsive[4]),
                                lazyLoad:true
                            },
                            480:{
                                margin: parseInt(margin[3]),
                                items:parseInt(responsive[3]),
                                lazyLoad:true
                            },
                            768:{
                                margin: parseInt(margin[2]),
                                items:parseInt(responsive[2]),
                                lazyLoad:true
                            },
                            992:{
                                margin: parseInt(margin[1]),
                                items:parseInt(responsive[1]),
                                lazyLoad:true
                            },
                            1200:{
                                margin: parseInt(margin[0]),
                                items:parseInt(responsive[0]),
                                lazyLoad:true
                            }

                        }
                    })

                });
            });    
        }        
        ResOwlSlider();    


        // Responsive OWL    
        function SynOwlSlider() {
            $(".wrap-syn-owl").each(function () {
                var $this = $(this);
                var sync1 = $this.find(".syn-slider-1");
                var sync2 = $this.find(".syn-slider-2");

                var autospeed = sync1.attr('data-autospeed'); 

                var autospeed2 = sync2.attr('data-autospeed'); 
                var responsive =  sync2.attr('data-res').split(',');
                var margin =  sync2.attr('data-margin').split(',');  


                var dataout1 = sync1.attr('data-out'); 
                var datain1 = sync1.attr('data-in'); 

                  var slidesPerPage = 5; //globaly define number of elements per page
                  var syncedSecondary = true;

                  sync1.owlCarousel({
                    singleItem: true,
                    items:1,
                    loop: true,
                    navText: ["<i class='icon-161'></i>","<i class='icon-171'></i>"],
                    nav:(sync1.hasClass('s-nav') ? true : false),
                    dots:(sync1.hasClass('s-dots') ? true : false),
                    autoplay: sync1.hasClass('s-auto') ? true : false,
                    autoplayHoverPause:true,
                    autoplayTimeout: (autospeed ? parseInt(autospeed) : 5000),
                    center: sync1.hasClass('s-center') ? true : false,
                    autoWidth: (sync1.hasClass('s-width') ? true : false),
                    autoHeight: (sync1.hasClass('s-height') ? true : false),
                    lazyLoad:(sync1.hasClass('s-lazy') ? true : false),
                    video:(sync1.hasClass('s-video') ? true : false),
                        animateOut: dataout1,
                        animateIn: datain1,                           


                  }).on('changed.owl.carousel', syncPosition);

                  sync2
                    .on('initialized.owl.carousel', function () {
                      sync2.find(".owl-item").eq(0).addClass("current");
                    })
                    .owlCarousel({
                        smartSpeed: 200,
                        slideSpeed : 500,
                        slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                        responsiveRefreshRate : 100,
                        navText: ["<i class='icon-161'></i>","<i class='icon-171'></i>"],
                        nav:(sync2.hasClass('s-nav') ? true : false),
                        dots:(sync2.hasClass('s-dots') ? true : false),
                        autoWidth: (sync2.hasClass('s-width') ? true : false),
                        autoHeight: (sync2.hasClass('s-height') ? true : false),
                        lazyLoad:(sync2.hasClass('s-lazy') ? true : false),
                        responsive:{
                            0:{
                                margin: parseInt(margin[4]),
                                items:parseInt(responsive[4])
                            },
                            480:{
                                margin: parseInt(margin[3]),
                                items:parseInt(responsive[3])
                            },
                            768:{
                                margin: parseInt(margin[2]),
                                items:parseInt(responsive[2])
                            },
                            992:{
                                margin: parseInt(margin[1]),
                                items:parseInt(responsive[1])
                            },
                            1200:{
                                margin: parseInt(margin[0]),
                                items:parseInt(responsive[0])
                            }

                        }

                  }).on('changed.owl.carousel', syncPosition2);

                  function syncPosition(el) {
                    //if you set loop to false, you have to restore this next line
                    //var current = el.item.index;
                    
                    //if you disable loop you have to comment this block
                    var count = el.item.count-1;
                    var current = Math.round(el.item.index - (el.item.count/2) - .5);
                    
                    if(current < 0) {
                      current = count;
                    }
                    if(current > count) {
                      current = 0;
                    }
                    
                    //end block

                    sync2
                      .find(".owl-item")
                      .removeClass("current")
                      .eq(current)
                      .addClass("current");
                    var onscreen = sync2.find('.owl-item.active').length - 1;
                    var start = sync2.find('.owl-item.active').first().index();
                    var end = sync2.find('.owl-item.active').last().index();
                    
                    if (current > end) {
                      sync2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                      sync2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                  }
                  
                  function syncPosition2(el) {
                    if(syncedSecondary) {
                      var number = el.item.index;
                      sync1.data('owl.carousel').to(number, 100, true);
                    }
                  }
                  
                  sync2.on("click", ".owl-item", function(e){
                    e.preventDefault();
                    var number = $(this).index();
                    sync1.data('owl.carousel').to(number, 300, true);
                  });
            });    
        }        
        SynOwlSlider();    
    });
})(jQuery); 