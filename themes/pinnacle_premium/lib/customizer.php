<?php 
add_action( 'customize_controls_print_styles', 'controls_print_styles' );
function controls_print_styles() {
            wp_enqueue_style(
                'kt-customizer-style',
                get_template_directory_uri() . '/assets/css/customizer.css',
                '1.0'
            );
        }
/* if (class_exists('WP_Customize_Control'))
{
class KT_Customize_Sliderui_Control extends WP_Customize_Control {
  public $type = 'slider';
  public function enqueue() {
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-slider' );
  }
  public function render_content() {
    $this_val = $this->value() ? $this->value() : $this->default; 
    $id = str_replace("]","_",$this->id);
    $id = str_replace("[","_",$id);
    ?>
    <label>
      <span class="customize-control-title">
        <?php echo esc_html( $this->label ); ?>
      </span>
      <?php if ( '' != $this->description ) { ?>
      <span class="kt_tooltip hint--left" data-hint="<?php echo esc_attr($this->description); ?>"><span class='dashicons dashicons-info'></span></span>
      <?php } ?>
       <input type="text" id="input_<?php echo esc_attr($id); ?>" value="<?php echo $this_val; ?>" <?php $this->link(); ?>/>
    </label>
    <div id="slider_<?php echo esc_attr($id); ?>" class="kt-slider-ui"></div>
    <script>
      jQuery(document).ready(function($) {
        $( "#slider_<?php echo esc_attr($id); ?>" ).slider({
          value : <?php echo $this_val; ?>,
          min   : <?php echo $this->choices['min']; ?>,
          max   : <?php echo $this->choices['max']; ?>,
          step  : <?php echo $this->choices['step']; ?>,
          slide : function( event, ui ) { $( "#input_<?php echo esc_attr($id); ?>" ).val(ui.value).keyup(); }
        });
        $( "#input_<?php echo esc_attr($id); ?>" ).val( $( "#slider_<?php echo esc_attr($id); ?>" ).slider( "value" ) );
        $( "#input_<?php echo esc_attr($id); ?>" ).keyup(function() {
          $( "#slider_<?php echo esc_attr($id); ?>" ).slider( "value", $(this).val() );
        });
      });
    </script>
    <?php
  }
}

class KT_Customize_Switch_Control extends WP_Customize_Control {
  public $type = 'switch';

  public function render_content() { 
     $id = str_replace("]","_",$this->id);
    $id = str_replace("[","_",$id);
    ?>
    <label>
      <div class="switch-info">
        <input style="display: none;" type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
      </div>
      <span class="customize-control-title">
        <?php echo esc_html( $this->label ); ?>
      </span>
      <?php if ( '' != $this->description ) { ?>
      <span class="kt_tooltip hint--left" data-hint="<?php echo esc_attr($this->description); ?>"><span class='dashicons dashicons-info'></span></span>
      <?php } ?>
      <?php $classes = ( esc_attr( $this->value() ) ) ? ' On' : ' Off'; ?>
      <div class="kt_switch switch_<?php echo esc_attr($id); ?> <?php echo $classes; ?>">
        <div class="kt_toggle"></div>
        <span class="On"><?php echo __('On', 'pinnacle'); ?></span>
        <span class="Off"><?php echo __('Off', 'pinnacle'); ?></span>
      </div>
      </label>
     <script>
    jQuery(document).ready(function($) {
      $('.switch_<?php echo esc_attr($id); ?>').click(function() {
        if ($(this).hasClass('On')) {
          $(this).parent().find('input:checkbox').attr('checked', true);
          $(this).removeClass('On').addClass('Off');
        } else {
          $(this).parent().find('input:checkbox').attr('checked', false);
          $(this).removeClass('Off').addClass('On');
        }
    });
  });
     </script>
     <?php

  }
}
*/
/*
class KT_Customize_Image_Control extends WP_Customize_Control {
  public $type = 'image';
  public $mime_type = 'image';
   public function enqueue() {
                wp_enqueue_media();
        }

         public function render_content() {
    $this_val = $this->value() ? $this->value() : $this->default; 
    $id = str_replace("]","_",$this->id);
    $id = str_replace("[","_",$id); ?>
    <label>
      <span class="customize-control-title">
        <?php echo esc_html( $this->label ); ?>
      </span>
      <?php if ( '' != $this->description ) { ?>
        <span class="description customize-control-description"><?php echo $this->description; ?></span>
      <?php } ?>
    </label>
    <div id="kt_image_<?php echo esc_attr($id); ?>" class="kt_image_control">
    <?php
      $placeholder = isset( $this->field['placeholder'] ) ? $this->field['placeholder'] : __( 'No media selected', 'redux-framework' );
      echo '<input placeholder="' . $placeholder . '" type="text" class="regular-text" name="' . esc_attr($id) . '[url]" id="' . esc_attr($id). '[url]" value="' . $this_val['url'] . '"/>';
            echo '<input type="hidden" class="upload-id" name="' . esc_attr($id) . '[id]" id="' . esc_attr($id). '[id]" value="' . $this_val['id'] . '" />';
            echo '<input type="hidden" class="upload-height" name="' . esc_attr($id) . '[height]" id="' . esc_attr($id). '[height]" value="' . $this_val['height'] . '" />';
            echo '<input type="hidden" class="upload-width" name="' . esc_attr($id) . '[width]" id="' . esc_attr($id). '[width]" value="' . $this_val['width'] . '" />';
            echo '<input type="hidden" class="upload-thumbnail" name="' . esc_attr($id) . '[thumbnail]" id="' . esc_attr($id). '[thumbnail]" value="' . $this_val['thumbnail'] . '" />';
        ?>
    <div class="actions">
    <?php
           echo '<div class="upload_button_div">';

            //If the user has WP3.5+ show upload/remove button
            echo '<span class="button media_upload_button" id="' . esc_attr($id) . '-media">' . __( 'Upload', 'redux-framework' ) . '</span>';

            $hide = '';
            if ( empty( $this_val['url'] ) || $this_val['url'] == '' ) {
                $hide = ' hide';
            }

            echo '<span class="button remove-image' . $hide . '" id="reset_' . esc_attr($id) . '" rel="' . esc_attr($id) . '">' . __( 'Remove', 'redux-framework' ) . '</span>';

            echo '</div>';
           ?>
         <div style="clear:both"></div>
        </div>

    <?php
    }

} */

/* } */