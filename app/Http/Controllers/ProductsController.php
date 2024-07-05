<?php

namespace App\Http\Controllers;

use App\Utils;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Events\SubmitOrder;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\User;

class ProductsController extends Controller
{
    // public $condition = false;
    // public $selProducts = [];
    public function getProducts(){
        $products = Products::get();
        return view('products', compact('products'));
    }

    public function saveOrder(Request $request){
        if(!empty($request->productId)){
            return (json_encode(['data'=>$request->productId, 'res'=>'1']));
        }
    }

    public function saveDetails(Request $request){
        $blockedCountries = ['SO'];
        $request->validate([
            'email' => 'required|email',
            'products'=>'required|min:1'
        ]);
        if($request->ip()){
            $resdata = Utils::getThisIpCountryCode($request->ip());
            
            if(!empty($resdata)){
                $code = $resdata['data']['location']['country']['alpha2'];
                // $code = 'SO';
                if(!in_array($code, $blockedCountries)){
                    //check user exists or not
                    $check = User::where('email', $request->email)->exists();
                    if(!$check){
                        User::create(['name'=>'TestABC', 'email'=>$request->email, 'password'=>'Test123']);
                    }
                    $order = Orders::create(['email'=>$request->email, 'shipping_address_1'=>$request->ship_address]);
                    $orderId = $order->id; 
                    if(!empty($request->products)){
                        foreach($request->products as $key=>$value){
                            $order_item = new OrderItems();
                            $order_item->order_id = $orderId;
                            $order_item->product_id = $value;
                            $order_item->save();
                        }
                    }
                    // event(new SubmitOrder($order));
                    SubmitOrder::dispatch($order);
                }else{
                    // dd("dfksd");
                    return "0";
                }
            }else{
                return "1";
            }
        }
        
    }
}
