@extends('layouts.app')
@section('css')
    <style>
        table th:not(:first-child){
            min-width: 170px;
            font-size: 13px;
        }
        table th.c_product{
            min-width: 300px;
            font-size: 14px;
        }
        table td{
            font-size: 14px;
            /*max-width: 100px;*/
            overflow: auto;
            white-space: nowrap;
            scrollbar-width: none; /* Firefox */
            scrollbar-height: none; /* Firefox */
          -ms-overflow-style: none;  /* IE 10+ */
        }
        table td::-webkit-scrollbar{
            width: 0px;
            height: 0px;
            background: transparent;
        }
        .custom_slc{
            max-width: 130px;
            padding: 3px 8px;
            border: 1px solid #dce4ec;
            border-radius: 4px;
            margin-bottom: 2px;
        }
    </style>
@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card shadow my-4">
        <div class="card-body">
          <div class="table-responsive" style="margin:0 auto;">
              <a style="" class="btn btn-primary btn-sm mb-2" href="/crud/{{$table}}/create"><i class="fa fa-plus"></i> Thêm mới</a>
            <table class="table table-bordered table-sm" id="{{$table}}_table" style="width: 100%;margin-top: 10px;">
                <thead>
                    <th>Action</th>
                    <th style="min-width: 30px !important;">Id</th>
                    @foreach($columnInfos as $key => $value)
                    <th>{{ convertColumnNameToString($key) }}</th>
                    @endforeach
                </thead>

                <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
   
      
@endsection

@section('javascript')

    <script>
    $(function() {
        $('.alert.alert-success').delay(2000).slideUp();
        var columnObj = <?php echo json_encode($columnInfos); ?>;
        const keys = Object.keys(columnObj);
        var columnConfig = [];
        columnConfig.push({data: 'actions', name: 'actions', orderable: false, searchable: false});
        columnConfig.push({ data: 'id', name: 'id' });
        for(const key of keys){
            columnConfig.push({data: key, name: key});
        }

        $('#{{$table}}_table').DataTable({
            "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'<'toolbar'>><'col-sm-12 col-md-4'f>>" + "<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "processing": true,
            "serverSide": true,
            "method": 'get',
            "scrollX": true,
            "select": true,
            "paging": true,
            "pageLength": 10,
            "ajax": {
                "url": '{!! route('crud.data', $table) !!}',
                "type": 'get'
            },
            "columns": columnConfig
        });
        
        //$('select[name={{$table}}_table_length]').removeClass('form-control').addClass('select_tbl_uv');
    });
    </script>
@endsection