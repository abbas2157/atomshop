<section>
    <p>Please select the product details you can provide:</p>
    <div class="row">
        <div class="col-lg">
            <label class="ckbox">
                    <input type="checkbox"><span>Product Specifications</span>
            </label>
        </div>
        <div class="col-lg">
            <label class="ckbox">
                    <input type="checkbox"><span>Pricing Information</span>
            </label>
        </div>
        <div class="col-lg">
            <label class="ckbox">
                    <input type="checkbox"><span>Product Images</span>
            </label>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg m-3">
            <div class="form-group">
                <label>Select status <span class="text-danger">*</span></label>
                <select name="investment_capacity" id="investment_capacity" class="form-control" required>
                    <option value="2.5 Million">2.5 Million</option>
                    <option value="5.0 Million">5.0 Million</option>
                    <option value="10 Million">10 Million</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
        <div class="col-lg mt-3">
            <div class="form-group">
                <label>Do you have any previous experience in the installment business?</label>
                <div>
                    <label>
                        <input type="radio" name="previous_experience" value="1" required> Yes
                    </label>
                    <label>
                        <input type="radio" name="previous_experience" value="0" required> No
                    </label>
                </div>
            </div>
        </div>
    </div>
</section>
