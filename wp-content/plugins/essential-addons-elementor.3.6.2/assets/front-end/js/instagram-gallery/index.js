var InstagramGallery = function($scope, $) {
    if (!isEditMode) {
        $instagram_gallery = $(".eael-instafeed", $scope).isotope({
            itemSelector: ".eael-instafeed-item",
            percentPosition: true,
            columnWidth: ".eael-instafeed-item"
        });

        $instagram_gallery.imagesLoaded().progress(function() {
            $instagram_gallery.isotope("layout");
        });
    }

    // ajax load more
    $(".eael-load-more-button", $scope).on("click", function(e) {
        e.preventDefault();

        $this = $(this);
        $settings = $this.attr("data-settings");
        $page = $this.attr("data-page");

        // update load moer button
        $this.addClass("button--loading");
        $("span", $this).html("Loading...");

        $.ajax({
            url: localize.ajaxurl,
            type: "post",
            data: {
                action: "instafeed_load_more",
                security: localize.nonce,
                settings: $settings,
                page: $page
            },
            success: function(response) {
                $html = $(response.html);

                // append items
                $instagram_gallery = $(".eael-instafeed", $scope).isotope();
                $(".eael-instafeed", $scope).append($html);
                $instagram_gallery.isotope("appended", $html);
                $instagram_gallery.imagesLoaded().progress(function() {
                    $instagram_gallery.isotope("layout");
                });

                // update load more button
                if (response.num_pages > $page) {
                    $this.attr("data-page", parseInt($page) + 1);
                    $this.removeClass("button--loading");
                    $("span", $this).html("Load more");
                } else {
                    $this.remove();
                }
            },
            error: function() {}
        });
    });
};

jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/eael-instafeed.default",
        InstagramGallery
    );
});
