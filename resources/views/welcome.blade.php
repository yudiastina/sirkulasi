<x-main-layout>
    <div x-data="{ TugasAkhir: true }">
        <div class="py-20">
            <div class="container mx-auto flex flex-col py-20">
                <h1 class="uppercase text-center text-3xl py-2">cari</h1>
                <div class="text-center py-2 flex-row space-x-1">

                    <button @click="TugasAkhir = true" :class="{
                        'border-b-4 border-red-600 font-bold bg-gray-100': TugasAkhir, 
                        'border-b-4 border-white hover:border-gray-400 hover:bg-gray-50': ! TugasAkhir}"
                        class="capitalize transition duration-500 ease-in-out p-2">
                        tugas akhir
                    </button>
                    
                    <button @click="TugasAkhir = false" :class="{
                        'border-b-4 border-white hover:border-gray-400 hover:bg-gray-50': TugasAkhir, 
                        'border-b-4 border-red-600 font-bold bg-gray-100': ! TugasAkhir}"
                        class="capitalize transition duration-500 ease-in-out p-2">
                        kerja praktek
                    </button>

                </div>
                <span x-show="TugasAkhir" class="text-center mb-4 capitalize">
                    masukkan satu atau lebih kata dari judul, kata kunci, abstrak laporan tugas akhir
                </span>
                <span x-show="!TugasAkhir" class="text-center mb-4 capitalize">
                    masukkan satu atau lebih kata dari judul laporan kerja praktek
                </span>
                <div class=" w-full md:w-2/3 mx-auto mb-4">

                    <div :class="{'block': TugasAkhir, 'hidden': ! TugasAkhir}" class=" space-y-4">
                        <x-search></x-search>
                    </div>
                    <div :class="{'hidden': TugasAkhir, 'block': ! TugasAkhir}" class=" space-y-4">
                        <x-search-kp></x-search-kp>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</x-main-layout>