<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Models\Sales;
use App\Models\SaleItem;

class SaleController extends Controller
{
    public function list()
    {
    	return view('list');
    }
    public function listFetch(Request $request)
    {
        $sales = Sales::get();
         return Datatables::of($sales)
                ->addIndexColumn()
                ->editColumn("action", function ($sales) {
                    return '<a href="'.route('sales-view',['id'=>base64_encode($sales->id)]).'" ><i class="fas fa-eye text-success"></i></a>'.
                        ' &nbsp; '.
                        '<div class="dropdown" style="display: inline;">'.
                            '<a href="#"data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-bars text-secondary"></i>'.
                            '</a>'.
                            '<ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: top, left; top: 20px; left: -142px;">'.
                                '<li class="ms-dropdown-list">'.
                                    '<a class="dropdown-item bg-success text-white" href="javascript:void( 0);" onclick="change_status(this);" data-status="1" data-id="'.$sales->id.'">Draft</a>'.
                                    '<a class="dropdown-item bg-warning text-white" href="javascript:void(0);" onclick="change_status(this);" data-status="2" data-id="'.$sales->id.'">Pending</a>'.
                                    '<a class="dropdown-item bg-danger text-white" href="javascript:void(0);" onclick="change_status(this);" data-status="3" data-id="'.$sales->id.'">Canceled</a>'.
                                    '<a class="dropdown-item bg-info text-white" href="javascript:void(0);" onclick="change_status(this);" data-status="4" data-id="'.$sales->id.'">Delivered</a>'.
                                '</li>'.
                            '</ul>'.
                        '</div>'.' &nbsp; '.
                        // '<a href="javascript:void(0);" onclick="add_notes(this);" data-id="'.$patient->id.'"><i class="fas fa-sticky-note-o text-primary"></i></a>'.
                        // ' &nbsp; '.
                    '';
                })
                ->editColumn("status", function ($sales) {
                    if ($sales->status == 1) {
                        return '<span class="badge badge-success">Draft</span>';
                    } elseif ($sales->status == 2) {
                        return '<span class="badge badge-warning">Pending</span>';
                    } elseif ($sales->status == 3) {
                        return '<span class="badge badge-danger">Canceled</span>';
                    } elseif ($sales->status == 4) {
                        return '<span class="badge badge-info">Delivered</span>';
                    } else {
                        return '-';
                    }
                })
                ->rawColumns(["action", "status"])
                ->make(true);
    }
    public function changeStatus(Request $request)
    {
        if(!$request->ajax()){
            exit('No direct script access allowed');
        }

        if(!empty($request->all()))
        {
            $status = $request->status;
            $id = $request->id;

            $update = Sales::find($id);
            $update->status = $status;
            $update->save();
            
            if($update)
            {
                return response()->json(['code' => 200]);
            }
            else
            {
                return response()->json(['code' => 201]);
            }
        }
        else
        {
            return response()->json(['code' => 201]);
        }   
    }
    public function view($id)
    {
        $id = base64_decode($id);
        $sales = Sales::with('saleItems.product')->find($id);
        // dd($sales);
        return view('view',compact('sales'));
    }
    public function addDummyRecords()
    {
        Sales::factory()->count(250)->create();
        SaleItem::factory()->count(250)->create();
    	
        return response()->json(['code' => 200,'message'=>'Dummy records added successfully!']);
    }
}
