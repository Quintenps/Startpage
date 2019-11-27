function getNextColorScheme() {
    colorSchemes = [];
    currentColorScheme = Cookies.get('colorscheme');

    $('.color-scheme').each(function () {
        colorSchemes.push(this.id);
    });

    currentIndex = colorSchemes.indexOf(currentColorScheme);
    nextIndex = (currentIndex + 1) % colorSchemes.length;

    return colorSchemes[nextIndex];
}

function setColorScheme() {
    $('.color-scheme').prop("disabled", true);
    var newColorScheme = getNextColorScheme();
    Cookies.set('colorscheme', newColorScheme, {
        expires: 999
    });
    $("#" + newColorScheme).prop("disabled", false);
}


$(function () {


    if (Cookies.get('colorscheme')) {
        $("#" + Cookies.get('colorscheme')).prop("disabled", false);
        console.log('Setting preffered color scheme: ' + Cookies.get('colorscheme'));
    } else {
        $("#color-scheme-default").prop("disabled", false);
        Cookies.set('colorscheme', 'color-scheme-default', {
            expires: 999
        });
        console.log('No color scheme available, setting default (default)');
    }
    $("body").keydown(function (e) {
        if (e.key == "PageUp") {
            setColorScheme();
        }
    });

})
