<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'reviewConn.php';
require 'loginConn.php';

require_once  __DIR__ . '/../hiphop_website/private/config.php';

try {
    $newReview = new Review($config);
    $newUser = new UserAccount();

}
catch (PDOException $e){
    echo "<pre>PDO Error: " . $e->getMessage() . "</pre>";
    exit;
}

$newReview = new Review($config);
$categories = $newReview->fetchCategories();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <title>
            Reviews
        </title>
         <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
           
            .starContainer {
                background-color: #bcbd8b;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                text-align: center;
                width: 600px;
                margin: auto; 
            }

            .reviewTitle{
                font-size: 24px;
                margin: 0;
            }

            .rating {
                font-size: 20px;
                margin: 10px 0;
            }

            .stars{
                font-size: 30px;
                margin: 10px 0;
            }

            .star{
                cursor: pointer;
                margin: 0 5px;
            }

            .one {
                color: rgb(255, 0, 0);
            }

            .two {
                color: rgb(255, 106, 0);
            }

            .three {
                color: rgb(251, 255, 120);
            }

            .four {
                color: rgb(255, 255, 0);
            }

            .five {
                color: rgb(24, 159, 14);
            }

            textarea{
                width: 90%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            button {
                background-color: #007BFF;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            button:hover {
                background-color: #0056b3;
            }

            .reviews {
                margin-top: 20px;
                text-align: left;
            }

            .review {
                border: 1px solid #ccc;
                border-radius: 4px;
                padding: 10px;
                margin: 10px 0;
            }

            .review p {
                margin: 0;
            }
            .categoryFilter {
                
                text-align: center;
            

            }
        </style>
    </head>
    <body>
        <script src="script.js"> </script>
        <div id="header"></div>
        <h1 class="reviewHeader">Welcome to the Review Section!</h1>
        
        <h2 class="reviewMid">Check out the best reviewed songs</h2><br/>
        <div class="categoryFilter">
            <p> Filter By Music Category: </p><br/>
            <select id="category" name="category">
                <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['category_id']) ?>">
                            <?= htmlspecialchars($category['category_name']) ?>
                        </option>

                    <?php endforeach; ?>
                
            </select><br>
        </div>

        <div class="starContainer">
            <h1 class="reviewTitle">Wrong Ones (feat. Tim McGraw)</h1>
            <div class="rating">
                <span id="rating">
                    0
                </span> / 5 
                
            </div>
             <select id="category" name="category">
                <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['category_id']) ?>">
                            <?= htmlspecialchars($category['category_name']) ?>
                        </option>

                    <?php endforeach; ?>
                
            </select><br>
            <div class="stars" id="stars">
                <span class="star" data-value="1">★</span>
			    <span class="star" data-value="2">★</span>
			    <span class="star" data-value="3">★</span>
			    <span class="star" data-value="4">★</span>
			    <span class="star" data-value="5">★</span>
            </div>
            <p>Your Review: </p>
            <textarea id="review"
				placeholder="Write your review here">
		    </textarea>
           
		    <button id="submit">Submit</button>
		    <div class="reviews" id="reviews">
		    </div>
        </div>
     

      
<!-- generate the process for this-->
        </div>
    <script>
        function getStarColorClass(value){
    switch(value) {
        case 1:
            return "one";
        case 2:
            return "two";
        case 3:
            return "three";
        case 4: 
            return "four";
        case 5:
            return "five";
        default:
            return "";
    }
    /*if (value == 1) {
        return "one";
    }
    else if (value == 2) {
        return "two";
    }
    else if (value == 3){
        return "three";
    }
    else if (value == 4){
        return "four";
    }
    else if (value == 5){
        return "five";
    }
    else {
        return "";
    }*/
}

const stars = document.querySelectorAll(".star");
const rating = document.getElementById("rating");
const reviewText = document.getElementById("review");
const submitBtn = document.getElementById("submit");
const reviewsContainer = document.getElementById("reviews");

stars.forEach((star) => {
    star.addEventListener("click", () => {
        const value = parseInt(star.getAttribute("data-value"));
        stars.forEach((s) => s.classList.remove("one", "two", "three", "four", "five"));

        stars.forEach((s, index) => {
            if (index < value) {
                s.classList.add(getStarColorClass(value));
            }
        });

        rating.innerText = value;
        stars.forEach((s) => s.classList.remove("selected"));
        star.classList.add("selected");
    });
});

submitBtn.addEventListener("click", () => {
    const review = reviewText.value;
    const userRating = parseInt(rating.innerText);

    if(!userRating || !review) {
        alert ("Please select a rating and provide a review before submitting.");
        return;
    }

    if (userRating > 0){
        const reviewElement = document.createElement("div");
        reviewElement.classList.add("review");
        reviewElement.innerHTML = `<p><strong>Rating: ${userRating}/5</strong></p><p>${review}</p>`;
		reviewsContainer.appendChild(reviewElement);

        reviewText.value = "";
		rating.innerText = "0";
		stars.forEach((s) => s.classList.remove("one", 
												"two", 
												"three", 
												"four", 
												"five", 
												"selected"));
	
    }
});





    </script>
    </body>
</html>
