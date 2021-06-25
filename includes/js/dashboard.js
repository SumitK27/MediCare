$(".myTable").DataTable({
    pagingType: "full_numbers",
    lengthMenu: [
        [20, 50, 100, -1],
        [20, 50, 100, "All"],
    ],
});

// Hide sub menus
$("#body-row .collapse").collapse("hide");

// Collapse/Expand icon
$("#collapse-icon").addClass("fa-angle-double-left");

// Collapse click
$("[data-toggle=sidebar-collapse]").click(function () {
    SidebarCollapse();
    iconScale();
});

$(document).ready(function () {
    if ($(window).width() < 786) {
        SidebarCollapse();
        iconScale();
    }
});

function iconScale() {
    if ($("#sidebar-container").hasClass("sidebar-expanded")) {
        console.log("Expanded");
        $(".icon").removeClass("collapsed-icons");
        $(".loggedIn").show();
    }
    if ($("#sidebar-container").hasClass("sidebar-collapse")) {
        console.log("Collapsed");
        $(".icon").addClass("collapsed-icons");
        $(".loggedIn").hide();
    }
}

function SidebarCollapse() {
    $(".menu-collapsed").toggleClass("d-none");
    $(".sidebar-subMenu").toggleClass("d-none");
    $(".subMenu-icon").toggleClass("d-none");
    $("#sidebar-container").toggleClass("sidebar-expanded sidebar-collapse");

    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $(".sidebar-separator-title");
    if (SeparatorTitle.hasClass("d-flex")) {
        SeparatorTitle.removeClass("d-flex");
    } else {
        SeparatorTitle.addClass("d-flex");
    }

    // Collapse/Expand icon
    $("#collapse-icon").toggleClass(
        "fa-angle-double-left fa-angle-double-right"
    );
}
