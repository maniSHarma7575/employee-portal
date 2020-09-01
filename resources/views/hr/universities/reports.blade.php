@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            @include('hr.universities.menu')
            <br><br>
        </div>
        <div class="col-md-12">
            @include('status', ['errors' => $errors->all()])
        </div>
        <div class="col-md-12">
        </div>
    </div>
    <div class="card-deck" id="university_reports">
  <div class="card">
    <div class="card-body">
        <h5 class="card-title">Total Applications</h5>
        <hr-universities-reports :applications="{{json_encode($applications['total']) }}" />
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <h5 class="card-title">Approved Applications</h5>
        <hr-universities-reports :applications="{{json_encode($applications['approved']) }}" />
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <h5 class="card-title">Rejected Applications</h5>
        <hr-universities-reports :applications="{{json_encode($applications['rejected']) }}"/>
    </div>
  </div>
</div>
</div>
@endsection
