<x-main-layout>

    <x-slot name="header">
        <div class="flex items-center flex-col-reverse md:flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center md:text-start md:w-1/2">
                {{ __('Koleksi') }}
            </h2>
            <div class="w-full md:w-1/2">
                <x-search-kp></x-search-kp>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto flex flex-col md:flex-row md:gap-4 px-4">
        <div class="w-auto md:w-2/3 mt-10">
            <div class="mb-6">
                {{$kerjaPrakteks->onEachSide(1)->links()}}
            </div>
            <div class="flex flex-col md:grid  gap-4">

                @unless (count($kerjaPrakteks) == 0)
                @foreach ($kerjaPrakteks as $kerjaPraktek)
                <div class="border border-gray-100 hover:border-gray-300">
                    <div class="py-4 px-2">
                    <h4 class="text-center mb-2">
                        <a href="/kerja-praktek/{{ $kerjaPraktek->id }}"
                            class="capitalize font-medium hover:font-bold">{{ $kerjaPraktek->judul_final }}</a>
                    </h4>
                    <div class="flex justify-center">
                        <button
                            class="uppercase bg-gray-100 text-xs p-2 hover:bg-pink-600 hover:text-white transition duration-500 ease-in-out">
                            <a href="/kerja-praktek/{{ $kerjaPraktek->id }}">
                                detail cantuman
                            </a>
                        </button>
                    </div>

                </div>
            </div>
            @endforeach

            @else
            No Data
            @endunless
        </div>
        <div class="mt-6 mb-6">
            {{$kerjaPrakteks->onEachSide(1)->links()}}
        </div>
    </div>

    <div class="w-auto md:w-1/3 mt-10">
        <div class="mb-8">
            <h2 class="capitalize text-2xl">deskripsi pencarian</h2>
            <hr class="my-3">
            <span>Ditemukan {{ $kerjaPrakteks->total() }} dari pencarian Anda melalui kata kunci:
                {{ request('search') }}
            </span>
        </div>
        <div class="mb-8">
            <h2 class="capitalize text-2xl">informasi</h2>
            <hr class="my-3">
            <span>
                Akses Katalog Publik Daring - Gunakan fasilitas pencarian untuk mempercepat penemuan data katalog
            </span>
        </div>
    </div>

    </div>

</x-main-layout>