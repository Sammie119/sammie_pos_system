@extends('layout.app')

@section('title', 'POS | Income & Expenditure')

@section('content')
    <div class="container-fluid px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-3 mb-5 my-5 shadow-lg">

            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 2rem;">Income & Expenditure List</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('add_income_exp') }}" class="btn btn-success">Add Inc or Exp</a>
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
                                <th>Transaction Name</th>
                                <th>Transaction Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tran as $key => $tr)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $tr->transaction_name }}</td>
                                    <td>{{ $tr->transaction_type }}</td>
                                    <td>{{ number_format($tr->transaction_amount, 2) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($tr->transaction_date)) }}</td>
                                    <td>{{ $tr->user->username }}</td>
                                    <td>
                                        {{-- <a class="btn btn-info" href="show_receivable/{{ $tr->id }}" title="View" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-eye"></i></a> --}}
                                        <a class="btn btn-danger" onclick="return confirm('This Record will be deleted permanently!!!')" href="delete_income/{{ $tr->id }}" title="Delete" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-user-times"></i></a>
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
