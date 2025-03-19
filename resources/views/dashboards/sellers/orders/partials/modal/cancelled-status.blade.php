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
                <label>Customer Verification Failed</label>
                <select class="form-control" name="customer_verification_failed">
                    <option>All Things are OK.</option>
                    <option>Invalid Contact Details (Wrong/Unreachable phone number)</option>
                    <option>Incorrect Customer Information (Mismatch in name, CNIC, or address)</option>
                    <option>Unresponsive Customer (No answer to calls/messages)</option>
                    <option>Suspicious/Fraudulent Activity (Fake documents or identity concerns)</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-lg mt-2">
                <label>Installment Plan Rejected</label>
                <select class="form-control" name="installment_plan_rejected">
                    <option>All Things are OK.</option>
                    <option>Credit Criteria Not Met (Low score or insufficient income)</option>
                    <option>Required Documents Missing/Invalid (ID, salary slip, bank statement, etc.)</option>
                    <option>Poor Payment History (Previous defaults on installments)</option>
                    <option>High Financial Risk Detected (Red flags from verification team)</option>
                </select>
              </div>
            </div>
            <div class="row">
                <div class="col-lg mt-2">
                  <label>Product Unavailable </label>
                  <select class="form-control" name="product_unavailable">
                      <option value="" >All Things are OK.</option>
                      <option>Out of Stock (Product no longer available)</option>
                      <option>Discontinued by Seller (No longer being sold)</option>
                      <option>Listing Error (Wrong price, details, or duplicate listing)</option>
                      <option>Delivery Issue (Seller unable to deliver in requested location)</option>
                  </select>
                </div>
              </div>
            <div class="row">
              <div class="col-lg mt-2">
                <label>Other (Please Specify) </label>
                <textarea name="reason" class="form-control" cols="30" rows="10" placeholder=" Custom Reason"></textarea>
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