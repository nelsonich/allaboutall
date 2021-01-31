$(function () {
    const limit = 5;
    let page = 1;
    let url = window.location.pathname.split('/');
    const categoryId = url[url.length - 1];
    const token = $('meta[name="csrf-token"]').attr('content')
    setGlobalVariableValue('ifIssetData', $('div.childCategories').data('ifissetdata'))

    $('div.childCategories').scroll(function () {
        if ($('div.childCategories').scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight && (globalVariables.ifIssetData === true || globalVariables.ifIssetData === 'true')) {
            $('img#loader').removeClass('hide')
            $.ajax({
                url: `/get-data`,
                method: 'post',
                dataType: 'json',
                data: {_token: token, offset: page * limit, id: categoryId, q: $('input#search').val()},
                success: function (res) {
                    $('img#loader').addClass('hide')
                    page++;
                    $('div.childCategories').attr('data-ifIssetData', res['ifIssetData'])
                    setGlobalVariableValue('ifIssetData', res['ifIssetData'])
                    $.each(res['childCategories'], function (index, value) {
                        let li = `<li style="display: flex; margin-bottom: 5px;">
                                    <div style="background-image: url('../storage/category_details/images/${value['category_details']['image']}')"></div>
                                    <div class="ml-1">
                                        <h3><a href="/info-p/${categoryId}/${value.id}" class="click">${value.name}</a></h3>
                                        <p>${textLimit(value['category_details']['preview_text'], 100)}</p>
                                    </div>
                                </li>`;
                        $('div.childCategories > ul').append(li);
                    });
                },
                error: function (error) {
                    console.log(error)
                }
            });
        }
    });

    $(document).on('click', 'a.click', function (e) {
        e.preventDefault();
        let that = $(this);
        let url = that.attr('href').split('/');
        const categoryId = url[url.length - 1];

        $.ajax({
            url: `/add-link-count/${categoryId}`,
            method: 'GET',
            dataType: 'json',
            success: function (res) {
                if (res) location.href = that.attr('href')
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    setBackground($('section').data('bg'), $('section').data('path'))
});
