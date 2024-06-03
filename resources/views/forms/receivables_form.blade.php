<div class="col-12">
    <label for="inputAddress" class="form-label">Supplier's Name</label>
    <select name="supplier_id" class="form-control" id="inputAddress" autofocus>
        <option value="" selected disabled>Select Supplier</option>
        @forelse ( \App\Models\Supplier::select('name', 'id')->orderBy('name')->get() as $supplier)
            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
        @empty
            <option value="">No Data Found</option>
        @endforelse
    </select>
    @if ($errors->has('supplier_id'))
        <span class="error" style="color: red">{{ $errors->first('supplier_id') }}</span>
    @endif
</div>

<div class="col-md-6">
    <label for="inputCity" class="form-label">Invoice/Receipt Number</label>
    <input type="text" name="invoice_no" value="" class="form-control" id="inputCity">
    @if ($errors->has('invoice_no'))
        <span class="error" style="color: red">{{ $errors->first('invoice_no') }}</span>
    @endif
</div>
<div class="col-6">
    <label for="inputAddress" class="form-label">received_date</label>
    <input type="date" name="received_date" value="" max="<?php echo date('Y-m-d');?>" class="form-control" id="inputAddress">
    @if ($errors->has('received_date'))
        <span class="error" style="color: red">{{ $errors->first('received_date') }}</span>
    @endif
</div>

<div class="col-md-12">
    <div class="row ">
        <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Enter Product</label>
            <input type="text" class="form-control form-control-border product" list="datalistOptions" placeholder="Enter Product">
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
    </div>
</div>

<hr>

<div class="col-md-12">
    <div class="row ">
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Code</label>
        </div>
        <div class="col-md-5">
            <label for="recipient-name" class="control-label">Brand - Product (Description)</label>
        </div>
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Quantity</label>
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

<div class="col-md-4 ms-auto">
    <label for="inputEmail4" class="form-label">Total Amount</label>
    <input type="number" name="total_amount" step="0.01" value="" min="0" class="form-control bg-white total_amount" style="text-align: right" id="inputEmail4" readonly>
    @if ($errors->has('total_amount'))
        <span class="error" style="color: red">{{ $errors->first('total_amount') }}</span>
    @endif
</div>
