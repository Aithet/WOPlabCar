(function( $ ) {

    let year = document.querySelector("#year");

    $(document).ready(function () {
        year.innerText = new Date().getFullYear();
    });

    $(".btn-animated").on("click", function () {
        let href = $(this).attr("href");

        $("html, body").animate({
            scrollTop: $(href).offset().top
        }, {
            duration: 570,   // по умолчанию «400»
            easing: "linear" // по умолчанию «swing»
        });

        return false;
    });

})( jQuery );