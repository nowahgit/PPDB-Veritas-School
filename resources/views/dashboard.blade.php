@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard PPDB</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Pendaftar -->
        <div class="bg-blue-500 text-white rounded-2xl p-6 shadow-lg">
            <h2 class="text-xl font-semibold">Total Pendaftar</h2>
            <p class="text-4xl font-bold">{{ $total_pendaftar ?? 0 }}</p>
        </div>

        <!-- Total Panitia -->
        <div class="bg-green-500 text-white rounded-2xl p-6 shadow-lg">
            <h2 class="text-xl font-semibold">Total Panitia</h2>
            <p class="text-4xl font-bold">{{ $total_panitia ?? 0 }}</p>
        </div>
    </div>
</div>
@endsection
