


var _token = $('meta[name="csrf-token"]').attr('content');

jQuery(document).ready(function ($) {

    //profile photo upload
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
});

// Numeric only control handler
jQuery.fn.ForceNumericOnly =
    function () {
        return this.each(function () {
            $(this).keydown(function (e) {
                var key = e.charCode || e.keyCode || 0;
                // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                // home, end, period, and numpad decimal
                return (
                    key == 8 ||
                    key == 9 ||
                    key == 13 ||
                    key == 46 ||
                    key == 110 ||
                    key == 190 ||
                    (key >= 35 && key <= 40) ||
                    (key >= 48 && key <= 57) ||
                    (key >= 96 && key <= 105));
            });
        });
    };

function active(id) {
    let el = document.getElementById('status' + id);
    el.classList.remove('text-danger')
    el.classList.add('text-info')
}

function inactive(id) {
    let el = document.getElementById('status' + id);
    el.classList.remove('text-info')
    el.classList.add('text-danger')
}

function deleteItem(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از عمیات حذف اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d6303b',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'حذف شود'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'DELETE',
                url: route,
                data: {
                    _token: _token,
                },
                success: function (data) {
                    document.getElementById('tr' + id).style.display = 'none'
                    Swal.fire('انجام شد', '', 'success')
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function statusItem(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از تغییر وضعیت اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d6303b',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'تغییر'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'put',
                url: route,
                data: {
                    _token: _token,
                },
                success: function (data) {
                    if (data == 'inactive' || data == 'ban') {
                        inactive(id);
                    } else if (data == 'active') {
                        active(id);
                    }
                    Swal.fire('انجام شد', '', 'success')
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function statusItemAvailable(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از تغییر وضعیت حضور خود اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d6303b',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'تغییر'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'put',
                url: route,
                data: {
                    _token: _token,
                },
                success: function (data) {
                    let el = document.getElementById('available_status');
                    let el_text = document.getElementById('available_status_text');
                    if (data == 'not available') {
                        el_text.innerText = 'در دسترس نیستم'
                        el.classList.remove('badge-success')
                        el.classList.add('badge-warning')
                    } else if (data == 'active') {
                        el_text.innerText = 'در دسترس هستم'
                        el.classList.remove('badge-warning')
                        el.classList.add('badge-success')
                    }
                    Swal.fire('انجام شد', '', 'success')
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function choosePerson(event, id) {
    event.preventDefault();
    Swal.fire({
        input: 'textarea',
        inputLabel: "در صورت نیاز پیغامی برای سرتیم قرار دهید:",
        inputPlaceholder: 'پیام',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true,
        confirmButtonText: 'انتخاب سرتیم',
    }).then((result) => {
        if (result.isConfirmed) {
            let value = document.getElementById('swal2-input').value;
            document.getElementById(`message_${id}`).value = value;
            document.getElementById(`person_${id}`).submit();
        }
    });

}

function changePersonTeamLeader(event, id) {
    event.preventDefault();
    Swal.fire({
        input: 'textarea',
        inputLabel: "در صورت نیاز پیغامی برای سرتیم قرار دهید:",
        inputPlaceholder: 'پیام',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true,
        confirmButtonText: 'انتخاب سرتیم',
    }).then((result) => {
        if (result.isConfirmed) {
            let value = document.getElementById('swal2-input').value;
            document.getElementById(`message_${id}`).value = value;
            document.getElementById(`person_${id}`).submit();
        }
    });

}

function changePersonExpert(event, id) {
    event.preventDefault();
    Swal.fire({
        input: 'textarea',
        inputLabel: "در صورت نیاز پیغامی برای متخصص قرار دهید:",
        inputPlaceholder: 'پیام',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true,
        confirmButtonText: 'انتخاب متخصص',
    }).then((result) => {
        if (result.isConfirmed) {
            let value = document.getElementById('swal2-input').value;
            document.getElementById(`message_${id}`).value = value;
            document.getElementById(`person_${id}`).submit();
        }
    });

}

function chooseExpert(event, id) {
    event.preventDefault();
    Swal.fire({
        input: 'textarea',
        inputLabel: "در صورت نیاز پیغامی برای متخصص قرار دهید:",
        inputPlaceholder: 'پیام',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true,
        confirmButtonText: 'انتخاب متخصص',
    }).then((result) => {
        if (result.isConfirmed) {
            let value = document.getElementById('swal2-input').value;
            document.getElementById(`message_${id}`).value = value;
            document.getElementById(`person_${id}`).submit();
        }
    });

}

function fail_order_form(event, route) {
    event.preventDefault();
    const {value: message} = Swal.fire({
        text: 'آیا از مختومه کردن این سفارش اطمینان دارید ؟',
        icon: 'warning',
        input: 'textarea',
        inputLabel: "با ذکر دلیل مختومه کردن سفارش را ادامه دهید :‌",
        inputPlaceholder: 'توضیحات',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true,
        confirmButtonText: 'لغو سفارش',
        inputValidator: (value) => {
            if (!value) {
                return 'لطفا متن را وارد کنید'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'post',
                url: route,
                data: {
                    description: document.getElementById('swal2-input').value,
                    _token: _token,
                },
                success: function (data) {
                    jQuery('#btnsActiveForm').fadeOut();
                    console.log(jQuery('#btnsActiveForm'))
                    Swal.fire('انجام شد', '', 'success')
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function fail_order_form_approve_by_team_leader(event, route) {
    event.preventDefault();
    const {value: message} = Swal.fire({
        text: 'آیا از تایید کردن درخواست لغو سفارش اطمینان دارید ؟',
        icon: 'warning',
        input: 'textarea',
        inputLabel: "با ذکر دلیل تایید کردن لغو سفارش را ادامه دهید :‌",
        inputPlaceholder: 'توضیحات',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true,
        confirmButtonText: ' تایید لغو سفارش',
        inputValidator: (value) => {
            if (!value) {
                return 'لطفا متن را وارد کنید'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'post',
                url: route,
                data: {
                    description: document.getElementById('swal2-input').value,
                    _token: _token,
                },
                success: function (data) {
                    document.getElementById('btnsActiveForm').style.display = 'none';
                    document.getElementById('failedOrder').style.display = 'block';
                    Swal.fire('انجام شد', '', 'success')
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function fail_order_form_request(event, route) {
    event.preventDefault();
    const {value: message} = Swal.fire({
        text: 'آیا از دادن درخواست لغو برای این سفارش اطمینان دارید ؟',
        icon: 'warning',
        input: 'textarea',
        inputLabel: "با ذکر دلیل لغو کردن سفارش را ادامه دهید :‌",
        inputPlaceholder: 'توضیحات',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true,
        confirmButtonText: 'لغو سفارش',
        inputValidator: (value) => {
            if (!value) {
                return 'لطفا متن را وارد کنید'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'post',
                url: route,
                data: {
                    description: document.getElementById('swal2-input').value,
                    _token: _token,
                },
                success: function (data) {
                    document.getElementById('btnsActiveForm').style.display = 'none';
                    document.getElementById('failedOrder').style.display = 'block';
                    Swal.fire('انجام شد', '', 'success')
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function not_agreement_with_customer(event, route) {
    event.preventDefault();
    const {value: message} = Swal.fire({
        text: 'ایا از این درخواست اطمینان دارید ؟',
        icon: 'warning',
        input: 'textarea',
        inputLabel: "با ذکر دلیل لغو کردن سفارش را ادامه دهید :‌",
        inputPlaceholder: 'توضیحات',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true,
        confirmButtonText: 'لغو سفارش',
        inputValidator: (value) => {
            if (!value) {
                return 'لطفا متن را وارد کنید'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'post',
                url: route,
                data: {
                    description: document.getElementById('swal2-input').value,
                    _token: _token,
                },
                success: function (data) {
                    document.getElementById('btnsActiveForm').style.display = 'none';
                    document.getElementById('failedOrder').style.display = 'block';
                    Swal.fire('انجام شد', '', 'success')
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function send_to_supporter_set_factor(event, route) {
    event.preventDefault();
    const {value: message} = Swal.fire({
        text: 'ایا از این درخواست اطمینان دارید ؟',
        icon: 'warning',
        input: 'textarea',
        inputLabel: "توضیحات خود را وارد کنید :‌",
        inputPlaceholder: 'توضیحات',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true,
        confirmButtonText: 'ارسال',
        inputValidator: (value) => {
            if (!value) {
                return 'لطفا متن را وارد کنید'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'post',
                url: route,
                data: {
                    description: document.getElementById('swal2-input').value,
                    _token: _token,
                },
                success: function (data) {
                    window.location.replace(route);
                    Swal.fire('انجام شد', '', 'success')
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function accept_order_form_request(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از انتخابتان اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#41d487',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'بله'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'post',
                url: route,
                data: {
                    _token: _token,
                },
                success: function (data) {
                    // let el = document.getElementById('available_status');

                    Swal.fire('انجام شد', '', 'success')
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function end_work_order_by_expert(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از اتمام کار این سفارش و صدور فاکتور  اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#41d487',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'بله'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'post',
                url: route,
                data: {
                    _token: _token,
                },
                success: function (data) {
                    // let el = document.getElementById('available_status');

                    Swal.fire('انجام شد', '', 'success')
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function deleteJsonField(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از عمیات حذف اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d6303b',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'حذف شود'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'DELETE',
                url: route,
                data: {
                    _token: _token,
                },
                success: function (data) {
                    document.getElementById(id).style.display = 'none'
                    Swal.fire('انجام شد', '', 'success')
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function deleteQuestionField(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از عمیات حذف اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d6303b',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'حذف شود'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'DELETE',
                url: route,
                data: {
                    _token: _token,
                },
                success: function (data) {
                    document.getElementById(id).style.display = 'none'
                    Swal.fire('انجام شد', '', 'success')
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function questionPrice(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از تعیین این قیمت اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d6303b',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'انجام'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'put',
                url: route,
                data: {
                    _token: _token,
                    price: jQuery(`#price_${id}`).val()
                },
                success: function (data) {
                    Swal.fire('انجام شد', '', 'success')
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function questionPriority(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از تعیین این اولویت اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d6303b',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'انجام'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'patch',
                url: route,
                data: {
                    _token: _token,
                    priority: jQuery(`#priority_${id}`).val()
                },
                success: function (data) {
                    Swal.fire('انجام شد', '', 'success')
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function deletePriceField(event, route, id) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از عمیات حذف اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d6303b',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'حذف شود'
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'DELETE',
                url: route,
                data: {
                    _token: _token,
                },
                success: function (data) {
                    document.getElementById(id).style.display = 'none'
                    Swal.fire('انجام شد', '', 'success')
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}

function set_report(id) {
    document.getElementById('report_body').innerText = document.getElementById(`report_${id}`).value;
}

function showReportSettlement(report) {
    if (report) {
        document.getElementById('report_body').innerText = report
    } else {
        document.getElementById('report_body').innerText = 'پیامی موجود نیست'
    }
}

function end_work_order_by_expert_submit_form(event) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از اتمام کار این سفارش و صدور فاکتور  اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#41d487',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'بله'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('factor_form').submit();
        }
    })
}

function end_work_order_by_factor_admin_submit_form(event, route) {
    event.preventDefault();
    Swal.fire({
        text: 'آیا از اتمام کار این سفارش و صدور فاکتور  اطمینان دارید ؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#41d487',
        cancelButtonColor: '#4d6182',
        confirmButtonText: 'بله'
    }).then((result) => {
        if (result.isConfirmed) {
            let data = {};
            let trs = $('#table_factor_body').children('tr')
            $.each(trs, function (key, value) {
                data[key] = {
                    name: $(value).find('.title_td').text(),
                    unit: $(value).find('.unit_td').text(),
                    price: $(value).find('.price_td').text(),
                    discount_pure: $(value).find('.discount_pure_td').text(),
                    discount_percent: $(value).find('.discount_percent_td').text(),
                    count: $(value).find('.input_td').val(),
                    amount: $(value).find('.calculated_td').text()
                }
            });
            jQuery.ajax({
                type: 'post',
                url: route,
                data: {
                    data: data,
                    price_final: $('#final_price').text(),
                    _token: _token,
                },
                success: function (data) {
                    Swal.fire('انجام شد', '', 'success')
                    location.reload();
                },
                error: function (data) {
                    Swal.fire('با خطا مواجه شد', '', 'info')
                }
            });
        }
    })
}


$('#btn_add_price').click(function (event) {
    let el = $('#select_item_factor option:selected');
    let price = el.attr('data-price')
    let unit = el.attr('data-unit')
    let title = el.val()
    let discount_pure = el.attr('data-discount_pure')
    let discount_percent = el.attr('data-discount_percent')
    let price_id = el.attr('data-price_id')
    event.preventDefault();
    if ($(`#price_${price_id}`).length == 0) {
        $table_body = $('#table_factor_body')
        let input = `<input type="email" id="price_${price_id}" name="price[${price_id}]" class="form-control input_td input-sm price_factor d-inline add_price">`
        let tr = `<tr>
                              <td scope="row" class="title_td" id="title_${price_id}">${title}</td>
                                <td class="unit_td">${unit}</td>
                                <td class="price_td">${price}</td>
                                <td class="discount_pure_td">${discount_pure}</td>
                                <td class="discount_percent_td">${discount_percent}</td>
                                <td>${input}</td>
                                <td id="claculate_${price_id}" class="pricePlus calculated_td"></td>
                                <td><div class="btn btn-sm btn-danger del_row">حذف</div></td>
                            </tr>`
        $table_body.append(tr);
        $(".del_row").click(function () {
            $(this).closest('tr').remove()
            let final_price = 0
            $('.pricePlus').each(function (i, obj) {
                final_price += Number(obj.innerText);
            });
            document.getElementById('final_price').innerText = final_price;
        })
        $(`#price_${price_id}`).ForceNumericOnly().keyup(function () {
            let val = $(this).val();
            val *= price;
            if (typeof Number(discount_pure) == "number" && discount_pure > 0) {
                val -= discount_pure
            }
            if (typeof Number(discount_percent) == "number" && discount_percent > 0) {
                val -= ((val * discount_percent) / 100);
            }
            if (val > 0 && typeof Number(val) == "number") {
                document.getElementById(`claculate_${price_id}`).innerText = val;
            }
            let final_price = 0
            $('.pricePlus').each(function (i, obj) {
                final_price += Number(obj.innerText);
            });
            document.getElementById('final_price').innerText = final_price;
        });

    } else {
        alert('این واحد را قبلا وارد کرده اید!')
    }


})

$('#custom_discount_pure , #custom_discount_percent , #custom_price').ForceNumericOnly();
$('#custom_add_fields').click(function (event) {
    let price = $('#custom_price').val()
    let unit = $('#custom_unit').val()
    let title = $('#custom_title').val()
    let discount_pure = $('#custom_discount_pure').val()
    let discount_percent = $('#custom_discount_percent').val()
    let price_id = Math.floor(Math.random() * 10000) + 1
    event.preventDefault();
    if ($(`#price_${price_id}`).length == 0) {
        $table_body = $('#table_factor_body')
        let input = `<input type="email" id="price_${price_id}" name="price[${price_id}]" class="form-control input_td input-sm price_factor d-inline add_price">`
        let tr = `<tr>
                                <td scope="row" class="title_td" id="title_${price_id}">${title}</td>
                                <td class="unit_td">${unit}</td>
                                <td class="price_td">${price}</td>
                                <td class="discount_pure_td">${discount_pure}</td>
                                <td class="discount_percent_td">${discount_percent}</td>
                                <td>${input}</td>
                                <td id="claculate_${price_id}" class="pricePlus calculated_td"></td>
                                <td><div class="btn btn-sm btn-danger del_row">حذف</div></td>
                            </tr>`
        $table_body.append(tr);
        $(".del_row").click(function () {
            $(this).closest('tr').remove()
            let final_price = 0
            $('.pricePlus').each(function (i, obj) {
                final_price += Number(obj.innerText);
            });
            document.getElementById('final_price').innerText = final_price;
        })
        $(`#price_${price_id}`).ForceNumericOnly().keyup(function () {
            let val = $(this).val();
            val *= price;
            if (typeof Number(discount_pure) == "number" && discount_pure > 0) {
                val -= discount_pure
            }
            if (typeof Number(discount_percent) == "number" && discount_percent > 0) {
                val -= ((val * discount_percent) / 100);
            }
            if (val > 0 && typeof Number(val) == "number") {
                document.getElementById(`claculate_${price_id}`).innerText = val;
            }
            let final_price = 0
            $('.pricePlus').each(function (i, obj) {
                final_price += Number(obj.innerText);
            });
            document.getElementById('final_price').innerText = final_price;
        });

    } else {
        alert('این واحد را قبلا وارد کرده اید!')
    }


})

$('#btn_del_price').click(function (event) {
    event.preventDefault();
    var ids = $.map($('#factor_table').bootstrapTable('getSelections'), function (row) {
        return row.id
    })
    $('#factor_table').bootstrapTable('remove', {
        field: 'id',
        values: ids
    })
})


// jQuery(document).ready(function() {
//     jQuery(".example1").pDatepicker({
//         observer: true,
//         format: 'YYYY/MM/DD H:m:s',
//         altField: '#observer-timestamp-begin'
//     });
//     jQuery(".example2").pDatepicker({
//         observer: true,
//         format: 'YYYY/MM/DD H:m:s',
//         altField: '#observer-timestamp-end'
//     });
//     jQuery(".createUser").pDatepicker({
//         observer: true,
//         format: 'YYYY/MM/DD',
//         altField: '#createUser-timestamp'
//     });
//
//     jQuery('.select2Js').select2();
// });


function deleteCategory(event, id) {
    event.preventDefault;
    var id = id;
    jQuery('#modalBtnId').trigger('click');
    document.getElementById('btnDel').onclick = function submitDeleteForm() {
        jQuery.ajax({
            type: 'DELETE',
            url: document.getElementById('urlDel' + id).value,
            data: {
                _token: _token,
            },
            success: function (data) {
                jQuery("#btnClose").trigger('click');
                document.getElementById('tr' + id).style.display = 'none'
                document.getElementById('alertDelCategory').classList.add('d-block')
            }
        });
    }
};

function makeCategory(event) {
    event.preventDefault;
    let wrongs = [];
    let name = document.getElementById('name').value;
    let slug = document.getElementById('slug').value;
    let parentId = document.getElementById('parentId').value;
    let url = document.getElementById('urlMakeCategory').value;

    jQuery.ajax({
        type: 'POST',
        url: url,
        data: {
            _token: _token,
            name: name,
            slug: slug,
            parentId: parentId,
        },
        success: function (data) {
            document.getElementById('alert').classList.add('d-block')
        },
        error: function (errors) {
            if (errors.responseJSON.errors.parentId) {
                wrongs['parentId'] = errors.responseJSON.errors.parentId[0];
            }
            if (errors.responseJSON.errors.slug) {
                wrongs['slug'] = errors.responseJSON.errors.slug[0];
            }
            if (errors.responseJSON.errors.name) {
                let nameValid = document.getElementById('nameValid');
                nameValid.classList.remove('d-none')
                nameValid.children[0].innerHTML = errors.responseJSON.errors.name[0]
            }
            console.log(wrongs)
        }
    });
};

// Dropzone.options.brandDZ = {
//     // url: document.getElementById('urlBrandSave').value,
//     clickable: true,
//     addRemoveLinks: true,
//     acceptedFiles: '.png,.jpg,.pdf',
//     dictDefaultMessage: 'تصویر را در اینجا قرار دهید',
//     parallelUploads: 1,
//     autoProcessQueue: false,
//     uploadMultiple: false,
//     init: function () {
//
//         var myDropzone = this;
//
//         // Update selector to match your button
//         document.getElementById("sendBrand").addEventListener('click', function () {
//             myDropzone.processQueue();
//         });
//
//         this.on('sending', function (file, xhr, formData) {
//             // Append all form inputs to the formData Dropzone will POST
//             let name = document.getElementById('name').value;
//             let slug = document.getElementById('slug').value;
//             let country = document.getElementById('country').value;
//             let category_id = document.getElementById('category_id').value;
//             formData.append('name', name);
//             formData.append('slug', slug);
//             formData.append('country', country);
//             formData.append('category_id', category_id);
//             formData.append('_token', _token);
//         });
//     },
//     success: function (file, response) {
//         document.getElementById('alertBrand').classList.remove('d-none');
//     }
//
// };

// Dropzone.options.slidDZ = {
//     url: document.getElementById('urlSave').value,
//     clickable: true,
//     addRemoveLinks: true,
//     acceptedFiles: '.png,.jpg,.pdf',
//     dictDefaultMessage: 'تصویر را در اینجا قرار دهید',
//     parallelUploads: 1,
//     autoProcessQueue: false,
//     uploadMultiple: false,
//     init: function () {
//
//         var myDropzone = this;
//
//         // Update selector to match your button
//         document.getElementById("sendSlid").addEventListener('click', function () {
//             myDropzone.processQueue();
//         });
//
//         this.on('sending', function (file, xhr, formData) {
//             // Append all form inputs to the formData Dropzone will POST
//             let name = document.getElementById('name').value;
//             let slug = document.getElementById('slug').value;
//             let description = document.getElementById('description').value;
//             let category= document.getElementById('category_id').value;
//             let brand = document.getElementById('brand_id').value
//             ;
//             formData.append('name', name);
//             formData.append('slug', slug);
//             formData.append('description', description);
//             formData.append('category', category);
//             formData.append('brand', brand);
//             formData.append('_token', _token);
//         });
//     },
//     success: function (file, response) {
//         document.getElementById('alertSlide').classList.remove('d-none');
//     },
//     error: function (file, response) {
//         document.getElementById('alertSlideError').classList.remove('d-none');
//     }
//
// };




function toastMessage(text="عملیات موفقیت امیز بوذ",heading="موفق",type="success",loaderBg="#90e084"){
    jQuery.toast({
        text : text,
        showHideTransition : 'slide',  // It can be plain, fade or slide
        heading: heading,
        icon: type,
        loader: true,        // Change it to false to disable loader
        loaderBg: loaderBg,
        textAlign: 'right'
    })
}


