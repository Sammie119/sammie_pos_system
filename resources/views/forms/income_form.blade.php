<div class="col-md-12">
    <div class="row ">
        <div class="col-md-4">
            <label for="recipient-name" class="control-label">Transaction Name</label>
        </div>
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Transaction Type</label>
        </div>
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Amount</label>
        </div>
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Date</label>
        </div>
        <div class="col-md-2">
            <label for="recipient-name" class="control-label">Action</label>
        </div>
    </div>
</div>

<div class="col-md-12 form_field_outer p-0">
    <div class="col-md-12 getTotalAmount" id="contentProduct">

        <div class="row mb-2">
            <div class="form-group col-4">
                <input type="text" class="form-control bg-white" name="transaction_name[]" required>
            </div>
            <div class="form-group col-2">
                <select class="form-control bg-white" name="transaction_type[]" required>
                    <option disabled>--Select--</option>
                    <option>Income</option>
                    <option>Expenditure</option>
                </select>
            </div>
            <div class="form-group col-2">
                <input type="number" min="0" step="0.1" class="form-control bg-white" name="transaction_amount[]" placeholder="0.00" required>
            </div>
            <div class="form-group col-2">
                <input type="date" name="transaction_date[]" max="<?php echo date('Y-m-d')?>" step="0.01" class="form-control bg-white"  name="amount[]" required>
            </div>
            <div class="form-group col-1">
                <input type="button" class="form-control btn btn-success addProduct" value="Add">
            </div>
            {{-- <div class="form-group col-1">
                <input type="button" class="btn btn-danger btn-sm bottn_delete" value="Del">
            </div> --}}
        </div>

    </div>
</div>

