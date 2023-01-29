<?php
include("theconnection.php");
if(isset($_GET['cid'])){
$cid = $_GET['cid']; 
$smt = $Conn->prepare('SELECT a.*,c.category_name FROM auctions as a,categories as c where a.category_id=c.category_id AND a.category_id='.$cid);
$smt->execute();

}
?>
<!DOCTYPE html>
<html>

<head>
	<title>ibuy Auctions</title>
	<link rel="stylesheet" href="ibuy.css" />
	<a href="login.php">Signup or login</a>
</head>

<body>
	<header>
		<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

	</header>


	<main>



		<h1>YOUR SELECTED Categories</h1>
		<?php

    if(isset($_GET['cid']))
    {
        $flag = 0;
		echo $smt->rowCount() . " records found.<br><hr><br>";
		while ($phrase = $smt->fetch()) {
			$flag++;

			echo '<article class="product">
			<!-- <img src="product.png" alt="product name"> -->
			<h1>'.$flag.'</h1>
			<section class="details">
				<h2><b>' . $phrase['title'] . '</b></h2>
				<h3>'.$phrase['category_name'].'</h3>
				<p>Auction created by <a href="#">User.Name</a></p>
				<p class="price">Current bid: £123.45</p>
				<time>Time left: 8 hours 3 minutes</time>
				<form action="#" class="bid">
					<input type="text" name="bid" placeholder="Enter bid amount" />
					<input type="submit" value="Place bid" />
				</form>
			</section>
			<section class="description">
				<p>Description: '.$phrase['description'].'</p>
			</section>

			<section class="reviews">
				<h2>Reviews of User.Name </h2>
				<ul>
					<li><strong>Ali said </strong> great ibuyer! Product as advertised and delivery was quick <em>29/09/2019</em></li>
					<li><strong>Dave said </strong> disappointing, product was slightly damaged and arrived slowly.<em>22/07/2019</em></li>
					<li><strong>Susan said </strong> great value but the delivery was slow <em>22/07/2019</em></li>

				</ul> ';

				?>
				
				<form action="add_review.php" method="post">
					<label>Add your review</label> <textarea name="reviewtext"></textarea>

					<input type="submit" name="submit" value="Add Review" />
				</form>
			</section>
		</article>
		<hr>
<?php
		
		}
		if ($flag<=0) {
			echo "No record found";
		}
    }
    else
    {
        echo "Category not supplied.";
    }
    
?>		
		<footer>
			&copy; ibuy 2019
		</footer>
	</main>
</body>

</html>