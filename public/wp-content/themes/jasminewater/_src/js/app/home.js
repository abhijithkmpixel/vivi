jQuery.noConflict();
jQuery( document ).ready(function( $ ) {

  /* Social Posts */
  var social = $('section.social');
  if(social.length){
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajax_url,
      data: {
        'action' : 'fetch_posts', 
        'shop' : 'localhost',
        'stream-id' : 1,
        'disable-cache': '',
        'hash': '',
        'page': 0,
        'preview': 0,
        'token': 0,
        'boosted': 0
      },
      success: function (data) {
        var social = '';
        for (var item of data.items) {
          social += `<div class="col">
            <div class="card">
              <a href="` +item.permalink+ `" target="_blank" class="link">
                <picture class="social-item-picture">
                  <source srcset="` +item.media.url+ `" type="image/jpeg"> 
                  <img src="` +item.media.url+ `" width="288px" height="280px" alt="VIVI">
                </picture>
              </a>
            </div>
          </div>`;
        }
        $('#social-wall-container').empty().append(social);
      }
    });
  }

  var bannerHome = new Swiper('.banner-slider', {
    direction: 'horizontal',
    loop: false,
    effect: 'fade',
    speed: 300,
    autoplay: 5000,
    autoplayDisableOnInteraction: false,
    pagination: {
      el: '.banner-slider .swiper-pagination .container',
      clickable: true
    },
    on: {
      init: function () {
        // $('.banner-slider .swiper-slide .aos-init').removeClass('aos-animate');
        $('.banner-slider .swiper-slide.swiper-slide-active .aos-init').addClass('aos-animate');
      },
      slideChangeTransitionStart: function () {
        $('.banner-slider .swiper-slide .aos-init').removeClass('aos-animate');
      },
      slideChangeTransitionEnd: function () {
        $('.banner-slider .swiper-slide.swiper-slide-active .aos-init').addClass('aos-animate');
      }
    }
  });
  
  var contentSlider = new Swiper('.content-slider', {
    direction: 'horizontal',
    loop: false,
    speed: 600,
    autoplay: 6000,
    autoplayDisableOnInteraction: false,
    onSlideChangeStart: function(s) {  
      var x = s.activeIndex;
      console.log(x);
    },
    pagination: {
      el: '.content-slider .swiper-pagination .container',
      clickable: true
    }
  });

  var slide = new Swiper('.swiper-container-slide', {
    loop: true,
    effect: 'coverflow',
    grabCursor: false,
    parallax: true,
    centeredSlides: true,
    slideToClickedSlide: true,
    slidesPerView: 3,
    coverflowEffect: {
      rotate: 150,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
    }
  });

  const locoScroll = new LocomotiveScroll({
    el: document.querySelector('[data-scroll-container]'),
    smooth: 0,
    useKeyboard: true,
    repeat: false,
    resetNativeScroll: true,
    class: 'is-inview',
    initClass: 'has-scroll-init',
    scrollbarClass: 'c-scrollbar',
    scrollingClass: 'has-scroll-scrolling',
    draggingClass: 'has-scroll-dragging',
    smoothClass: 'has-scroll-smooth',
    getDirection: true
  }).on('scroll', (arg) => {
    var el = document.querySelector('body');
    
    if(arg.scroll.y > 100){
      el.classList.add('show-sticky');
    } else {
      if(el.classList.contains('show-sticky')){
        el.classList.remove('show-sticky');
      }
    }
    
    if(arg.direction == 'up'){
      el.classList.add('up');
      if(el.classList.contains('down')){
        el.classList.remove('down');
      }
    } else {
      el.classList.add('down');
      if(el.classList.contains('up')){
        el.classList.remove('up');
      }
    }
  
  });
  
  window.addEventListener('load', (event) => {
    var resizeEvent = window.document.createEvent('UIEvents'); 
    resizeEvent.initUIEvent('resize', true, false, window, 0); 
    window.dispatchEvent(resizeEvent);
  });

  $('#mobile_menu_close_btn').click(function(e){
    $('#site-navigation').removeClass('toggled');
    e.preventDefault();
  });

});