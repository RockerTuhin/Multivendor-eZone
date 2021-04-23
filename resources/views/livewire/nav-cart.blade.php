<div class="same-style-text">
    <a href="{{ route('cart.index') }}">My Cart <br>
        @auth
            {{ Cart::session(auth()->id())->getContent()->count() }}
            @else
                0
        @endauth 
    &nbsp;Item</a>
    <script>
        @if( session()->has('update_success'))
        
            new Noty({

                type: 'success',
                layout: top,
                text: '{{ session()->get('update_sucess') }}'
            });
        
        @endif
    </script>
</div>