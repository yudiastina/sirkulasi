<x-app-layout>
    <x-slot name="header">
        {{ __('Kerja Praktek') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <div class="px-6 py-4">
                    <form method="post" action="{{ route('admin.kp.update', [ $kerjaPraktek->id ]) }}"
                        class="mt-6 space-y-6" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <!-- THNAKA -->
                        <div class="mt-4">
                            <x-input-label for="THNAKA" :value="__('THNAKA')" />

                            <x-text-input id="THNAKA" class="block mt-1 w-full" type="text" name="THNAKA"
                                :value="old('THNAKA', $kerjaPraktek->THNAKA)" required autofocus />

                            <x-input-error :messages="$errors->get('THNAKA')" class="mt-2" />
                        </div>

                        <!-- Periode -->
                        <div class="mt-4">
                            <x-input-label for="Periode" :value="__('Periode')" />

                            <x-text-input id="Periode" class="block mt-1 w-full" type="text" name="Periode"
                                :value="old('Periode',$kerjaPraktek->Periode)" required autofocus />

                            <x-input-error :messages="$errors->get('Periode')" class="mt-2" />
                        </div>

                        <!-- nim -->
                        <div class="mt-4">
                            <x-input-label for="nim" :value="__('NIM')" />

                            <x-text-input id="nim" class="block mt-1 w-full bg-gray-200" type="number" name="nim"
                                :value="old('nim',$kerjaPraktek->nim)" disabled />

                            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                        </div>

                        <!-- DOSEN_PEMB Address -->
                        <div class="mt-4">
                            <x-input-label for="DOSEN_PEMB" :value="__('DNSID Pembimbing')" />

                            <x-text-input id="DOSEN_PEMB" class="block mt-1 w-full" type="text" name="DOSEN_PEMB"
                                :value="old('DOSEN_PEMB',$kerjaPraktek->DOSEN_PEMB)" required />

                            <x-input-error :messages="$errors->get('DOSEN_PEMB')" class="mt-2" />
                        </div>
                        <!-- nmdosen Address -->
                        <div class="mt-4">
                            <x-input-label for="nmdosen" :value="__('Pembimbing')" />

                            <x-text-input id="nmdosen" class="block mt-1 w-full" type="text" name="nmdosen"
                                :value="old('nmdosen',$kerjaPraktek->nmdosen)" required />

                            <x-input-error :messages="$errors->get('nmdosen')" class="mt-2" />
                        </div>

                        <!-- judul_final -->
                        <div class="mt-4">
                            <x-input-label for="judul_final" :value="__('Judul Final')" />

                            <x-text-input id="judul_final" class="block mt-1 w-full" type="text" name="judul_final"
                                :value="old('judul_final',$kerjaPraktek->judul_final)" required autofocus />

                            <x-input-error :messages="$errors->get('judul_final')" class="mt-2" />
                        </div>

                        <!-- link_laporan_final -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Laporan Final</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_laporan_final" name="link_laporan_final"
                                type="file">
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <a href="{{ asset('storage/' .$kerjaPraktek->NIM. '/dokumen_final/' . $kerjaPraktek->link_laporan_final) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            <input type="hidden" name="old_link_laporan_final"
                                value="{{ $kerjaPraktek->link_laporan_final }}">
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
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <a href="{{ asset('storage/' .$kerjaPraktek->NIM. '/dokumen_final/' . $kerjaPraktek->link_pendahuluan) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            <input type="hidden" name="old_link_pendahuluan"
                                value="{{ $kerjaPraktek->link_pendahuluan }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>

                        <!-- link_bab1 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab I</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab1" name="link_bab1" type="file">
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <a href="{{ asset('storage/' .$kerjaPraktek->NIM. '/dokumen_final/' . $kerjaPraktek->link_bab1) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            <input type="hidden" name="old_link_bab1" value="{{ $kerjaPraktek->link_bab1 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab2 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab II</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab2" name="link_bab2" type="file">
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <a href="{{ asset('storage/' .$kerjaPraktek->NIM. '/dokumen_final/' . $kerjaPraktek->link_bab2) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            <input type="hidden" name="old_link_bab2" value="{{ $kerjaPraktek->link_bab2 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab3 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab III</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab3" name="link_bab3" type="file">
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <a href="{{ asset('storage/' .$kerjaPraktek->NIM. '/dokumen_final/' . $kerjaPraktek->link_bab3) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            <input type="hidden" name="old_link_bab3" value="{{ $kerjaPraktek->link_bab3 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab4 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab IV</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab4" name="link_bab4" type="file">
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <a href="{{ asset('storage/' .$kerjaPraktek->NIM. '/dokumen_final/' . $kerjaPraktek->link_bab4) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            <input type="hidden" name="old_link_bab4" value="{{ $kerjaPraktek->link_bab4 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab5 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab V</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab5" name="link_bab5" type="file">
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <a href="{{ asset('storage/' .$kerjaPraktek->NIM. '/dokumen_final/' . $kerjaPraktek->link_bab5) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            <input type="hidden" name="old_link_bab5" value="{{ $kerjaPraktek->link_bab5 }}">
                            {{-- <x-input-error :messages="$errors->get('kata_kunci_eng')" class="mt-2" /> --}}

                        </div>
                        <!-- link_bab6 -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">Upload Bab VII</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="link_bab6" name="link_bab6" type="file">
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <a href="{{ asset('storage/' .$kerjaPraktek->NIM. '/dokumen_final/' . $kerjaPraktek->link_bab6) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            <input type="hidden" name="old_link_bab6" value="{{ $kerjaPraktek->link_bab6 }}">
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
                            {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                JPG or GIF (MAX. 800x400px).</p> --}}
                            <a href="{{ asset('storage/' .$kerjaPraktek->NIM. '/dokumen_final/' . $kerjaPraktek->link_daftar_pustaka) }}"
                                class="capitalize text-sm text-gray-600 underline hover:text-blue-800" target="_blank">
                                lihat file sebelumnya</a>
                            <input type="hidden" name="old_link_daftar_pustaka"
                                value="{{ $kerjaPraktek->link_daftar_pustaka }}">
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
                                <label for="pendahuluan">
                                    <input type="checkbox" name="akses_user[]" id="pendahuluan" value="pendahuluan"
                                        {{ in_array("pendahuluan", $akses_user) ? 'checked' : '' }}>
                                    Pendahuluan
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
                                <label for="bab vi">
                                    <input type="checkbox" name="akses_user[]" id="bab vi" value="bab vi"
                                        {{ in_array("bab vi", $akses_user) ? 'checked' : '' }}>
                                    Bab VI
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
                        </div>

                        <div class="flex items-center justify-end mt-4">
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