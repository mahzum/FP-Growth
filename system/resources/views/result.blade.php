@extends('layout')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    F-List
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Item</th>
                            <th scope="col">Id Item</th>
                            <th scope="col">Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php
                        $no = 1;
                      @endphp
                      @foreach ($flist as $key => $value)
                        <tr>
                          <th scope="row">{{$no++}}</th>
                          <td>{{$value['item']['name']}}</td>
                          <td>{{$value['item']['id']}}</td>
                          <td>{{$value['count']}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Result
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pattern</th>
                                <th scope="col">Support</th>
                                <th scope="col">Confidence</th>
                                <th scope="col">Lift Ratio</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php
                            $no = 1;
                          @endphp
                          @foreach ($result as $key => $value)
                            <tr>
                              <th scope="row">{{$no++}}</th>
                              <td>{{$value['pattern']}}</td>
                              <td>{{round($value['support'],3)}}</td>
                              <td>{{round($value['confidence'],3)}}</td>
                              <td>{{$value['liftratio']}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
