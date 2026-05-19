<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="mt-6 p-4 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-white dark:bg-neutral-900">
            @include('livewire.notes', ['notes' => $notes, 'tags' => $tags])
        </div>

        <div class="mt-6 p-4 border border-neutral-200 dark:border-neutral-700 rounded-xl bg-white dark:bg-neutral-900">
            @include('livewire.tag-form')
        </div>

    </div>
</x-layouts.app>
