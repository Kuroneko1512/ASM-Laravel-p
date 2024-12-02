<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();

        $cart = Cart::where('session_id', $sessionId)->first();

        $cartItems = $cart->items;

        if ($cart) {
            session()->put('cart_count', $cart->items()->sum('quantity'));
        }
        if (!$cart) {
            return view('client.cart', ['cart' => null, 'cartItems' => collect()]);
        }

        $cartItems = $cart->items->map(function ($item) {
            $item->total = $item->price * $item->quantity;
            return $item;
        });

        $subtotal = $cartItems->sum('total');
        $total = $subtotal; // You can add tax/shipping calculation here if needed

        return view('client.cart', compact('cart', 'cartItems', 'subtotal', 'total'));
    }

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $sessionId = session()->getId();

        $cart = Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['user_id' => auth()->id()]
        );

        $price = optional(ProductVariant::find($validated['variant_id']))->sale_price
            ?? optional(Product::find($validated['product_id']))->sale_price
            ?? optional(Product::find($validated['product_id']))->price;

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $existingItem = CartItem::where([
            'cart_id' => $cart->id,
            'product_id' => $validated['product_id'],
            'product_variant_id' => $validated['variant_id']
        ])->first();

        if ($existingItem) {
            // Nếu đã có thì cộng thêm số lượng
            $existingItem->increment('quantity', $validated['quantity']);
        } else {
            // Nếu chưa có thì tạo mới
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'product_variant_id' => $validated['variant_id'],
                'quantity' => $validated['quantity'],
                'price' => $price
            ]);
        }

        // Cập nhật tổng số lượng trong session bằng cách tính lại từ database
        $totalQuantity = $cart->items()->sum('quantity');
        session()->put('cart_count', $totalQuantity);

        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
    }



    public function updateQuantity(Request $request)
    {
        foreach($request->cart_items as $itemId => $quantity) {
            CartItem::find($itemId)->update(['quantity' => $quantity]);
        }
        
        $cart = Cart::where('session_id', session()->getId())->first();
        $totalQuantity = $cart->items()->sum('quantity');
        session()->put('cart_count', $totalQuantity);
    
        return back()->with('success', 'Cập nhật giỏ hàng thành công');
    }
    

    public function removeItem(CartItem $item)
    {
        $cart = $item->cart;
        $item->delete();

        // $totalQuantity = $cart->items()->sum('quantity');
        
        // session()->put('cart_count', $totalQuantity);

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
}
