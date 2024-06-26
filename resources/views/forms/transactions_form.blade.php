
<div class="col-md-12">
    <div class="row ">
        <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Enter Product</label>
            <input type="text" class="form-control form-control-border product" list="datalistOptions" placeholder="Enter Product" autofocus>
            <datalist id="datalistOptions">
                @forelse ( \App\Models\Product::select('name', 'code', 'brand')->orderBy('name')->get() as $product)
                    <option value="{{ $product->name }}">
                @empty
                    <option value="No Data Found">
                @endforelse
            </datalist>
        </div>
        <div class="form-group col-md-2">
            <label for="recipient-name" class="control-label">Action</label>
            <a class="form-control btn btn-success addProduct">Add</a>
        </div>
        <div class="form-group col-md-4 px-5 ">
            <label for="recipient-name" class="control-label mb-2">Invoice Type</label>
            <div class="row">
                <div class="form-check col-md-6">
                    <input class="form-check-input" type="radio" name="payment_method" value="taxable" id="cash" checked>
                    <label class="form-check-label" for="cash">Taxable</label>
                </div>
                <div class="form-check col-md-6">
                    <input class="form-check-input" type="radio" name="payment_method" value="non-taxable" id="electronic">
                    <label class="form-check-label" for="electronic">Non Taxable</label>
                </div>
            </div>
        </div>

    </div>
</div>

<hr>

<div class="col-md-12">
    <div class="row ">
        <div class="col-md-6">
            <label for="recipient-name" class="control-label">Brand - Product (Description)</label>
        </div>
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Quantity</label>
        </div>
        <div class="col-md-1">
            <label for="recipient-name" class="control-label">Rate</label>
        </div>
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Amount</label>
        </div>
        <div class="col-md-1">
            <label for="recipient-name" class="control-label">Action</label>
        </div>
    </div>
</div>

<div class="col-md-12 form_field_outer p-0">
    <div class="col-md-12 getTotalAmount" id="contentProduct">
        <div class="show_data">No Data Found</div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-6">
        <label for="recipient-name" class="control-label">Customer</label>
        <input type="text" name="customer" class="form-control form-control-border customer mb-3" list="customerOptions" placeholder="Select Customer" required>
        <datalist id="customerOptions">
            @forelse ( \App\Models\Customer::select('name')->orderBy('name')->get() as $cus)
                <option value="{{ $cus->name }}">
            @empty
                <option value="No Data Found">
            @endforelse
            <option value="Add Customer">
        </datalist>
        <div style="display: none" id="displayCustomerInput">
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control cusInput" name="name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control cusInput" name="address">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control cusInput" name="phone">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">City/Town</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control cusInput" name="location">
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <table class="table table-borderless">
            <tr>
                <th style="text-align: right; padding-right: 10px;">Total Amount:</th>
                <td style="width: 40%"><input type="number" name="total_amount" step="0.01" value="" min="0" class="form-control bg-white total_amount" placeholder="0.00" style="text-align: right" id="inputEmail4" readonly>
                    @if ($errors->has('total_amount'))
                        <span class="error" style="color: red">{{ $errors->first('total_amount') }}</span>
                    @endif
                </td>
            </tr>
            {{-- <tr>
                <th style="text-align: right; padding-right: 10px;">Amount Given:</th>
                <td style="width: 23%"><input type="number" step="0.01" value="" min="0" class="form-control bg-white" style="text-align: right" placeholder="0.00" id="amount_given"></td>
            </tr>
            <tr>
                <th style="text-align: right; padding-right: 10px;">Change:</th>
                <td style="width: 23%"><input type="number" class="form-control bg-white" style="text-align: right" id="change" placeholder="0.00" readonly></td>
            </tr> --}}
        </table>
    </div>
</div>


{{-- <table style="display: none; margin-top: -10px" id="transac">
    <tr>
        <th style="text-align: right; padding-right: 10px;">Transaction ID:</th>
        <td style="width: 22%"><input type="number" class="form-control bg-white" style="text-align: right" name="payment_transac_no" id="transaction_id"></td>
    </tr>
</table> --}}
