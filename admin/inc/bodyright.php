<?php
	if(isset($_GET['viewall_cat'])){
		if(isset($_GET['viewall_sub_cat'])){
			if(isset($_GET['add_product'])){
				if(isset($_GET['viewall_product'])){
?>					
					<div id="bodyright">
					   <?php
							if(!isset($_GET['edit_cat'])){
								  //include("edit_cat.php");
							}
							
							if(!isset($_GET['edit_sub_cat'])){
								  //include("edit_sub_cat.php");
							}
							
							if(isset($_GET['delete_cat'])){
								//include("delete_Cat.php");
							}
						?>
					</div><!--end of bodyright-->
<?php					
				}
			}
		}
	}
?>