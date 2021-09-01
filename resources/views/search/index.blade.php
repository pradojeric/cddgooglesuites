@extends('layouts.student')

@section('content')
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mx-auto">
                        <form action="/" method="get">
                            <div class="row">
                                <div class="col-sm py-2">
                                    <input type="text" name="student_id" class="form-control" placeholder="Student ID" value="{{ request()->get('student_id') ?? '' }}" required>
                                </div>
                                <div class="col-sm py-2">
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ request()->get('first_name') ?? '' }}" required>
                                </div>
                                <div class="col-sm py-2">
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ request()->get('last_name') ?? '' }}" required>
                                </div>
                                <div class="col-sm-2 py-2">
                                    <input type="submit" class="btn btn-primary w-100">
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>

            @if(request()->get('student_id'))
                <div class="card mt-5">
                    <div class="card-header">
                        <span>Search Results</span>
                    </div>
                    <div class="card-body">
                        @if(!$result)
                            No Result Found
                        @else
                            <div class="d-flex flex-lg-row flex-column justify-content-between">
                                <div class="d-flex flex-column mx-3 mt-3">
                                    <span class="font-weight-bold text-secondary">G Suite:</span>
                                    <div class="d-flex flex-column bg-success border border-secondary text-white rounded p-4">
                                        <span class="font-weight-bold">
                                            {{ $result->google_account }}
                                        </span>
                                        <span>
                                            Default password: colegio2021
                                        </span>
                                    </div>
                                    <div class="mx-auto mt-1">
                                        <a href="https://mail.google.com" target="_blank">
                                            <img src="{{ asset('img/google.jpg') }}" alt="" class="rounded border border-secondary col">
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap flex-column mx-3 mt-3">
                                    <span class="font-weight-bold text-secondary">STEP:</span>
                                    <div class="d-flex flex-column border border-secondary text-white rounded p-4 {{ $result->step_account ? 'bg-success' : 'bg-primary' }}">
                                        <span class="font-weight-bold">
                                            {{ $result->step_account }}
                                        </span>
                                        <span>
                                            {{ $result->step_account ? 'Default Password: colegio2021' : 'Please contact our STEP facebook page' }}
                                        </span>
                                    </div>
                                    <div class="mx-auto mt-1">
                                        <a href="https://cdd.step.com.ph/login" target="_blank">
                                            <img src="{{ asset('img/step.jpg') }}" alt="" class="rounded border border-secondary col">
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap flex-column mx-3 mt-3">
                                    <span class="font-weight-bold text-secondary">MyCdD Portal:</span>
                                    <div class="d-flex flex-column border border-secondary text-white rounded p-4 {{ $result->cdd_portal_account ? 'bg-success' : 'bg-primary' }}">
                                        <span class="font-weight-bold">
                                            {{ $result->cdd_portal_account }}
                                        </span>
                                        <span>
                                            {{ $result->cdd_portal_account ? 'Default Password: '.$result->student_id : 'Please contact cddmis@cdd.edu.ph' }}
                                        </span>
                                    </div>
                                    <div class="mx-auto mt-1">
                                        <a href="http://mycdd.cdd.edu.ph" target="_blank">
                                            <img src="{{ asset('img/cddportal.jpg') }}" alt="" class="rounded border border-secondary col">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 text-right">
                                <div>
                                    <span>Note: <b>Please change your password immediately!</b> Contact the MIS department for any concerns regarding with your accounts.</span>
                                </div>
                                <div>
                                    <span>
                                        STEP FB Page:
                                        <a href="https://www.facebook.com/steplms" target="_blank">
                                            /steplms
                                        </a>
                                    </span>

                                </div>
                                <div>
                                    <span>
                                        CdD MIS:
                                        <a href="mailto:cddmis@cdd.edu.ph" target="_blank">
                                            cddmis@cdd.edu.ph
                                        </a>
                                    </span>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
