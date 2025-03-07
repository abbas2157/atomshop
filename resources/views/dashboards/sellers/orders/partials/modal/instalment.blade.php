<div id="instalment-status" class="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-demo">
        <div class="modal-header">
          <h6 class="modal-title">Instalment Detail</h6>
        </div>
        <div class="modal-body">
          <form method="POST" id="instalment-form" onsumit="return false;" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-lg mt-2">
                <label>Day of Month (For Instalment)</label>
                <select class="form-control" name="installment_tenure">
                    
                    @php
                      $days = ['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th'];
                    @endphp
                    @for($i = 0; $i < count($days); $i++)
                      <option value="{{ $i+1 }}">{{ $days[$i] ?? 0 }} Day</option>
                    @endfor
                </select>
              </div>
            </div>
            <div class="row">
                <input type="hidden" name="status" class="status">
                <div class="col-lg mt-2">
                  <label>Advance Price </label>
                  <input type="number" class="form-control" value="{{ $order->advance_price ?? '' }}" name="advance_price" id="advance_price" placeholder="Rs. 00">
                </div>
            </div>
            <div class="row">
              <div class="col-lg mt-2">
                <label>Installment Tenure</label>
                <select class="form-control" name="installment_tenure">
                    <option value="3" {{ ($order->instalment_tenure == 3) ? 'selected' : '' }}>3 Months</option>
                    <option value="4" {{ ($order->instalment_tenure == 4) ? 'selected' : '' }}>4 Months</option>
                    <option value="5" {{ ($order->instalment_tenure == 5) ? 'selected' : '' }}>5 Months</option>
                    <option value="6" {{ ($order->instalment_tenure == 6) ? 'selected' : '' }}>6 Months</option>
                    <option value="7" {{ ($order->instalment_tenure == 7) ? 'selected' : '' }}>7 Months</option>
                    <option value="8" {{ ($order->instalment_tenure == 8) ? 'selected' : '' }}>8 Months</option>
                    <option value="9" {{ ($order->instalment_tenure == 9) ? 'selected' : '' }}>9 Months</option>
                    <option value="10" {{ ($order->instalment_tenure == 10) ? 'selected' : '' }}>10 Months</option>
                    <option value="11" {{ ($order->instalment_tenure == 11) ? 'selected' : '' }}>11 Months</option>
                    <option value="12" {{ ($order->instalment_tenure == 12) ? 'selected' : '' }}>12 Months</option>
                </select>
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
              <input type="hidden" name="status" class="status">
              <div class="col-lg mt-2">
                <label>Upload Receipt (Optional) </label>
                <input type="file" class="form-control" name="instalment_pictrue">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-indigo instalment-btn">Save changes</button>
          <a href="" class="btn btn-outline-light">Close</a>
        </div>
      </div>
    </div>
</div>