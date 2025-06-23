<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div
                class="relative aspect-video overflow-hidden rounded-xl {{-- border border-neutral-200 dark:border-neutral-700 --}}">
                {{-- <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                     <x-mary-stat  class="bg-white text-gray-900" title="Messages" value="44" icon="o-envelope" tooltip="Hello" color="text-primary" />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl {{-- border border-neutral-200 dark:border-neutral-700 --}}">
                <x-mary-stat title="Sales" description="This month" value="22.124" icon="o-arrow-trending-up"
                tooltip-bottom="There" />
                {{-- <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl {{-- border border-neutral-200 dark:border-neutral-700 --}}">
               {{--  <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                    <x-mary-stat title="Lost" description="This month" value="34" icon="o-arrow-trending-down"
                tooltip-left="Ops!" />
            </div>

            <div
                class="relative aspect-video overflow-hidden rounded-xl {{-- border border-neutral-200 dark:border-neutral-700 --}}">
               {{--  <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                    <x-mary-stat title="Sales" description="This month" value="22.124" icon="o-arrow-trending-down"
                class="text-orange-500" color="text-pink-500" tooltip-right="Gosh!" />
            </div>


        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
