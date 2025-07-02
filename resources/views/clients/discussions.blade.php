@include('partials.clients.headers')
    <input type="hidden" id="pageno">
    <input type="hidden" id="page_total">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <form id="frmPost">
                <textarea class="form-control" style="resize: none;" rows="2" 
                placeholder="Start a discussion..." data-key="post" data="req"></textarea>            
                <div class="custom-control custom-checkbox mt-1">
                    <input class="custom-control-input" type="checkbox" id="is_notification_enabled" name="is_notification_enabled">
                    <label for="is_notification_enabled" class="custom-control-label">Receive Email Notification</label>
                  </div>
                <button class="btn btn-primary btn-block mt-2" data-trigger="post">
                    <i class="far fa-paper-plane"></i> Post
                </button>
            </form>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="div-table-data" id="div-table-data"></div>
        </div>
    </div>
</div>
  @include('partials.clients.footers')
  <script src="{{ asset('scripts/modules/scripts.js') }}"></script>
  <script src="{{ asset('scripts/discussions.js') }}"></script>