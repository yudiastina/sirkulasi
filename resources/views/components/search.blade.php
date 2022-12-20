<form action="/tugas-akhir/" class="items-center z-0">
    <div class="relative px-4 z-0">
        <div class="absolute top-4 left-8">
            <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
        </div>

        <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-full z-0 shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            placeholder="Laporan Tugas Akhir" value="{{ request('search') }}"/>
        <div class="md:absolute md:top-0 md:right-4 mt-2 mb-4 md:mt-0 md:mb-0">
            <button type="submit"
                class="w-full  h-14 md:w-20 text-white rounded-full md:rounded-r-full md:rounded-l-none bg-pink-600 hover:bg-pink-800 transition duration-500 ease-in-out">
                Search
            </button>
        </div>
    </div>
</form>