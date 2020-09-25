function minimizeNav() { // main-header-bar
    var elements = document.getElementsByClassName('main-header-bar');
    var requiredElement = elements[0];
    if (this.scrollY > this.innerHeight / 1.1) {
        requiredElement.style.transform = "translateY(-40%)";
        requiredElement.style.opacity = "0.8";

    } else {
        requiredElement.style.transform = "translateY(0%)";
        requiredElement.style.opacity = "1";
        // document.body.classList.remove("interest-body");
        // var img = "images/interest-main-img.jpg";
        // document.body.style.background = 'url("images/interest-main-img.jpg") no-repeat center fixed';
    }
}
window.addEventListener("scroll", minimizeNav);

// Blog side bar 
// need to set it only for that page
document.getElementById("blog-sidebar-hider").addEventListener("click", hideBlogSidebar);

function hideBlogSidebar() {
    document.getElementById('blog-sidebar').style.right = '-100%';
    document.getElementById('blog-sidebar-opener').style.opacity = '1';
    document.getElementById('blog-sidebar').style.zIndex = '-1';
    document.getElementById('blog-sidebar-hider').style.opacity = '0';
}

document.getElementById("blog-sidebar-opener").addEventListener("click", openBlogSidebar);

function openBlogSidebar() {
    document.getElementById('blog-sidebar').style.right = '0';
    document.getElementById('blog-sidebar-opener').style.opacity = '0';
    document.getElementById('blog-sidebar').style.zIndex = '999';
    document.getElementById('blog-sidebar-hider').style.opacity = '1';
}