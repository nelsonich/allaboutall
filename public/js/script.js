$(function () {
    const limit = 5;
    let url = window.location.pathname.split("/");
    const categoryId = url[url.length - 1];
    const token = $('meta[name="csrf-token"]').attr("content");
    setGlobalVariableValue(
        "ifIssetData",
        $("div.childCategories").data("ifissetdata")
    );

    $("div.childCategories").scroll(function () {
        if (
            $("div.childCategories").scrollTop() + $(this).innerHeight() >=
                $(this)[0].scrollHeight &&
            (globalVariables.ifIssetData === true ||
                globalVariables.ifIssetData === "true")
        ) {
            $("p.loader").removeClass("hide");
            // $('div.childCategories ul').addClass("hide")

            getChildData({
                _token: token,
                offset: globalVariables.perPage * limit,
                id: categoryId,
                q: $("input#search").val(),
            }).then((res) => {
                if (res) {
                    $("p.loader").addClass("hide");
                    // $('div.childCategories ul').removeClass("hide")
                    setGlobalVariableValue(
                        "perPage",
                        globalVariables.perPage++
                    );
                    $("div.childCategories").attr(
                        "data-ifIssetData",
                        res["ifIssetData"]
                    );
                    setGlobalVariableValue("ifIssetData", res["ifIssetData"]);
                    $.each(res["childCategories"], function (index, value) {
                        let li = `<li style="display: flex; margin-bottom: 5px;">
                                    <div style="background-image: url('../storage/category_details/images/${
                                        value["category_details"]["image"]
                                    }')"></div>
                                    <div class="ml-1">
                                        <h3><a href="/info-p/${categoryId}/${
                            value.id
                        }" class="click">${value.name}</a></h3>
                                        <p>${textLimit(
                                            value["category_details"][
                                                "preview_text"
                                            ],
                                            100
                                        )}</p>
                                    </div>
                                </li>
                                <hr />`;
                        $("div.childCategories > ul").append(li);
                    });
                }
            });
        }
    });

    $(document).on("click", "a.click", function (e) {
        e.preventDefault();
        let that = $(this);
        let url = that.attr("href").split("/");
        const categoryId = url[url.length - 1];

        $.ajax({
            url: `/api/add-link-count/${categoryId}`,
            method: "GET",
            dataType: "json",
            success: function (res) {
                if (res) location.href = that.attr("href");
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#newsletterform").submit(function (e) {
        e.preventDefault();
        const submit = $("#newsletterform button[type=submit]");
        let name = $("#name").val();
        let email = $("#email").val();

        $("#newsletterform input").removeClass("noValid");
        $("#newsletterform p.errorMessage").text("");

        let isValidForm = formValidation([
            { field: "name", required: true, value: name },
            { field: "email", required: true, value: email },
        ]);

        if (isValidForm.length > 0) {
            isValidForm.forEach((element) => {
                $(`#newsletterform input[name=${element.field}]`).addClass(
                    "noValid"
                );
                $(
                    `#newsletterform input[name=${element.field}] + p.errorMessage`
                ).text(element.error);
            });

            return false;
        }

        submit.addClass("disabled");
        submit.text("Подождите");

        $.ajax({
            url: "/api/subscribe",
            type: "post",
            dataType: "json",
            data: { _token: token, name: name, email: email },
            success: function (data) {
                submit.removeClass("disabled");
                submit.text("Подписываться");
                $("#newsletterform input").val("");

                createSuccessMessageWindow(data.title, data.message);
                removeModal("successMessageWindow", 6000);
            },
            error: function (error) {
                createErrorMessageWindow(error.responseJSON.errors.email[0]);
                submit.removeClass("disabled");
                submit.text("Подписываться");
                removeModal("errorMessageWindow", 6000);
            },
        });
    });

    $(document).on("click", "span.closeModal", function () {
        $(this).parent().parent().remove();
    });

    // setBackground($('section').data('bg'), $('section').data('path'))
});
