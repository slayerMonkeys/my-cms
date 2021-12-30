require('./bootstrap');

$(document).on('click','#showModalButton', (e) => {
    e.preventDefault();
    const href = $('#showModalButton').attr('data-view');

    $.get(href, (result) => {
        //$('#postDeleteModal').modal('show');
        $('#postDeleteModal .modal-footer').html(result).show();
    });
});
