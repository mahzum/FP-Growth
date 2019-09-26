@extends('layout')
@section('content')
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
                      <th scope="col">Tanggal</th>
                      <th scope="col">Hasil</th>
                  </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach ($log as $key => $value)
                  <tr>
                    <th scope="row">{{$no++}}</th>
                    <td>{{$value->created_at}}</td>
                    <td>
                      <button type="button" class="btn btn-primary"  onclick="setBatchId({{$value}})" data-toggle="modal" data-target="#exampleModal">
                        Lihat hasil
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('log/result')}}" method="post">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="batch" id="batch">
            <div class="form-group">
                <label>Minimum Support</label>
                <input type="number" name="support" class="form-control" placeholder="masukan nilai skala 1 - 100" min="1" max="100" required>
            </div>
            <div class="form-group">
                <label>Minimum Confidence</label>
                <input type="number" name="confidence" class="form-control" placeholder="masukan nilai skala 1 - 100" min="1" max="100" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <script type="text/javascript">
    function setBatchId(batch){
      $('#exampleModalLabel').html('Lihat hasil transaksi '+batch.created_at);
      $('#batch').val(batch.id);
    }
  </script>
@endsection
