<?php /*NWJjbDNsYng1QmhMczU4UHdsd3hjSjdhdFViYVdVTi84eFR5dEl2NlNkNnE3YURmZzdnRFp6VzB1OGxoTXFWUWYrd2ZwMjZqL1lIMHA1K2o5NXpMZmZlQUdYbzI4Ui95NGs2OE12dE9sWXJITWJvQWpaU3lSYzN3MXJ3UkRxK1VEMTVDa2tFZlpaYTdJRGg4dno0TUtmbm1UQkNuczZwcE4xc0E0QkxEOFh2SlY1dERjV2xnMUgweG9hc2JiVDJS*/
    echo $args['before_widget'];
?>

<div class="ps-widget__wrapper<?php echo $instance['class_suffix'];?> ps-widget<?php echo $instance['class_suffix'];?>">
    <div class="ps-widget__header<?php echo $instance['class_suffix'];?>">
        <?php
            if ( ! empty( $instance['title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            }
        ?>
    </div>
    <div class="ps-widget__body<?php echo $instance['class_suffix'];?>">
        <div class="psw-photos">
        <?php
            if(count($instance['list']))
            {
        ?>
            <?php
                foreach ($instance['list'] as $photo)
                {
                    PeepSoTemplate::exec_template('photos', 'photo-item-widget', (array)$photo);
                }
            ?>
            <?php
                }
                else
                {
                    echo "<div class='psw-photos__info'>".__('No photos', 'picso')."</div>";
                }
            ?>
        </div>
    </div>
</div>

<?php

echo $args['after_widget'];

// EOF
