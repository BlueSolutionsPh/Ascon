(function($){

  $(document).ready(function(){

    /* 数字の制御 */
    $('input.numeric').attr( { title:'半角数字で入力してください' } );
    $('input.numeric').css( 'ime-mode','disabled');
    $('input.numeric').keyup( function () {
      var Sanma = function (srcValue) {
        var num = new String(srcValue).replace(/,/g, "");
        while( num != ( num = num.replace( /^(-?\d+)(\d{3})/, "$1,$2" ) ) );
        return num;
      }

      var val_before = this.value ;
      var val_after = val_before.replace( /[^0-9]/g, '' ) ;
      val_after = Sanma(val_after) ;
      if ( val_before != val_after ) this.value = val_after;

    });

    /* 数字のみ可 */
    $('input.numOnly').attr( { title:'半角数字で入力してください' } );
    $('input.numOnly').css( 'ime-mode','disabled');
    $('input.numOnly').keyup( function () {
      var val_before = this.value ;
      var val_after = val_before.replace( /[^0-9]/g, '' ) ;
      if ( val_before != val_after ) this.value = val_after;
    });

    /* 日付のみ可 */
    $('input.dateOnly').attr( { title:'YYYY-MM-DD形式で入力してください' } );
    $('input.dateOnly').css( 'ime-mode','disabled');
    $('input.dateOnly').keyup( function () {
      var val_before = this.value ;
      var val_after = val_before.replace( /[^0-9-]/g, '' ) ;
      if ( val_before != val_after ) this.value = val_after;
    });

    $('input.dateOnly').each( function () {
      var opt = read_option( $(this).attr('cal_option'), '0,2,2' );

      $(this).datepicker({
        dateFormat  :'yy-mm-dd',
        monthNames  : ['1&#26376;', '2&#26376;', '3&#26376;', '4&#26376;', '5&#26376;', '6&#26376;', '7&#26376;', '8&#26376;', '9&#26376;', '10&#26376;', '11&#26376;', '12&#26376;' ],
        dayNamesMin : ['&#26085;', '&#26376;', '&#28779;', '&#27700;', '&#26408;', '&#37329;', '&#22303;' ],
        nextText    : '&#27425;&#26376;&#x3e;',
        prevText    : '&#x3c;&#21069;&#26376;',
        currentText : '&#20170;&#26085;',
        defaultDate : 30*parseInt(opt[0]),
        numberOfMonths   : parseInt(opt[1]),
        stepMonths       : parseInt(opt[2])
      });

    });

    $('input.dateOnly').change( function () {
      var val = this.value.match(/^(\d+)\-(\d+)\-(\d+)$/);
      if ( !val ){ this.value = ''; return ; }
      var yy = val[1];
      var mm = val[2];
      var dd = val[3];
      mm = mm.replace( /^0/, '' );
      dd = dd.replace( /^0/, '' );
      yy = parseInt(yy);
      mm = parseInt(mm);
      dd = parseInt(dd);
      var error = 0;
      if ( yy < 1000 || yy > 2037 ) error=1;
      if ( !( mm >= 1 && mm <= 12) ) error=2;
      if ( !error ) {
        var dd_max ;
        if ( mm != 2 ) {
          dd_max = new Array( 0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 )[mm];
        }
        else{
          dd_max = ( ( yy % 4 == 0 && yy % 100 != 0 ) || yy % 400 == 0 ) ? 29 : 28;
        }

        if ( !( dd >= 1 && dd <= dd_max) ) error=3 ;
      }
      if (error) this.value = '' ;
    });

    $('input.datetime').each( function () {
      var opt = read_option( $(this).attr('cal_option'), '0,1,1' );

      $(this).datetimepicker({
        dateFormat  :'yy-mm-dd',
        timeFormat  :'hh:mm',
        showOn: "button",
        buttonImage: "<?php echo URL::base(null, false) ?>js/jquery/calendar.gif",
        buttonImageOnly: true,
        showMinute  : true,
        monthNames  : ['1&#26376;', '2&#26376;', '3&#26376;', '4&#26376;', '5&#26376;', '6&#26376;', '7&#26376;', '8&#26376;', '9&#26376;', '10&#26376;', '11&#26376;', '12&#26376;' ],
        dayNamesMin : ['&#26085;', '&#26376;', '&#28779;', '&#27700;', '&#26408;', '&#37329;', '&#22303;' ],
        nextText    : '&#27425;&#26376;&#x3e;',
        prevText    : '&#x3c;&#21069;&#26376;',
        currentText : '&#20170;&#26085;',
        defaultDate : 30*parseInt(opt[0]),
        numberOfMonths   : parseInt(opt[1]),
        stepMonths       : parseInt(opt[2])
//        onSelect : function (dateText){
//          date = $(this).datepicker("getDate");
//          date.setMinutes(0);
//          date.setSeconds(0);
//          $(this).datepicker( "setDate" , date );
//        }
      });

    });

    $('input.datetime_2m').each( function () {
      var opt = read_option( $(this).attr('cal_option'), '0,2,1' );

      $(this).datetimepicker({
        dateFormat  :'yy-mm-dd',
        timeFormat  :'hh:mm',
        showOn: "button",
        buttonImage: "<?php echo URL::base(null, false) ?>js/jquery/calendar.gif",
        buttonImageOnly: true,
        showMinute  : true,
        monthNames  : ['1&#26376;', '2&#26376;', '3&#26376;', '4&#26376;', '5&#26376;', '6&#26376;', '7&#26376;', '8&#26376;', '9&#26376;', '10&#26376;', '11&#26376;', '12&#26376;' ],
        dayNamesMin : ['&#26085;', '&#26376;', '&#28779;', '&#27700;', '&#26408;', '&#37329;', '&#22303;' ],
        nextText    : '&#27425;&#26376;&#x3e;',
        prevText    : '&#x3c;&#21069;&#26376;',
        currentText : '&#20170;&#26085;',
        defaultDate : 30*parseInt(opt[0]),
        numberOfMonths   : parseInt(opt[1]),
        stepMonths       : parseInt(opt[2])
//        onSelect : function (dateText){
//          date = $(this).datepicker("getDate");
//          date.setMinutes(0);
//          date.setSeconds(0);
//          $(this).datepicker( "setDate" , date );
//        }
      });

    });

    $('input.datetime_end').each( function () {
      var opt = read_option( $(this).attr('cal_option'), '0,1,1' );

      $(this).datetimepicker({
        dateFormat  :'yy-mm-dd',
        timeFormat  :'hh:mm',
        showOn: "button",
        buttonImage: "<?php echo URL::base(null, false) ?>js/jquery/calendar.gif",
        buttonImageOnly: true,
        showMinute  : true,
        monthNames  : ['1&#26376;', '2&#26376;', '3&#26376;', '4&#26376;', '5&#26376;', '6&#26376;', '7&#26376;', '8&#26376;', '9&#26376;', '10&#26376;', '11&#26376;', '12&#26376;' ],
        dayNamesMin : ['&#26085;', '&#26376;', '&#28779;', '&#27700;', '&#26408;', '&#37329;', '&#22303;' ],
        nextText    : '&#27425;&#26376;&#x3e;',
        prevText    : '&#x3c;&#21069;&#26376;',
        currentText : '&#20170;&#26085;',
        defaultDate : 30*parseInt(opt[0]),
        numberOfMonths   : parseInt(opt[1]),
        stepMonths       : parseInt(opt[2]),
        hour	:	23,
        minute	:	59
      });

    });

    $('input.datetime_2m_end').each( function () {
      var opt = read_option( $(this).attr('cal_option'), '0,2,1' );

      $(this).datetimepicker({
        dateFormat  :'yy-mm-dd',
        timeFormat  :'hh:mm',
        showOn: "button",
        buttonImage: "<?php echo URL::base(null, false) ?>js/jquery/calendar.gif",
        buttonImageOnly: true,
        showMinute  : true,
        monthNames  : ['1&#26376;', '2&#26376;', '3&#26376;', '4&#26376;', '5&#26376;', '6&#26376;', '7&#26376;', '8&#26376;', '9&#26376;', '10&#26376;', '11&#26376;', '12&#26376;' ],
        dayNamesMin : ['&#26085;', '&#26376;', '&#28779;', '&#27700;', '&#26408;', '&#37329;', '&#22303;' ],
        nextText    : '&#27425;&#26376;&#x3e;',
        prevText    : '&#x3c;&#21069;&#26376;',
        currentText : '&#20170;&#26085;',
        defaultDate : 30*parseInt(opt[0]),
        numberOfMonths   : parseInt(opt[1]),
        stepMonths       : parseInt(opt[2]),
        hour	:	23,
        minute	:	59
      });

    });
    
    $('input.date').each( function () {
      var opt = read_option( $(this).attr('cal_option'), '0,1,1' );

      $(this).datepicker({
        dateFormat  :'yy-mm-dd',
        showOn: "button",
        buttonImage: "<?php echo URL::base(null, false) ?>js/jquery/calendar.gif",
        buttonImageOnly: true,
        monthNames  : ['1&#26376;', '2&#26376;', '3&#26376;', '4&#26376;', '5&#26376;', '6&#26376;', '7&#26376;', '8&#26376;', '9&#26376;', '10&#26376;', '11&#26376;', '12&#26376;' ],
        dayNamesMin : ['&#26085;', '&#26376;', '&#28779;', '&#27700;', '&#26408;', '&#37329;', '&#22303;' ],
        nextText    : '&#27425;&#26376;&#x3e;',
        prevText    : '&#x3c;&#21069;&#26376;',
        currentText : '&#20170;&#26085;',
        defaultDate : 30*parseInt(opt[0]),
        numberOfMonths   : parseInt(opt[1]),
        stepMonths       : parseInt(opt[2])
      });

    });

    $('input.birthday').focus( function () {
      $(this).datepicker({
        dateFormat  :'yy-mm-dd',
        monthNamesShort : ['1&#26376;', '2&#26376;', '3&#26376;', '4&#26376;', '5&#26376;', '6&#26376;', '7&#26376;', '8&#26376;', '9&#26376;', '10&#26376;', '11&#26376;', '12&#26376;' ],
        dayNamesMin : ['&#26085;', '&#26376;', '&#28779;', '&#27700;', '&#26408;', '&#37329;', '&#22303;' ],
        currentText : '&#20170;&#26085;',
        changeYear  : true,
        changeMonth : true,
        yearRange   : '-80:+10'
      });
    });

  });//ready

})(jQuery);

