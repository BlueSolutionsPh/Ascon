<arr_dev>
  <?php foreach($arr_dev as $dev_id => $dev_name): ?>
    <dev>
      <dev_id><?php echo(Html::chars($dev_id)) ?></dev_id>
      <dev_name><?php echo(Html::chars($dev_name)) ?></dev_name>
    </dev>
  <?php endforeach ?>
</arr_dev>