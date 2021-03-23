<?php $this->load->model('categories_model', 'categories'); ?>
<?php $i=0; foreach($this->categories->get_categories() as $category): if($i>4) break; ?>
		<li>
			<a href="<?php echo base_url("products/index/$category->id"); ?>">
				<?php echo $category->name; ?>
			</a>
		</li>
<?php $i++; endforeach; ?>