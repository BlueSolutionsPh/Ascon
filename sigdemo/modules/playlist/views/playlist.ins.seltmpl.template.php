
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Create a separate playlist for each client</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Create a separate playlist for each client</h3>
        <div class="content">

          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "ins_seltmpl") ?>
          <?php echo Form::hidden("act", "seltmpl") ?>

            <div class="">
              <dl class="dl_input_02" style="float:left;width:50%">

                <dt>Playlist name</dt>
                <dd>
                  <?php echo Form::input("playlist_name", HTML::replace_empty_array_value($post, "playlist_name"), array("id" => "playlist_ins_seltmpl_playlist_name", "required" => "true", "maxlength" => "60", "class" => "input250")) ?>※ Within 60 characters
                </dd>
                <dt>Contract client name</dt>
                <dd>
                  <?php echo Form::select("client_id", $arr_all_client, HTML::replace_empty_array_value($post, "client_id"), array("id" => "playlist_ins_client_id", "required" => "true")) ?>
                </dd>
                <dt>Delivery month</dt>
                <dd>
                  <?php echo Form::select("deliverymonth_id", $arr_delivery_month,  HTML::replace_empty_array_value($post, "deliverymonth_id"), array("id" => "playlist_ins_deliverymonth_id", "required" => "true")) ?>
                </dd>

                <dt>Delivery period</dt>
                <dd>
                  <?php echo Form::input("sta_dt", $post["sta_dt"], array("id" => "playlist_ins_sta_dt", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off', "required" => "true")) ?></td>
                    ～
                  <?php echo Form::input("end_dt", $post["end_dt"], array("id" => "playlist_ins_end_dt", "maxlength" => "20", 'class'=>'input100 date', 'cal_option'=>'0,1,1', 'autocomplete'=>'off', "required" => "true")) ?></td>
                </dd>

              </dl>

            </div>
            <div class="clearfix"></div>
            <div class="text_01 hr_wrapper_02">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_PLAYLIST, "Return", array("id" => "playlist_ins_seltmpl_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "playlist_ins_seltmpl_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>

    <!-- #/main -->
