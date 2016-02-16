jQuery(document).ready(function($) {
      $('.customize-control-switch .kt_switch').click(function() {
        if ($(this).hasClass('On')) {
          $(this).parent().find('input:checkbox').attr('checked', true);
          $(this).removeClass('On').addClass('Off');
        } else {
          $(this).parent().find('input:checkbox').attr('checked', false);
          $(this).removeClass('Off').addClass('On');
        }
    });
  });