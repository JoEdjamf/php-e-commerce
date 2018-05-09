<?php
session_start();
include "db.php";
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categories</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["id_cat"];
			$cat_name = $row["titre_cat"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["brand"])){
	$brand_query = "SELECT * FROM marques";
	$run_query = mysqli_query($con,$brand_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Marques</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["id_marque"];
			$brand_name = $row["titre_marque"];
			echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["page"])){
	$sql = "SELECT * FROM produits";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}
if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM produits LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['id_produit'];
			$pro_cat   = $row['cat_produit'];
			$pro_brand = $row['marque_produit'];
			$pro_title = $row['titre_produit'];
			$pro_price = $row['prix_produit'];
			$pro_image = $row['image_produit'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$pro_price €
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Ajouter au panier</button>
								</div>
							</div>
						</div>	
			";
		}
	}
}
if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM produits WHERE cat_produit = '$id'";
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM produits WHERE marque_produit = '$id'";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM produits WHERE cle_produit LIKE '%$keyword%'";
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['id_produit'];
			$pro_cat   = $row['cat_produit'];
			$pro_brand = $row['marque_produit'];
			$pro_title = $row['titre_produit'];
			$pro_price = $row['prix_produit'];
			$pro_image = $row['image_produit'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$pro_price €
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Ajouter au panier</button>
								</div>
							</div>
						</div>	
			";
		}
	}
									
	if(isset($_POST["addToProduct"])){
		
		if(isset($_SESSION["uid"])){
			$p_id = $_POST["proId"];
		$user_id = $_SESSION["uid"];
		$sql = "SELECT * FROM panier WHERE id_prod = '$p_id' AND id_utilisateur = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Produit déjà ajouté au panier Continuer le Shopping..!</b>
				</div>
			";//not in video
		} else {
			$sql = "SELECT * FROM produits WHERE id_produit = '$p_id'";
			$run_query = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($run_query);
				$id = $row["id_produit"];
				$pro_name = $row["titre_produit"];
				$pro_image = $row["image_produit"];
				$pro_price = $row["prix_produit"];
			$sql = "INSERT INTO `panier` 
			(`id`, `id_prod`, `ajout_ip`, `id_utilisateur`, `titre_produit`,
			`image_produit`, `quantite`, `prix`, `total`)
			VALUES (NULL, '$p_id', '0', '$user_id', '$pro_name', 
			'$pro_image', '1', '$pro_price', '$pro_price')";
			if(mysqli_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Le produit ajouté..!</b>
					</div>
				";
			}
		}
		}else{
			echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Désolé veuillez d'abord vous connecter</b>
					</div>
				";
		}
		
		
		
		
	}
