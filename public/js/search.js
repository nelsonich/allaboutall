$(function() {
    $('input#search').on('keyup', function(event) {
        let that = $(this)
        let parentId = that.data('parent_id')
        if (event.keyCode === 13) {
            if (that.val() === "") return;
            let container = $('div.childCategories > ul');
            container.empty();

            $('p.loader').removeClass('hide')
            $.ajax({
                url: `/api/search/${parentId}/${that.val()}`,
                method: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('p.loader').addClass('hide')
                    setGlobalVariableValue('ifIssetData', res['ifIssetData'])

                    if (res['childCategories'].length > 0) {
                        $.each(res['childCategories'], function(index, value) {
                            let li = `<li style="display: flex; margin-bottom: 5px;">
                                    <div style="background-image: url('../storage/category_details/images/${value['category_details']['image']}')"></div>
                                    <div class="ml-1">
                                        <h3><a href="/info-p/${parentId}/${value.id}" class="click">${value.name}</a></h3>
                                        ${textLimit(value['category_details']['preview_text'], 100)}
                                    </div>
                                </li>
                                <hr />`;

                            container.append(li);
                        });
                    } else {
                        container.append(`<p class="text-center">Пусто!</p>`);
                    }

                },
                error: function(error) {
                    console.log(error)
                }
            });
        }
    });
});
