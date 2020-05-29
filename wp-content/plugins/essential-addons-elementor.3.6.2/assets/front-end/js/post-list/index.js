var postListHandler = function($scope, $) {
    // category
    $('.post-categories', $scope).on('click', 'a', function(e) {
        e.preventDefault();

        // tab class
        $('.post-categories a', $scope).removeClass('active');
        $(this).addClass('active');

        // collect props
        $class = $('.post-categories', $scope).data('class');
        $args = $('.post-categories', $scope).data('args');
        $settings = $('.post-categories', $scope).data('settings');
        $page = 1;
        $taxonomy = {
            taxonomy: $('.post-categories a.active', $scope).data('taxonomy'),
            field: 'term_id',
            terms: [$('.post-categories a.active', $scope).data('id')]
        };

        // ajax
        $.ajax({
            url: localize.ajaxurl,
            type: 'post',
            data: {
                action: 'load_more',
                class: $class,
                args: $args,
                taxonomy: $taxonomy,
                settings: $settings,
                page: $page
            },
            success: function(response) {
                var $content = $(response);
                
                if ($content.hasClass('no-posts-found') || $content.length == 0) {
                    // do nothing
                } else {
                    $('.eael-post-appender', $scope)
                        .empty()
                        .append($content);

                    // update page
                    $('.post-list-pagination', $scope).data('page', 1);

                    // update nav
                    $('.btn-prev-post', $scope).prop('disabled', true);
                    $('.btn-next-post', $scope).prop('disabled', false);
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    // load more
    $('.post-list-pagination', $scope).on('click', 'button', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        
        // collect props
        var $this = $(this),
            $class = $this.parent('.post-list-pagination').data('class'),
            $args = $this.parent('.post-list-pagination').data('args'),
            $settings = $this.parent('.post-list-pagination').data('settings'),
            $page = $this.hasClass('btn-prev-post')
                ? parseInt($this.parent('.post-list-pagination').data('page')) - 1
                : parseInt($this.parent('.post-list-pagination').data('page')) + 1,
            $taxonomy = {
                taxonomy: $('.post-categories a.active', $scope).data('taxonomy'),
                field: 'term_id',
                terms: [$('.post-categories a.active', $scope).data('id')]
            };

        if(($taxonomy.taxonomy == '')||($taxonomy.taxonomy != 'all')||($taxonomy.taxonomy == 'undefined')){
            $taxonomy.taxonomy = 'all';
        };

        $this.prop('disabled', true);
        
        if ($page <= 0) {
            return;
        }
        
        $.ajax({
            url: localize.ajaxurl,
            type: 'post',
            data: {
                action: 'load_more',
                class: $class,
                args: $args,
                taxonomy: $taxonomy,
                settings: $settings,
                page: $page
            },
            success: function(response) {
                console.log;
                var $content = $(response);
                
                if ($content.hasClass('no-posts-found') || $content.length == 0) {
                    // do nothing
                } else {
                    
                    $('.eael-post-appender', $scope)
                        .empty()
                        .append($content);
                    $('.post-list-pagination button', $scope).prop('disabled', false);

                    $this.parent('.post-list-pagination').data('page', $page);
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
};

jQuery(window).on('elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction('frontend/element_ready/eael-post-list.default', postListHandler);
});
