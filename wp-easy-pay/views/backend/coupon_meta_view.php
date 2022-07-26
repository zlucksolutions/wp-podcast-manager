<?php 
/**
 * Coupon Meta HTML
 */
$wpep_coupons_code = get_post_meta( get_the_ID(), 'wpep_coupons_code', true );
$wpep_coupons_desc = get_post_meta( get_the_ID(), 'wpep_coupons_desc', true );
$wpep_coupons_discount_type = get_post_meta( get_the_ID(), 'wpep_coupons_discount_type', true );
$wpep_coupons_amount = get_post_meta( get_the_ID(), 'wpep_coupons_amount', true );
$wpep_coupons_expiry = get_post_meta( get_the_ID(), 'wpep_coupons_expiry', true );
$wpep_coupons_form_include = get_post_meta( get_the_ID(), 'wpep_coupons_form_include', true );
$wpep_coupons_form_exclude = get_post_meta( get_the_ID(), 'wpep_coupons_form_exclude', true );
?>

<div class="easypayblock">

    <?php

    if ( isset( $_COOKIE['wpep-setting-tab'] ) ) {
        $tab_opened = $_COOKIE['wpep-setting-tab'];
    } else {
        $tab_opened = 'panel-1-ctrl';
    }

    ?>
    <!-- TAB CONTROLLERS -->
    <input id="panel-1-ctrl" class="panel-radios" type="radio"
        name="tab-radios" 
        <?php
            if ( 'panel-1-ctrl' == $tab_opened ) :
                echo 'checked';
    endif;
            ?>
            />
    <input id="panel-2-ctrl" class="panel-radios" type="radio"
        name="tab-radios" 
        <?php
            if ( 'panel-2-ctrl' == $tab_opened ) :
                echo 'checked';
    endif;
            ?>
            />
    <input id="nav-ctrl" class="panel-radios" type="checkbox" name="nav-checkbox"/>
    <!-- TABS LIST -->
    <ul id="tabs-list">
        <!-- MENU TOGGLE -->
        <label id="open-nav-label" for="nav-ctrl"></label>
        <li id="li-for-panel-1" data-id="panel-1-ctrl">
            <label class="panel-label" for="panel-1-ctrl">General Setting</label>
        </li>
        <!--INLINE-BLOCK FIX
        -->
        <li id="li-for-panel-2" data-id="panel-2-ctrl">
            <label class="panel-label" for="panel-2-ctrl">Advanced Setting</label>
        </li>
    </ul>


    <article id="panels" class="wpeasyPay">
        <div class="container">
            <section id="panel-1">
				<main>
                    <div id="formPage">
                        <h3 class="">Coupon Details</h3>
                        <div class="wpeasyPay__body">
                            <div class="form-group">
                                <label>Coupon Code:</label>
                                <input type="text" class="form-control" placeholder="please enter title" id="wpep_coupons_code" name="wpep_coupons_code"
                                    value="<?php echo $wpep_coupons_code; ?>"/>
                                <div class="sep15px">&nbsp;</div>
                                <button class="btn btn-primary" id="wpep_coupons_generate_code">Generate Code</button>
                            </div>

                            <div class="form-group">
                                <label>Coupon Description:</label>
                                <textarea type="text" class="form-control form-control-textarea"
                                        placeholder="Please Enter description (Optional)"
                                        name="wpep_coupons_desc"><?php echo $wpep_coupons_desc; ?></textarea>
                            </div>
                        </div>
                    </div>
                </main>
			</section>

            <section id="panel-2">
                <main>
                    <div id="formPage">
                        <div class="form-group">
                            <label>
                                Discount Type:
                                <div class="wp_easy_pay-tooltip-box">
                                    <small class="wp_easy_pay-tooltip">Select discount type. Default is fixed.</small>
                                </div>
                            </label>
                            <select class="form-control" name="wpep_coupons_discount_type" id="wpep_coupons_discount_type">
                                <option value="fixed" 
                                <?php
                                if ( $wpep_coupons_discount_type == 'fixed' ) {
                                    echo 'selected';
                                }
                                ?>
                                > Fixed Discount
                                </option>
                                <option value="percentage" 
                                <?php
                                if ( $wpep_coupons_discount_type == 'percentage' ) {
                                    echo 'selected';
                                }
                                ?>
                                > Percentage Discount
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>
                                Coupon Amount:
                                <div class="wp_easy_pay-tooltip-box">
                                    <small class="wp_easy_pay-tooltip">Enter discount amount. If type is percentage number will be count as percentage.</small>
                                </div>
                            </label>
                            <input type="text" class="form-control" placeholder="please enter title" name="wpep_coupons_amount"
                                value="<?php echo $wpep_coupons_amount; ?>"/>                            
                        </div>

                        <div class="form-group">
                            <label>
                                Coupon Expiry Date:
                                <div class="wp_easy_pay-tooltip-box">
                                    <small class="wp_easy_pay-tooltip">Enter expiry date for coupon.</small>
                                </div>
                            </label>
                            <input type="text" id="wpep_coupons_expiry" class="form-control" placeholder="DD-MM-YYYY" name="wpep_coupons_expiry"
                                value="<?php echo $wpep_coupons_expiry; ?>"/>
                        </div>

                        <div class="form-group">
                            <label>
                                Forms Include:
                                <div class="wp_easy_pay-tooltip-box">
                                    <small class="wp_easy_pay-tooltip">Select form that the coupon will be applied to. Apply to all form if left blank.</small>
                                </div>
                            </label>
                            <?php 
                            $args = array(
                                'numberposts' => -1,
                                'post_type'   => 'wp_easy_pay',
                            );
                            $forms = get_posts( $args );
                                                             
                            if ( ! empty( $forms ) ) {
                                ?>
                                <select class="form-control" name="wpep_coupons_form_include[]" id="wpep_coupons_form_include" multiple>
                                <?php
                                foreach( $forms as $form ) {
                                    if ( empty(trim($form->post_title)) ) {
                                        $form->post_title = "Payment Form - " . $form->ID;
                                    }
                                    ?>
                                    <option value="<?php echo $form->ID; ?>"
                                    <?php
                                    if ( !empty($wpep_coupons_form_include) && in_array($form->ID, $wpep_coupons_form_include) ) {
                                        echo 'selected';
                                    }
                                    ?>
                                    ><?php echo $form->post_title; ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                                <?php
                            }
                            ?>                            
                        </div>

                        <div class="form-group">
                            <label>
                                Forms Exclude:
                                <div class="wp_easy_pay-tooltip-box">
                                    <small class="wp_easy_pay-tooltip">Select form that the coupon will not be applied to. No effect if left blank.</small>
                                </div>
                            </label>                            
                            <?php                                                         
                                if ( ! empty( $forms ) ) {
                                    ?>
                                    <select class="form-control" name="wpep_coupons_form_exclude[]" id="wpep_coupons_form_exclude" multiple>
                                    <?php
                                    foreach( $forms as $form ) {
                                        if ( empty(trim($form->post_title)) ) {
                                            $form->post_title = "Payment Form - " . $form->ID;
                                        }
                                        ?>
                                        <option value="<?php echo $form->ID; ?>"
                                        <?php
                                        if ( !empty($wpep_coupons_form_exclude) && in_array($form->ID, $wpep_coupons_form_exclude) ) {
                                            echo 'selected';
                                        }
                                        ?>><?php echo $form->post_title; ?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                                    <?php
                                }
                                ?>                            
                        </div>
                    </div>
                </main>
			</section>
        </div>
    </article>
</div>