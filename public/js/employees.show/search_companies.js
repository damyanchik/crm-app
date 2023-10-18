$('#searchCompanyInput').on('input', function () {
    var searchText = $(this).val().toLowerCase();
    $('.company-link').each(function () {
        var companyText = $(this).text().toLowerCase();
        if (companyText.indexOf(searchText) !== -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});
