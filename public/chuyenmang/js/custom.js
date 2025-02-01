// navigation  menu js
function openNav() {
    $("#myNav").addClass("menu_width");
    $(".menu_btn-style").fadeIn();
}

function closeNav() {
    $("#myNav").removeClass("menu_width");
    $(".menu_btn-style").fadeOut();
}





// slider carousel control


$('.slider_btn_prev').on('click', function (e) {
    e.preventDefault()
    $('.slider_text_carousel').carousel('prev')
    $('.slider_image_carousel').carousel('prev')
})


$('.slider_btn_next').on('click', function (e) {
    e.preventDefault()
    $('.slider_text_carousel').carousel('next')
    $('.slider_image_carousel').carousel('next')
})


