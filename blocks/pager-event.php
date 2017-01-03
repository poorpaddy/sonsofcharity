<div class="navigation">
	<div class="prev">
		<?php $prev_post_id = next_post_link_plus( array(
			'order_by' => 'numeric', 
			'meta_key' => 'event_start_date',
			'order_2nd' => 'ASC',
			'post_type' => '"events"',
			'format' => '%link',
			'link' => 'Next <i class="fa fa-angle-right"></i>',
			'echo' => 'false',
			'return' => 'id'
		) ); ?>
		
		<?php 
			$currentdate = getdate()[0];
			$postprevdate = get_field('event_start_date', $prev_post_id);
			if ($currentdate >= $postprevdate)  {$exprevposts = false;}
			else {$exprevposts = true;}
		?>
		
		<?php next_post_link_plus( array(
			'order_by' => 'numeric', 
			'meta_key' => 'event_start_date',
			'order_2nd' => 'ASC',
			'post_type' => '"events"',
			'format' => '%link',
			'link' => 'Next <i class="fa fa-angle-right"></i>',
			'echo' => $exprevposts
		) ); ?>
	</div>
	<div class="next">
		<?php $next_post_id = previous_post_link_plus( array(
			'order_by' => 'numeric', 
			'meta_key' => 'event_start_date',
			'order_2nd' => 'ASC',
			'post_type' => '"events"',
			'format' => '%link',
			'link' => '<i class="fa fa-angle-left"></i> Prev',
			'echo' => 'false',
			'return' => 'id'
		) ); ?>
		
		<?php 
			$postnextdate = get_field('event_start_date', $next_post_id);
			if ($currentdate > $postnextdate)  { $exnextposts = false;}
			else {$exnextposts = true;}
		?>
		
		<?php previous_post_link_plus( array(
			'order_by' => 'numeric', 
			'meta_key' => 'event_start_date',
			'order_2nd' => 'ASC',
			'post_type' => '"events"',
			'format' => '%link',
			'link' => '<i class="fa fa-angle-left"></i> Prev',
			'echo' => $exnextposts
		) ); ?>
	</div>
</div>

