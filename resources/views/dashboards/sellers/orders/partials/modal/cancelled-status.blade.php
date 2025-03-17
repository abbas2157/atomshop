<div id="cancelled-status" class="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-demo">
        <div class="modal-header">
          <h6 class="modal-title">Delivery Detail</h6>
        </div>
        <div class="modal-body">
          <form method="POST" id="cancelled-form" onsumit="return false;" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <input type="hidden" name="status" class="status">
              <div class="col-lg mt-2">
                <label>Address Not Found</label>
                <select class="form-control" name="address_found">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-lg mt-2">
                <label>Customer Physical Meet</label>
                <select class="form-control" name="customer_physical_meet">
                    <option value="No">No</option>
                      <option value="Yes">Yes</option>
                </select>
              </div>
            </div>
            <div class="row">
                <div class="col-lg mt-2">
                  <label>Device Not Found</label>
                  <select class="form-control" name="device_not_found">
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
            <div class="row">
              <div class="col-lg mt-2">
                <label>Address Reason</label>
                <textarea name="reason" class="form-control" cols="30" rows="10"></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-indigo cancelled-btn">Save changes</button>
          <a href="" class="btn btn-outline-light">Close</a>
        </div>
      </div>
    </div>
</div>