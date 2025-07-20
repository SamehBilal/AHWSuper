<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('developers::components.layouts.master', ['navbarClass' => 'bg-primary'])] class extends Component {
    public $pageTitle = 'Privacy Policy';
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
                    Privacy Policy
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl text-amber-50 mb-8 max-w-2xl mx-auto">
                    Your privacy matters. Learn how we protect your data and your rights.
                </p>

            </div>
        </main>
    </div>
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8 {{-- text-white --}}">
        <!-- Main Content -->

        <h2 class="text-2xl font-semibold mt-8 mb-4">Overview</h2>
        <p class="mb-4">This Privacy Policy explains in detail how we collect, use, and store the data of users of
            Arabhardware services, which we collect through your use of our website, applications, and electronic
            services managed and controlled by the parent company Arabsoftware FZE, located in Dubai Silicon Oasis, UAE,
            and Arabhardware (LLC), located in 6th of October City, Egypt. The terms in this document apply to
            Arabhardware and all its subsidiaries and websites, including (Arabhardware website, Arabhardware Store),
            referred to in this document as (we, Arabhardware). This document covers information collected directly
            through services fully controlled by Arabhardware and does not cover privacy data collected by other sites
            such as YouTube or social media. For more information about the privacy policies of those other sites,
            please visit each site individually.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Privacy Policy on Arabhardware Website</h2>
        <p class="mb-4">Arabhardware is committed to protecting your privacy and ensuring the security of your personal
            information. This Privacy Policy explains the types of personal information we collect, how we use,
            disclose, and protect it.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">What Does This Privacy Policy Apply To?</h2>
        <p class="mb-4">This Privacy Policy applies to personal information we collect in connection with the services
            we provide, including information collected through our website and social media pages managed by
            Arabhardware. This Privacy Policy is an integral part of the Terms of Use of the Arabhardware website.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Your Consent</h2>
        <p class="mb-4">By using the Arabhardware website, you agree to the terms of this Privacy Policy. We will not
            collect, use, or disclose your personal information without your consent. In most cases, we will ask for
            your explicit consent, but in other cases, we may infer your consent from your use of the services.</p>
        <p class="mb-4">By using any of Arabhardware's sites, you agree to our collection, use, and disclosure of your
            personal information in accordance with this Privacy Policy. We may request additional consent if we need to
            use your personal information for purposes not covered by this Privacy Policy. You are not required to
            provide such consent, but if you choose not to, your participation in certain activities may be limited. If
            you provide additional consent, the terms of that consent will apply in case of any conflict with this
            Privacy Policy.</p>
        <p class="mb-4">If you do not agree to the collection, use, and disclosure of your personal information as
            described, please do not use the Arabhardware website or provide us with your personal information in any
            other way.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">What Information Do We Collect?</h2>
        <p class="mb-4">In this Privacy Policy, "personal information" means information or pieces of information that
            could identify you. This typically includes your name, address, username, email address, and phone number,
            and may also include other information such as your IP address, shopping habits, preferences, and lifestyle
            or interest information. We may collect personal information about you from different sources, including:
        </p>
        <ul class="list-disc pl-6 mb-4">
            <li>Information you provide to us directly</li>
            <li>Information we collect automatically when you use the Arabhardware website</li>
            <li>Information we collect from other sources</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-8 mb-4">How Do We Use Your Personal Information?</h2>
        <p class="mb-4">We may use your personal information to:</p>
        <ul class="list-disc pl-6 mb-4">
            <li>Improve our products and your experience on the Arabhardware website</li>
            <li>Provide you with the products and services you request from us</li>
        </ul>
        <p class="mb-4">If we collect personal information for a specific purpose, we will not retain it longer than
            necessary to fulfill that purpose, unless we are required to retain it for legitimate business or legal
            reasons. To protect information from accidental or intentional destruction, when we delete information from
            our services, we may not immediately delete residual copies from our servers or remove information from our
            backup systems.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Who Do We Share Your Personal Information With?</h2>
        <p class="mb-4">We do not share your personal information with anyone outside Arabhardware. However, we may
            share your personal information with trusted third parties, in which case the information is anonymized and
            not linked to your personal data.</p>
        <p class="mb-4">If we share your personal information with third parties, we will do our best to ensure they
            keep your information secure and take all reasonable steps to protect it from misuse and only use it in a
            manner consistent with this Privacy Policy and applicable data protection laws and regulations.</p>
        <p class="mb-4">Arabhardware does not sell personal information.</p>
        <p class="mb-4">We may transfer your personal information to servers located outside your country of residence
            or to affiliates or trusted third parties in other countries so that they may process personal information
            on our behalf. By using the Arabhardware website or providing your personal information in any other way,
            you consent to this in accordance with this Privacy Policy and applicable data protection laws and
            regulations.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Protecting Your Personal Information</h2>
        <p class="mb-4">We take all appropriate precautions to keep your personal information secure and require the
            same from any third party who handles or processes your personal information on our behalf. Access to your
            personal information is restricted to prevent unauthorized access, modification, or misuse, and is only
            available to our employees on a need-to-know basis.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Deleting Your Personal Data</h2>
        <p class="mb-4">You have the right to request the prevention of use and deletion of your stored personal data.
            To do so, please contact us at <a href="mailto:info@arabhardware.net"
                class="underline">info@arabhardware.net</a> and your request will be answered as soon as possible.</p>
    </div>
</div>