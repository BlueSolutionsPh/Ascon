<p class="pagination"  style="float:left;">
	<?php if ($first_page !== FALSE): ?>
		<a href="" onclick="func_page_search(<?php echo $first_page ?>);return false;" rel="first"><?php echo __('<<') ?></a>
	<?php else: ?>
		<?php echo __('<<') ?>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="" onclick="func_page_search(<?php echo $previous_page ?>);return false;" rel="prev"><?php echo __('<') ?></a>
	<?php else: ?>
		<?php echo __('<') ?>
	<?php endif ?>

	<?php if($total_pages > MAX_PAGE_CNT): ?>
		<?php if($total_pages > MAX_PAGE_CNT): ?>
			<?php if($current_page - floor((MAX_PAGE_CNT - 1) / 2) > 0): ?>
				<?php $sta = $current_page - floor((MAX_PAGE_CNT - 1) / 2) ?>
			<?php else: ?>
				<?php $sta = 1 ?>
			<?php endif ?>
			<?php if($total_pages > ($sta + MAX_PAGE_CNT - 1)): ?>
				<?php $end = $sta + MAX_PAGE_CNT - 1 ?>
			<?php else: ?>
				<?php $end = $total_pages ?>
				<?php $sta = $total_pages - MAX_PAGE_CNT + 1 ?>
			<?php endif ?>
		<?php endif ?>
	<?php else: ?>
		<?php $sta = 1 ?>
		<?php $end = $total_pages ?>
	<?php endif ?>
	
	<?php for ($i = $sta; $i <= $end; $i++): ?>
		<?php if ($i == $current_page): ?>
			<strong><?php echo $i ?></strong>
		<?php else: ?>
			<a href="" onclick="func_page_search(<?php echo $i ?>);return false;"><?php echo $i ?></a>
		<?php endif ?>
	<?php endfor ?>
	
	<?php if ($next_page !== FALSE): ?>
		<a href="" onclick="func_page_search(<?php echo $next_page ?>);return false;" rel="next"><?php echo __('>') ?></a>
	<?php else: ?>
		<?php echo __('>') ?>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="" onclick="func_page_search(<?php echo $last_page ?>);return false;" rel="last"><?php echo __('>>') ?></a>
	<?php else: ?>
		<?php echo __('>>') ?>
	<?php endif ?>

</p><!-- .pagination -->

<div style="float:right;">
	<?php echo (($current_page - 1) * MAX_CNT_PER_PAGE) + 1 ?>件 ～ <?php if(($current_page * (MAX_CNT_PER_PAGE)) > $total_items): echo $total_items; else: echo $current_page * (MAX_CNT_PER_PAGE); endif?>件　全<?php echo $total_items ?>件
</div>

<div class="clear"></div>