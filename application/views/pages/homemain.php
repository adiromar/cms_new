<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
		<h2 class="text-center mt-4"><?=  $title  ?> Page</h2>
		<?php 
		foreach ($tables as $key) {
			$name = $key['title'];
			$id = $key['id'];
			echo "<h2>".$key['title']." :</h2>"; 
			?>
			<form action="<?php base_url(); ?>posts/insert" method="post">
			<?php
				$fields = explode(',', $key['fields']);
				$types = explode(',', $key['types']);
				
				$fields = array_combine($fields, $types); ?>
				<div class="form-inline mb-4">
				<?php
				foreach ($fields as $key => $value) 
				{ ?>
					<?php if ($value == 'TEXT'): ?>
						<label for="" class="form-control-label col-md-4"><?= ucfirst($key) ?>:</label>
						<textarea name="<?= $key ?>" class="form-control col-md-8" required></textarea>

					<?php elseif (strpos($value,'radio') !== FALSE): ?>
						
					<label for="" class="form-control-label col-md-4"><?= ucfirst($key) ?>:</label>
						<?php foreach ($values as $k) 
						{
							if ($id == $k['tableid'] && $value == $k['name']) 
							{
								$vals = explode('|', $k['vals']);
								foreach ($vals as $k) 
								{ ?>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="<?= $key ?>">
										<label class="form-check-label form-control-label" ><?= $k ?></label>
									</div>
						<?php   }
							}
						}	 ?>
					
					<?php endif; ?>
						<input type="hidden" name="tablename" value="<?= $name ?>">
				<?php	}  ?> 
						<input class="btn btn-info col-md-4 offset-6 mt-4" type="submit" value="submit">
				</div>
			</form>
		<?php
		// break;
		}//end of main loop
		?>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>