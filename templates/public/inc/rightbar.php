<div class="right">
	<h2>Danh mục</h2>
	<ul>
		<?php
			$queryDM = "SELECT * FROM category";
			$resultDM = $mysqli->query($queryDM);
			while($arDM = mysqli_fetch_assoc($resultDM)){
				$id_cat = $arDM['id_cat'];
				$name = $arDM['name'];
				//biểu thức chính quy
				$new_name = convertUtf8ToLatin($name);
				$url = '/danh-muc/' . $new_name . '-' . $id_cat;
		?>
		<li><a href="<?php echo $url; ?>"><?php echo $arDM['name'] ;?></a></li>
		<?php
			}
		?>
	</ul>
</div>