<div id="bodyleft">
	<h3>Content Management</h3>	
	
	<ul>
		<li><a href="indexAdmin.php?user_statistic">View User</a></li>
		<li><a href="indexAdmin.php?viewall_cat">View all Categories</a></li>
		<li><a href="indexAdmin.php?viewall_Sub_cat">View sub Categories</a></li>
		<li><a href="indexAdmin.php?Add_products">Add New Products</a></li>
		<li><a href="indexAdmin.php?viewall_products1">View All Products</a></li>
		<li><a href="indexAdmin.php?viewall_brands">View All Brands</a></li>
		<li><a href="indexAdmin.php?user_contactMessages">View All Contact Messages</a></li>
	</ul>
</div><!--end of bodyleft-->

<?php
if(isset($_GET['delete_Message'])){
	include("delete_message.php");
}

if(isset($_GET['user_contactMessages'])){
	include("viewall_contactMessages.php");
}

if(isset($_GET['viewall_brands'])){
	include("brand.php");
}

if(isset($_GET['user_statistic'])){
	include("user_statistic.php");
}

if(isset($_GET['delete_brand'])){
	include("delete_brand.php");
}

if(isset($_GET['delete_pro'])){
	include("delete_pro.php");
}

if(isset($_GET['delete_sub_cat'])){
	include("delete_sub_cat.php");
}

if(isset($_GET['delete_cat'])){
	include("delete_Cat.php");
}

if(isset($_GET['edit_pro'])){
	include("edit_pro.php");
}

if(isset($_GET['edit_cat'])){
	include("edit_cat.php");
}

if(isset($_GET['edit_sub_cat'])){
	include("edit_sub_cat.php");
}

if(isset($_GET['viewall_cat'])){
	include("cat.php");
}

if(isset($_GET['viewall_Sub_cat'])){
	include("sub_cat.php");
}

if(isset($_GET['Add_products'])){
	include("add_products.php");
}

if(isset($_GET['viewall_products1'])){
	include("viewall_products1.php");
}
?>