<x-main-layout>

    <x-slot name="header">
        <div class="flex items-center flex-col-reverse md:flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center md:text-start md:w-1/2">
                {{ __('Detail Cantuman') }}
            </h2>
            <div class="w-full md:w-1/2">
                <x-search-kp></x-search-kp>
            </div>
        </div>
    </x-slot>

    <div class="flex px-10 max-w-6xl mx-auto">
        <div class="w-full mt-10">
            <div class="flex flex-col gap-4">
                <div>
                    <div class="flex flex-col mx-auto gap-4">
                        <div>
                            <h3 class="capitalize text-xl font-medium mb-6">{{ $kerjaPraktek->judul_final }}
                            </h3>
                            <dl>
                                <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                    <dt class="text-sm font-medium text-gray-600">THNAKA</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                        {{ $kerjaPraktek->THNAKA }}</dd>
                                </div>
                                <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                    <dt class="text-sm font-medium text-gray-600">Periode</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                        {{ $kerjaPraktek->Periode }}</dd>
                                </div>
                                <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                    <dt class="text-sm font-medium text-gray-600">NIM</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                        {{ $kerjaPraktek->nim }}</dd>
                                </div>
                                <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                    <dt class="text-sm font-medium text-gray-600">Pembimbing</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                        {{ $kerjaPraktek->nmdosen }}</dd>
                                </div>
                            </dl>
                        </div>

                    </div>
                </div>
                <div>
                    <div class="bg-white mb-8">
                        <dt class="text-md font-medium text-gray-700 mb-2">File</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                
                   
                                @if ($kerjaPraktek->link_laporan_final and in_array('laporan final', $akses_user))
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <!-- Heroicon name: mini/paper-clip -->
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            <a rel="noopener noreferrer">
                                                laporan_final.pdf</a>
                                        </span>
                                    </div>
                                    @can('laporan_final', $kerjaPraktek)
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('view_kp_laporan_final_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                    </div>
                                    @endcan
                                </li>
                                @endif
                                

                                
                                @if ($kerjaPraktek->link_pendahuluan and in_array('pendahuluan', $akses_user))
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <!-- Heroicon name: mini/paper-clip -->
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            <a 
                                                rel="noopener noreferrer">
                                                pendahuluan.pdf</a>
                                        </span>
                                    </div>
                                    @can('pendahuluan', $kerjaPraktek)
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('view_kp_pendahuluan_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                    </div>
                                    @endcan
                                </li>
                                @endif
                                

                                
                                @if ($kerjaPraktek->link_bab1 and in_array('bab i', $akses_user))
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <!-- Heroicon name: mini/paper-clip -->
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            <a 
                                                rel="noopener noreferrer">
                                                bab1.pdf</a>
                                        </span>
                                    </div>
                                    @can('bab1', $kerjaPraktek)
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('view_kp_bab1_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                    </div>
                                    @endcan
                                </li>
                                @endif
                                

                                
                                @if ($kerjaPraktek->link_bab2 and in_array('bab ii', $akses_user))
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <!-- Heroicon name: mini/paper-clip -->
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            <a 
                                                rel="noopener noreferrer">
                                                bab2.pdf</a>
                                        </span>
                                    </div>
                                    @can('bab2', $kerjaPraktek)
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('view_kp_bab2_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                    </div>
                                    @endcan
                                </li>
                                @endif
                                

                                
                                @if ($kerjaPraktek->link_bab3 and in_array('bab iii', $akses_user))
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <!-- Heroicon name: mini/paper-clip -->
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            <a 
                                                rel="noopener noreferrer">
                                                bab3.pdf</a>
                                        </span>
                                    </div>
                                    @can('bab3', $kerjaPraktek)
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('view_kp_bab3_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                    </div>
                                    @endcan
                                </li>
                                @endif
                                

                                
                                @if ($kerjaPraktek->link_bab4 and in_array('bab iv', $akses_user))
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <!-- Heroicon name: mini/paper-clip -->
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            <a 
                                                rel="noopener noreferrer">
                                                bab4.pdf</a>
                                        </span>
                                    </div>
                                    @can('bab4', $kerjaPraktek)
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('view_kp_bab4_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                    </div>
                                    @endcan
                                </li>
                                @endif
                                

                                
                                @if ($kerjaPraktek->link_bab5 and in_array('bab v', $akses_user))
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <!-- Heroicon name: mini/paper-clip -->
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            <a 
                                                rel="noopener noreferrer">
                                                bab5.pdf</a>
                                        </span>
                                    </div>
                                    @can('bab5', $kerjaPraktek)
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('view_kp_bab5_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                    </div>
                                    @endcan
                                </li>
                                @endif
                                

                                
                                @if ($kerjaPraktek->link_bab6 and in_array('bab vi', $akses_user))
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <!-- Heroicon name: mini/paper-clip -->
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            <a 
                                                rel="noopener noreferrer">
                                                bab6.pdf</a>
                                        </span>
                                    </div>
                                    @can('bab6', $kerjaPraktek)
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('view_kp_bab6_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                    </div>
                                    @endcan
                                </li>
                                @endif
                                

                                
                                @if ($kerjaPraktek->link_daftar_pustaka and in_array('daftar pustaka', $akses_user))
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <!-- Heroicon name: mini/paper-clip -->
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            <a  rel="noopener noreferrer">
                                                daftar_pustaka.pdf</a>
                                        </span>
                                    </div>
                                    @can('daftar_pustaka', $kerjaPraktek)
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ route('view_kp_daftar_pustaka_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                            rel="noopener noreferrer"
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
        </div>
</x-main-layout>