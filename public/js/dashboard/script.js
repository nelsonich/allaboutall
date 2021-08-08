$(function() {
    const token = $('meta[name="csrf-token"]').attr('content');

    $("#side_navigation .closebtn").on("click", function() {
        document.getElementById("side_navigation").style.width = "0";
    });

    $("span.open_side_navigation").on("click", function() {
        document.getElementById("side_navigation").style.width = "100%";
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