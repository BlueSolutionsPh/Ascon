( function( $ ){

  $(document).ready(function(){
    /* Open a small window */
    $('a.ow, a[ow_option]').click( function (){
      var opt = read_option( $(this).attr('ow_option'), '350,350' );
      var t =  $(this).attr('target') || 'sw';
      window.open( this.href, t, 'resizable=yes,scrollbars=yes,width='+opt[0]+',height='+opt[1]).focus();
      return false;
    });

    /* Open a small window */
    $('form.ow, form[ow_option]').submit( function (){
      var opt = read_option( $(this).attr('ow_option'), '350,350' );
      var t =  $(this).attr('target') || 'sw';
      window.open( '', t, 'resizable=yes,scrollbars=yes,width='+opt[0]+',height='+opt[1]).focus();
      this.target = 'sw';
    });

    /* Transmission processing without screen transition */
    $('form.hw').submit( function (){

      var check = $(this).attr('check');
      var conf = $(this).attr('confirm');
      var success = $(this).attr('success');

      if ( check && !eval(check) ) return false;
      if ( conf && !confirm(conf) ) return false;

      $.ajax({
        url : this.action,
        data: $(this).serialize(),
        type: 'post',
        success : function(){
          if ( success  ) { alert(success); }
          else { document.location.reload(true); }
        } // success
      }); // $.ajax

      return false;
    });

    /* koukai switching(ajax) */
    $('a.hw').click( function (){
      var $$ = $(this);

      $.ajax({
        url : $$.attr('href'),
        data: {},
        type: 'get',
        success : function(text){
          if ( new String($$.html()).match(/Release/) ) {
            if ( text==0 ){
              $$.html('private');
              $$.removeClass('koukai-1');
              $$.addClass('koukai-0');
            }else {
              $$.html('Release');
              $$.removeClass('koukai-0');
              $$.addClass('koukai-1');
             }
          } else if ( new String($$.html()).match(/Use/) ) {
            if ( text==0 ){
              $$.html('out of service');
              $$.removeClass('koukai-1');
              $$.addClass('koukai-0');
            }else {
              $$.html('available');
              $$.removeClass('koukai-0');
              $$.addClass('koukai-1');
             }
          } else {
            document.location.reload(true) ;
          }
        }
      }); // $.ajax

      return false;
    });

    /* stripe */
    $("table.stripe tr:odd").addClass("odd");
    $("table.stripe tr").hover( function () { $(this).addClass("hover") }, function () { $(this).removeClass("hover") } );

    /*  Menu opening and closing  */
    $('#main_navi h3').click(function(){
      $(this).next().slideToggle();
      return false;
    });
    $('.box_type01 h2').click(function(){
    $(this).next('.inner').slideToggle();
      return false;
    });

    /*  Add odd to tr */
    $("tr:odd").addClass("odd");

  });//ready

})(jQuery);

var pageSeek = function (sk) {
  jQuery('input[name=sk]').val(sk);
  jQuery('#skForm').submit();
}

var pageSort = function (key) {
  jQuery('input[name=SortN]').val(key);
  jQuery('#skForm').submit();
}
