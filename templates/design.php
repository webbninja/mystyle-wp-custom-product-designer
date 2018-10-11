<?php
/**
 * The template for displaying a MyStyle Design.
 * 
 * NOTE: THIS FILE IS NOT YET THEMEABLE.
 * 
 * @package MyStyle
 * @since 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>
    <p>
        <img class="mystyle-centered" src="<?php echo $design->get_web_url(); ?>"/>
    </p>
    <?php if ( $design->get_print_url() != null) { ?>
        <ul class="mystyle-button-group">
            <li>
                <a target="_blank" href="<?php echo $design->get_print_url(); ?>" class="button">
                    Print
                </a>
            </li>
        </ul>
    <?php } else { ?>
        <ul class="mystyle-button-group">
            <li>
                <a 
                    onclick="
                        jQuery('#mystyle-renderer-wrapper-<?php echo $design->get_design_id();?>:not(:has(>iframe))')
                            .append('<iframe src=\'<?php echo $renderer_url ?>\' width=\'100%\' height=\'300\'></iframe>'); 
                        return true;
                    "
                    class="button"
                >
                    Render Print File
                </a>
            </li>
        </ul>
        <div id="mystyle-renderer-wrapper-<?php echo $design->get_design_id();?>" class="mystyle-renderer-wrapper"></div>
    <?php } ?>

</div>
