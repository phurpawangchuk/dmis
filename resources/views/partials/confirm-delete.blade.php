<div class="modal fade" id="form-confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="form-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="form-body">
                <p></p>
            </div>
            <div class="modal-footer text-right">
                <div id="post-loading-container" class="d-none text-center">
                    <img src="{{ asset('images\loading.gif') }}" alt="">
                </div>
                <div class="clearfix"></div>
                <button type="submit" class="btn btn-danger btn-sm" id="form-submit"><i class="fas fa-check"></i> PROCEED</button>
            </div>
        </div>
    </div>
</div>
