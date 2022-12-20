<div>
    <div class="px-6 py-4">
        <form action="{{ route('admin.users.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="" class="text-lg font-semibold">Upload Data User</label>
                <input type="file" name="csv_file" id="" class="mt-4 block w-full">
            </div>
            <div>
            <button type="submit"
                class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">import
                data</button>
            </div>
        </form>
    </div>
</div>