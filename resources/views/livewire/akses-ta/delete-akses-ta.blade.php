<div class="p-8">
    <div class="flex flex-col">
        <h3 class="uppercase font-semibold text-center text-lg">Are You Sure Want To Delete ?</h3>
        <div class="">
        </div>

    </div>

    <div class="flex flex-row gap-4 mt-8 justify-center">
        <button wire:click="cancel" class="bg-gray-500 px-4 py-2 text-white text-lg rounded-md">cancel</button>
        <Form wire:submit.prevent='destroy({{ $aksesTugasAkhirId }})'>
            <button class="bg-red-600 px-4 py-2 text-white text-lg rounded-md">Delete</button>
        </Form>
    </div>
</div>
