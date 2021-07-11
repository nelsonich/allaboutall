const globalVariables = {
    ifIssetData: false,
}

const textLimit = (text, limit) => {
    return text.length > limit ? text.substr(0, limit) + "..." : text;
}

const setBackground = (bg, path) => {
    if (bg === undefined && path === undefined) {
        $('body').css('background-color', 'rgba(0, 0, 0, .5)')
    } else {
        if(path === '') {
            $('body').css({
                backgroundImage: `url('/storage/${bg}')`,
                backgroundRepeat: 'repeat',
                backgroundSize: 'unset',
            })
        } else {
            $('body').css('background-image', `url('/storage/${path}/${bg}')`)
        }
    }
}

const setGlobalVariableValue = (key, value) => globalVariables[key] = value;
