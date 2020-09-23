// Blog side bar 
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

function bgChanger() {
    if (this.scrollY > this.innerHeight / 1.1) {
        // var elements = document.getElementsByClassName('entry-content');
        // var requiredElement = elements[0];

        document.getElementById('main').style.background = 'white';
    } else {
        // document.body.classList.remove("interest-body");
        // var img = "images/interest-main-img.jpg";
        // document.body.style.background = 'url("images/interest-main-img.jpg") no-repeat center fixed';
    }
}
window.addEventListener("scroll", bgChanger);