var Sortable = require('sortablejs'),
  Clipboard = require('clipboard-js'),
  sortable;

// Make sortable lists sortable.
sortable = document.getElementById('modules-list');

if (sortable != null) {
  Sortable.create(sortable);
}

// Visibility for calendar input field for modules.
$('.calendar-type').on('change', 'select', function() {
  var $this = $(this),
      value = $this.val(),
      $inputs = $this.siblings('.calendar-type-input');

  // Hide all fields.
  $inputs.prop('hidden', 'hidden');

  // If selected calendar type is a file, show file upload fields.
  if (value.indexOf('-file') !== -1) {
    $inputs.filter('.file').prop('hidden', false);
  } else {
    $inputs.filter(':not(.file)').prop('hidden', false);
  }
}).find('select').trigger('change');

// Allow copying calendar URLs.
$('.calendar-link').on('click', function(e) {
  Clipboard.copy($(this).attr('title'));

  e.preventDefault();
});

// Make user confirm deletion.
$('.icon-delete').on('click', function(e) {
  var $this = $(this);

  // Create Bootstrap Modal and listen form button click.
  $('#confirmDeleteModal')
    .on('click', '.modal-footer .confirm', function (e) {
      $this.parents('form').submit();
    }).modal();

  e.preventDefault();
});