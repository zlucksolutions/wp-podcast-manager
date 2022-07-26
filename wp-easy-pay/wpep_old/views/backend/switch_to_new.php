<?php

	if ( isset( $_POST['switch_submission'] ) ) {

		update_option( 'wpep_stn', 'true' );
		$url = admin_url('edit.php?post_type=wp_easy_pay&page=wpep-settings');
		echo( "<script> location.href='".$url."' </script>" );
		exit;
	}

?>
<style>

    .wpep_container {
        width: 100%;
        display: grid;
        overflow-x: hidden;
    }

    .wpep_row_flex {
        margin-left: -15px;
        margin-right: -15px;
        display: flex;
        flex-direction: row;
    }

    .wpep_row_flex_inverse {
        margin-left: -15px;
        margin-right: -15px;
        display: flex;
        flex-direction: row-reverse;
    }

    .wpep_col_flex {
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
        position: relative;
        min-height: 1px;
        display: flex;
    }

    .wpep_row {
        margin-left: -15px;
        margin-right: -15px;
    }

    .wpep_col-12 {
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
        position: relative;
        min-height: 1px;
    }

    .wpep_col_flex {
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
        position: relative;
        min-height: 1px;
    }

    .wpep_container:after,
    .wpep_container:before,
    .wpep_row:after,
    .wpep_row:before {
        display: table;
        content: " ";
    }

    .wpep-btn {
        padding: 0px 40px;
        line-height: 40px;
        outline: none;
        font-size: 16px;
        text-align: center;
        border: none;
        background: transparent;
        color: #000;
        cursor: pointer;
        display: inline-block;
        text-decoration: none;
    }

    .wpep-btn-primary {
        background: #2065e0;
        border: 1px solid #2065e0;
        box-shadow: 0px 0px 20px -8px #3475e9;
        color: #fff;
        opacity: 1;
        transition: opacity .25s ease-in-out;
        -moz-transition: opacity .25s ease-in-out;
        -webkit-transition: opacity .25s ease-in-out;
    }

    .wpep-btn-primary:hover,
    .wpep-btn-primary:focus,
    .wpep-btn-primary:active {
        opacity: 0.8;
    }

    .wpep-btn-secondary {
        background: #ffffff;
        border: 1px solid #e2e5ec;
        box-shadow: 0px 0px 15px -8px #3475e9;
        color: #595d6e;
        opacity: 1;
        transition: opacity .25s ease-in-out;
        -moz-transition: opacity .25s ease-in-out;
        -webkit-transition: opacity .25s ease-in-out;
    }

    .wpep-btn-secondary:hover,
    .wpep-btn-secondary:focus,
    .wpep-btn-secondary:active {
        opacity: 0.8;
    }

    /* rollback page css */
    .wpep_switch_to_v3-0 {
        box-shadow: 0 0 13px 0 rgba(82, 63, 105, .1);
        border: none;
        -webkit-box-shadow: 0 0 13px 0 rgba(82, 63, 105, .1);
        -moz-box-shadow: 0 0 13px 0 rgba(82, 63, 105, .1);
        -o-box-shadow: 0 0 13px 0 rgba(82, 63, 105, .1);
        -ms-box-shadow: 0 0 13px 0 rgba(82, 63, 105, .1);
        padding: 30px 0px 0px 0px;
        margin: 20px 15px 20px 15px;
        width: auto;
        position: relative;
        background: #fff;
    }

    .wpep_switch_to_v3-0::before {
        content: '';
        width: 100%;
        height: 1120px;
        position: absolute;
        top: 0px;
        border-radius: 0px 0px 50px 50px;
        background: #fff url("<?= WPEP_ROOT_URL_OLD . 'assets/switch_to_new/img/screen-bg.png'?>");
        background-repeat: no-repeat;
        background-position: center top;
    }

    .wpep-text-center {
        text-align: center;
    }

    .wpep_title {
        margin: 0;
        padding: 0;
        font-size: 46px;
        font-weight: 900;
        color: #242333;
        line-height: normal;
    }

    .wpep_title_sub {
        margin: 0;
        padding: 0;
        font-size: 34px;
        font-weight: 600;
        color: #242333;
        line-height: normal;
        letter-spacing: 1px;
    }

    .wpep_switch_to_v3-0 p {
        letter-spacing: 1px;
        font-weight: 100;
        font-size: 16px;
        color: #7a7e8e;
        line-height: 28px;
    }

    .wpep-img-responsive {
        max-width: 100%;
        height: auto;
        display: block;
        outline: none;
    }

    .sep25px {
        clear: both;
        height: 25px;
    }

    .wpep-form .wpep-form-group {
        margin-bottom: 1.5rem;
    }

    .wpep_flex_dir_col {
        flex-direction: column;
    }

    .welcompara {
        text-align: center;
        margin-bottom: 30px;
    }

    .welcompara h1 {
        padding-top: 70px;
    }

    .welcompara p {
        font-size: 22px;
        margin: 5px 0px 0px 0px;
        color: #78799a;
    }

    .demosection {
        position: relative;
        width: 800px;
        height: 770px;
        margin: 0px auto;
        top: 0px;
        padding-bottom: 60px;
        background: transparent url("<?= WPEP_ROOT_URL_OLD . 'assets/switch_to_new/img/screen.png'?>");
        background-repeat: no-repeat;
        background-position: top center;
        background-size: contain;
    }

    .demohere {
        width: 790px;
        height: 770px;
        background: rgba(255, 255, 255, 0.6);
        position: absolute;
        top: 54px;
        left: 5px;
        right: 0px;
        color: #fff;
        text-align: center;
        border-radius: 0px 0px 25px 25px;
        overflow: hidden;
    }

    .demohere img {
        width: 100%;
    }

    .demohere img.imgtemp {
        width: 1000px;
        position: relative;
        left: -74px;
        top: -114px;
    }

    .swithplugin {
        margin-top: 25px;
    }

    .swithplugin .wpep-btn-primary {
        background: #1e3bb1;
        border: 1px solid #1e3bb1;
        box-shadow: 0px 0px 20px -8px #3475e9;
        color: #00ffdc;
        font-weight: 600;
        letter-spacing: 1px;
        border-radius: 50px;
        font-size: 24px;
        padding: 10px 60px;
    }

    .sectionblock {
        padding: 60px;
    }

    .sectionodd {
        background: #fbfaff;
    }

    .sectioneven {}

    .ctawrap {
        padding: 30px 60px 40px 60px;
        text-align: center;
        color: #fff;
        background: #2065e0 url("<?= WPEP_ROOT_URL_OLD . 'assets/switch_to_new/img/ctabar.png'?>");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .ctawrap .wpep-form-group {
        margin: 0px;
    }

    .ctawrap h1 {
        color: #fff;
        font-size: 34px;
        margin-bottom: 15px;
    }

    .ctawrap p {
        color: #fff;
    }

    .ctawrap .wpep-btn-primary {
        background: #fff;
        border: 1px solid #fff;
        box-shadow: 0px 0px 20px -8px #669dff;
        color: #2065e0;
        margin-bottom: 20px;
        color: #000;
        font-weight: 600;
        letter-spacing: 1px;
        border-radius: 50px;
        font-size: 24px;
        padding: 10px 60px;
    }
    .wpep-disabled {
        opacity: 0.75;
        pointer-events: none;
    }
    #featured-slider-wpep {
        width: 800px;
        height: 770px;
        overflow: hidden;
        position: relative;
        background: url("<?= WPEP_ROOT_URL_OLD . 'assets/switch_to_new/img/bg.jpg'?>");
    }

    #slider-wpep {
        width: 800px;
        height: 1250px;
        position: absolute;
        top: 0px;
        left: 0px;
    }

    #slider-wpep .slide {
        width: 800px;
        height: 770px;
        position: relative;
    }
