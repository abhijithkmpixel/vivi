jQuery.noConflict();
jQuery( document ).ready(function( $ ) {

  /* Cart Update */
  var plusBtn = $('.vivi-quantity .qty-selector .plus');
  var minusBtn = $('.vivi-quantity .qty-selector .minus');
  var singleAddToCart = $('.single_add_to_cart_button');
  var loopAddToCart = $('.loop_add_to_cart_button');
  
  function updateCart(qtyInput) {
    $('#page').addClass('processing');
    var qtyParent = qtyInput.parents('.vivi-quantity');
    var qty = qtyInput.parents('.vivi-quantity').find('.qty');
    var cart_item_qty = qty.val();
    var cart_item_key = qty.attr("id");
    var cart_item_id = qty.attr("data-product");
    var cart_item_nonce = update_cart_nonce;
    var qty_items = $('.vivi-quantity .qty');
    var cart = $('.dynamic-cart');

    qtyParent.addClass('active');
    
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajax_url,
      data: {action : 'update_cart_status', 'cart_item_key' : cart_item_key, 'cart_item_qty' : cart_item_qty, 'cart_item_id' : cart_item_id, nonce: cart_item_nonce},
      success: function (data) {

        var cart_msg = '';
        for (i = 0; i < data.cart_items.length; i++) {
          cart_msg += data.cart_items[i]['title'] + ' x ' +  data.cart_items[i]['count'] + "<br>";
        }

        $('#page').removeClass('processing');

        if(data.cart_total_count < 1){
          cart.find('.count').addClass('hidden').text(data.cart_total_count);
          cart_msg += 'Your cart is currently empty.';
        } else {
          cart.find('.count').removeClass('hidden').text(data.cart_total_count);
          if(lang == 'rtl'){
            cart_msg += '<br/> <a href="'+site_url+'/ar/cart" class="btn btn-simple btn-white">عرض السلة</a>';
          } else {
            cart_msg += '<br/> <a href="'+site_url+'/cart" class="btn btn-simple btn-white">View Cart</a>';
          }
        }

        for (var i = 0; i < qty_items.length; i++){
          if( $(qty_items[i]).val() < 1 ){
            $(qty_items[i]).parents('.vivi-quantity').removeClass('active');
          }
        }

        var productTitle = '';
        if(lang == 'rtl'){
          productTitle = (data.cart_total_count > 1) ? 'تمت أضافة الطلب إلي السلة' : 'تمت أضافة الطلب إلي السلة';
        } else {
          productTitle = (data.cart_total_count > 1) ? 'Products added to cart.' : 'Product added to cart.';
        }

        $.toast({ 
          heading: (data.cart_total_count < 1) ? 'Cart Updated!' : data.cart_total_count + '&nbsp;' + productTitle,
          text : cart_msg, 
          showHideTransition : 'fade',  // It can be plain, fade or slide
          // bgColor : 'blue',      // Background color for toast
          // textColor : '#eee',    // text color
          allowToastClose : true,   // Show the close button or not
          hideAfter : 6000,         // `false` to make it sticky or time in miliseconds to hide after
          stack : 1,                // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
          textAlign : (lang == 'rtl') ? 'right': 'left',  // Alignment of text i.e. left, right, center
          position : (lang == 'rtl') ? 'bottom-left': 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
          showHideTransition: 'slide',
          icon: (data.cart_total_count < 1) ? 'info' : 'success'
        });

      }
    });
  }

  $(document).on('click', '.qty', function (e) {
    e.preventDefault();
    var isProductLoop = $(this).parents().hasClass('product-loop-item');
    if(isProductLoop){
      updateCart($(this));
    }
  });

  plusBtn.click(function(e){
    e.preventDefault();
    var isProductLoop = $(this).parents().hasClass('product-loop-item');
    var currentVal = $(this).prev().val();
    var newVal = parseInt(currentVal) + 1;
    $(this).prev().val(newVal);
    if(isProductLoop){
      updateCart($(this));
    }
  });

  minusBtn.click(function(e){
    e.preventDefault();
    var isProductLoop = $(this).parents().hasClass('product-loop-item');
    var currentVal = $(this).next().val();
    var newVal = parseInt(currentVal) - 1;
    if(parseInt(currentVal) != 0){
      $(this).next().val(newVal);
      if(isProductLoop){
        updateCart($(this));
      }
    }
  });
  
  singleAddToCart.click(function(e){
    e.preventDefault();
    updateCart($(this));
  });

  loopAddToCart.click(function(e){
    e.preventDefault();
    $(this).parents('.vivi-quantity').find('input').val(1);
    updateCart($(this).parents('.vivi-quantity').find('input'));
  });

  /* OTP Login */
  var mobileNumber = $('#mobile_number');
  var emailAddress = $('#email_address');
  var verificationCode = $('#verification_code');
  var recaptchaContainer = $('#recaptcha-container');

  var sendCode = $('#sendCode');
  var verifyCode = $('#verifyCode');
  var mobileNumberForm = $('#form_mobile');
  var mobileOtpForm = $('#form_verification');
  var OtpError = $('#OtpError');
  var OtpSuccess = $('#OtpSuccess');
  
  function render() {
    window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
  }

  if(recaptchaContainer.length){
    render();
  }

  function processOtpLogin(idToken, phoneNumber) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajax_url,
      data: {
        action: 'process_otp_login', 
        nonce: otp_auth_nonce,
        idToken: idToken, 
        phoneNumber: phoneNumber, 
        apiKey: firebaseConfig.apiKey
      },
      success: function (data) {
        if(data.status != 1){
          $(OtpError).removeClass('hidden').html(data.status);
        } else {
          location.reload();
        }
      }
    });
  }
  
  function processOtpRegister(idToken, phoneNumber, emailAddress) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajax_url,
      data: {
        action: 'process_otp_register', 
        nonce: otp_auth_nonce,
        idToken: idToken, 
        phoneNumber: phoneNumber, 
        emailAddress: emailAddress, 
        apiKey: firebaseConfig.apiKey
      },
      success: function (data) {
        if(data.status != 1){
          $(OtpError).removeClass('hidden').html(data.status);
        } else {
          location.reload();
        }
      }
    });
  }

  function verifyOtp(checkType) {
    coderesult.confirm(verificationCode.val()).then(function (result) {
      var userobj=result.user;
      var token=userobj.ra;
      var phone=userobj.phoneNumber;
      var email=emailAddress.val();
      if(token!=null && token!=undefined && token!=""){
        if(checkType == "login"){
          processOtpLogin(token, phone);
        }
        if(checkType == "register"){
          processOtpRegister(token, phone, email);
        }
      }
    }).catch(function (error) {
      $(OtpError).removeClass('hidden').html(error.message);
      verifyCode.attr('disabled', false);
    });
  }

  function sendOtp(checkType) {
    firebase.auth().signInWithPhoneNumber(mobileNumber.val(), window.recaptchaVerifier).then(function (confirmationResult) {
      window.confirmationResult=confirmationResult;
      coderesult=confirmationResult;
      mobileNumberForm.addClass('hidden');
      mobileOtpForm.removeClass('hidden');
      if(checkType == "login"){
        $(OtpSuccess).removeClass('hidden').html(val_otsr);
      }
      if(checkType == "register"){
        $(OtpSuccess).removeClass('hidden').html(val_otsm);
      }
    }).catch(function (error) {
      $(OtpError).removeClass('hidden').html(error.message);
      sendCode.attr('disabled', false);
    });
  }

  function checkUserExists(checkType) {
    if(checkType == "login"){
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_url,
        data: {action : 'check_user_exists', 'mobile_number' : mobileNumber.val(), nonce: verify_user_nonce},
        success: function (data) {
          var user_status = data.status;
          if(user_status){
            sendOtp(checkType);
          } else {
            $(OtpError).removeClass('hidden').html(val_nuex);
            sendCode.attr('disabled', false);
          }
        }
      });   
    }
    if(checkType == "register"){
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajax_url,
        data: {action : 'check_user_exists', 'mobile_number' : mobileNumber.val(), nonce: verify_user_nonce},
        success: function (data) {
          var user_status = data.status;
          if(user_status){
            $(OtpError).removeClass('hidden').html(val_malr);
            sendCode.attr('disabled', false);
          } else {
            sendOtp(checkType);
          }
        }
      });
    }
  }

  sendCode.click(function(e){
    $(OtpError).addClass('hidden');
    $(OtpSuccess).addClass('hidden');
    sendCode.attr('disabled', true);

    if(this.dataset.otp == "login"){
      if(mobileNumber.val() != ''){
        checkUserExists(this.dataset.otp);
      } else {
        $(OtpError).removeClass('hidden').html(val_perm);
        sendCode.attr('disabled', false);
      }
    }

    if(this.dataset.otp == "register"){
      if(mobileNumber.val() == '' || emailAddress.val() == ''){
        if(mobileNumber.val() == ''){
          $(OtpError).removeClass('hidden').html(val_mobile);
          sendCode.attr('disabled', false);
        }
        if(emailAddress.val() == '') {
          $(OtpError).removeClass('hidden').html(val_mail);
          sendCode.attr('disabled', false);
        }
      } else {
        checkUserExists(this.dataset.otp);
      }
    }
  
    e.preventDefault();
  });

  verifyCode.click(function(e){
    $(OtpError).addClass('hidden');
    $(OtpSuccess).addClass('hidden');
    verifyCode.attr('disabled', true);
    if(verificationCode.val() != ''){
      verifyOtp(this.dataset.otp);
    } else {
      $(OtpError).removeClass('hidden').html(val_eotpr);
      verifyCode.attr('disabled', false);
    }
    e.preventDefault();
  });

});
 
jQuery(document).ajaxComplete(function(event, xhr, settings) {
  // debugger;
  if (
    settings.url === '?wc-ajax=apply_coupon' ||
    settings.url === '/?wc-ajax=apply_coupon' ||
    settings.url === '?wc-ajax=remove_coupon' ||
    settings.url === '/?wc-ajax=remove_coupon' ||
    settings.url === '/vivi/?wc-ajax=apply_coupon' ||
    settings.url === '/vivi/?wc-ajax=remove_coupon' ||
    settings.url === 'ar/?wc-ajax=apply_coupon' ||
    settings.url === '/ar/?wc-ajax=apply_coupon' ||
    settings.url === 'ar/?wc-ajax=remove_coupon' ||
    settings.url === '/ar/?wc-ajax=remove_coupon' ||
    settings.url === '/ar/vivi/?wc-ajax=apply_coupon' ||
    settings.url === '/ar/vivi/?wc-ajax=remove_coupon'
    ) {
      location.reload();
  }
});