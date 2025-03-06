<div id="instalment-modal" class="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-demo">
        <div class="modal-header">
          <h6 class="modal-title">Pay Instalment</h6>
        </div>
        <div class="modal-body">
          <form method="POST" id="pay-instalment-form" onsumit="return false;" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="hidden" name="order_id" value="{{ $order->id ?? '' }}">
                <div class="col-lg">
                  <label>Instalment Price </label>
                  <input type="number" class="form-control" readonly name="instalment_price" id="instalment_price" placeholder="Rs. 00">
                </div>
            </div>
            <div class="row">
                <div class="col-lg mt-2">
                  <label>Payment Method</label>
                  <select class="form-control" name="payment_method">
                      <option value="By Hand">By Hand</option>
                      <option value="JazzCash">JazzCash</option>
                      <option value="Easypaisa">Easypaisa</option>
                      <option value="Bank">Bank</option>
                  </select>
                </div>
            </div>
            <div class="row">
              <div class="col-lg mt-2">
                <label>Upload Receipt (Optional) </label>
                <input type="file" class="form-control" name="instalment_pictrue">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-indigo pay-instalment-btn">Save changes</button>
          <a href="" class="btn btn-outline-light">Close</a>
        </div>
      </div>
    </div>
</div>