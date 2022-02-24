<table class="table table-striped">
	<thead>
	  	<tr>
			<th>ID</th>
			<th><?= _('Name') ?></th>
			<th><?= _('Date') ?></th>
			<th></th>
	  	</tr>
	</thead>
	<tbody>
<?
foreach($htaccesses as $htaccess){
?>
		<tr>
			<th><?= $htaccess['id'] ?></th>
			<td><?= $htaccess['name'] ?></td>
			<td><?= $htaccess['date'] ?></td>
			<td>
				<a href="<?= $langPath ?>/delete-htaccess/<?= $htaccess['id'] ?>" title="<?= _('Delete htaccess') ?>"><i class="fa fa-trash fa-lg red"></i></a>
		  		<a href="<?= $langPath ?>/download-htaccess/<?= $htaccess['id'] ?>" title="<?= _('Download htaccess') ?>"><i class="fa fa-download fa-lg"></i></a>
		  	</td>
		</tr>     
<?
	}
?>
	</tbody>
</table>