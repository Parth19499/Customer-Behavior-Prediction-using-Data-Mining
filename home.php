<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/homePage.css">
	<script type = "text/javascript" src = "js/home.js"></script>
</head>
<body>
	<div id = "logout">
			<form action = "PHP/logout.php">
				<input class = "btn-buy" type="submit" value="Logout">
			</form>
		</div>
	<div class = "big-div">
	<div class = "user">
		<h2>Welcome, 
		<!--php-->
		<?php
			session_start();
			$email = $_SESSION["validate_session"];
			print '<script type="text/javascript">';
    		//print 'alert("'.$email.'")';
    		print '</script>';
			$db = 'smarthea_mp2';
			$name = " ";
			$connection = new mysqli('localhost','root','',$db) or die("connection failed");
			$query = "SELECT name FROM userdetails WHERE email = '"  .$email."'";
			if($res = mysqli_query($connection,$query)) {
				while($rows = mysqli_fetch_row($res)) {
					$name = $rows[0];
				}
				mysqli_free_result($res);
			}
			echo $name;
        ?>
		<!--php--></h2>
		<p id = "session"><?php echo $email;?></p>
	</div>
	<div class = "buy-items">
		<h4>Buy Items from following list</h4>
		<?php
		    $items = array('meatballs', 'zucchini', 'chocolate bread', 'salad', 'hand protein bar', 'fresh bread', 'whole weat flour', 'turkey', 'white wine', 'gums', 'fromage blanc', 'spinach', 'salmon', 'green tea', 'eggplant', 'shampoo', 'cottage cheese', 'tomato juice', 'whole wheat rice', 'ham', 'french wine', 'almonds', 'clothes accessories', 'pancakes', 'dessert wine', 'cookies', 'asparagus', 'olive oil', 'pasta', 'chili', 'extra dark chocolate', 'cereals', 'nonfat milk', 'cider', 'chocolate', 'water spray', 'soda', 'cream', 'tomato sauce', 'corn', 'burgers', 'salt', 'parmesan cheese', 'gluten free bar', 'cake', 'candy bars', 'mint green tea', 'melons', 'shallot', 'pet food', 'light mayo', 'burger sauce', 'light cream', 'antioxydant juice', 'babies food', 'frozen vegetables', 'sandwich', 'hot dogs', 'eggs', 'mayonnaise', 'herb & pepper', 'body spray', 'yogurt cake', 'mineral water', 'cooking oil', 'pickles', 'napkins', 'escalope', 'sparkling water', 'bramble', 'blueberries', 'bacon', 'pepper', 'carrots', 'shrimp', 'fresh tuna', 'ketchup', 'oil', 'tomatoes', 'mushroom cream sauce', 'ground beef', 'muffins', 'soup', 'tea', 'strong cheese', 'frozen smoothie', 'strawberries', 'grated cheese', 'red wine', 'protein bar', 'green beans', 'green grapes', 'flax seed', 'avocado', 'milk', 'rice', 'chicken', 'honey', 'energy drink', 'butter', 'bug spray', 'black tea', 'chutney', 'toothpaste', 'brownies', 'barbecue sauce', 'magazines', 'low fat yogurt', ' asparagus', 'french fries', 'yams', 'oatmeal', 'cauliflower', 'vegetables mix', 'champagne', 'whole wheat pasta', 'spaghetti', 'energy bar', 'mashed potato', 'mint');
            echo '<select id = "dropdown" name = "dropdown" onchange = "selectedItem()">';
            echo '<option value = "select">Select items</option>';
            for($i = 0;$i < sizeof($items);$i++)
                echo '<option value = "'.$items[$i].'">'.$items[$i].'</option>';
            echo '</select>';
		?>
	</div>
	<div id = "selected-div">
	    <ol id = "selected-items">
	        
	    </ol>
	     <button class = "btn-buy" type="button" onclick = "updateDatabase()">Buy</button> 
	     <p id = ordered> </p>
	     <div id = db></div>
	</div></div>
	<div class= "recommendation">
		<?php
		    $db = 'smarthea_mp2';
		    $items = "";
		    $connection = new mysqli('localhost','root','',$db) or die("connection failed");
			$query = "SELECT items FROM userdetails WHERE email = '"  .$email."'";
			if($res = mysqli_query($connection,$query)) {
				while($rows = mysqli_fetch_row($res)) {
					$items = $rows[0];
				}
				mysqli_free_result($res);
			}
			//$itemArray = explode(",", $items);
			// for($i = 0;$i < count($itemArray);$i++)
			// 	echo $itemArray[$i].'<br>';
			//python
            echo shell_exec("python FPG.py \"".$items."\"");
			//python
		?>
	</div>
</body>
</html>