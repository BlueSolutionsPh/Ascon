
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Delivery time type</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Delivery time types</h3>
        <div class="content">
          <?php echo Form::open() ?>
          <?php echo Form::hidden("disp", "up") ?>
          <?php echo Form::hidden("act", "conf") ?>

            <div class="hr_wrapper_01">
              <dl class="dl_input_02">
              
                <dt>Morning</dt>
                <dd>
                  <?php echo Form::select('sta_t-h_2', $map_list['time_h'], $post['sta_t-h_2'], array("id" => "sta_t-h_2")) ?>
                  :
                  <?php echo Form::select('sta_t-m_2', $map_list['time_m'], $post['sta_t-m_2'], array("id" => "sta_t-m_2")) ?>
                   ～ 
                  <?php echo Form::select('end_t-h_2', $map_list['time_h'], $post['end_t-h_2'], array("id" => "end_t-h_2")) ?>
                  :
                  <?php echo Form::select('end_t-m_2', $map_list['time_m'], $post['end_t-m_2'], array("id" => "end_t-m_2")) ?>
                </dd>
                
                
                <dt>Noon</dt>
                <dd>
                  <?php echo Form::select('sta_t-h_3', $map_list['time_h'], $post['sta_t-h_3'], array("id" => "sta_t-h_3")) ?>
                  :
                  <?php echo Form::select('sta_t-m_3', $map_list['time_m'], $post['sta_t-m_3'], array("id" => "sta_t-m_3")) ?>
                   ～ 
                  <?php echo Form::select('end_t-h_3', $map_list['time_h'], $post['end_t-h_3'], array("id" => "end_t-h_3")) ?>
                  :
                  <?php echo Form::select('end_t-m_3', $map_list['time_m'], $post['end_t-m_3'], array("id" => "end_t-m_3")) ?>
                </dd>
                
                
                <dt>Night</dt>
                <dd>
                  <?php echo Form::select('sta_t-h_4', $map_list['time_h'], $post['sta_t-h_4'], array("id" => "sta_t-h_4")) ?>
                  :
                  <?php echo Form::select('sta_t-m_4', $map_list['time_m'], $post['sta_t-m_4'], array("id" => "sta_t-m_4")) ?>
                   ～ 
                  <?php echo Form::select('end_t-h_4', $map_list['time_h'], $post['end_t-h_4'], array("id" => "end_t-h_4")) ?>
                  :
                  <?php echo Form::select('end_t-m_4', $map_list['time_m'], $post['end_t-m_4'], array("id" => "end_t-m_4")) ?>
                </dd>
              </dl>
            </div>
            <div class="text_01">Confirm the above contents and press "Update" button</div>
            <div class="btn_area_02">
              <?php echo HTML::anchor("/" . MODULE_NAME_MENU, "Return", array("id" => "timezone_up_back", "class" => "btn1 btn_l"), null, false) ?>
              <?php echo Form::button(NULL, "update", array("id" => "timezone_up_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
            </div>
          <?php echo Form::close() ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- #/main --> 
