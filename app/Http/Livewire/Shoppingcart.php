<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shoppingcart as Cart;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\BillingDetail;

class Shoppingcart extends Component
{
    public $cartitems, $sub_total = 0, $total = 0, $tax = 0;
    public $billingDetails = [];

    public function render()
    {
        $this->cartitems = Cart::with('product')
                ->where(['user_id'=>auth()->user()->id])
                ->where('status', '!=', Cart::STATUS['success'])
                ->get();
        $this->total = 0;$this->sub_total = 0; $this->tax = 0;

        foreach($this->cartitems as $item){
            $this->sub_total += $item->product->price * $item->quantity;
        }
        $this->total = $this->sub_total - $this->tax;

        return view('livewire.shoppingcart');
    }

    public function incrementQty($id){
        $cart = Cart::whereId($id)->first();
        $cart->quantity += 1;
        $cart->save();

        session()->flash('success', 'Product quantity updated !!!');
    }

    public function decrementQty($id){
        $cart = Cart::whereId($id)->first();
        if($cart->quantity > 1){
            $cart->quantity -= 1;
            $cart->save();
            session()->flash('success', 'Product quantity updated !!!');
        }else{
            session()->flash('info','You cannot have less than 1 quantity');
        }
    }

    public function removeItem($id){
        $cart = Cart::whereId($id)->first();

        if($cart){
            $cart->delete();
            $this->emit('updateCartCount');
        }
        session()->flash('success', 'Product removed from cart !!!');
    }

    public function storeBillingDetails()
    {
        
        $this->validate([
            'billingDetails.first_name' => 'required',
            'billingDetails.last_name' => 'required',
            'billingDetails.email' => 'required',
            'billingDetails.address' => 'required',
            'billingDetails.city' => 'required',
            'billingDetails.state' => 'required',
            'billingDetails.zip_code' => 'required',
        ]);

        // Create a new billing detail
        $billingDetail = new BillingDetail([
            'first_name' => $this->billingDetails['first_name'],
            'last_name' => $this->billingDetails['last_name'],
            'email' => $this->billingDetails['email'],
            'address' => $this->billingDetails['address'],
            'city' => $this->billingDetails['city'],
            'state' => $this->billingDetails['state'],
            'zip_code' => $this->billingDetails['zip_code'],
        ]);


        auth()->user()->billingDetails()->save($billingDetail);

        session()->flash('success', 'Billing details saved successfully.');
    }

    public function checkout(){
        
        $this->storeBillingDetails();
        $provider = new PayPalClient([]);
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => 'USD',
                        'value'  => $this->total
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => route('payment.cancel'),
                'return_url' => route('payment.success')
            ]

        ]);

        if($order['status'] == 'CREATED'){
            foreach ($this->cartitems as $item) {
                $item->status = Cart::STATUS['in_process'];
                $item->payment_id = $order['id'];
                
                $item->save();
            }
            return redirect($order['links'][1]['href']);
        }
        session()->flash('error','Something went wrong, Please Try again');
    }

    
    
}
