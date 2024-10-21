function showSection(sectionId) {
    var sections = document.querySelectorAll(".section");
    sections.forEach(function (section) {
        section.style.display = "none";
    });
    document.getElementById(sectionId).style.display = "block";
}
