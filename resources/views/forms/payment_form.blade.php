
<div class="col-md-12">
    <div class="row ">
        <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Invoice Number</label>
            <input type="text" name="invoice_no" class="form-control form-control-border invoice" list="datalistOptions" placeholder="Enter Invoice Number">
            <datalist id="datalistOptions">
                @forelse ( \App\Models\Invoice::select('id')->orderBy('id')->get() as $invoice)
                    <option>{{ $invoice->id }}</option>
                @empty
                    <option value="No Data Found">
                @endforelse
            </datalist>
        </div>
        <div class="form-group col-md-2">
            <label for="recipient-name" class="control-label">Action</label>
            <a class="form-control btn btn-success addInvoice">Add</a>
        </div>
        <div class="form-group col-md-4 px-5 ">
            <label for="recipient-name" class="control-label mb-2">Mode of Payment</label>
            <div class="row">
                <div class="form-check col-md-4">
                    <input class="form-check-input" type="radio" name="payment_method" value="cash" id="cash" checked>
                    <label class="form-check-label" for="cash">Cash</label>
                </div>
                <div class="form-check col-md-4">
                    <input class="form-check-input" type="radio" name="payment_method" value="cheque" id="electronic">
                    <label class="form-check-label" for="electronic">Cheque</label>
                </div>
                <div class="form-check col-md-4">
                    <input class="form-check-input" type="radio" name="payment_method" value="momo" id="electronic">
                    <label class="form-check-label" for="electronic">MoMo</label>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="col-md-12">
    <div class="row ">
        <div class="col-md-5">
            <label for="recipient-name" class="control-label">Product (Description)</label>
        </div>
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Rate</label>
        </div>
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Quantity</label>
        </div>
        <div class="col-md-3">
            <label for="recipient-name" class="control-label">Amount</label>
        </div>
    </div>
</div>

<div class="col-md-12 form_field_outer p-0">
    <div class="col-md-12 getTotalAmount" id="contentInvoice">
        <div class="show_data">No Data Found</div>
    </div>
</div>

<hr>

<div class="col-md-4 ms-auto">
    {{-- <label for="inputEmail4" class="form-label">Total Amount</label>
    <input type="number" name="total_amount" step="0.01" value="" min="0" class="form-control bg-white total_amount" style="text-align: right" id="inputEmail4" readonly>
    @if ($errors->has('total_amount'))
        <span class="error" style="color: red">{{ $errors->first('total_amount') }}</span>
    @endif --}}
      <div class="mb-3 row">
        <label for="tax" class="col-sm-4 col-form-label">Tax</label>
        <div class="col-sm-8">
            <input type="number" name="" step="0.01" value="0.00" min="0" class="form-control bg-white tax" style="text-align: right" id="tax" readonly>
        </div>
      </div>

      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-4 col-form-label">Total Amount</label>
        <div class="col-sm-8">
            <input type="number" name="total_amount" step="0.01" value="0.00" min="0" class="form-control bg-white total_amount" style="text-align: right" id="inputEmail4" readonly>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="paid" class="col-sm-4 col-form-label">Paid Amount</label>
        <div class="col-sm-8">
            <input type="number" name="paid" step="0.01" value="0.00" min="0" class="form-control bg-white paid" style="text-align: right" id="paid" readonly>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="amount" class="col-sm-4 col-form-label">Amount</label>
        <div class="col-sm-8">
            <input type="number" name="amount_paid" step="0.01" value="0.00" min="0" class="form-control bg-white amount_paid" style="text-align: right" id="amount" required>
            @if ($errors->has('amount_paid'))
                <span class="error" style="color: red">{{ $errors->first('amount_paid') }}</span>
            @endif
        </div>
      </div>
      <div class="mb-3 row">
        <label for="balance" class="col-sm-4 col-form-label">Balance</label>
        <div class="col-sm-8">
            <input type="number" name="balance" step="0.01" value="0.00" min="0" class="form-control bg-white balance" style="text-align: right" id="balance" readonly>
        </div>
      </div>
</div>
