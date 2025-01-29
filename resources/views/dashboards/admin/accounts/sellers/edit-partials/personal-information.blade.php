<section>
    <p class="mg-b-20"> To get registered, kindly fill out the form below with supplier's details</p>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>Business Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Enter Business Name" value="{{ old('business_name', $seller->business_name ?? '') }}" required>
        </div>
        <div class="col-lg mt-2">
            <label>Supplier name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="supplier_name" id="supplier_name" placeholder="Enter Supplier Name" value="{{ old('supplier_name', $seller->supplier_name ?? '') }}" required>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>CNIC Number <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="cnic_number" name="cnic_number" placeholder="Enter CNIC Number" value="{{ old('cnic_number', $seller->cnic_number ?? '') }}" required>
        </div>
        <div class="col-lg mt-2">
            <label>Website (if applicable) </label>
            <input type="text" class="form-control" name="website" placeholder="Website (if applicable)" value="{{ old('website', $seller->website ?? '') }}">
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>Supplier email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Supplier Email" 
            value="{{ old('email', $user->email ?? '') }}" required>
        </div>
        <div class="col-lg mt-2">
            <label>Supplier phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Supplier Phone" 
            value="{{ old('phone', $user->phone ?? '') }}" required> 
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>Select status <span class="text-danger">*</span></label>
            <select class="form-control" name="status">
                <option value="active" {{ old('status', $seller->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="block" {{ old('status', $seller->status ?? '') == 'block' ? 'selected' : '' }}>Block</option>
                <option value="pending" {{ old('status', $seller->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="support" {{ old('status', $seller->status ?? '') == 'support' ? 'selected' : '' }}>Support</option>
            </select>
        </div>
        <div class="col-lg mt-2"></div>
    </div>
</section>