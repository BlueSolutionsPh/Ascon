
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix"><div class="text">Terminal setting [Display history by terminal]</div>
          <div class="menu_link"><?php echo HTML::anchor("/" . MODULE_NAME_MENU, "To the menu", array("id" => "dllog_menu", "class" => "btn2"), null, false) ?></div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Display download history by terminal</h3>
        <div class="content">

          <div class="hr_wrapper_01">
            <?php echo Form::open(null, array("id" => "dllog_search_form")) ?>
            <?php echo Form::hidden("dev_id", $post["dev_id"]) ?>
              <table cellspacing="1" cellpadding="3" border="0" class="searchForm">
                <tr>
                  <td>
                  start date<br />
                  <?php echo Form::input("sta_date", HTML::replace_empty_array_value($post, "sta_date"), array("id" => "dllog_sta_date", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                  ※YYYY-MM-DD
                  </td>
                </tr>
                <tr>
                  <td>
                  End date<br />
                  <?php echo Form::input("end_date", HTML::replace_empty_array_value($post, "end_date"), array("id" => "dllog_end_date", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off')) ?>
                  ※YYYY-MM-DD
                  </td>
                </tr>
                <tr>
                <td>
                                           ※ When not specified, last 7 days,<br />
　                                       When specifying only the start date, it is 7 days after the start date,<br />
　                                       Up to 1000 items of information on 7 days before the end date are displayed when only the end date is specified<br />
                </td>
                </tr>
                <tr>
                <td>
                                           ※ Since data before 60 days will be deleted, it can not be confirmed.
                </td>
                </tr>
                <tr>
                  <td><?php echo Form::button(NULL, "Search", array("id" => "dllog_search", "type" => "submit", 'class'=>'btn3')) ?></td>
                </tr>
              </table>
            <?php echo Form::close() ?>
          </div>

          <div class="hr_wrapper_01">
            <h3>Display download history by terminal</h3>
            <p class="text01">
              <?php echo Form::label("shop_name", "Store name:") ?>
              <?php echo Form::label("shop_name", $shop_name) ?>
            </p>
            <p class="text01">
              <?php echo Form::label("dev_name", "Device name:") ?>
              <?php echo Form::label("dev_name", $dev_name) ?>
            </p>
          </div>

          <?php echo $pagination ?>

          <?php if(!empty($arr_dl_log)):?>
            <table class="tbl_01 tbl_yoko on">
              <tr>
                <th scope="col" width="20%">Program guide download start date and time</th>
                <th scope="col" width="20%">Program guide download end date and time</th>
                <th scope="col" width="20%">HTML download start date and time</th>
                <th scope="col" width="20%">HTML download end date and time</th>
              </tr>

              <?php foreach ($arr_dl_log as $dl_log): ?>
              <tr>
                <td style="text-align:center;">
                  <?php if(isset($dl_log["prog"]) && isset($dl_log["prog"]->sta_dt)):?>
                  <?php echo(Kohana_HTML::entities(HTML::replace_empty_str($dl_log["prog"], "sta_dt"))); ?>
                  <?php else: ?>
                  -
                  <?php endif ?>
                </td>
                <td style="text-align:center;">
                  <?php if(isset($dl_log["prog"]) && isset($dl_log["prog"]->end_dt)):?>
                  <?php echo(Kohana_HTML::entities(HTML::replace_empty_str($dl_log["prog"], "end_dt"))); ?>
                  <?php else: ?>
                  -
                  <?php endif ?>
                </td>
                <td style="text-align:center;">
                  <?php if(isset($dl_log["html"]) && isset($dl_log["html"]->sta_dt)):?>
                  <?php echo(Kohana_HTML::entities(HTML::replace_empty_str($dl_log["html"], "sta_dt"))); ?>
                  <?php else: ?>
                  -
                  <?php endif ?>
                </td>
                <td style="text-align:center;">
                  <?php if(isset($dl_log["html"]) && isset($dl_log["html"]->end_dt)):?>
                  <?php echo(Kohana_HTML::entities(HTML::replace_empty_str($dl_log["html"], "end_dt"))); ?>
                  <?php else: ?>
                  -
                  <?php endif ?>
                </td>
              </tr>
              <?php endforeach ?>

            </table>
          <?php endif ?>
          <?php echo $pagination ?>

        </div>
      </div>
    </div>
    <!-- #/main -->
