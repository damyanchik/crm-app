$('#table-breakpoint').basictable({
    breakpoint: 772,
});

updateTableStripedClass();

$(window).resize(function() {
    updateTableStripedClass();
});

function updateTableStripedClass() {
    var breakpoint = 772;
    var $table = $('#table-breakpoint');

    if ($(window).width() <= breakpoint) {
        $table.addClass('table-striped');
    } else {
        $table.removeClass('table-striped');
    }
}
