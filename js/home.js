var items = ['meatballs', 'zucchini', 'chocolate bread', 'salad', 'hand protein bar', 'fresh bread', 'whole weat flour', 'turkey', 'white wine', 'gums', 'fromage blanc', 'spinach', 'salmon', 'green tea', 'eggplant', 'shampoo', 'cottage cheese', 'tomato juice', 'whole wheat rice', 'ham', 'french wine', 'almonds', 'clothes accessories', 'pancakes', 'dessert wine', 'cookies', 'asparagus', 'olive oil', 'pasta', 'chili', 'extra dark chocolate', 'cereals', 'nonfat milk', 'cider', 'chocolate', 'water spray', 'soda', 'cream', 'tomato sauce', 'corn', 'burgers', 'salt', 'parmesan cheese', 'gluten free bar', 'cake', 'candy bars', 'mint green tea', 'melons', 'shallot', 'pet food', 'light mayo', 'burger sauce', 'light cream', 'antioxydant juice', 'babies food', 'frozen vegetables', 'sandwich', 'hot dogs', 'eggs', 'mayonnaise', 'herb & pepper', 'body spray', 'yogurt cake', 'mineral water', 'cooking oil', 'pickles', 'napkins', 'escalope', 'sparkling water', 'bramble', 'blueberries', 'bacon', 'pepper', 'carrots', 'shrimp', 'fresh tuna', 'ketchup', 'oil', 'tomatoes', 'mushroom cream sauce', 'ground beef', 'muffins', 'soup', 'tea', 'strong cheese', 'frozen smoothie', 'strawberries', 'grated cheese', 'red wine', 'protein bar', 'green beans', 'green grapes', 'flax seed', 'avocado', 'milk', 'rice', 'chicken', 'honey', 'energy drink', 'butter', 'bug spray', 'black tea', 'chutney', 'toothpaste', 'brownies', 'barbecue sauce', 'magazines', 'low fat yogurt', ' asparagus', 'french fries', 'yams', 'oatmeal', 'cauliflower', 'vegetables mix', 'champagne', 'whole wheat pasta', 'spaghetti', 'energy bar', 'mashed potato', 'mint'];
var cart = [];
var finalString = "";

function selectedItem() {
    var e = document.getElementById("dropdown");
    var strUser = e.options[e.selectedIndex].text;
    if(cart.indexOf(strUser) >= 0)
        alert('item already selected');
    else {
        cart.push(strUser);
        var ol = document.getElementById("selected-items");
        var li = document.createElement('li');
        li.setAttribute('onclick','removeItem(this)');
        li.innerHTML = strUser;
        ol.appendChild(li);
        
    }
}

function removeItem(x) {
    //alert(x.innerHTML)
    cart.splice(cart.indexOf(x.innerHTML),1);
    var ol = document.getElementById("selected-items");
    ol.removeChild(x);
}

function updateDatabase() {
    var i = 0;
    if(cart.length > 0) {
        for(i = 0;i < cart.length-1;i++) {
            finalString += cart[i] + ", ";
        }
        finalString += cart[i];
        var p = document.getElementById("ordered");
        p.innerHTML = "<b>Ordered Items : </b>" + finalString;
        //var db = document.getElementById("db");
        //db.innerHTML = "<?php $email = '<script>document.getElementById('session').innerHTML;</script>';$connection = new mysqli('remotemysql.com','1ZMOoaSYsb','iHv3osBp46','1ZMOoaSYsb') or die('connection failed');$query = \"update items from userdetails where email = '\".$email.\"'\";if(mysqli_query($connection,$query))echo 'success';else echo'problem occured';?>";
        // window.onload = function() {
        //     if(!window.location.hash) {
        //         window.location = window.location + '#loaded';
                
        //     }
        // }
    }
    else
        alert("cart empty");
}