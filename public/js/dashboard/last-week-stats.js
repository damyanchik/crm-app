$('.lastWeekDiff').each(function() {
    var value = $(this).text();

    if (parseFloat(value) < 0) {
        $(this).html('<i class="fa-solid fa-down-long danger"></i> ' + value).css('color', '#c90707');
    } else if (parseFloat(value) > 0) {
        $(this).html('<i class="fa-solid fa-up-long success"></i> ' + value).css('color', '#136c13');
    }
});
