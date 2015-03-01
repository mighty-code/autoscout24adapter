$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);// Button that triggered the modal
    var detailUrl = button.data('detail-url');// Extract info from data-* attributes
    var title = button.data('detail-title');// Extract info from data-* attributes
    var modal = $(this);
    modal.find('.modal-title').text(title);
    modal.find('#detailFrame').prop("src",detailUrl);
});