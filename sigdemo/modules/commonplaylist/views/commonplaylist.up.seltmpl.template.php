
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Update common playlist</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Update common playlist</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "up_seltmpl") ?>
          <?php echo Form::hidden("act", "seltmpl") ?>
          <?php echo Form::hidden("playlist_id", $post["playlist_id"]) ?>

            <div class="">
              <dl class="dl_input_02" style="float:left;width:50%">

                <dt>Playlist name</dt>
                <dd>
                  <?php echo Form::input("playlist_name", $post["playlist_name"], array("id" => "commonplaylist_up_seltmpl_playlist_name", "required" => "true", "maxlength" => "60", "class" => "input250")) ?>※ Within 60 characters
                </dd>

                <dt>sex</dt>
                <dd>
                  <?php echo Form::select("sex_id", $arr_sex,  $post["sex_id"], array("id" => "commonplaylist_up_seltmpl_sex_id", "required" => "true")) ?>
                </dd>

                <dt>Delivery time zone</dt>
                <dd>
                  <?php echo Form::select("timezone_id", $arr_time_zone,  $post["timezone_id"], array("id" => "commonplaylist_up_seltmpl_timezone_id", "required" => "true")) ?>
                </dd>

                <dt>Delivery month</dt>
                <dd>
                  <?php echo Form::select("deliverymonth_id", $arr_delivery_month,  $post["deliverymonth_id"], array("id" => "commonplaylist_up_seltmpl_deliverymonth_id", "required" => "true")) ?>
                </dd>

                <dt>Delivery period</dt>
                <dd>
                  <?php echo Form::input("sta_dt", substr($post["sta_dt"],0,10), array("id" => "commonplaylist_up_seltmpl_sta_dt", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off', "required" => "true")) ?></td>
                    ～
                  <?php echo Form::input("end_dt", substr($post["end_dt"],0,10), array("id" => "commonplaylist_up_seltmpl_end_dt", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off', "required" => "true")) ?></td>
                </dd>

              </dl>

            </div>
            <div class="clearfix"></div>
            <div class="text_01 hr_wrapper_02">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_COMMONPLAYLIST, "Return", array("id" => "commonplaylist_up_seltmpl_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "update", array("id" => "commonplaylist_up_seltmpl_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>

    <!-- #/main -->
