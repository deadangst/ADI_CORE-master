jQuery(document).ready(function ($) {

    var ajaxurl = multi_blog_pagination.ajax_url;

    function multi_blog_is_on_screen(elem) {

        if ($(elem)[0]) {

            var tmtwindow = jQuery(window);
            var viewport_top = tmtwindow.scrollTop();
            var viewport_height = tmtwindow.height();
            var viewport_bottom = viewport_top + viewport_height;
            var tmtelem = jQuery(elem);
            var top = tmtelem.offset().top;
            var height = tmtelem.height();
            var bottom = top + height;
            return (top >= viewport_top && top < viewport_bottom) ||
                (bottom > viewport_top && bottom <= viewport_bottom) ||
                (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom);
        }
    }

    var n = window.TWP_JS || {};
    var paged = parseInt(multi_blog_pagination.paged) + 1;
    var maxpage = multi_blog_pagination.maxpage;
    var nextLink = multi_blog_pagination.nextLink;
    var loadmore = multi_blog_pagination.loadmore;
    var loading = multi_blog_pagination.loading;
    var nomore = multi_blog_pagination.nomore;
    var pagination_layout = multi_blog_pagination.pagination_layout;

    function multi_blog_load_content_ajax(){

        if ((!$('.theme-no-posts').hasClass('theme-no-posts'))) {

            $('.theme-loading-button .loading-text').text(loading);
            $('.theme-loading-status').addClass('theme-ajax-loading');
            $('.theme-loaded-content').load(nextLink + ' .post', function () {
                if (paged < 10) {
                    var newlink = nextLink.substring(0, nextLink.length - 2);
                } else {

                    var newlink = nextLink.substring(0, nextLink.length - 3);
                }
                paged++;
                nextLink = newlink + paged + '/';
                if (paged > maxpage) {
                    $('.theme-loading-button').addClass('theme-no-posts');
                    $('.theme-loading-button .loading-text').text(nomore);
                } else {
                    $('.theme-loading-button .loading-text').text(loadmore);
                }
                var lodedContent = $('.theme-loaded-content').html();
                $('.theme-loaded-content').html('');

                $('.content-area .article-wraper').append(lodedContent);

                $('.theme-loading-status').removeClass('theme-ajax-loading');

                $('.theme-article-post').each(function () {

                    if (!$(this).hasClass('theme-article-loaded')) {

                        $(this).addClass(paged + '-theme-article-ajax');
                        $(this).addClass('theme-article-loaded');
                    }

                });

                if (typeof booster_extension_read_later_posts == 'function') {

                    booster_extension_read_later_posts(paged + '-theme-article-ajax');
                }
                // Toolstip
                $('.'+paged + '-theme-article-ajax .booster-favourite-post').click(function(){
                    
                    if( $(this).hasClass('booster-favourite-selected') ){
                        $(this).find('svg').attr('fill','');
                    }else{
                        $(this).find('svg').attr('fill','red');
                    }
                    
                });

                $('.'+paged + '-theme-article-ajax .booster-favourite-selected').each(function(){
                    $(this).find('svg').attr('fill','red');
                });

                var isMobile = false;

                if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    $('html').addClass('touch');
                    isMobile = true;
                }
                else{
                    $('html').addClass('no-touch');
                    isMobile = false;
                }

                
                // Background
                var pageSection = $(".data-bg");
                pageSection.each(function (indx) {
                    if ($(this).attr("data-background")) {
                        $(this).css("background-image", "url(" + $(this).data("background") + ")");
                    }
                });

            });

        }
    }

    $('.theme-loading-button').click(function () {

        multi_blog_load_content_ajax();
        
    });

    if (pagination_layout == 'auto-load') {
        $(window).scroll(function () {

            if (!$('.theme-loading-status').hasClass('theme-ajax-loading') && !$('.theme-loading-button').hasClass('theme-no-posts') && maxpage > 1 && multi_blog_is_on_screen('.theme-loading-button')) {
                
                multi_blog_load_content_ajax();
                
            }

        });
    }

    $(window).scroll(function () {

        if (!$('.twp-single-infinity').hasClass('twp-single-loading') && $('.twp-single-infinity').attr('loop-count') <= 3 && multi_blog_is_on_screen('.twp-single-infinity')) {

            $('.twp-single-infinity').addClass('twp-single-loading');
            var loopcount = $('.twp-single-infinity').attr('loop-count');
            var postid = $('.twp-single-infinity').attr('next-post');

            var data = {
                'action': 'multi_blog_single_infinity',
                '_wpnonce': multi_blog_pagination.ajax_nonce,
                'postid': postid,
            };

            $.post(ajaxurl, data, function (response) {

                if (response) {
                    var content = response.data.content.join('');
                    var content = $(content);
                    $('.twp-single-infinity').before(content);
                    var newpostid = response.data.postid.join('');
                    var newpostid = $(newpostid);
                    $('.twp-single-infinity').attr('next-post', newpostid['selector']);

                    $('article').each(function () {

                        $('article').each(function () {

                             if ($('body').hasClass('booster-extension') && $(this).hasClass('after-load-ajax') ) {

                                    var cid = $(this).attr('id');
                                    $(this).addClass( cid );
                                       
                                    likedislike(cid);
                                    booster_extension_post_reaction(cid);

                            }

                            $(this).removeClass('after-load-ajax');

                        });

                        $(this).removeClass('after-load-ajax');
                    });

                }

                $('.twp-single-infinity').removeClass('twp-single-loading');
                loopcount++;
                $('.twp-single-infinity').attr('loop-count', loopcount);

            });

        }

    });

});