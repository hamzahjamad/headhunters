  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient_id = button.data('recipient-id') 
  var recipient_name = button.data('recipient-name') 
  var type = button.data('title-type') 
  var modal = $(this)
  modal.find('.modal-title').text('Delete '+type+' for ' + recipient_name)
  modal.find('.modal-body form').attr('action', function(i, value) {
  	console.log(value + recipient);
        return value + '/' + recipient_id;
    });
})