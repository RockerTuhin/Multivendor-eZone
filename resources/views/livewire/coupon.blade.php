<div>
    {{-- <form action="{{ route('cart.coupon') }}" method="GET">
        <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text" required="">
		<input class="button" name="apply_coupon" value="Apply coupon" type="submit">
    </form> --}}
    <form wire:submit.prevent="applyCoupon">
        {{-- <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text" required=""> --}}
        <input id="coupon_code" class="input-text" wire:model="coupon_code" placeholder="Coupon code" type="text" required="">
		<input class="button" name="apply_coupon" value="Apply coupon" type="submit">
    </form>
</div>
