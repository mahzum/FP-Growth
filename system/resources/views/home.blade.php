@extends('layout')
@section('content')
<form enctype="multipart/form-data" method="post" action="{{url('log')}}">
    @csrf
    <div class="form-group">
        <label>Minimum Support</label>
        <input type="number" name="support" class="form-control" placeholder="masukan nilai skala 1 - 100" min="1" max="100" required>
    </div>
    <div class="form-group">
        <label>Minimum Confidence</label>
        <input type="number" name="confidence" class="form-control" placeholder="masukan nilai skala 1 - 100" min="1" max="100" required>
    </div>
    <div class="form-group">
        <label>File</label>
        <input type="file" name="transactions" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
