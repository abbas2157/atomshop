<div id="delivered-status" class="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-demo">
        <div class="modal-header">
          <h6 class="modal-title">Delivery Detail</h6>
        </div>
        <div class="modal-body">
          <form method="POST" id="delivered-form" onsumit="return false;" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <input type="hidden" name="status" class="status">
              <div class="col-lg mt-2">
                <label>Upload Picture </label>
                <input type="file" class="form-control" name="delivered_pictrue">
              </div>
            </div>
            <div class="row">
              <div class="col-lg mt-2">
                <label>Recieved by </label>
                <select class="form-control" name="recieved_by">
                    <option value="By Himself">By Himself</option>
                    <option value="By Someone else">By Someone else</option>
                </select>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-indigo delivered-btn">Save changes</button>
          <a href="" class="btn btn-outline-light">Close</a>
        </div>
      </div>
    </div>
</div>