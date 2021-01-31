const globalVariables = {
    ifIssetData: false,
}

const textLimit = (text, limit) => {
    return text.length > limit ? text.substr(0, limit) + "..." : text;
}

const setBackground = (bg, path) => {
    $('body').css('background-image', `url('/storage/${path}/${bg}')`)
}

const setGlobalVariableValue = (key, value) => globalVariables[key] = value;
