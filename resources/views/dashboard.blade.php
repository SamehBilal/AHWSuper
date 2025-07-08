@php
    $breadcrumbs = [
        [
            'label' => 'Home',
            'icon' => 'm-home',
            'tooltip-left' => 'Tooltips are supported!',
        ],
        [
            'label' => 'Documents',
            'link' => '/docs/components/breadcrumbs',
            'tooltip' => 'Default position is top!',
        ],
        [
            'label' => 'Edit document',
            'tooltip-bottom' => 'Positions are changable!',
        ],
    ];
@endphp
<x-layouts.app :title="__('Arabhardware | Dashboard')">

    <x-mary-breadcrumbs
    :items="$breadcrumbs"
    separator="o-slash"
    separator-class="text-primary"
    class=" p-3 rounded-box"
    icon-class="text-primary"
    link-item-class="text-sm font-bold"
/>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <x-mary-stat class="border border-neutral-200 dark:border-neutral-700" title="Messages" value="44"
                icon="o-envelope" tooltip="Hello" color="text-primary" />

            <x-mary-stat class="border border-neutral-200 dark:border-neutral-700" title="Sales" description="This month"
                value="22.124" icon="o-arrow-trending-up" tooltip-bottom="There" />

            <x-mary-stat class="border border-neutral-200 dark:border-neutral-700" title="Lost"
                description="This month" value="34" icon="o-arrow-trending-down" tooltip-left="Ops!" />

            <x-mary-stat title="Sales" description="This month" value="22.124" icon="o-arrow-trending-down"
                class="text-orange-500 border border-neutral-200 dark:border-neutral-700" color="text-pink-500"
                tooltip-bottom="Gosh!" />
        </div>

        <ul class="timeline">
            <li>
              <div class="timeline-start">1984</div>
              <div class="timeline-middle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  class="h-5 w-5"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <div class="timeline-end timeline-box">First Macintosh computer</div>
              <hr />
            </li>
            <li>
              <hr />
              <div class="timeline-start">1998</div>
              <div class="timeline-middle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  class="h-5 w-5"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <div class="timeline-end timeline-box">iMac</div>
              <hr />
            </li>
            <li>
              <hr />
              <div class="timeline-start">2001</div>
              <div class="timeline-middle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  class="h-5 w-5"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <div class="timeline-end timeline-box">iPod</div>
              <hr />
            </li>
            <li>
              <hr />
              <div class="timeline-start">2007</div>
              <div class="timeline-middle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  class="h-5 w-5"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <div class="timeline-end timeline-box">iPhone</div>
              <hr />
            </li>
            <li>
              <hr />
              <div class="timeline-start">2015</div>
              <div class="timeline-middle">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  class="h-5 w-5"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <div class="timeline-end timeline-box">Apple Watch</div>
            </li>
          </ul>

        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