</style>

<div class="wpep_switch_to_v3-0 wpep_container">
    <div class="wpep_row">
        <div class="wpep_col-12 welcompara">
            <h1 class="wpep_title wpep-text-center">Welcome to WP Easy Pay</h1>
            <p>Introducing phenomenal new features that make your website payment process
            <br> easier, faster, and safer.</p>

            <div class="swithplugin">
                <form action="#" method="POST" class="wpep-form" enctype="multipart/form-data">
					<input type="hidden" name="switch_submission" />
                    <div class="wpep-form-group">
                        <input type="submit" name="wpep_switch_to_new_submit"
                            class="wpep-btn wpep-btn-primary wpep-btn-square wpep-disabled" value="Switch to v4.0" disabled="disabled">
                    </div>
                    <div class="wpep-form-group">
                        <input type="checkbox" id="switch" value="off" name="wpep_switch_to_new">
                        <label for="switch">Do you really want to switch to <strong>newer version</strong></label>
                        <div style="color: red; margin-top: 10px;">Once you opt for version v4.0, you will need to create new forms once again but don't worry!</div> <div style="color: red;"> If you have an issue with the new version, you can always contact support for guidance.</div>
                    </div>
                </form>
            </div>
        </div>
    </div>

 

    <div class="sectioneven sectionblock">
        <div class="wpep_row_flex">
            <div class="wpep_col_flex wpep_flex_dir_col">
                <h3 class="wpep_title_sub">Multiple Forms</h3>
                <p>Crete multiple payment forms on your website and connect them with the Square payment gateway to accept payment globally. Each form can be embed onto the website individually using shortcode. Build great-looking online forms that hook people in and unlock your platform's full potential by offering secure payment checkout via WP EasyPay. </p>
            </div>
            <div class="wpep_col_flex popup-gallery">
                <a href="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/all_forms.png' ?>">
                    <img src="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/all_forms.png' ?>"
                        alt="snapshot 1" class="wpep-img-responsive" title="snapshot 1">
                </a>
            </div>
        </div>
    </div>

    <div class="sectionodd sectionblock">
        <div class="wpep_row_flex_inverse">
            <div class="wpep_col_flex wpep_flex_dir_col">
                <h3 class="wpep_title_sub">Custom Amount Layout</h3>
                <p>Give your customers the power to enter custom amount for donations, one-time payments or subscriptions on your payment forms. Everything happens on your payment page swiftly and smoothly. 
