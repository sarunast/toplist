<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

<?php if ($paginator->getLastPage() > 1): ?>
	
		<ul class="pagination" style="margin-top: 5px;">
			<?php echo $presenter->render(); ?>
		</ul>
	
<?php endif; ?>
