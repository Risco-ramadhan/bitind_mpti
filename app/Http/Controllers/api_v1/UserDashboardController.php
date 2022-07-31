<?php

namespace App\Http\Controllers\api_v1;

use App\Http\Controllers\Controller;
use App\Models\OrderSection;
use App\Models\SalesTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserDashboardController extends Controller
{

    public $token = true;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(['user' => Auth::user()]);
    }

    public function cardProductDashboard()
    {
        $user = Auth::user();
        $order = DB::table('order_sections')
                ->select(DB::raw('count(order_sections.id) as countOrder' ))
                ->join('users', 'order_sections.userid', '=', 'users.id')
                ->join('sales_transactions', 'sales_transactions.orderid', '=', 'order_sections.id')
                ->where('order_sections.userid', $user->id)
                ->where('sales_transactions.status_pembayaran', 1)
                ->get();

        return response()->json(['message' => 'Product Order data successfully show', 'order' => $order]);
    }

    public function cardProductSales()
    {
        $user = Auth::user();
        $sales = DB::table('order_sections')
                ->select(DB::raw('count(sales_transactions.id) as countSales'))
                ->join('users', 'order_sections.userid', '=', 'users.id')
                ->join('sales_transactions', 'sales_transactions.orderid', '=', 'order_sections.id')
                ->where('order_sections.userid', $user->id)
                ->get();

        return response()->json(['message' => 'Product Sales data successfully show', 'sales' => $sales]);
    }

    public function detailSalesFinished()
    {
        $user = Auth::user();
        $finish = DB::table('order_sections')
                ->select(DB::raw('count(sales_transactions.id) as countSalesFinish'))
                ->join('users', 'order_sections.userid', '=', 'users.id')
                ->join('sales_transactions', 'sales_transactions.orderid', '=', 'order_sections.id')
                ->where('order_sections.userid', $user->id)
                ->where('sales_transactions.status_pembayaran', 1)
                ->get();

        return response()->json(['message' => 'Product Sales Finish successfully show', 'finish' => $finish]);
    }

    public function detailSalesUnfinished()
    {
        $user = Auth::user();
        $unfinish = DB::table('order_sections')
                ->select(DB::raw('count(sales_transactions.id) as countSalesUnfinished'))
                ->join('users', 'order_sections.userid', '=', 'users.id')
                ->join('sales_transactions', 'sales_transactions.orderid', '=', 'order_sections.id')
                ->where('order_sections.userid', $user->id)
                ->where('sales_transactions.status_pembayaran', 0)
                ->get();

        return response()->json(['message' => 'Product Sales Unfinished successfully show', 'unfinish' => $unfinish]);
    }

    public function orderUser(Request $request)
    {
        $user = Auth::user();
        $order = OrderSection::where('userid', $user->id)
               ->orderBy('id')
               ->take(4)
               ->get();

        return response()->json(['order'=>$order]);
    }

    public function statusUser(Request $request)
    {
      
        $user = Auth::user();
        $sales = DB::table('sales_transactions')
                ->select('sales_transactions.id', 'sales_transactions.orderid', 'order_sections.bussiness_name', 'order_sections.id_product', 'sales_transactions.status_pembayaran', 'sales_transactions.status_product')
                ->join('order_sections', 'order_sections.id', '=', 'sales_transactions.orderid')
                ->where('order_sections.userid', $user->id)
                ->get();

        return response()->json(['message' => 'Sales transactions successfully show', 'sales'=>$sales]);
    }

    public function userWebsite(Request $request)
    {
        $user = Auth::user();
        $timeline = DB::table('sales_transactions')
                    ->select('order_sections.id', 'order_sections.bussiness_name')
                    ->join('order_sections', 'order_sections.id', '=', 'sales_transactions.orderid')
                    ->where('order_sections.userid', $user->id)
                    ->where('sales_transactions.status_pembayaran', 1)
                    ->get();

        $data = [
            'status' => 200,
            'message' => 'Get Website Timeline Successfully',
            'data' => $timeline,
        ];

        return response()->json($data, 200);
    }

    public function detailWebsite($id = null)
    {
        // $user = Auth::user();
        $detailtimeline =   DB::table('order_sections')
                            ->select('*')
                            ->join('sales_transactions', 'order_sections.id', '=', 'sales_transactions.orderid')
                            ->join('timelines', 'timelines.id_transaction', '=', 'sales_transactions.id')
                            ->where('order_sections.id', $id)
                            ->get();

        $data = [
            'status' => 200,
            'message' => 'Get Detail Website Timeline Successfully',
            'data' => $detailtimeline,
        ];

        return response()->json($data, 200);
    }

    public function timelinePreparing($id = null)
    {
        $prepare =  DB::table('order_sections')
                    ->select(
                        'sales_transactions.id',
                        'sales_transactions.orderid', 
                        'url_reference', 
                        'color1', 
                        'color2', 
                        'color3', 
                        'image_reference', 
                        'bussiness_name', 
                        'url_reference')
                    ->from('order_sections')
                    ->join('sales_transactions', 'order_sections.id', '=', 'sales_transactions.orderid')
                    ->where('sales_transactions.id', $id)
                    ->get();

        $data = [
            'status' => 200,
            'message' => 'Get Preparing Data Website Timeline Successfully',
            'data' => $prepare,
        ];

        return response()->json($data, 200);
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
