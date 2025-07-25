$('.bars').click(function () {
    $('.sidebar__nav').toggleClass('is-active');
    $('.content').toggleClass('is-active');
})
$('.notification__icon').on('click', function () {
    $('.dropdown__notification').toggleClass('is-active');
})
$(document).on('click', function (event) {
    if (!$(event.target).closest('.dropdown__notification').length && !$(event.target).closest('.notification').length) {
        $('.dropdown__notification').removeClass('is-active');
    }
})
$('.avatar-img__input').on('change', function () {
    var input = $(this);
    if (input[0] && input[0].files && input[0].files[0]) {
        if (!input[0].files[0].type.includes("image")) {
            // $('.avatar--img').attr('src', '../img/pr3o.png');
            return false;
        }
        var reader = new FileReader();
        reader.onload = function (e) {

            $('.avatar___img')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input[0].files[0]);
    }
});
$('input:file').change(
    function (e) {
        // console.log(e.currentTarget.files);
        // var numFiles = e.currentTarget.files.length;
        var fileSize = parseInt(e.currentTarget.files[0].size, 10) / 1024;
        filesize = Math.round(fileSize);
        $('.filesize').addClass('filesize').text('(' + filesize + 'kb)');
        $('.selectedFiles').text(e.currentTarget.files[0].name).appendTo($('.selectedFiles'));

    });

