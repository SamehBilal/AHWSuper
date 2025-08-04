@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <div class="font-medium text-2xl [&:has(+[data-flux-subheading])]:mb-2 [[data-flux-subheading]+&]:mt-2">{{ $title }}</div>
    <div class="text-sm">{{ $description }}</div>
</div>
