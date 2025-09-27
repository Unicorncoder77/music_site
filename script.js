
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


