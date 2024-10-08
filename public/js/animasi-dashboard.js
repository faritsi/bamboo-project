// ABout US
document.addEventListener("DOMContentLoaded", function () {
    var imgAboutUs = document.getElementById("img-about-us");
    var textAboutUs = document.getElementById("text-about-us");

    window.addEventListener("scroll", function () {
        var imgRect = imgAboutUs.getBoundingClientRect();
        var textRect = textAboutUs.getBoundingClientRect();
        var windowHeight = window.innerHeight;

        if (imgRect.top <= windowHeight && imgRect.bottom >= 0) {
            imgAboutUs.classList.add("visible");
        } else {
            imgAboutUs.classList.remove("visible");
        }

        if (textRect.top <= windowHeight && textRect.bottom >= 0) {
            textAboutUs.classList.add("visible");
        } else {
            textAboutUs.classList.remove("visible");
        }
    });
});

// Our Service
document.addEventListener("DOMContentLoaded", function () {
    var judulOurService = document.getElementById("judul-our-service");
    var ourServiceText = document.getElementById("our-service");
    var listOurService = document.getElementById("list-our-service");

    window.addEventListener("scroll", function () {
        var judulRect = judulOurService.getBoundingClientRect();
        var serviceRect = ourServiceText.getBoundingClientRect();
        var listRect = listOurService.getBoundingClientRect();
        var windowHeight = window.innerHeight;

        if (judulRect.top <= windowHeight && judulRect.bottom >= 0) {
            judulOurService.classList.add("visible");
        } else {
            judulOurService.classList.remove("visible");
        }

        if (serviceRect.top <= windowHeight && serviceRect.bottom >= 0) {
            ourServiceText.classList.add("visible");
        } else {
            ourServiceText.classList.remove("visible");
        }

        if (listRect.top <= windowHeight && listRect.bottom >= 0) {
            listOurService.classList.add("visible");
        } else {
            listOurService.classList.remove("visible");
        }
    });
});

// Catalog
document.addEventListener("DOMContentLoaded", function () {
    var judulCatalog = document.getElementById("judul-catalog");
    var textCatalog = document.getElementById("text-catalog");
    var carouselCatalog = document.getElementById("carousel-catalog");

    window.addEventListener("scroll", function () {
        var judulRect = judulCatalog.getBoundingClientRect();
        var textRect = textCatalog.getBoundingClientRect();
        var carouselRect = carouselCatalog.getBoundingClientRect();
        var windowHeight = window.innerHeight;

        if (judulRect.top <= windowHeight && judulRect.bottom >= 0) {
            judulCatalog.classList.add("visible");
        } else {
            judulCatalog.classList.remove("visible");
        }

        if (textRect.top <= windowHeight && textRect.bottom >= 0) {
            textCatalog.classList.add("visible");
        } else {
            textCatalog.classList.remove("visible");
        }

        if (carouselRect.top <= windowHeight && carouselRect.bottom >= 0) {
            carouselCatalog.classList.add("visible");
        } else {
            carouselCatalog.classList.remove("visible");
        }
    });
});

// Activity
document.addEventListener("DOMContentLoaded", function () {
    var textActivity = document.getElementById("text-activity");
    var carouselAct = document.querySelector(".carousel-act");

    window.addEventListener("scroll", function () {
        var textRect = textActivity.getBoundingClientRect();
        var containerRect = carouselAct.getBoundingClientRect();
        var windowHeight = window.innerHeight;

        if (textRect.top <= windowHeight && textRect.bottom >= 0) {
            textActivity.classList.add("visible");
        } else {
            textActivity.classList.remove("visible");
        }

        if (containerRect.top <= windowHeight && containerRect.bottom >= 0) {
            carouselAct.classList.add("visible");
        } else {
            carouselAct.classList.remove("visible");
        }
    });
});

// Pimpinan
document.addEventListener("DOMContentLoaded", function () {
    var textSo = document.getElementById("text-so");
    var profileSo = document.getElementById("profile-so");

    window.addEventListener("scroll", function () {
        var textRect = textSo.getBoundingClientRect();
        var profileRect = profileSo.getBoundingClientRect();
        var windowHeight = window.innerHeight;

        if (textRect.top <= windowHeight && textRect.bottom >= 0) {
            textSo.classList.add("visible");
        } else {
            textSo.classList.remove("visible");
        }

        if (profileRect.top <= windowHeight && profileRect.bottom >= 0) {
            profileSo.classList.add("visible");
        } else {
            profileSo.classList.remove("visible");
        }
    });
});

// Footer
document.addEventListener("DOMContentLoaded", function () {
    var footerContainer = document.getElementById("container-footer");

    window.addEventListener("scroll", function () {
        var footerRect = footerContainer.getBoundingClientRect();
        var windowHeight = window.innerHeight;

        if (footerRect.top <= windowHeight && footerRect.bottom >= 0) {
            footerContainer.classList.add("visible");
        } else {
            footerContainer.classList.remove("visible");
        }
    });
});
