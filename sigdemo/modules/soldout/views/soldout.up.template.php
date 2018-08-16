    <div id="main">
      <?php echo View::get_action_msg($arr_action_result, $arr_error) ?>
      <div class="soldout">
        <h3 class="title">Sold out image update</h3>
        <div class="content">
          <?php echo Form::open(null, array("enctype" => "multipart/form-data")) ?>
            <?php echo Form::hidden("disp", "up") ?>
            <?php echo Form::hidden("act", "up") ?>
            <p class="text01">
              <?php echo Form::label("image_file", "Image file") ?><br />
              <?php echo Form::file("image_file", array("id" => "soldout_up_image_file", "class" => "soldout", "required" => "true", "size" => "50")) ?>
            </p>
            <?php echo Form::button(NULL, "update", array("id" => "soldout_up_submit", "class" => "soldout", "type" => "submit")) ?>
          <?php echo Form::close() ?>
        </div>
      </div>
    </div>
    <!-- #/main --> 
