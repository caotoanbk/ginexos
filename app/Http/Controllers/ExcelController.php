<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Wclient;
use App\Outsource;
use App\Osstatistic;
use Excel;

class ExcelController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function importExport()
    {
		$clients = Wclient::pluck('WclientsName', 'Id');
        return view('importExport', compact('clients'));
    }

    //file export code
    public function downloadExcel(Request $request, $type){
        $data = Item::get()->toArray();
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data){
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    //import file to database code
    public function importExcel(Request $request)
	{
		if($request->hasFile('import_file')){
			$file = $request->file('import_file');
			$path = $file->getRealPath();
			//dd($request->file('import_file'));
			$destinationPath = 'uploads';
			$file->move($destinationPath,$file->getClientOriginalName());
			//dd('hello');
			
			$public_path = public_path('uploads/'.$file->getClientOriginalName());
			$data = Excel::load($public_path, function($reader) {})->get();
			//dd($data);
			if(!empty($data) && $data->count()){
				$data_arr = $data->toArray();
				for ($i=0; $i < count($data_arr); $i++) { 
					if($i < 10) continue;
					$row = $data_arr[$i];
					if(strpos(strval($row[0]), "Tổng") !== false) break;
					$maos = trim(strval(is_null($row[1])?"":$row[1]));
					$os = Outsource::where('maos', $maos)->get();
					if(count($os) == 0){
						// insert new os
						$newos = Outsource::create([
							'maos' => $maos,
							'congty' => $request->get('congty'),
							'cmt' => strval(is_null($row[2])?"":$row[2]),
							'ngaycap' => strval(is_null($row[3])?"":$row[3]),
							'noicap' => strval(is_null($row[4])?"":$row[4]),
							'hoten' => strval(is_null($row[5])?"":$row[5]),
							'pic' => strval(is_null($row[6])?"":$row[6]),
							'ngayvao' => strval(is_null($row[7])?"":$row[7]),
							'line' => strval(is_null($row[8])?"":$row[8]),
							'bophan' => strval(is_null($row[9])?"":$row[9]),
							'songaydklv' => strval(is_null($row[10])?"":$row[10]),
							'ngayhethd' => strval(is_null($row[11])?"":$row[11]),
							'ngaynghi' => strval(is_null($row[12])?"":$row[12]),
						]);
						$osid = $newos->id;
					}else{
						$osid = $os->first()->id;
					}
					//tim bang cong thang
					$ngaycong = Osstatistic::where('ngay_lam', $request->get('ngaylam'))->where('osid', $osid);
					if(count($ngaycong->get()) > 0){
						$ngaycong->update([
							//'osid' => $osid,
							//'ngay_lam' => $request->get('ngaylam'),
							'gc' => strval(is_null($row[13])?"":$row[13]),
							'tc' => strval(is_null($row[14])?"":$row[14]),
							'gc1' => strval(is_null($row[15])?"":$row[15]),
							'tc1' => strval(is_null($row[16])?"":$row[16]),
							'gc2' => strval(is_null($row[17])?"":$row[17]),
							'tc2' => strval(is_null($row[18])?"":$row[18]),
							'day_type' => $request->get('day_type')
						]);
					}else{					
						$new_bangcong = Osstatistic::create([
							'osid' => $osid,
							'ngay_lam' => $request->get('ngaylam'),
							'gc' => strval(is_null($row[13])?"":$row[13]),
							'tc' => strval(is_null($row[14])?"":$row[14]),
							'gc1' => strval(is_null($row[15])?"":$row[15]),
							'tc1' => strval(is_null($row[16])?"":$row[16]),
							'gc2' => strval(is_null($row[17])?"":$row[17]),
							'tc2' => strval(is_null($row[18])?"":$row[18]),
							'day_type' => $request->get('day_type')
						]);
					}
	

				}
				\Session::flash('flash_message', 'Success!');
				return redirect('/bang-cong');
			}


		}
	}
}
