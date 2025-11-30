
function loadHeader(url, target){
    fetch(url, {cache: "no-store"})
        .then(response => {
            if (!response.ok){
                throw new Error("Network response was not ok");
            }

            return response.text();
        })
        .then(data => {
            document.getElementById(target).innerHTML = data;
        })
        .catch (error => {
            console.error("Fetch error:", error);
            document.getElementById(target).innerHTML = "<p>Error loading component </p>";
        });
}

document.addEventListener("DOMContentLoaded", () => {
    loadHeader("header.php", "header");
})

/*function getStarColorClass(value){
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
    }
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
*/



