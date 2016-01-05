var Sortable = require('./sortable'),
  sortable;

// Make sortable lists sortable.
sortable = document.getElementById('modules-list');

if (sortable != null) {
  Sortable.create(sortable);
}

// Visibility for calendar input field for modules.
$('.calendar-type').on('change', 'select', function() {
  var $this = $(this),
      value = $this.val();

  // Hide all fields.
  $this.siblings('input').prop('hidden', 'hidden');

  // If selected calendar type is a file, show file upload fields.
  if (value.indexOf('-file') !== -1) {
    $this.siblings('input[type="file"]').prop('hidden', false);
  } else {
    $this.siblings('input[type="text"]').prop('hidden', false);
  }
}).find('select').trigger('change');