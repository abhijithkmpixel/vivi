jQuery.noConflict();
jQuery( document ).ready(function( $ ) {

  $.validator.addMethod("letters", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
  }, val_char);
  
  $.validator.addMethod('phone', function(value, element) {
    return value.match(/^\+(?:[0-9] ?){6,14}[0-9]$/);
  }, val_phone);
  
  $.validator.addMethod("email", function(value, element) {
    return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
  }, val_mail);

  $.validator.setDefaults({
    debug: false,
    errorElement: 'span',
    errorClass: 'validate error',
  });

  $("form[name='checkout']").validate({
    rules: {
      billing_first_name: {
        required: true,
        letters: true
      },
      billing_last_name: {
        required: true,
        letters: true
      },
      billing_address_1: {
        required: true,
      },
      billing_city: {
        required: true,
      },
      billing_email: {
        required: true,
        email: true
      },
      billing_phone: {
        required: true,
        // phone: true
      },
      intlTelInput: {
        required: true,
        phone: true
      }
    },
    messages: {
      billing_first_name: val_fname,
      billing_last_name: val_lname,
      billing_address_1: val_baddr,
      billing_city: val_city,
      billing_email: {
        required: val_rfld,
        email: val_mail
      },
      billing_phone: {
        required: val_rfld,
        phone: val_phone
      },
      intlTelInput: {
        required: val_rfld,
        phone: val_phone
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  
  $("form[name='update-profile']").validate({
    rules: {
      account_first_name: {
        required: true,
        letters: true
      },
      account_last_name: {
        required: true,
        letters: true
      },
      account_display_name: {
        required: true,
      },
      account_email: {
        required: true,
        email: true
      },
      user_phone: {
        required: true,
      },
      intlTelInput: {
        required: true,
        phone: true
      },
      password_current: {
        // required: true,
        minlength: 8
      },
      password_1: {
        // required: true,
        minlength: 8
      },
      password_2: {
          // required: true,
          minlength: 8,
          equalTo: "#password_1"
      }
    },
    messages: {
      account_first_name: val_fname,
      account_last_name: val_lname,
      account_display_name: val_rfld,
      account_email: {
        required: val_rfld,
        email: val_mail
      },
      user_phone: {
        required: val_rfld,
        phone: val_phone
      },
      intlTelInput: {
        required: val_rfld,
        phone: val_phone
      },
      password_current: {
        // required: "Please provide current password",
        minlength: val_pmin
      },
      password_1: {
        // required: "Please provide a password",
        minlength: val_pmin
      },
      password_2: {
        // required: "Please confirm password",
        minlength: val_pmin,
        equalTo: val_peqr
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  
  $("form[name='registration']").validate({
    rules: {
      billing_first_name: {
        required: true,
        letters: true
      },
      billing_last_name: {
        required: true,
        letters: true
      },
      billing_address_1: {
        required: true,
      },
      billing_city: {
        required: true,
      },
      email: {
        required: true,
        email: true
      },
      user_phone: {
        required: true,
      },
      intlTelInput: {
        required: true,
        phone: true
      },
      password: {
        required: true,
        minlength: 8
      },
      password2: {
          required: true,
          minlength: 8,
          equalTo: "#reg_password"
      }
    },
    messages: {
      billing_first_name: val_fname,
      billing_last_name: val_lname,
      billing_address_1: val_baddr,
      billing_city: val_city,
      email: {
        required: val_rfld,
        email: val_mail
      },
      user_phone: {
        required: val_rfld,
        phone: val_phone
      },
      intlTelInput: {
        required: val_rfld,
        phone: val_phone
      },
      password: {
        required: val_rfld,
        minlength: val_pmin
      },
      password2: {
        required: val_rfld,
        minlength: val_pmin,
        equalTo: val_peqr
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

  $("form[name='login']").validate({
    rules: {
      username: {
        required: true
      },
      password: {
        required: true,
        minlength: 8
      }
    },
    messages: {
      username: {
        required: val_rfld
      },
      password: {
        required: val_rfld,
        minlength: val_pmin
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

  $("form[name='otp-register']").validate({
    rules: {
      email_address: {
        required: true,
        email: true
      },
      intlTelInput: {
        required: true,
        min: 8,
        phone: true
      }
    },
    messages: {
      email_address: {
        required: val_rfld,
        email: val_mail
      },
      intlTelInput: {
        required: val_rfld,
        min: val_phone,
        number: val_phone
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  
  $("form[name='otp-login']").validate({
    rules: {
      intlTelInput: {
        required: true,
        min: 8,
        phone: true
      }
    },
    messages: {
      intlTelInput: {
        required: val_rfld,
        min: val_phone,
        number: val_phone
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

  $("form[name='otp-register-verification']").validate({
    rules: {
      verification_code: {
        required: true
      }
    },
    messages: {
      verification_code: val_otpc
    },
    success: function(element) {
      $('button[type="button"]').attr('disabled', false);
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

  $("form[name='otp-login-verification']").validate({
    rules: {
      verification_code: {
        required: true
      }
    },
    messages: {
      verification_code: val_otpc
    },
    success: function(element) {
      $('button[type="button"]').attr('disabled', false);
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

  var bannerInner = new Swiper('.banner-inner-slider', {
    direction: 'horizontal',
    loop: false,
    arrows: true,
    speed: 600,
    autoplay: 6000,
    slidesPerView: 1,
    autoplayDisableOnInteraction: false,
    noSwiping: false,
    onSlideChangeStart: function(s) {  
      var x = s.activeIndex;
      console.log(x);
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    on: {
      slideChangeTransitionStart: function () {
        $('.banner-inner-slider .swiper-slide .aos-init').removeClass('aos-animate');
      },
      slideChangeTransitionEnd: function () {
        $('.banner-inner-slider .swiper-slide.swiper-slide-active .aos-init').addClass('aos-animate');
      }
    }
  });
  
  var certiificate = new Swiper('.certiificate-slider', {
    loop: true,
    grabCursor: false,
    slidesPerView: 2,
    spaceBetween: 60,
    navigation: {
      nextEl: '.swiper-button-next-certiificate',
      prevEl: '.swiper-button-prev-certiificate'
    },
    breakpoints: {
      1100 : {
        spaceBetween: 60
      },
      768 : {
        spaceBetween: 30
      },
      300 : {
        spaceBetween: 30,
        slidesPerView: 'auto'
      }
    }
  });
  
  var related_products = new Swiper('.related-products ul.products', {
    loop: false,
    grabCursor: false,
    slidesPerView: 'auto',
    spaceBetween: 0,
    navigation: {
      nextEl: '.swiper-button-next-related',
      prevEl: '.swiper-button-prev-related'
    },
    // breakpoints: {
    //   1100 : {
    //     slidesPerView: 3
    //   },
    //   991 : {
    //     slidesPerView: 2
    //   },
    //   768 : {
    //     slidesPerView: 1
    //   }
    // }
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
  
  var dialCode = '';
  var mobileNumber = document.querySelectorAll(".intlTelInput");
  var iti;

  var updateMobileDial = new Event('input', {
    bubbles: true,
    cancelable: true,
  });

  
  for (i = 0; i < mobileNumber.length; ++i) {
    
    iti = window.intlTelInput(mobileNumber[i], {
      initialCountry: "auto",
      nationalMode: false,
      defaultCountry: 'auto',
      preferredCountries: [ 'us', 'ca', 'gb'],
      separateDialCode: false,
      autoHideDialCode: false,
      dropdownContainer: document.body,
      autoPlaceholder: "off",
      geoIpLookup: function(success, failure) {
        fetch('https://ipinfo.io/json?token=cef281e6a5a303')
          .then(res => res.json())
          .then(resp => {
            var countryCode = (resp && resp.country) ? resp.country : "us";
          success(countryCode);
        });
      },
      placeholderNumberType: "MOBILE",
      utilsScript: site_url + "/wp-content/themes/jasminewater/dist/js/utils.js" // just for formatting/placeholders etc
    });
    
    mobileNumber[i].addEventListener('input', function(e){
      var num = e.target.value;
      $(this).parents('.iti').next('input').val(num);
    })
    
    mobileNumber[i].addEventListener('countrychange', function(e, countryData){
      for (i = 0; i < mobileNumber.length; ++i) {
        // mobileNumber[i].value = '';
        mobileNumber[i].dispatchEvent(updateMobileDial);
      }
      // dialCode = '+'+iti.selectedCountryData.dialCode;
      // $(this).parents('.iti').next('input').val('');
    });
    
    mobileNumber[i].addEventListener("open:countrydropdown", function() {
      $('body').addClass('scroll-disable');
    });
    
    mobileNumber[i].addEventListener("close:countrydropdown", function() {
      $('body').removeClass('scroll-disable');
    });
    
  }
  
  $('#mobile_menu_close_btn').click(function(e){
    $('#site-navigation').removeClass('toggled');
    e.preventDefault();
  });
  
  $('.woocommerce-input-wrapper select.country_select').select2();
  $('.woocommerce-input-wrapper select.state_select').select2();
  
  $('.filter-wrapper .custom-select select').select2({
    minimumResultsForSearch: -1
  });
  
  $('.select-wrap select').select2({
    minimumResultsForSearch: -1
  });
 
  $('select#salutation').select2({
    minimumResultsForSearch: -1
  }).on('select2:select', function (e) {
    var data = e.params.data;
    if(data.id == 'individual'){
      $("input[id=user_phone]").rules("remove", "required");
      $("input[id=user_phone]").parents('.form-row').find('label .required, span.validate').addClass('hidden');
    }  else {
      $("input[id=user_phone]").rules("add", "required");
      $("input[id=user_phone]").parents('.form-row').find('label .required, span.validate').removeClass('hidden')
    }
  });

  var dt = new Date();
  dt.setHours( dt.getHours() + 2 );

  $('#delivery_date').appendDtpicker({
    "dateFormat": "DD/MM/YYYY H:mm TT",
    "futureOnly": true,
    // "minDate": new Date(),
    "minTime":"10:00",
    "maxTime":"18:00",
    "closeOnSelected": true,
    // "current": dt,
    "dateOnly": true
  });

  var filter = $('.woocommerce-ordering .filter-wrapper');
  filter.find('input, select').on('change', function(){
    $(this).parents('form').submit();
  });
});