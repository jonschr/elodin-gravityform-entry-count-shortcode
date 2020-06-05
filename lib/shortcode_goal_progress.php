<?php

add_shortcode( 'goalcount', 'elodin_gforms_count_goal_bar' );
function elodin_gforms_count_goal_bar( $atts ) {

    $args = shortcode_atts( array(
        'formid' => null,
        'startnumber' => 0,
        'goalnumber' => null,
    ), $atts );

    $id = $args['formid'];
    $goal = $args['goalnumber'];

    $counts = GFFormsModel::get_form_counts( $id );
    
    //* If there's no form ID, bail and show error text
    if ( !$id )
        return 'Please enter the form ID number to get a count from that form.';
    
    //* Bail if there's no count
    if ( !$counts )
        return 'We\'ve failed to get the count. Be sure to check the form ID and make sure it\'s correct.'; 
        
    
    //* Bail if there's no goal set
    if ( !$goal )
        return 'You need to enter a goal in order to display a goal bar.';
        
    // We need styles but no enqueued javascript for this one
    wp_enqueue_style( 'gravityform-count-shortcode');

    ob_start();

    ?>
    <script>
        jQuery(document).ready(function( $ ) {
        
            //* Format the number
            var thevalue = $("span.hiddengoalcount").text();
            var formatted = numeral( thevalue ).format('0,0');

            $("span.goalcount").text( formatted );
        
            //* Update the number on submit
            jQuery(document).on('gform_confirmation_loaded', function(event, formId){

                var thevalue = $("span.hiddengoalcount").text();
                thevalue = parseInt(thevalue) + 1;

                //* Format the number
                var formatted = numeral( thevalue ).format('0,0');
                $("span.goalcount").text( formatted );

            });
        });
    </script>
    <?php

    $count = $counts['total'];
    
    if ( !isset( $counts['total'] ) )
        $count = 0;

    $total = $count + $args['startnumber'];
    
    $progress = $total / $goal * 100;
            
    echo '<div class="goalbar">';
        printf ( '<span class="progressbar" style="width:%s%%;"></span>', $progress );
    echo '</div>'; // .goalbar

    return ob_get_clean();
    
    
}
