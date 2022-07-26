<div class="col-12">
    <label for="inputAddress" class="form-label">Name of Product</label>
    <input type="text" name="name" value="{{ (isset($product->id)) ? $product->name : '' }}" class="form-control" id="inputAddress" autofocus>
    @if ($errors->has('name'))
        <span class="error" style="color: red">{{ $errors->first('name') }}</span>
    @endif
</div>
<div class="col-md-8">
    <label for="inputTextarea4" class="form-label">Description</label>
    <input type="text" name="description" value="{{ (isset($product->id)) ? $product->description : '' }}" class="form-control" id="inputAddress">
    @if ($errors->has('description'))
        <span class="error" style="color: red">{{ $errors->first('description') }}</span>
    @endif
</div>
<div class="col-md-4">
    <label for="inputTextarea4" class="form-label">Product Code</label>
    <input type="text" name="code" value="{{ (isset($product->id)) ? $product->code : '' }}" class="form-control" id="inputAddress">
    @if ($errors->has('code'))
        <span class="error" style="color: red">{{ $errors->first('code') }}</span>
    @endif
</div>
<div class="col-md-4">
    <label for="inputCity" class="form-label">Brand</label>
    <input type="text" name="brand" value="{{ (isset($product->id)) ? $product->brand : '' }}" class="form-control" id="inputCity">
    @if ($errors->has('brand'))
        <span class="error" style="color: red">{{ $errors->first('brand') }}</span>
    @endif
</div>
<div class="col-md-4">
    <label for="inputEmail4" class="form-label">Cost Price</label>
    <input type="number" name="cost" step="0.01" value="{{ (isset($product->id)) ? $product->cost : '' }}" min="0" class="form-control" id="inputEmail4">
    @if ($errors->has('cost'))
        <span class="error" style="color: red">{{ $errors->first('cost') }}</span>
    @endif
</div>
<div class="col-md-4">
    <label for="inputEmail4" class="form-label">Selling Price</label>
    <input type="number" name="price" step="0.01" value="{{ (isset($product->id)) ? $product->price : '' }}" min="0" class="form-control" id="inputEmail4">
    @if ($errors->has('price'))
        <span class="error" style="color: red">{{ $errors->first('price') }}</span>
    @endif
</div>