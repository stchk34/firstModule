(function ($) {
  Drupal.behaviors.formErrorBehavior = {
    attach: function (context, settings) {
      $('.img-responsive').once('ffdf').click(function (event) {
        $(this).parent().toggleClass('active-popup');
      });
    }
  }
})(jQuery);
