$(document).ready(function() {
    let links = $(".sidebar-link");
    let url = window.location.pathname;
    let currentUrl;

    links.each(function() {
        currentUrl = $(this)[0].href.split("/").slice(3).join("/");
        if(currentUrl.replace(/\//g, "") == url.replace(/\//g, "")) {
            $(this).parent().addClass("active");
            return false;
        }
    });
});
