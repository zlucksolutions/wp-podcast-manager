<?php

$current_post_id = get_the_ID();
$firstname = get_post_meta( $current_post_id, 'wpep_first_name', true );
$lastname = get_post_meta( $current_post_id, 'wpep_last_name', true );
$email = get_post_meta( $current_post_id, 'wpep_email', true );
$charge_amount = get_post_meta( $current_post_id, 'wpep_square_charge_amount', true );
$charge_signup_amount = get_post_meta( $current_post_id, 'wpep_square_signup_amount', true );
$charge_amount_no_currency = get_post_meta( $current_post_id, 'wpep_square_charge_amount', true );
$charge_currency = get_post_meta( $current_post_id, 'wpep_charge_currency', true );
$discount_amount = get_post_meta( $current_post_id, 'wpep_square_discount', true );
$taxes = get_post_meta( $current_post_id, 'wpep_square_taxes', true );
$transaction_status = get_post_meta( $current_post_id, 'wpep_transaction_status', true );
$transaction_id = get_the_title( $current_post_id );
$transaction_type = get_post_meta( $current_post_id, 'wpep_transaction_type', true );
$form_id = get_post_meta( $current_post_id, 'wpep_form_id', true );
$form_values = get_post_meta( $current_post_id, 'wpep_form_values', true );
$wpep_transaction_error = get_post_meta( $current_post_id, 'wpep_transaction_error', true );
$wpep_refund_id = get_post_meta( $current_post_id, 'wpep_square_refund_id', true );
$wpep_refund_amount = get_post_meta( $current_post_id, 'wpep_refunded_amount', true );
$currency_symbols = array(
    'USD',
    'CAD',
    'GBP',
    'AUD',
    'JPY',
    'EUR',
    '$',
    'C$',
    'A$',
    '¥',
    '£',
    '€'
);
foreach ( $currency_symbols as $value ) {
    $charge_amount_no_currency = str_replace( $value, '', $charge_amount_no_currency );
}
$charge_amount_no_currency = str_replace( ',', '', $charge_amount_no_currency );
$charge_amount_no_currency = (double) $charge_amount_no_currency * 100;
$full_refunded = false;

if ( $wpep_refund_amount !== '' && $wpep_refund_amount !== false ) {
    $refund_amount = $wpep_refund_amount;
} else {
    $refund_amount = 0;
}

if ( $charge_amount_no_currency == $wpep_refund_amount ) {
    $full_refunded == true;
}
$charge_amount_no_currency = $charge_amount_no_currency / 100;
$refund_amount = (double) $refund_amount / 100;
?>

<script>

jQuery(document).ready(function() {

	jQuery('form input').keydown(function (e) {
    if (e.keyCode == 13) {
      e.preventDefault();
      return false;
    }
  });

});

</script>
<div class="reportDetailsContainer">
  <div class="reportDetails">
	  <h3>Payment Details</h3>
	  <table>
		<tbody>

		<?php 
?>
		  <tr>
			<th>Payment type</th>
			<td><?php 
echo  $transaction_type ;
?></td>
		  </tr>
		  <tr>
			<th>Transaction ID</th>
			<td><?php 
echo  get_the_title() ;
?></td>
		  </tr>
	  
		  <tr>
			<th>Payments Amount</th>
			<td><?php 
echo  $charge_amount ;
?></td>
		  </tr>
		  <?php 

if ( isset( $charge_signup_amount ) && $charge_signup_amount != 0 ) {
    ?>
		  <tr>
		  <th>Signup Fees</th>
			<td><?php 
    echo  $charge_signup_amount ;
    ?> <span><?php 
    echo  $charge_currency ;
    ?></span></td>
		  </tr>
		  <?php 
}

if ( !empty($taxes) ) {
    foreach ( $taxes['name'] as $key => $fees ) {
        $fees_check = ( isset( $taxes['check'][$key] ) ? $taxes['check'][$key] : 'no' );
        $fees_name = ( isset( $taxes['name'][$key] ) ? $taxes['name'][$key] : '' );
        $fees_value = ( isset( $taxes['value'][$key] ) ? $taxes['value'][$key] : '' );
        $charge_type = ( isset( $taxes['type'][$key] ) ? $taxes['type'][$key] : '' );
        
        if ( 'yes' === $fees_check ) {
            
            if ( 'percentage' == $charge_type ) {
                $charge_type = '%';
            } else {
                $charge_type = 'fixed';
            }
            
            ?>
					<tr>
						<th><?php 
            echo  $fees_name ;
            ?></th>
						<td><?php 
            echo  $fees_value . ' <small>(' . $charge_type . ')</small>' ;
            ?></td>
					</tr>
					<?php 
        }
    
    }
}
?>
		


		  <tr>
			<th>Payments Status</th>
			<td><?php 
echo  $transaction_status ;
?></td>
		  </tr>
	  

		  <?php 

if ( isset( $wpep_transaction_error ) && !empty($wpep_transaction_error) ) {
    ?>
		  <tr>
			<th>Payment Error</th>
			<td><?php 
    print_r( $wpep_transaction_error );
    ?></td>
		  </tr>
				<?php 
}

?>

		  <tr>
			<th>WPEP Form</th>
			<td><a  target="_blank" href="<?php 
echo  get_edit_post_link( $form_id ) ;
?>"> click here </a></td>
		  </tr>

		  <tr>
			<th>User Name</th>
			<td><?php 
echo  $firstname . ' ' . $lastname ;
?></td>
		  </tr>
		  
		  <tr>
			<th>User Email</th>
			<td><?php 
echo  $email ;
?></td>
		  </tr>

		</tbody>
	  </table>
	</div>


  <?php 

if ( isset( $form_values ) && !empty($form_values) ) {
    echo  '<div class="reportDetails">
    <h3>Form Field</h3>
    <table>
      <tbody>';
    foreach ( $form_values as $key => $value ) {


      if ( isset( $value['label'] ) ) {

      if ( $value['label'] !== 'Products Data' && $value['label'] !== 'quantity' ) {
    
        echo  '<tr>';
        
        if ( isset( $value['label'] ) ) {
            $label = ucfirst( str_replace( '_', ' ', $value['label'] ) );
            echo  '<th scope="col">' . $label . '</th>' ;
        }
        
        if ( isset( $value['label'] ) ) {
            
            if ( 'Uploaded File URL' == $value['label'] ) {
                $uploaded_file_link = "<a target='_blank' href='" . $value['value'] . "'> Click to see uploaded file </a>";
                echo  '<td scope="col">' . $uploaded_file_link . '</td>';
            } elseif ( 'Products Data' == $value['label'] ) {
                $json = json_decode( $value['value'], true );

            } else {
                if ( isset( $value['value'] ) ) {
                    echo  '<td scope="col">' . $value['value'] . '</td>';
                }
            }
        
        }
        echo  '</tr>';

      }

    }

    }
    echo  '</tbody>
    </table>
  </div>' ;
}

?>
  </div>