if(isset($_POST["get_cart_product"]) || isset($_POST["cart_checkout"])){
	$uid = $_SESSION["uid"];
	$sql = "SELECT * FROM panier WHERE id_utilisateur = '$uid'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	if($count > 0){
		$no = 1;
		$total_amt = 0;
		while($row=mysqli_fetch_array($run_query)){
			$id = $row["id"];
			$pro_id = $row["id_prod"];
			$pro_name = $row["titre_produit"];
			$pro_image = $row["image_produit"];
			$qty = $row["quantite"];
			$pro_price = $row["prix"];
			$total = $row["total"];
			$price_array = array($total);
			$total_sum = array_sum($price_array);
			$total_amt = $total_amt + $total_sum;
			setcookie("ta",$total_amt,strtotime("+1 day"),"/","","",TRUE);
			if(isset($_POST["get_cart_product"])){
				echo "
				<div class='row'>
					<div class='col-md-3 col-xs-3'>$no</div>
					<div class='col-md-3 col-xs-3'><img src='product_images/$pro_image' width='60px' height='50px'></div>
					<div class='col-md-3 col-xs-3'>$pro_name</div>
					<div class='col-md-3 col-xs-3'>€.$pro_price</div>
				</div>
			";
			$no = $no + 1;
			}else{
				echo "
					<div class='row'>
							<div class='col-md-2 col-sm-2'>
								<div class='btn-group'>
									<a href='#' remove_id='$pro_id' class='btn btn-danger btn-xs remove'><span class='glyphicon glyphicon-trash'></span></a>
									<a href='' update_id='$pro_id' class='btn btn-primary btn-xs update'><span class='glyphicon glyphicon-ok-sign'></span></a>
								</div>
							</div>
							<div class='col-md-2 col-sm-2'><img src='product_images/$pro_image' width='50px' height='60'></div>
							<div class='col-md-2 col-sm-2'>$pro_name</div>
							<div class='col-md-2 col-sm-2'><input type='text' class='form-control qty' pid='$pro_id' id='qty-$pro_id' value='$qty' ></div>
							<div class='col-md-2 col-sm-2'><input type='text' class='form-control price' pid='$pro_id' id='price-$pro_id' value='$pro_price' disabled></div>
							<div class='col-md-2 col-sm-2'><input type='text' class='form-control total' pid='$pro_id' id='total-$pro_id' value='$total' disabled></div>
						</div>
				";
			}
				
		}
		if(isset($_POST["cart_checkout"])){
			echo "<div class='row'>
				<div class='col-md-8'></div>
				<div class='col-md-4'>
					<h1>Total $$total_amt</h1>
				</div>";
		}
		echo '
		
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				  <input type="hidden" name="cmd" value="_cart">
				  <input type="hidden" name="business" value="paniershopping@electronicstore.com">
				  <input type="hidden" name="upload" value="1">';
				  
				  $x=0;
				  $uid = $_SESSION["uid"];
				  $sql = "SELECT * FROM panier WHERE id_utilisateur = '$uid'";
				  $run_query = mysqli_query($con,$sql);
				  while($row=mysqli_fetch_array($run_query)){
					  $x++;
				 echo  '<input type="hidden" name="item_name_'.$x.'" value="'.$row["titre_produit"].'">
				  <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
				  <input type="hidden" name="amount_'.$x.'" value="'.$row["prix"].'">
				  <input type="hidden" name="quantity_'.$x.'" value="'.$row["quantite"].'">';
				  
				  }
				  
				echo   '
				<input type="hidden" name="return" value="http://www.sysc.esy.es/shoppingCart/paiement_effectue.php"/>
				<input type="hidden" name="cancel_return" value="http://www.sysc.esy.es/shoppingCart/annuler.php"/>
				<input type="hidden" name="currency_code" value="USD"/>
				<input type="hidden" name="custom" value="'.$uid.'"/>
				<input style="float:right;margin-right:80px;" type="image" name="submit"
					src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="Verification Paypal"
					alt="PayPal - La Securité, paiement en ligne facile">
				</form>';
		
		
		
		
	}
}

if(isset($_POST["cart_count"]) AND isset($_SESSION["uid"])){
	$uid = $_SESSION["uid"];
	$sql = "SELECT * FROM panier WHERE id_utilisateur = '$uid'";
	$run_query = mysqli_query($con,$sql);
	echo mysqli_num_rows($run_query);
}
if(isset($_POST["removeFromCart"])){
	$pid = $_POST["removeId"];
	$uid = $_SESSION["uid"];
	$sql = "DELETE FROM panier WHERE id_utilisateur = '$uid' AND id_prod = '$pid'";
	$run_query = mysqli_query($con,$sql);
	if($run_query){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Produit retiré du panier Continuer le Shopping..!</b>
			</div>
		";
	}
}

if(isset($_POST["updateProduct"])){
	$uid = $_SESSION["uid"];
	$pid = $_POST["updateId"];
	$qty = $_POST["qty"];
	$price = $_POST["price"];
	$total = $_POST["total"];
	
	$sql = "UPDATE panier SET quantite = '$qty',prix='$price',total='$total' 
	WHERE id_utilisateur = '$uid' AND id_prod='$pid'";
	$run_query = mysqli_query($con,$sql);
	if($run_query){
		echo "
			<div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Prodict mis à jour Continuer le Shopping..!</b>
			</div>
		";
	}
}
?>






























