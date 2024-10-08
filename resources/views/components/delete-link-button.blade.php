<!-- Delete Button with Modal Confirmation -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal"
    data-bs-target="#confirmDeleteModal-{{$link->id}}">
    {{ __('Delete') }}
</button>

<!-- Modal for Delete Confirmation -->
<div class="modal fade" id="confirmDeleteModal-{{$link->id}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">{{ __('Confirm Delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to delete this link? This action cannot be undone.') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>

                <!-- Actual Delete Form -->
                <form action="{{ route('links.delete', $link) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>