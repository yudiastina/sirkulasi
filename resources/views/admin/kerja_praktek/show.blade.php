<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            {{ __('Kerja Praktek') }}
        </div>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex flex-row gap-4">
                <div>
                    <a href="{{ route('admin.kp.edit', [ $kerjaPraktek->id ]) }}"
                        class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">edit</a>
                </div>
                <div>
                    <form action="{{ route('admin.kp.destroy', [ $kerjaPraktek->id ]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button><span
                                class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Hapus</span></button>
                    </form>
                </div>

            </div>
            <div class="flex flex-row px-2 gap-10">
                <div class="w-auto md:w-2/3 mt-10">
                    <div class="flex flex-col gap-4">
                        <div>
                            <div class="flex flex-col-reverse md:flex-row mx-auto gap-4">
                                <div>
                                    <h3 class="capitalize text-xl font-medium mb-2">{{ $kerjaPraktek->judul_final }}
                                    </h3>
                                    <div class="flex flex-col mb-4 mt-4">
                                        <div>
                                            <div>
                                                <dl>
                                                    <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                                        <dt class="text-sm font-medium text-gray-600">THNAKA</dt>
                                                        <dd
                                                            class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                                            {{ $kerjaPraktek->THNAKA }}</dd>
                                                    </div>
                                                    <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                                        <dt class="text-sm font-medium text-gray-600">Periode</dt>
                                                        <dd
                                                            class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                                            {{ $kerjaPraktek->Periode }}</dd>
                                                    </div>
                                                    <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                                        <dt class="text-sm font-medium text-gray-600">NIM</dt>
                                                        <dd
                                                            class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                                            {{ $kerjaPraktek->nim }}</dd>
                                                    </div>
                                                    <div class=" py-2 sm:grid sm:grid-cols-3 ">
                                                        <dt class="text-sm font-medium text-gray-600">Pembimbing</dt>
                                                        <dd
                                                            class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                                            {{ $kerjaPraktek->nmdosen }}</dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="bg-white">
                                <dt class="text-md font-medium text-gray-700">File</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                        
                                        @can('laporan_final', $kerjaPraktek)
                                        @if ($kerjaPraktek->link_laporan_final)
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
                                                    <a href="{{ route('view_kp_laporan_final_pdf', [$kerjaPraktek->id]) }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        laporan_final.pdf</a>
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('view_kp_laporan_final_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                            </div>
                                        </li>
                                        @endif
                                        @endcan
        
                                        @can('pendahuluan', $kerjaPraktek)
                                        @if ($kerjaPraktek->link_pendahuluan)
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
                                                    <a href="{{ route('view_kp_pendahuluan_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                        rel="noopener noreferrer">
                                                        pendahuluan.pdf</a>
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('view_kp_pendahuluan_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                            </div>
                                        </li>
                                        @endif
                                        @endcan
        
                                        @can('bab1', $kerjaPraktek)
                                        @if ($kerjaPraktek->link_bab1)
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
                                                    <a href="{{ route('view_kp_bab1_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                        rel="noopener noreferrer">
                                                        bab1.pdf</a>
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('view_kp_bab1_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                            </div>
                                        </li>
                                        @endif
                                        @endcan
        
                                        @can('bab2', $kerjaPraktek)
                                        @if ($kerjaPraktek->link_bab2)
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
                                                    <a href="{{ route('view_kp_bab2_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                        rel="noopener noreferrer">
                                                        bab2.pdf</a>
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('view_kp_bab2_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                            </div>
                                        </li>
                                        @endif
                                        @endcan
        
                                        @can('bab3', $kerjaPraktek)
                                        @if ($kerjaPraktek->link_bab3)
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
                                                    <a href="{{ route('view_kp_bab3_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                        rel="noopener noreferrer">
                                                        bab3.pdf</a>
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('view_kp_bab3_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                            </div>
                                        </li>
                                        @endif
                                        @endcan
        
                                        @can('bab4', $kerjaPraktek)
                                        @if ($kerjaPraktek->link_bab4)
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
                                                    <a href="{{ route('view_kp_bab4_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                        rel="noopener noreferrer">
                                                        bab4.pdf</a>
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('view_kp_bab4_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                            </div>
                                        </li>
                                        @endif
                                        @endcan
        
                                        @can('bab5', $kerjaPraktek)
                                        @if ($kerjaPraktek->link_bab5)
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
                                                    <a href="{{ route('view_kp_bab5_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                        rel="noopener noreferrer">
                                                        bab5.pdf</a>
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('view_kp_bab5_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                            </div>
                                        </li>
                                        @endif
                                        @endcan
        
                                        @can('bab6', $kerjaPraktek)
                                        @if ($kerjaPraktek->link_bab6)
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
                                                    <a href="{{ route('view_kp_bab6_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                        rel="noopener noreferrer">
                                                        bab6.pdf</a>
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('view_kp_bab6_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                            </div>
                                        </li>
                                        @endif
                                        @endcan
        
                                        @can('daftar_pustaka', $kerjaPraktek)
                                        @if ($kerjaPraktek->link_daftar_pustaka)
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
                                                    <a href="{{ route('view_kp_daftar_pustaka_pdf', [$kerjaPraktek->id]) }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        daftar_pustaka.pdf</a>
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('view_kp_daftar_pustaka_pdf', [$kerjaPraktek->id]) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">view</a>
                                            </div>
                                        </li>
                                        @endif
                                        @endcan
                                    </ul>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-auto md:w-1/3 mt-10">
                    <div class="mt-4 flex flex-col">
                        <h2 class="capitalize text-xl">file yang dapat diakses user</h2>
                        <hr class="my-3">
                        <dl>
                            @foreach ($akses_user as $item)
                            <dt class="text-base pb-1 font-normal text-gray-600 uppercase">{{ $item }}</dt>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>