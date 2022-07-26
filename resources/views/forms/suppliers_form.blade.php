<div class="col-12">
    <label for="inputAddress" class="form-label">Name of Supplier</label>
    <input type="text" name="name" value="{{ (isset($supplier->id)) ? $supplier->name : '' }}" class="form-control" id="inputAddress" autofocus>
    @if ($errors->has('name'))
        <span class="error" style="color: red">{{ $errors->first('name') }}</span>
    @endif
</div>
<div class="col-md-6">
    <label for="inputCity" class="form-label">Address</label>
    <input type="text" name="address" value="{{ (isset($supplier->id)) ? $supplier->address : '' }}" class="form-control" id="inputCity">
    @if ($errors->has('address'))
        <span class="error" style="color: red">{{ $errors->first('address') }}</span>
    @endif
</div>
<div class="col-md-6">
    <label for="inputEmail4" class="form-label">Contact</label>
    <input type="number" name="contact" value="{{ (isset($supplier->id)) ? $supplier->contact : '' }}" min="0" class="form-control" id="inputEmail4">
    @if ($errors->has('contact'))
        <span class="error" style="color: red">{{ $errors->first('contact') }}</span>
    @endif
</div>
<div class="col-md-12">
    <label for="inputTextarea4" class="form-label">Items Supplied</label>
    <textarea name="description" rows="3" style="width: 100%">{{ (isset($supplier->id)) ? $supplier->description : '' }}</textarea>
    @if ($errors->has('description'))
        <span class="error" style="color: red">{{ $errors->first('description') }}</span>
    @endif
</div>