(function($) {
  $.fn.popupHelp=function(config) {
    /**
      * marginTop: It is the difference between the display target and the height of the window.
      *   If 0 is specified, the top edge is aligned.
      * marginLeft: This is the difference between the display object and the window.
      *   If 0 is specified, the left edge is aligned.
      * className: Class name to set in the window.
      * speed: Number of seconds to display the window [ms].
      */
    var defaults = {
      marginTop: 0,
      marginLeft: 20,
      className: "popup_help_window",
      speed: 100
    }

    var options = $.extend(defaults, config);

    // Prepare the objects in the help window.
    var popupObj = $("<p/>").addClass(defaults.className).appendTo($("body"));

    return this.each(function() {

      $(this).mouseover(function() {
        // This is processing when the mouse overlaps the display object.

        // Set a message in the window.
        popupObj.text($(this).attr('data-message'));

        // Calculate the offset of the window.
        var offsetTop = $(this).offset().top + defaults.marginTop;
        var offsetLeft = $(this).offset().left + defaults.marginLeft;

        // Arrange the window position and display it.
        popupObj.css({
          "top": offsetTop,
          "left": offsetLeft
        }).show(defaults.speed);

      }).mouseout(function() {
        // This is processing when the mouse overlaps the display object.
        // Empty the text and hide the window.
        popupObj.text("").hide("fast");
      });
    });
  };
})(jQuery);
