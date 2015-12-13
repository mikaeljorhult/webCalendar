var Sortable = require('./sortable'),
    sortable;

// Make sortable lists sortable.
sortable = document.getElementById('modules-list');

if (sortable != null) {
  Sortable.create(sortable);
}