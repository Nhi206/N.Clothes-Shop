document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll(".filter-btn");
    const products = document.querySelectorAll(".product-item");

    buttons.forEach(btn => {
        btn.addEventListener("click", function () {

            let filter = this.getAttribute("data-filter");

            products.forEach(p => {
                if (filter === "all" || p.dataset.category === filter) {
                    p.style.display = "block";
                } else {
                    p.style.display = "none";
                }
            });

        });
    });

});