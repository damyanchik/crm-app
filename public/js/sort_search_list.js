$(document).ready(function() {
    var arrowImagePath = $('#listManager').data('arrow');
    var lastClickedTh = null;

    $('th[data-column]')
        .css('cursor', 'pointer')
        .click(function () {
            var th = $(this);
            var column = th.data('column');

            if (lastClickedTh && lastClickedTh !== th) {
                lastClickedTh.find('.rotate-icon').remove();
                lastClickedTh.css('cursor', 'pointer');
            }

            if (lastClickedTh && lastClickedTh.data('column') !== column) {
                $('#listManager input[name="order"]').val('');
            }

            if (!th.find('.rotate-icon').length) {
                var icon = $('<img src="'+arrowImagePath+'" class="rotate-icon ms-1" style="width: 0.7rem; cursor: pointer">');
                rotateIconClick(column, icon);
                th.append(icon);
                lastClickedTh = th;
            }
    });

    function rotateIconClick(column, icon) {
        addParam('column', column);
        changeOrder()
        var currentSort = $('#listManager input[name="order"]').val();
        var rotateIcon = currentSort === 'desc' ? 'rotate(180deg)' : 'rotate(0deg)';
        icon.css('transform', rotateIcon);

        $('#listManager input[name="order"]').trigger('change');
        $('#listManager input[name="column"]').trigger('change');
    }

    function addParam(name, value) {
        $('#listManager input[name="' + name + '"]').val(value);
    }

    function changeOrder() {
        var currentSortOrder = $('#listManager input[name="order"]').val();

        if (currentSortOrder === 'asc') {
            $('#listManager input[name="order"]').val('desc');
        } else {
            $('#listManager input[name="order"]').val('asc');
        }
    }
});
