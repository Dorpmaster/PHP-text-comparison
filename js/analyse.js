(function ($) {

    $(document).ready(function () {
        $("span.replace").mouseenter(function () {
            $(this).find("del, ins").toggle()
        }).mouseleave(function () {
            $(this).find("del, ins").toggle()
        });
    });
})(jQuery);
