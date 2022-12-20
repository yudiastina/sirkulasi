<x-main-layout>

    <x-slot name="header">
        <div class="flex items-center flex-col-reverse md:flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center md:text-start md:w-1/2">
                {{ __('Detail Cantuman') }}
            </h2>
            <div class="w-full md:w-1/2">
                <x-search></x-search>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto flex flex-col md:flex-row md:gap-4 lg:px-10 space-x-4">
        <div class="w-auto md:w-2/3 mt-10">
            <div class="flex flex-col gap-4">
                <div>
                    <div class="flex flex-col-reverse md:flex-row mx-auto gap-4">
                        <div>
                            <h3 class="capitalize text-xl font-medium mb-2">{{ $tugasAkhir->judul_final }}</h3>
                            <h3 class="capitalize text-base font-medium mb-6 italic">
                                ( {{ $tugasAkhir->judul_final_eng }} )</h3>
                            <div class="mb-4 flex flex-col space-y-1">
                                <span>Kata Kunci: {{ $tugasAkhir->kata_kunci }}</span>
                                <span class="italic">Keyword: {{ $tugasAkhir->kata_kunci_eng }}</span>
                            </div>
                            <hr>
                            <div class="py-4">
                                <span class="capitalize ">abstrak</span>
                                <p class="text-justify">{{ $tugasAkhir->abstrak }}</p>
                            </div>
                            <hr>
                            <div class="py-4 italic">
                                <span class="capitalize ">abstrack</span>
                                <p class="text-justify">{{ $tugasAkhir->abstrak_eng }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white mb-8">
                    <dt class="text-md font-medium text-gray-700 mb-2">File</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        <ul role="list"
                            class="divide-y divide-gray-200 rounded-md border border-gray-200">
                            
                            @if ($tugasAkhir->link_laporan_final and in_array('laporan final', $akses_user) )
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a rel="noopener noreferrer">
                                            laporan_final.pdf</a>
                                    </span>
                                </div>
                                @can('laporan_final', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_laporan_final_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_artikel and in_array('artikel', $akses_user) )
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a rel="noopener noreferrer">
                                            artikel.pdf</a>
                                    </span>
                                </div>
                                @can('artikel', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_artikel_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_pendahuluan and in_array('pendahuluan', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a  rel="noopener noreferrer">
                                            pendahuluan.pdf</a>
                                    </span>
                                </div>
                                @can('pendahuluan', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_pendahuluan_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                                              
                            @if ($tugasAkhir->link_abstrak and in_array('abstrak', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a  rel="noopener noreferrer">
                                            abstrak.pdf</a>
                                    </span>
                                </div>
                                @can('abstrak', $tugasAkhir) 
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_abstrak_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_bab1 and in_array('bab i', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a  rel="noopener noreferrer">
                                            bab1.pdf</a>
                                    </span>
                                </div>
                                @can('bab1', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_bab1_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_bab2 and in_array('bab ii', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a  rel="noopener noreferrer">
                                            bab2.pdf</a>
                                    </span>
                                </div>
                                @can('bab2', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_bab2_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_bab3 and in_array('bab iii', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a  rel="noopener noreferrer">
                                            bab3.pdf</a>
                                    </span>
                                </div>
                                @can('bab3', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_bab3_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_bab4 and in_array('bab iv', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a rel="noopener noreferrer">
                                            bab4.pdf</a>
                                    </span>
                                </div>
                                @can('bab4', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_bab4_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_bab5 and in_array('bab v', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a  rel="noopener noreferrer">
                                            bab5.pdf</a>
                                    </span>
                                </div>
                                @can('bab5', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_bab5_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_daftar_pustaka and in_array('daftar pustaka', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a rel="noopener noreferrer">
                                            daftar_pustaka.pdf</a>
                                    </span>
                                </div>
                                @can('daftar_pustaka', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_daftar_pustaka_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_lampiran and in_array('lampiran', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a  rel="noopener noreferrer">
                                            lampiran.pdf</a>
                                    </span>
                                </div>
                                @can('lampiran', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_lampiran_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            

                            
                            @if ($tugasAkhir->link_biodata and in_array('biodata', $akses_user))
                            <li
                                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                <div class="flex w-0 flex-1 items-center">
                                    <!-- Heroicon name: mini/paper-clip -->
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 w-0 flex-1 truncate">
                                        <a rel="noopener noreferrer">
                                            biodata.pdf</a>
                                    </span>
                                </div>
                                @can('biodata', $tugasAkhir)
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('view_ta_biodata_pdf', [$tugasAkhir->id]) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                </div>
                                @endcan
                            </li>
                            @endif
                            
                        </ul>
                    </dd>
                </div>
            </div>
        </div>

        <div class="w-auto md:w-1/3 mt-10">
            <div class="flex flex-col mb-8">
                <div>
                    <h2 class="capitalize text-xl">informasi</h2>
                    <hr class="my-3">
                    <div>
                        <dl>
                            <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                <dt class="text-sm font-medium text-gray-600">THNAKA</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                    {{ $tugasAkhir->THNAKA }}</dd>
                            </div>
                            <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                <dt class="text-sm font-medium text-gray-600">Periode</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                    {{ $tugasAkhir->Periode }}</dd>
                            </div>
                            <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                <dt class="text-sm font-medium text-gray-600">NIM</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                    {{ $tugasAkhir->NIM }}</dd>
                            </div>
                            <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                <dt class="text-sm font-medium text-gray-600">Pembimbing I</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                    {{ $tugasAkhir->Pembimbing1 }}</dd>
                            </div>
                            <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                <dt class="text-sm font-medium text-gray-600">Pembimbing II</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                    {{ $tugasAkhir->Pembimbing2 }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

</x-main-layout>