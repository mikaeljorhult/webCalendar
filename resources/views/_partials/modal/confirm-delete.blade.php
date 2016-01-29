<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('messages.close') }}">
					<span aria-hidden="true">&times;</span>
				</button>

				<h4 class="modal-title" id="confirmDeleteModalTitle">{{ trans('messages.delete') }}?</h4>
			</div>

			<div class="modal-body">
				{{ trans('messages.delete-object') }}
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.close') }}</button>
				<button type="button" class="btn btn-danger confirm">{{ trans('messages.delete') }}</button>
			</div>
		</div>
	</div>
</div>