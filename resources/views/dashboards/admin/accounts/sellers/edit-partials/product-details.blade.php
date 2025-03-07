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
        <div class="col-lg-4 mt-3">
            <div class="form-group">
                <label>Investment Capacity  <span class="text-danger">*</span></label>
                <select name="investment_capacity" id="investment_capacity" class="form-control" required>
                    <option value="2.5 Million" {{ $seller->investment_capacity == '2.5 Million' ? 'selected' : '' }}>2.5 Million</option>
                    <option value="5.0 Million" {{ $seller->investment_capacity == '5.0 Million' ? 'selected' : '' }}>5.0 Million</option>
                    <option value="10 Million" {{ $seller->investment_capacity == '10 Million' ? 'selected' : '' }}>10 Million</option>
                    <option value="Other" {{ $seller->investment_capacity == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        </div>
        <div class="col-lg-8 mt-3">
            <div class="form-group">
                <label>Do you have any previous experience in the installment business?</label>
                <select name="previous_experience" id="previous_experience" class="form-control" required>
                    <option value="1" {{ $seller->previous_experience == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $seller->previous_experience == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
    </div>
</section>