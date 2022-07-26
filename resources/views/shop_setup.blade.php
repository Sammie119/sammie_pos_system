@extends('layout.app')

@section('title', 'POS | Shop Setup')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-2 mb-5 my-5 shadow-lg">
            
            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 4rem;">Shop Details</h2>
                    </div><!--//resume-title-->
                </div><!--//row-->
                
            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 4rem 4rem;">
                <form action="shop_setup_save/1" method="POST" autocomplete="off" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Shop's Name</label>
                        <input type="text" name="shop_name" value="{{ $shop->shop_name }}" class="form-control" id="inputAddress">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" name="address" value="{{ $shop->address }}" class="form-control" id="inputAddress">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Contact 1</label>
                        <input type="number" name="phone1" value="{{ $shop->phone1 }}" min="0" class="form-control" id="inputCity">
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Contact 2</label>
                        <input type="number" name="phone2" value="{{ $shop->phone2 }}" min="0" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Email</label>
                        <input type="email" name="email" value="{{ $shop->email }}" class="form-control" id="inputAddress">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword5" class="form-label">Facebook</label>
                        <input type="text" name="facebook" value="{{ $shop->facebook }}" class="form-control" id="inputPassword5">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Logo Text</label>
                        <input type="text" name="text_logo" value="{{ $shop->text_logo }}" maxlength="20" class="form-control" id="inputPassword4">
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div><!--//resume-intro-->
            <hr>
            
            <div class="resume-footer text-center" style="margin-bottom: 1rem;">
                @include('layout.footer')
            </div><!--//resume-footer-->
        </article>
        
    </div><!--//container-->

@endsection
