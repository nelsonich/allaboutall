$(function() {
    const token = $('meta[name="csrf-token"]').attr('content')

    $('span.leftMenuToggle').on('click', function() {
        let leftBar = $('div.leftBar');
        if (leftBar.hasClass('hide')) {
            $('span.listName').removeClass('hide')
            leftBar.removeClass('hide')

            if ($('div.rightBar').hasClass('hide')) {
                $('main').css({
                    width: 'calc(100vw - 25%)',
                    transform: 'translate(60%, 0px)',
                });
            } else {
                $('main').css({
                    width: 'calc(100vw - 40%)',
                    transform: 'translate(50%, 0px)',
                });
            }
        } else {
            leftBar.addClass('hide')
            $('span.listName').addClass('hide')
            if ($('div.rightBar').hasClass('hide')) {
                $('main').css({
                    width: 'calc(100vw - 10%)',
                    transform: 'translate(50%, 0px)',
                });
            } else {
                $('main').css({
                    width: 'calc(100vw - 25%)',
                    transform: 'translate(40%, 0px)',
                });
            }
        }
    });

    $('span.rightMenuToggle').on('click', function() {
        let rightBar = $('div.rightBar');
        if (rightBar.hasClass('hide')) {
            rightBar.removeClass('hide')

            if ($('div.leftBar').hasClass('hide')) {
                $('main').css({
                    width: 'calc(100vw - 25%)',
                    transform: 'translate(40%, 0px)',
                });
            } else {
                $('main').css({
                    width: 'calc(100vw - 40%)',
                    transform: 'translate(50%, 0px)',
                });
            }
        } else {
            rightBar.addClass('hide')

            if ($('div.leftBar').hasClass('hide')) {
                $('main').css({
                    width: 'calc(100vw - 10%)',
                    transform: 'translate(50%, 0px)',
                });
            } else {
                $('main').css({
                    width: 'calc(100vw - 25%)',
                    transform: 'translate(60%, 0px)',
                });
            }
        }
    });

    $(".changeImage").change(function() {
        readURL(this, $(this));
    });

    function readURL(input, that) {
        if (input.files.length === 0) return
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                that.prev().find('img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    /* CkEditor */
    CKEDITOR.replaceAll('description');

    /* Carousel Modal */

    $('span.openCarouselModal').on('click', function() {
        let that = $(this)
        let modal = that.parent().parent().find('div.carouselItemsModal')
        modal.removeClass('hide')
    });

    $('span.closeCarouselModal').on('click', function() {
        let that = $(this)
        that.parent().parent().addClass('hide')
    });

    $('span.removeCarouselItem').on('click', function() {
        let that = $(this);
        let id = that.data('id');
        $.ajax({
            url: `/dashboard/categories/child/remove-carousel-item/${id}`,
            method: 'get',
            dataType: 'json',
            success: function(res) {
                if (res) that.parent().remove()
            },
            error: function(error) {
                console.log(error)
            }
        });
    });

    $('input[name=tags]').tagsinput();
});