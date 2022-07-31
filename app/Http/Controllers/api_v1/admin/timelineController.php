<?php

namespace App\Http\Controllers\api_v1\admin;

use App\Http\Controllers\Controller;
use App\Models\SalesTransaction;
use App\Models\Timeline;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class timelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'this admin access',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function orderAll(Request $request)
    {
        $order = DB::table('order_sections')
                ->select('*')
                ->get();

        return response()->json(['order'=>$order]);
    }

    public function deleteDataSalesTransactionUser($id = NULL)
    {
        $q  =   'delete order_sections, sales_transactions, timelines, revisions 
                from order_sections inner join sales_transactions on 
                order_sections.id = sales_transactions.orderid inner join timelines on 
                sales_transactions.id = timelines.id_transaction inner join revisions on 
                timelines.id = revisions.timelineid where sales_transactions.orderid = ?';
        $delete =   DB::delete($q, array($id));

        if ($delete) {
            $dataSales = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil menghapus sales data pada id ". $id
            );
    
            return response()->json($dataSales,201);
        }else{
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Delete Data Error',
                    'data' => 'Data not available',
                    'ErrorCode' => 400
                ], 400);
        }
    }

    public function showSalesTransactionData()
    {
        $sales = DB::table('sales_transactions')
                ->select('*')
                ->get();

        return response()->json(['sales'=>$sales]);
    }

    public function statusPaymentDataChanger($id = NULL, $status = NULL)
    {
        $editpembayaran =   SalesTransaction::where('id', $id)
                            ->update(['status_pembayaran' => $status]);

        if($status == 0)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status pembayaran pada id ". $id ." menjadi belum bayar"
            );
    
            return response()->json($data,201);
        }if($status == 1)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status pembayaran pada id ". $id ." menjadi sudah bayar"
            );
    
            return response()->json($data,201);
        }else{
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Status Payment Error',
                    'data' => 'Status Payment not available',
                    'ErrorCode' => 400
                ], 400);
        }
    }
    
    public function statusProductDataChanger($id = NULL, $status = NULL)
    {
        $editproduct    =   SalesTransaction::where('id', $id)
                            ->update(['status_product' => $status]);

        if($status == 0)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status product pada id ". $id ." menjadi belum selesai"
            );
    
            return response()->json($data,201);
        }if($status == 1)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status product pada id ". $id ." menjadi sudah selesai"
            );
    
            return response()->json($data,201);
        }else{
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Status Product Error',
                    'data' => 'Status Product not available',
                    'ErrorCode' => 400
                ], 400);
        }
    }

    public function showTimelinesData()
    {
        $timelines  = DB::table('timelines')
                    ->select('*')
                    ->get();

        return response()->json(['timelines'=>$timelines]);
    }

    public function statusTimelinesDataChanger($id = NULL, $status = '')
    {
        $editstatus =   Timeline::where('id', $id)
                        ->update(['status_timeline' => $status]);

        if($status == 'prepare')
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status timeline pada id ". $id ." menjadi prepare"
            );
    
            return response()->json($data,201);
        }if($status == 'building')
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status timeline pada id ". $id ." menjadi building"
            );
    
            return response()->json($data,201);
        }if($status == 'revision')
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status timeline pada id ". $id ." menjadi revision"
            );
    
            return response()->json($data,201);
        }if($status == 'finish')
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status timeline pada id ". $id ." menjadi finish"
            );
    
            return response()->json($data,201);
        }else{
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Timeline Error',
                    'data' => 'Timeline not available',
                    'ErrorCode' => 400
                ], 400);
        }
    }
    
    public function revisionDataChanger($id = NULL, $status = NULL)
    {
        $editrevision   =   Timeline::where('id', $id)
                            ->update(['revision' => $status]);

        if($status == 1)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status product pada id ". $id ." menjadi revisi ke-1"
            );
    
            return response()->json($data,201);
        }if($status == 2)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status product pada id ". $id ." menjadi revisi ke-2"
            );
    
            return response()->json($data,201);
        }if($status == 3)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status product pada id ". $id ." menjadi revisi ke-3"
            );
    
            return response()->json($data,201);
        }if($status == 4)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status product pada id ". $id ." menjadi revisi ke-4"
            );
    
            return response()->json($data,201);
        }if($status == 5)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status product pada id ". $id ." menjadi revisi ke-5"
            );
    
            return response()->json($data,201);
        }else{
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Revision Error',
                    'data' => 'Revision not available',
                    'ErrorCode' => 400
                ], 400);
        }
    }

    public function statusRevisionDataChanger($id = NULL, $status = NULL)
    {
        $editpembayaran =   SalesTransaction::where('id', $id)
                            ->update(['status_revision' => $status]);

        if($status == 0)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status revision pada id ". $id ." menjadi belum terevisi"
            );
    
            return response()->json($data,201);
        }if($status == 1)
        {
            $data = array(
                'status' => 201,
                'eror' => 0,
                'message' => "Anda berhasil mengupdate status revision pada id ". $id ." menjadi sudah terevisi"
            );
    
            return response()->json($data,201);
        }else{
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Status Revision Error',
                    'data' => 'Status Revision not available',
                    'ErrorCode' => 400
                ], 400);
        }
    }
}
