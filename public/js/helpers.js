const globalVariables = {
    ifIssetData: false,
};

const textLimit = (text, limit) => {
    return text.length > limit ? text.substr(0, limit) + "..." : text;
};

const setBackground = (bg, path) => {
    if (bg === undefined && path === undefined) {
        $("body").css("background-color", "rgba(0, 0, 0, .5)");
    } else {
        if (path === "") {
            $("body").css({
                backgroundImage: `url('/storage/${bg}')`,
                backgroundRepeat: "repeat",
                backgroundSize: "unset",
            });
        } else {
            $("body").css("background-image", `url('/storage/${path}/${bg}')`);
        }
    }
};

const formValidation = (data) => {
    let arr = [];
    data.forEach((element) => {
        if (element.required == true && element.value == "") {
            element.error = `${element.field} field is required!`;
            arr.push(element);
        } else {
            switch (element.field) {
                case "email":
                    if (!validateEmail(element.value)) {
                        element.error = "Email is not valid!";
                        arr.push(element);
                    }
                    break;
            }
        }
    });

    return arr;
};

function validateEmail(email) {
    const re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const createSuccessMessageWindow = (title, message) => {
    const modal = `<div class="successMessageWindow">
        <div>
            <span class="closeModal">
                <i class="fas fa-times"></i>
            </span>
        </div>
        <h4>${title}</h4>
        <p>${message}</p>
    </div>`;

    $("body").append(modal);
};

const createErrorMessageWindow = (error) => {
    const modal = `<div class="errorMessageWindow">
        <div>
            <span class="closeModal">
                <i class="fas fa-times"></i>
            </span>
        </div>
        <h4>Ошибка...</h4>
        <p>${error}</p>
    </div>`;

    $("body").append(modal);
};

const removeModal = (name, time) => {
    setTimeout(() => {
        $(`.${name}`).remove();
    }, time);
};

const getChildData = async (data) => {
    const response = await fetch(`/api/get-data`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });

    return await response.json();
};

const setGlobalVariableValue = (key, value) => (globalVariables[key] = value);
