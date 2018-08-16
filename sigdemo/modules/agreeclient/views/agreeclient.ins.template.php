
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Create Contract Client</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Create Contract Client</h3>
        <div class="content">

          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
          <?php echo Form::hidden("disp", "ins") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
                <dt>クライアント名</dt>
                <dd>
                  <?php echo Form::input("client_name", HTML::replace_empty_array_value($post, "client_name"), array("id" => "client_ins_client_name", "required" => "true", "maxlength" => "20", "class" => "input250")) ?>
                  ※ Within 20 characters
                </dd>
                <dt>Content file size total maximum value (GB)</dt>
                <dd>
                  <?php echo Form::input("max_total_cts_file_size", HTML::replace_empty_array_value($post, "max_total_cts_file_size"), array("id" => "client_ins_max_total_cts_file_size", "required" => "true", "maxlength" => "2", "class" => "input50")) ?>
                  ※ Within 2 digits
                </dd>
                <dt>Remarks</dt>
                <dd>
                  <?php echo Form::textarea("note", HTML::replace_empty_array_value($post, "note"), array("id" => "client_ins_note", "required" => "true", "maxlength" => "500", "class" => "input500")) ?>
                  ※ Within 500 characters
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Register" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_CLIENT, "Return", array("id" => "client_ins_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "Registration", array("id" => "client_ins_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main -->
