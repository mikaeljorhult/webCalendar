var Sortable = require('sortablejs'),
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