You can choose to display pre-defined amounts on your payment forms or create custom amount fields with a minimum and maximum range for payment amounts. </p>
            </div>
            <div class="wpep_col_flex popup-gallery">
                <a href="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/custom_layout.png'?>">
                    <img src="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/custom_layout.png'?>"
                        alt="snapshot 1" class="wpep-img-responsive" title="snapshot 1">
                </a>
            </div>
        </div>
    </div>


    <div class="sectioneven sectionblock">
        <div class="wpep_row_flex">
            <div class="wpep_col_flex wpep_flex_dir_col">
                <h3 class="wpep_title_sub">Payment Success Email Customization</h3>
                <p>The form success message can be a complete game-changer in terms of customer retention, loyalty, and trust. Customize payment success messages and improve your customers’ entire experience.
WP EasyPay provides customization options that can help you connect to your customers, humanize your brand, and, overall, create a better experience.</p>
            </div>
            <div class="wpep_col_flex popup-gallery">
                <a href="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/email_notifications.png'?>">
                    <img src="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/email_notifications.png'?>"
                        alt="snapshot 1" class="wpep-img-responsive" title="snapshot 1">
                </a>
            </div>
        </div>
    </div>




    <div class="sectionodd sectionblock">
        <div class="wpep_row_flex_inverse">
            <div class="wpep_col_flex wpep_flex_dir_col">
                <h3 class="wpep_title_sub">Easily Switch Between Currency Symbol & Code</h3>
                <p>WP EasyPay gives you the power to easily switch between Currency Symbol or Code on your payment forms. This feature expands the boundaries for any form since it gives customers the ease of understanding the purchase amount. 

