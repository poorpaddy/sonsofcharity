<?php $sq = get_search_query() ? get_search_query() : __('Enter search terms&hellip;', 'sonsofcharity'); ?>
<form method="get" class="search-form" action="<?php echo home_url(); ?>" >
	<fieldset>
		<input type="search" name="s" value="<?php echo $sq; ?>" />
		<input type="submit" class="btn btn-blue-border" value="Search" />
	</fieldset>
</form>