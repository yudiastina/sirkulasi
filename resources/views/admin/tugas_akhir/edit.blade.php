<x-app-layout>
    <x-slot name="header">
        {{ __('Tugas Akhir') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <div class="px-6 py-4">
                    <form method="post" action="{{ route('admin.ta.update', [ $tugasAkhir->id ]) }}"
                        class="mt-6 space-y-6" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <!-- THNAKA -->
                        <div class="mt-4">
                            <x-input-label for="THNAKA" :value="__('THNAKA')" />

                            <x-text-input id="THNAKA" class="block mt-1 w-full" type="text" name="THNAKA"
                                :value="old('THNAKA', $tugasAkhir->THNAKA)" required autofocus />

                            <x-input-error :messages="$errors->get('THNAKA')" class="mt-2" />
                        </div>

                        <!-- Periode -->
                        <div class="mt-4">
                            <x-input-label for="Periode" :value="__('Periode')" />

                            <x-text-input id="Periode" class="block mt-1 w-full" type="text" name="Periode"
                                :value="old('Periode',$tugasAkhir->Periode)" required autofocus />

                            <x-input-error :messages="$errors->get('Periode')" class="mt-2" />
                        </div>

                        <!-- NIM -->
                        <div class="mt-4">
                            <x-input-label for="NIM" :value="__('NIM')" />

                            <x-text-input id="NIM" class="block mt-1 w-full bg-gray-200" type="number" name="NIM"
                                :value="old('NIM',$tugasAkhir->NIM)" disabled />

                            <x-input-error :messages="$errors->get('NIM')" class="mt-2" />
                        </div>

                        <!-- dsnid_pemb1 Address -->
                        <div class="mt-4">
                            <x-input-label for="dsnid_pemb1" :value="__('DSNID Pembimbing I')" />

                            <x-text-input id="dsnid_pemb1" class="block mt-1 w-full" type="text" name="dsnid_pemb1"
                                :value="old('dsnid_pemb1',$tugasAkhir->dsnid_pemb1)" required />

                            <x-input-error :messages="$errors->get('dsnid_pemb1')" class="mt-2" />
                        </div>
                        <!-- Pembimbing1 Address -->
                        <div class="mt-4">
                            <x-input-label for="Pembimbing1" :value="__('Pembimbing I')" />

                            <x-text-input id="Pembimbing1" class="block mt-1 w-full" type="text" name="Pembimbing1"
                                :value="old('Pembimbing1',$tugasAkhir->Pembimbing1)" required />

                            <x-input-error :messages="$errors->get('Pembimbing1')" class="mt-2" />
                        </div>

                        <!-- dsnid_pemb2 Address -->
                        <div class="mt-4">
                            <x-input-label for="dsnid_pemb2" :value="__('DSNID Pembimbing II')" />

                            <x-text-input id="dsnid_pemb2" class="block mt-1 w-full" type="text" name="dsnid_pemb2"
                                :value="old('dsnid_pemb2',$tugasAkhir->dsnid_pemb2)" required />

                            <x-input-error :messages="$errors->get('dsnid_pemb2')" class="mt-2" />
                        </div>
                        <!-- Pembimbing2 Address -->
                        <div class="mt-4">
                            <x-input-label for="Pembimbing2" :value="__('Pembimbing II')" />

                            <x-text-input id="Pembimbing2" class="block mt-1 w-full" type="text" name="Pembimbing2"
                                :value="old('Pembimbing2',$tugasAkhir->Pembimbing2)" required />

                            <x-input-error :messages="$errors->get('Pembimbing2')" class="mt-2" />
                        </div>

                        <!-- judul_final -->
                        <div class="mt-4">
                            <x-input-label for="judul_final" :value="__('Judul Final')" />

                            <x-text-input id="judul_final" class="block mt-1 w-full" type="text" name="judul_final"
                                :value="old('judul_final',$tugasAkhir->judul_final)" required autofocus />

                            <x-input-error :messages="$errors->get('judul_final')" class="mt-2" />
                        </div>

                        <!-- judul_final_eng -->
                        <div class="mt-4">
                            <x-input-label for="judul_final_eng" :value="__('Judul Final Eng')" />

                            <x-text-input id="judul_final_eng" class="block mt-1 w-full" type="text"
                                name="judul_final_eng" :value="old('judul_final_eng',$tugasAkhir->judul_final_eng)"
                                required autofocus />

                            <x-input-error :messages="$errors->get('judul_final_eng')" class="mt-2" />
                        </div>

                        <!-- abstrak -->
                        <div class="mt-4">
                            <x-input-label for="abstrak" :value="__('Abstrak')" />
                            <textarea name="abstrak"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                id="abstrak" cols="10" rows="10" value="old('abstrak')" required
                                autofocus>{{ $tugasAkhir->abstrak }}</textarea>

                            <x-input-error :messages="$errors->get('abstrak')" class="mt-2" />
                        </div>

                        <!-- abstrak_eng -->
                        <div class="mt-4">
                            <x-input-label for="abstrak_eng" :value="__('Abstrak Eng')" />

                            <textarea name="abstrak_eng"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                id="abstrak_eng" cols="10" rows="10" value="old('abstrak_eng')" required
                                autofocus>{{ $tugasAkhir->abstrak_eng }}</textarea>

                            <x-input-error :messages="$errors->get('abstrak_eng')" class="mt-2" />
                        </div>

                        <!-- kata_kunci -->
                        <div class="mt-4">
                            <x-input-label for="kata_kunci" :value="__('Kata Kunci')" />

                            <x-text-input id="kata_kunci" class="block mt-1 w-full" type="text" name="kata_kunci"
                                :value="old('kata_kunci',$tugasAkhir->kata_kunci)" required autofocus />

                            <x-input-error :messages="$errors->get('kata_kunci')" class="mt-2" />
                        </div>

                        <!-- kata_kunci_eng -->
                        <div class="mt-4">
                            <x-input-label for="kata_kunci_eng" :value="__('Kata Kunci Eng')" />

                            <x-text-input id="kata_kunci_eng" class="block mt-1 w-full" type="text"
                                name="kata_kunci_eng" :value="old('kata_kunci_eng',$tugasAkhir->kata_kunci_eng)"
                                required autofocus />

                            <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" />
                        </div>

                        <!-- link_laporan_final -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Laporan Final</label>

                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_laporan_final" name="link_laporan_final"
                                type="file">
                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_laporan_final) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>

                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_laporan_final"
                                value="{{ $tugasAkhir->link_laporan_final }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>

                        <!-- link_artikel -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Artikel</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_artikel" name="link_artikel" type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_artikel) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_artikel" value="{{ $tugasAkhir->link_artikel }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>

                        <!-- link_pendahuluan -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Pendahuluan</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_pendahuluan" name="link_pendahuluan"
                                type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_pendahuluan) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_pendahuluan"
                                value="{{ $tugasAkhir->link_pendahuluan }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_abstrak -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Abstrak</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_abstrak" name="link_abstrak" type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_abstrak) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_abstrak" value="{{ $tugasAkhir->link_abstrak }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab1 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab I</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab1" name="link_bab1" type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_bab1) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_bab1" value="{{ $tugasAkhir->link_bab1 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab2 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab II</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab2" name="link_bab2" type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_bab2) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_bab2" value="{{ $tugasAkhir->link_bab2 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab3 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab III</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab3" name="link_bab3" type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_bab3) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_bab3" value="{{ $tugasAkhir->link_bab3 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab4 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab IV</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab4" name="link_bab4" type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_bab4) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_bab4" value="{{ $tugasAkhir->link_bab4 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab5 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab V</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab5" name="link_bab5" type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_bab5) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_bab5" value="{{ $tugasAkhir->link_bab5 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_daftar_pustaka -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Daftar Pustaka</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_daftar_pustaka" name="link_daftar_pustaka"
                                type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_daftar_pustaka) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_daftar_pustaka"
                                value="{{ $tugasAkhir->link_daftar_pustaka }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_lampiran -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Lampiran</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_lampiran" name="link_lampiran" type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_lampiran) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_lampiran" value="{{ $tugasAkhir->link_lampiran }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_biodata -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Biodata</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_biodata" name="link_biodata" type="file">

                            <a href="{{ asset('storage/' .$tugasAkhir->NIM. '/dokumen_final/' . $tugasAkhir->link_biodata) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <input type="hidden" name="old_link_biodata" value="{{ $tugasAkhir->link_biodata }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>

                        <div class="mt-4 flex flex-col">
                            <h3 class="font-medium capitalize">File yang dapat diakses user</h3>
                            <div>
                                <label for="laporan final">
                                    <input type="checkbox" name="akses_user[]" id="laporan final" value="laporan final"
                                        {{ in_array("laporan final", $akses_user) ? 'checked' : '' }}>
                                    Laporan Final
                                </label>
                            </div>
                            <div>
                                <label for="artikel">
                                    <input type="checkbox" name="akses_user[]" id="artikel" value="artikel"
                                        {{ in_array("artikel", $akses_user) ? 'checked' : '' }}>
                                    Artikel
                                </label>
                            </div>
                            <div>
                                <label for="pendahuluan">
                                    <input type="checkbox" name="akses_user[]" id="pendahuluan" value="pendahuluan"
                                        {{ in_array("pendahuluan", $akses_user) ? 'checked' : '' }}>
                                    Pendahuluan
                                </label>
                            </div>
                            <div>
                                <label for="abstrak_cb">
                                    <input type="checkbox" name="akses_user[]" id="abstrak_cb" value="abstrak"
                                        {{ in_array("abstrak", $akses_user) ? 'checked' : '' }}>
                                    Abstrak
                                </label>
                            </div>
                            <div>
                                <label for="bab i">
                                    <input type="checkbox" name="akses_user[]" id="bab i" value="bab i"
                                        {{ in_array("bab i", $akses_user) ? 'checked' : '' }}>
                                    Bab I
                                </label>
                            </div>
                            <div>
                                <label for="bab ii">
                                    <input type="checkbox" name="akses_user[]" id="bab ii" value="bab ii"
                                        {{ in_array("bab ii", $akses_user) ? 'checked' : '' }}>
                                        Bab II
                                </label>
                            </div>
                            <div>
                                <label for="bab iii">
                                    <input type="checkbox" name="akses_user[]" id="bab iii" value="bab iii"
                                        {{ in_array("bab iii", $akses_user) ? 'checked' : '' }}>
                                        Bab III
                                </label>
                            </div>
                            <div>
                                <label for="bab iv">
                                    <input type="checkbox" name="akses_user[]" id="bab iv" value="bab iv"
                                        {{ in_array("bab iv", $akses_user) ? 'checked' : '' }}>
                                        Bab IV
                                </label>
                            </div>
                            <div>
                                <label for="bab v">
                                    <input type="checkbox" name="akses_user[]" id="bab v" value="bab v"
                                        {{ in_array("bab v", $akses_user) ? 'checked' : '' }}>
                                        Bab V
                                </label>
                            </div>
                            <div>
                                <label for="daftar pustaka">
                                    <input type="checkbox" name="akses_user[]" id="daftar pustaka"
                                        value="daftar pustaka"
                                        {{ in_array("daftar pustaka", $akses_user) ? 'checked' : '' }}>
                                    Daftar Pustaka
                                </label>
                            </div>
                            <div>
                                <label for="lampiran">
                                    <input type="checkbox" name="akses_user[]" id="lampiran" value="lampiran"
                                        {{ in_array("lampiran", $akses_user) ? 'checked' : '' }}>
                                    Lampiran
                                </label>
                            </div>
                            <div>
                                <label for="biodata">
                                    <input type="checkbox" name="akses_user[]" id="biodata" value="biodata"
                                        {{ in_array("biodata", $akses_user) ? 'checked' : '' }}>
                                    Biodata
                                </label>
                            </div>
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                            </a> --}}

                            <x-primary-button class="ml-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>