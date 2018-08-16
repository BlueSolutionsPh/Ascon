
    <div class="top_title">
      <div class="top_title_wrapper">
        <div class="top_title_inner clearfix">
          <div class="text">Facility removal</div>
        </div>
      </div>
    </div>

    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="box_01">
        <h3 class="title">Facility removal</h3>
        <div class="content">
        <?php echo Form::open() ?>
        <?php echo Form::hidden("token", $token) ?>
        <?php echo Form::hidden("disp", "del") ?>
        <?php echo Form::hidden("act", "del") ?>
        <?php echo Form::hidden("shop_id", $shop_id) ?>
        <?php echo Form::hidden("client_id", $client_id) ?>

          <div class="text_02">Do you want to delete the following stores?</div>
          <div class="hr_wrapper_01">
            <table class="tbl_01">
              <tr>
                <th scope="row" width="20%">Name of facility</th>
                <td><?php echo(Kohana_HTML::entities($shop_name)); ?></td>
              </tr>
            </table>
          </div>
          <div class="text_01">Confirm the above contents and press "delete" button</div>
          <div class="btn_area_02">
            <?php echo HTML::anchor("/" . MODULE_NAME_SHOP, "Return", array("id" => "shop_del_back", "class" => "btn1 btn_l"), null, false) ?>
            <?php echo Form::button(NULL, "Delete", array("id" => "shop_del_submit", "type" => "submit", 'class'=>'btn1 btn_r')) ?>
          </div>
          <div class="clear"></div>
        <?php echo Form::close() ?>

        </div>
      </div>
    </div>
    <!-- #/main --> 
