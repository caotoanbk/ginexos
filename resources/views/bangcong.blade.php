@extends('layouts.app')

@section('content')
@if( Session::has('flash_message'))
    <div class="alert alert-success fade in"><em>{{ Session::get('flash_message')}}</em></div>
@endif
<div class="card mt-3" style="font-size: 14px;">
    <div class="card-header bg-info text-white text-center">Bảng công</div>
    <div class="card-body">
        <div class="table-responsive" style="margin:0 auto;">
          <table class="table table-bordered table-sm" id="bangcong_table" style="width: 100%;margin-top: 10px;">
              <thead>
                  <th>Mã số OS</th>
                  <th>CMND</th>
                  <th>Họ tên</th>
                  <th>Ngày vào</th>
                  <th>Line</th>
                  <th>B.Phận</th>
                  <th>Ngày công</th>
                  <th>GC</th>
                  <th>TC</th>
                  <th>GC1</th>
                  <th>TC1</th>
                  <th>GC2</th>
                  <th>TC2</th>
                  <th>Loại ngày</th>
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
        var columnConfig = [];

        columnConfig.push({data: 'maos', name: 'maos', className: 'none'});
        columnConfig.push({data: 'cmt', name: 'cmt'});
        columnConfig.push({data: 'hoten', name: 'hoten'});
        columnConfig.push({data: 'ngayvao', name: 'ngayvao', className: 'none'});
        columnConfig.push({data: 'line', name: 'line'});
        columnConfig.push({data: 'bophan', name: 'bophan', searchable: false, orderable: false});
        columnConfig.push({data: 'ngay_lam', name: 'ngay_lam'});
        columnConfig.push({data: 'gc', name: 'gc'});
        columnConfig.push({data: 'tc', name: 'tc'});
        columnConfig.push({data: 'gc1', name: 'gc1'});
        columnConfig.push({data: 'tc1', name: 'tc1'});
        columnConfig.push({data: 'gc2', name: 'gc2'});
        columnConfig.push({data: 'tc2', name: 'tc2'});
        columnConfig.push({data: 'day_type', name: 'day_type', searchable: false, orderable: false});

        $table = $('#bangcong_table').DataTable({
            "dom": "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'<'toolbar'>><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'<'note'>>>" + "<'row'<'col-sm-12'tr>>" +
"<'row mt-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "processing": true,
            "responsive": true,
            "select": {
                style:    'os',
                selector: 'tr'
            },
            "serverSide": true,
            "method": 'get',
            "scrollX": true,
            "select": true,
            "paging": true,
            "pageLength": 10,
            "ajax": {
                "url": '{!! route('bangcong.data') !!}',
                "type": 'get',
                "data": function(d){
                    d.khachhang = $('select[name=kh_filter]').val();
                    d.thang = $('input[name=_filter]').val();
                }
            },
            "columns": columnConfig
        });
        
        //$('select[name=bangcong_table_length]').removeClass('form-control').addClass('select_tbl_uv');
        $("div.toolbar").html(`
            Công ty: <select class="custom_select" name="kh_filter">
            </select>
            Tháng: <input type="text" name="thang_filter" class="custom_select datepickr" placeholder="Tháng.." style="width: 10em;" />
        `);
        flatpickr('.datepickr',{enableTime: false, dateFormat: "Y-m", allowInput: true});
        $.ajax({
            url: '/utility/get-array-info',
            method: 'get',
            cache: true,
            success: function(data){
                //cong ty
                rs = '<option value="">chọn</option>';
                $.each(data[0], function(i ,k){
                    rs += '<option value="' + i + '">' + k + '</option>';
                });	
                $('select[name=kh_filter]').html(rs);
            
            },
            error: function(error){
                console.log(error);
            }
        });

        $("select[name=kh_filter]").on('change', function(e){ $table.ajax.reload();});
        $("input[name=thang_filter]").on('change', function(e){ $table.ajax.reload();});

        $('div.note').html(`<small class='text-danger' style="font-style: italic; font-weight: bold;">*Ghi chú: GC: Giờ công ca ngày, GC1: Giờ công ca đêm
, TC: Tăng ca ca ngày, TC1: Tăng ca ca đêm, GC2: Giờ công ca HC, TC2: Tăng ca giờ HC, WK-D: Giờ công ca ngày cuối tuần, WK-TC:Tăng ca ngày cuối tuần
</small>`);
    });
</script>
@endsection