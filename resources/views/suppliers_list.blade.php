@extends('layout.app')

@section('title', 'POS | Suppliers')

@section('content')
    <div class="container-fluid px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-3 mb-5 my-5 shadow-lg">
            
            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 2rem;">Suppliers List</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('add_supplier') }}" class="btn btn-success">Add Supplier</a>
                    </div><!--//resume-contact-->
                </div><!--//row-->  
            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 2rem 2rem;">
                <div class="row align-items-center">
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Adress</th>
                                <th>Items Supplied</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($suppliers as $key => $supplier)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->contact }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->description }}</td>
                                    <td>
                                        <a class="btn btn-success" href="edit_supplier/{{ $supplier->id }}" title="Edit" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-danger" onclick="return confirm('This Supplier will be deleted permanently!!!')" href="delete_supplier/{{ $supplier->id }}" title="Delete" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-user-times"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="40">No Data Found</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    
                </div>
            </div><!--//resume-intro-->

            <hr>
            
            <div class="resume-footer text-center" style="margin-bottom: 1rem;">
                @include('layout.footer')
            </div><!--//resume-footer-->
            
        </article>
        
    </div><!--//container-->

@endsection