This feature is an quick and easy way to show specific currency names in a written form.</p>
            </div>
            <div class="wpep_col_flex popup-gallery">
                <a href="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/change_currency_code.png'?>">
                    <img src="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/change_currency_code.png'?>"
                        alt="snapshot 1" class="wpep-img-responsive" title="snapshot 1">
                </a>
            </div>
        </div>
    </div>


    <div class="sectioneven sectionblock">
        <div class="wpep_row_flex">
            <div class="wpep_col_flex wpep_flex_dir_col">
                <h3 class="wpep_title_sub">Transaction Notes Customization</h3>
                <p>Transaction Notes are an “optional” field that you may use to include additional information on a transaction. They are the first place to look when a trade your team entered does not appear in the Account Holdings after 24 hours.

Customizable transaction notes feature allows you to add additional or extra descriptions to items at the time of sale. This information will also appear on your digital receipts.</p>
            </div>
            <div class="wpep_col_flex popup-gallery">
                <a href="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/transaction_notes.png'?>">
                    <img src="<?= WPEP_ROOT_URL_OLD . 'assets/backend/img/transaction_notes.png'?>" alt="snapshot 1"
                        class="wpep-img-responsive" title="snapshot 1">
                </a>
            </div>
        </div>
    </div>

    <div class="ctawrap">
        <h1>WP EasyPay Version 4.0 is Better, Faster, Stronger</h1>
        <p>Upgrade into the future - Switch to WP EasyPay v4.0 today.</p>
        <form action="#" method="POST" class="wpep-form" enctype="multipart/form-data">
			<input type="hidden" name="switch_submission" />
            <div class="wpep-form-group">
                <input type="submit" name="wpep_switch_to_new_submit" class="wpep-btn wpep-btn-primary wpep-btn-square wpep-disabled"
                    value="Switch to v4.0" disabled="disabled">
            </div>
            <div class="wpep-form-group">
                <input type="checkbox" id="switch-1" value="off" name="wpep_switch_to_new">
                <label for="switch-1">Do you really want switch to newer version</strong></label>
                <div style="color: white; margin-top: 10px;">Once you opt for version 4.0, you will need to create new form once again but don't worry!</div> <div style="color: white;"> If you have an issue with the new version, you can always contact support for guidance.</div>
            </div>
        </form>
    </div>

</div>

<script src="<?= WPEP_ROOT_URL_OLD . 'assets/switch_to_new/js/jquery.magnific-popup.min.js'?>"></script>
<script>
    jQuery(function ($) {

        $('#switch, #switch-1').on('click', function(){
            if($(this).is(':checked')){
                $('input[name="wpep_switch_to_new_submit"]').attr('disabled', false);
                $('input[name="wpep_switch_to_new_submit"]').removeClass('wpep-disabled');
            } else {
                $('input[name="wpep_switch_to_new_submit"]').attr('disabled', true);
                $('input[name="wpep_switch_to_new_submit"]').addClass('wpep-disabled');
            }
        });

        // switch page slider
        var i = 0;
        var tumyukseklik = 0;
        var yukseklik = $('#slider-wpep .slide').height();
        $('#slider-wpep').css('height', ($('#slider-wpep .slide').length * yukseklik));
        function animasyon(px){
          $('#slider-wpep').stop(false, false).animate({
            top: -px
          }, 500);
        }
       
        $('#sayfalama a').click(function(){
          var index = $(this).index();
          pozisyon = index * yukseklik;
          animasyon(pozisyon);
          if(index == $('#slider-wpep .slide').length - 1){
            i = 0;
          }else{
            i = index + 1;
          }
          return false;
        });
       
        var zamanlayici = setInterval(function() {
          tumyukseklik = i * yukseklik;
          if(i == $('#slider-wpep .slide').length - 1){
            i = -1;
          }
          animasyon(tumyukseklik);
          i++;
        }, 2000);
    });


</script>
