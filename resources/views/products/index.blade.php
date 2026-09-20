@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h1 class="h3 mb-0">Productos</h1>
    <span class="text-muted small">{{ count($products) }} artículos disponibles</span>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @forelse ($products as $product)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 overflow-hidden">
                @if (!empty($product->image))
                    <img 
                        src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" 
                        class="card-img-top" 
                        alt="{{ $product->name }}"
                        style="height: 180px; object-fit: cover;"
                    >
                @else
                    <div 
                        class="bg-secondary-subtle d-flex align-items-center justify-content-center text-secondary border-bottom" 
                        style="height: 180px;"
                    >
                        <span class="small fw-semibold">Sin imagen</span>
                    </div>
                @endif

                <div class="card-body d-flex flex-column">

                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title fw-bold mb-0">{{ $product->name }}</h5>
                        <span class="badge bg-primary fs-6">${{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <p class="small mb-2">
                        @if($product->stock > 0)
                            <span class="text-success fw-semibold">En stock: {{ $product->stock }}</span>
                        @else
                            <span class="text-danger fw-semibold">Agotado</span>
                        @endif
                    </p>

                    <p class="card-text text-secondary flex-grow-1">
                        {{ $product->description }}
                    </p>

                    <form action="/cart/add/{{ $product->id }}" method="POST" class="d-flex gap-2">
                        @csrf
                        
                        <select name="quantity" class="form-select" style="width: 80px;">
                            @for ($i = 1; $i <= min($product->stock, 10); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                        <button type="submit" class="btn btn-dark">Añadir</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                No hay productos disponibles por el momento.
            </div>
        </div>
    @endforelse
</div>
@endsection