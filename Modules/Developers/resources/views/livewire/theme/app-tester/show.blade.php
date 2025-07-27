<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('developers::components.layouts.master', ['navbarClass' => 'bg-primary'])] class extends Component {
    public $pageTitle = 'Testing Invitation';
}; ?>
<div>
    <div class="bg-primary wave-bottom-border">
        <main
            class="relative z-10 flex flex-col items-center justify-center min-h-[calc(100vh-260px)] px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="text-center max-w-4xl mx-auto">

                <h2 x-data="{
                startingAnimation: { opacity: 0, y: 50, rotation: '25deg' },
                endingAnimation: { opacity: 1, y: 0, rotation: '0deg', stagger: 0.02, duration: 0.7, ease: 'back' },
                addCNDScript: true,
                splitCharactersIntoSpans(element) {
                    text = element.innerHTML;
                    modifiedHTML = [];
                    for (var i = 0; i < text.length; i++) {
                        attributes = '';
                        if (text[i].trim()) { attributes = 'class=\'inline-block\''; }
                        modifiedHTML.push('<span ' + attributes + '>' + text[i] + '</span>');
                    }
                    element.innerHTML = modifiedHTML.join('');
                },

                addScriptToHead(url) {
                    script = document.createElement('script');
                    script.src = url;
                    document.head.appendChild(script);
                },
                animateText() {
                    $el.classList.remove('invisible');
                    gsap.fromTo($el.children, this.startingAnimation, this.endingAnimation);
                }
            }" x-init="splitCharactersIntoSpans($el);
            if (addCNDScript) {
                addScriptToHead('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js');
            }
            gsapInterval2 = setInterval(function() {
                if (typeof gsap !== 'undefined') {
                    animateText();
                    clearInterval(gsapInterval2);
                }
            }, 5);"
                    class="invisible block pb-0.5 overflow-hidden text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-amber-50 mb-3 sm:mb-6 leading-tight">
                    You're Invited to Test!
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl text-amber-50 mb-8 max-w-2xl mx-auto">
                    {{ $tester->invitedBy->name }} wants you to help test their application
                </p>

            </div>
        </main>
    </div>
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8 {{-- text-white --}}">
        <div class="p-8">
            <!-- App Information -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <div class="flex items-start space-x-4">
                    <div class="w-16 h-16 bg-primary rounded-lg flex items-center justify-center">
                        <span class="text-white text-xl font-bold">
                            {{ substr($tester->oauthApp->name, 0, 2) }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $tester->oauthApp->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ $tester->oauthApp->description ?? 'An innovative application on the Arabhardware platform.' }}</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Created by {{ $tester->invitedBy->name }}
                        </div>
                    </div>
                </div>
            </div>

            @if($tester->message)
            <!-- Personal Message -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8">
                <h3 class="text-lg font-medium text-blue-900 mb-3">Personal Message</h3>
                <blockquote class="text-blue-800 italic text-lg leading-relaxed">
                    "{{ $tester->message }}"
                </blockquote>
                <p class="text-blue-600 text-sm mt-3">— {{ $tester->invitedBy->name }}</p>
            </div>
            @endif

            <!-- What This Means -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">What does this mean?</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Early Access</h4>
                            <p class="text-gray-600 text-sm">Get access to new features before they're public</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Bug Testing</h4>
                            <p class="text-gray-600 text-sm">Help identify and report issues</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Direct Feedback</h4>
                            <p class="text-gray-600 text-sm">Communicate directly with the development team</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Recognition</h4>
                            <p class="text-gray-600 text-sm">Be recognized as a valued community contributor</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <form action="{{ route('app-tester.accept', $tester->invitation_token) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Accept Invitation
                    </button>
                </form>

                <form action="{{ route('app-tester.reject', $tester->invitation_token) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Decline
                    </button>
                </form>
            </div>

            <!-- Footer Note -->
            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 text-center">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    This invitation is specifically for {{ $tester->email }} and cannot be transferred.
                    If you didn't expect this invitation, you can safely decline it.
                </p>
            </div>
        </div>
    </div>
</div>
