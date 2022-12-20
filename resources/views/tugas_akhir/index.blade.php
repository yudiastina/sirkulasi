<x-main-layout>

    <x-slot name="header">
        <div class="flex items-center flex-col-reverse md:flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center md:text-start md:w-1/2">
                {{ __('Koleksi') }}
            </h2>
            <div class="w-full md:w-1/2">
                <x-search></x-search>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto flex flex-col md:flex-row md:gap-4 px-4">
        <div class="w-auto md:w-2/3 mt-10">
            <div class="mb-6">
                {{$tugasAkhirs->onEachSide(1)->links()}}
            </div>
      
            <div class="flex flex-col md:grid  gap-4">

                @unless (count($tugasAkhirs) == 0)
                @foreach ($tugasAkhirs as $tugasAkhir)
                <div class="border border-gray-100 hover:border-gray-300">
                    <div class="py-4 px-2">
                    <h4 class="text-center">
                        <a href="/tugas-akhir/{{ $tugasAkhir->id }}"
                            class="capitalize font-medium hover:font-bold">{{ $tugasAkhir->judul_final }}</a>
                    </h4>
                    <div class="text-center mb-4 italic font-normal lowercase">{{ $tugasAkhir->kata_kunci }}</div>
                    <div class="flex justify-center">
                        <button
                            class="uppercase bg-gray-100 text-xs p-2 hover:bg-pink-600 hover:text-white transition duration-500 ease-in-out">
                            <a href="/tugas-akhir/{{ $tugasAkhir->id }}">
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
            {{$tugasAkhirs->onEachSide(1)->links()}}
        </div>
    </div>

    <div class="w-auto md:w-1/3 mt-10">
        <div class="mb-8">
            <h2 class="capitalize text-2xl">deskripsi pencarian</h2>
            <hr class="my-3">
            <span>Ditemukan {{ $tugasAkhirs->total() }} dari pencarian Anda melalui kata kunci:
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