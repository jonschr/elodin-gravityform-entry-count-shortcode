<?php

add_shortcode( 'formcount', 'elodin_gforms_count_get_count' );
function elodin_gforms_count_get_count( $atts ) {

    $args = shortcode_atts( array(
        'formid' => null,
        'startnumber' => 0,
        'goalnumber' => null,
    ), $atts );

    $id = $args['formid'];

    $counts = GFFormsModel::get_form_counts( $id );
    
    //* If there's no form ID, bail and show error text
    if ( !$id )
        return 'Please enter the form ID number to get a count from that form.';
    
    //* Bail if there's no count
    if ( !$counts )
        return; 'We\'ve failed to get the count. Be sure to check the form ID and make sure it\'s correct.'; 

    // We need the javascript, but don't need any styles for this shortcode
    wp_enqueue_script( 'numeral' );

    ob_start();

    ?>
    <script>
        jQuery(document).ready(function( $ ) {
        
            //* Format the number
            var thevalue = $("span.hiddencount").text();
            var formatted = numeral( thevalue ).format('0,0');

            $("span.formcount").text( formatted );
        
            //* Update the number on submit
            jQuery(document).on('gform_confirmation_loaded', function(event, formId){

                var thevalue = $("span.hiddencount").text();
                thevalue = parseInt(thevalue) + 1;

                //* Format the number
                var formatted = numeral( thevalue ).format('0,0');
                $("span.formcount").text( formatted );

            });
        });
    </script>
    <?php

    $count = $counts['total'];
    
    if ( !isset( $counts['total'] ) )
        $count = 0;

    $total = $count + $args['startnumber'];

    echo '<span class="formcount">' . $total . '</span>';
    echo '<span class="hiddencount" style="display: none;">' . $total . '</span>';

    return ob_get_clean();
    
    
}