var is_mail_addr = function (str) {
  return str.match( /^[a-zA-Z0-9_\/\-.\+\?\[\]]+\@[a-zA-Z0-9_\.\-]+\.\w+$/)
}

var tiny_init = function(elem, onchange_callback){

  if ( onchange_callback == undefined ) {
    onchange_callback = function (){
    };
  }

  tinyMCE.init({
    theme : "advanced",
    mode : "exact",
    elements : elem,
    plugins : "preview,contextmenu,fullscreen",
    plugin_preview_width : "600",
    plugin_preview_height : "600",
    //width: "500",
    //height: "500",
    theme_advanced_toolbar_location : "top",
    //theme_advanced_layout_manager : "SimpleLayout",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,
    theme_advanced_resizing_use_cookie : true,
    theme_advanced_buttons1 : "newdocument,formatselect,fontsizeselect,separator,bold,separator,forecolor",
    theme_advanced_buttons2 : "undo,redo,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,image,separator,code,separator,preview,separator,fullscreen",
    theme_advanced_buttons3 : "",
    //content_css : "styles-content.css",    // テキストエリアのフォントサイズを指定
    //popups_css  : "styles-popups.css",    // ポップアップウィンドウのフォント名を指定
    //apply_source_formatting : true,        // 出力する HTML を整形してくれる。デフォルトはオフ。
    //language    : "ja_utf-8"            // 日本語対応
    language : "ja",
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : '',
    blank : 'null',
    convert_urls: false,
    onchange_callback : onchange_callback
  });
};
