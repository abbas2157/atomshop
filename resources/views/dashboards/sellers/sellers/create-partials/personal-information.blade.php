    <p class="mg-b-20"> To get registered, kindly fill out the form below with seller's details</p>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>Business Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Enter Business Name" value="{{ old('business_name') }}" required>
        </div>
        <div class="col-lg mt-2">
            <label>Seller name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter customer name" value="{{ old('name') }}" required>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>CNIC Number <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="cnic_number" name="cnic_number" placeholder="Enter CNIC Number" value="{{ old('cnic_number') }}" required>
        </div>
        <div class="col-lg mt-2">
            <label>Website (if applicable) </label>
            <input type="text" class="form-control" name="website" placeholder="Website (if applicable)" value="{{ old('website') }}">
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>Seller email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter customer email" value="{{ old('email') }}" required>
        </div>
        <div class="col-lg mt-2">
            <label>Seller phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter customer phone" value="{{ old('phone') }}" required>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>Select status <span class="text-danger">*</span></label>
            <select class="form-control" name="status">
                <option value="active">Active</option>
                <option value="block">Block</option>
                <option value="pending">Pending</option>
                <option value="support">Support</option>
            </select>
        </div>
        <div class="col-lg mt-2"></div>
    </div>
</section>