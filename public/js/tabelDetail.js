$(document).ready(function () {
    $(".btn-toggle").on("click", function () {
        var row = $(this).closest("tr").next(".details-row");
        row.toggle();
        var icon = $(this).find("i");
        if (row.is(":visible")) {
            $(this).removeClass("icon-plus").addClass("icon-minus");
            icon.removeClass("fa-plus").addClass("fa-minus");
        } else {
            $(this).removeClass("icon-minus").addClass("icon-plus");
            icon.removeClass("fa-minus").addClass("fa-plus");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("modal");
    var btn = document.getElementById("tambah-content");
    var span = document.getElementsByClassName("close-btn")[0];

    btn.onclick = function () {
        modal.style.display = "block";
    };

    span.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
// edit
document.addEventListener("DOMContentLoaded", function () {
    // Open modal
    document.querySelectorAll(".cek").forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-id");
            const modal = document.getElementById("modalUpdate" + productId);
            if (modal) {
                modal.style.display = "block";
            }
        });
    });

    // Close modal
    document.querySelectorAll(".close-btn").forEach((button) => {
        button.addEventListener("click", function () {
            this.closest(".modal").style.display = "none";
        });
    });

    // Close modal when clicking outside of modal content
    window.addEventListener("click", function (event) {
        document.querySelectorAll(".modal").forEach((modal) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
});
// delet
document.addEventListener("DOMContentLoaded", function () {
    // Open edit modal
    document.querySelectorAll(".cek").forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-id");
            const modal = document.getElementById("modalUpdate" + productId);
            if (modal) {
                modal.style.display = "block";
            }
        });
    });

    // Open delete modal
    document.querySelectorAll(".delete-btn").forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-id");
            const modal = document.getElementById("modalDelete" + productId);
            if (modal) {
                modal.style.display = "block";
            }
        });
    });

    // Close modal
    document.querySelectorAll(".close-btn").forEach((button) => {
        button.addEventListener("click", function () {
            this.closest(".modal").style.display = "none";
        });
    });

    // Close modal when clicking outside of modal content
    window.addEventListener("click", function (event) {
        document.querySelectorAll(".modal").forEach((modal) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
});
