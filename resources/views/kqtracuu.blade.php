@extends('layouts.app')

@section('css')
<style>
	table#ngaycong th, table#ngaycong td{
		text-align: center;
	}
</style>
@endsection

@section('content')
	<?php
	$firstItem = $result->first();
	?>
	<div class="container mt-4">		
		<table class="w-100">
			<tr>
				<th colspan="5">PHIẾU THANH TOÁN LƯƠNG GINEX</th>
			</tr>
			<tr>
				<th colspan="5">Tháng 9.2020 (từ ngày 01.09.2020 đến 31.09.2020)</th>
			</tr>
			<tr>
				<td>Số CMND/CCCD:</td>
				<th>{{$firstItem != null ? $firstItem->cmt : ''}}</th>
				<td>Ngày cấp:</td>
				<td>{{$firstItem != null ? $firstItem->ngaycap : ''}}</td>
				<td>Nơi cấp:</td>
				<td>{{$firstItem != null ? $firstItem->noicap : ''}}</td>
			</tr>
			<tr><td colspan="6"></td></tr>
			<tr>
				<td>Họ tên:</td>
				<th>{{$firstItem != null ? $firstItem->hoten : ''}}</th>
				<td>Ngày vào công ty:</td>
				<th>{{$firstItem != null ? $firstItem->ngayvao : ''}}</th>
				<td>Mã nhân viên:</td>
				<th>{{$firstItem != null ? $firstItem->maos : ''}}</th>
			</tr>
			<tr><td colspan="6"></td></tr>
			<tr>
				<th colspan="6"><small><strong>Thông tin tài khoản ngân hàng (Đề nghị các anh chị kiểm tra kỹ thông tin tin tài khoản để chuyển tiền):</strong></small></th>
			</tr>
			<tr>
				<td>Tên chủ tài khoản:</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Số tài khoản ngân hàng:</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Tại ngân hàng:</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th><small><strong>Điện thoại:</strong></small></th>
				<td></td>
				<th><small><strong>Facebook:</strong></small></th>
				<td></td>
			</tr>
			<tr><td colspan="8"></td></tr>
			<tr>
				<th>Tổng tiền đã nhận:</th>
				<td></td>
			</tr>
			<tr><td colspan="6"></td></tr>
			<tr><td colspan="6"></td></tr>
			<tr><td colspan="6"></td></tr>
			<tr><th colspan="8">Lương cơ bản làm cơ sở đóng BHXH (nếu có): 4,730,000 VNĐ</th></tr>
			<tr>
				<td colspan="8">
					<table class="table table-bordered table-sm" style="font-size: 14px;">
						<tr>
							<th rowspan="3" style="text-align: center; vertical-align: middle;">Đơn giá/giờ</th>
							<td colspan="2" align="center">Ca ngày</td>
							<td colspan="2" align="center">Ca đêm</td>
							<td colspan="2" align="center">Ngày nghỉ</td>
						</tr>
						<tr>
							<td >Giờ hành chính</td>
							<td>Tăng ca</td>
							<td>Giờ hành chính</td>
							<td>Tăng ca</td>
							<td>Ca ngày</td>
							<td>Ca đêm</td>
						</tr>
						<tr>
							<th>23,500</th>
							<th>32,000</th>
							<th>28,375</th>
							<th>34,000</th>
							<th>45,750</th>
							<th>45,750</th>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td colspan="8"></td></tr>
			<tr>
				<tr colspan="8">
					<table class="table table-bordered table-sm table-hover" style="font-size: 14px;" id="ngaycong">
						<thead class="bg-secondary text-white">
							<tr>
								<th>STT</th>
								<th>Ngày làm việc</th>
								<th>Số giờ ca ngày</th>
								<th>Số giờ tăng ca ca ngày</th>
								<th>Số giờ ca đêm</th>
								<th>Số giờ tăng ca ca đêm</th>
								<th>Lương/ngày</th>
								<th>Ghi chú</th>
							</tr>
						</thead>
						<tbody>
							@for ($i = 1; $i <= 31; $i++)
								@if($result->contains('ngay_lam', $thang.'-'.str_pad($i,2,"0",STR_PAD_LEFT)))
									<?php
										$ngay = $thang.'-'.str_pad($i,2,"0",STR_PAD_LEFT);
										$it = $result->where('ngay_lam', $ngay)->last();
									?>
									<tr class="@if($it->day_type > 0) bg-warning @endif">
										<td>{{$i}}</td>
										<td>{{date_format(date_create($ngay), 'd/m/Y')}}</td>
										<td>{{$it->gc != '' ? $it->gc : '-'}}</td>
										<td>{{$it->tc != '' ? $it->tc : '-'}}</td>
										<td>{{$it->gc1 != '' ? $it->gc1 : '-'}}</td>
										<td>{{$it->tc1 != '' ? $it->tc1 : '-'}}</td>
										<td>-</td>
										<td>-</td>
									</tr>
								@else
									<tr>
										<td>{{$i}}</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
								@endif
							@endfor
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</div>

@endsection

@section('javascript')
	<script>
	flatpickr('.datepickr',{enableTime: false, dateFormat: "Y-m", allowInput: true});
	</script>
@endsection