function create_custom_dropdowns() {
    $('select').each(function (i, select) {
        if (!$(this).next().hasClass('dropdown-select')) {
            $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
            var dropdown = $(this).next();
            var options = $(select).find('option');
            var selected = $(this).find('option:selected');
            dropdown.find('.current').html(selected.data('display-text') || selected.text());
            options.each(function (j, o) {
                var display = $(o).data('display-text') || '';
                dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
            });
        }
    });

    $('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
}

$(document).on('click', '.dropdown-select', function (event) {
    if ($(event.target).hasClass('dd-searchbox')) {
        return;
    }
    $('.dropdown-select').not($(this)).removeClass('open');
    $(this).toggleClass('open');
    if ($(this).hasClass('open')) {
        $(this).find('.option').attr('tabindex', 0);
        $(this).find('.selected').focus();
    } else {
        $(this).find('.option').removeAttr('tabindex');
        $(this).focus();
    }
});

$(document).on('click', function (event) {
    if ($(event.target).closest('.dropdown-select').length === 0) {
        $('.dropdown-select').removeClass('open');
        $('.dropdown-select .option').removeAttr('tabindex');
    }
    event.stopPropagation();
});

function filter() {
    var valThis = $('#txtSearchValue').val();
    $('.dropdown-select ul > li').each(function () {
        var text = $(this).text();
        (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
    });
};

$(document).on('click', '.dropdown-select .option', function (event) {
    $(this).closest('.list').find('.selected').removeClass('selected');
    $(this).addClass('selected');
    var text = $(this).data('display-text') || $(this).text();
    $(this).closest('.dropdown-select').find('.current').text(text);
    $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
});

$(document).on('keydown', '.dropdown-select', function (event) {
    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
    if (event.keyCode == 13) {
        if ($(this).hasClass('open')) {
            focused_option.trigger('click');
        } else {
            $(this).trigger('click');
        }
        return false;
        // Down
    } else if (event.keyCode == 40) {
        if (!$(this).hasClass('open')) {
            $(this).trigger('click');
        } else {
            focused_option.next().focus();
        }
        return false;
        // Up
    } else if (event.keyCode == 38) {
        if (!$(this).hasClass('open')) {
            $(this).trigger('click');
        } else {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            focused_option.prev().focus();
        }
        return false;
        // Esc
    } else if (event.keyCode == 27) {
        if ($(this).hasClass('open')) {
            $(this).trigger('click');
        }
        return false;
    }
});

$(document).ready(function () {
    create_custom_dropdowns();
});
$('.checkedAll').on('click', function (e) {
    if ($(this).is(':checked', true)) {
        $(".sub-checkbox").prop('checked', true);
    } else {
        $(".sub-checkbox").prop('checked', false);
    }
});
function acceptAllLessons(route) {
    if (confirm("آیا از تایید همه جلسات این دوره اطمینان دارید؟")) {
        $("<form action='"+ route +"' method='post'>" +
            "<input type='hidden' name='_token' value='"+ $('meta[name="_token"]').attr('content') +"' /> "+
            "<input type='hidden' name='_method' value='patch'> " +
            "</form>").appendTo('body').submit();
    }
}
function acceptMultiple(route) {
    doMultipleAction(route, "آیا مطمئن هستید که می خواهید این سطرها را تایید کنید؟",'patch')
}
function rejectMultiple(route) {
    doMultipleAction(route, "آیا مطمئن هستید که می خواهید این سطرها را رد کنید؟",'patch')
}

function deleteMultiple(route) {
    doMultipleAction(route,"آیا مطمئن هستید که می خواهید این سطرها را حذف کنید؟" ,"delete")
}
function doMultipleAction(route,message, method){
    var allVals = getSelectedItems();
    if (allVals.length <= 0) {
        alert("یک سطر انتخاب کنید");
    } else {
        WRN_PROFILE_DELETE = message;
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
            $("<form action='"+ route +"' method='post'>" +
                "<input type='hidden' name='_token' value='"+ $('meta[name="_token"]').attr('content') +"' /> "+
                "<input type='hidden' name='_method' value='"+ method +"'> " +
                "<input type='hidden' name='ids' value='" + allVals + "'>" +
                "</form>").appendTo('body').submit();
        }
    }
}
function getSelectedItems() {
    var allVals = [];
    $(".sub-checkbox:checked").each(function () {
        allVals.push($(this).attr('data-id'));
    });
    return allVals;
}

$('.course__detial .item-delete').on('click', function (e) {
    WRN_PROFILE_DELETE = "آیا مطمئن هستید که می خواهید این سطر را حذف کنید؟";
    var check = confirm(WRN_PROFILE_DELETE);
    if (check == true) {
        $('table tr').filter("[data-row-id='" + $(this).attr('data-id') + "']").remove();
    }
});
$(document).on('click touchstart', function (e) {
    var serach__box = $('.t-header-search');
    var input = $('.search-input__box');
    if ($(e.target).is(serach__box) || serach__box.has(e.target).length == 1) {
        $('.t-header-search-content').show();
        $('.t-header-searchbox').addClass('open')
    } else {
        $('.t-header-search-content').hide();
        $('.t-header-searchbox').removeClass('open')

    }
})
$('.create-ads .ads-field-pn').on('click', function (e) {
    $('.file-upload').hide()
});
$('.create-ads .ads-field-banner').on('click', function (e) {
    $('.file-upload').show()
});
$('#discounts-field-2').on('click', function (e) {
    $('#selectCourseContainer').removeClass('d-none')
});
$('#discounts-field-1').on('click', function (e) {
    $('#selectCourseContainer').addClass('d-none')
});
function updateConfirmationStatus(event, route, message, status, field = 'confirmation_status', parent = 'tr', target= 'td.') {
    event.preventDefault();
    if(confirm(message)){
        $.post(route, { _method: "PATCH", _token: $('meta[name="_token"]').attr('content') })
            .done(function (response) {
                $(event.target).closest(parent).find(target + field).text(status);
                if (status == "تایید شده") {
                    $(event.target).closest(parent).find(target + field).html("<span class='text-success'>" + status + "</span>");
                }else{
                    $(event.target).closest(parent).find(target + field).html("<span class='text-error'>" + status + "</span>");
                }

                $.toast({
                    heading: 'عملیات موفق',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'success'
                })
            })
            .fail(function (response) {
                $.toast({
                    heading: 'عملیات ناموفق',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'error'
                })
            })
    }
}
function deleteItem(event, route, element = 'tr') {
    event.preventDefault();
    if(confirm('آیا از حذف این آیتم اطمینان دارید؟')){
        $.post(route, { _method: "delete", _token: $('meta[name="_token"]').attr('content') })
            .done(function (response) {
                event.target.closest(element).remove();
                $.toast({
                    heading: 'عملیات موفق',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'success'
                })
            })
            .fail(function (response) {
                $.toast({
                    heading: 'عملیات ناموفق',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'error'
                })
            })
    }
}
