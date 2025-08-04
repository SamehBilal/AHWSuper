<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
@if (@$noIndex)
    <meta name="robots" content="noindex">
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user-id" content="{{ auth()->id() }}">

{{-- <meta name="pgToken" content="{{ csrf_token() }}"> --}}

<title>{{ $pageTitle ?? "Arabhardware" }}</title>

{{-- <link rel="preload" href="https://arabhardware.net/theme-assets/fonts/helvetica/HelveticaNeuellight.woff2" as="font" type="font/woff2" crossorigin> --}}
<link rel="shortcut icon" href="{{ @$favicon ?? /* url('favicon.png') */"https://arabhardware.net/favicon.png" }} " type="image/x-icon">
<link rel="canonical" href="{{ @$canonical }}">
<meta name="description" content="{{ strip_tags(@$description) }}" />
<meta name="keywords" content="{{ @$keywords ?? '' }}">
<meta name="author" content="{{ @$author ?? '' }}">
<meta name="twitter:title" content="{{ @$stitle }}" />
<meta name="twitter:site" content="{{ URL('') }}" />
<meta name="twitter:creator" content="عرب هاردوير" />
<meta name="twitter:description" content="{{ strip_tags(@$description) }}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="{{ @$image ? $image : /* url('share.png') */"https://arabhardware.net/storage/uploads/settings//site_simage.webp" }}" />
<meta name="theme-color" content="{{ $themecolor ?? '#d70a15' }}" />
<meta property="og:url" content="{{ @$canonical }}" />
<meta property="og:title" content="{{ @$stitle }}" />
<meta property="og:description" content="{{ strip_tags(@$description) }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ @$image ? $image : /* url('share.png') */"https://arabhardware.net/storage/uploads/settings//site_simage.webp" }}" />

<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@vite(['modules/developers/resources/assets/css/app.css', 'modules/developers/resources/assets/js/app.js'], 'build-developers')

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

{{-- @if (!empty(@$gschema))
    <script type="application/ld+json">
        {!! @$gschema !!}
    </script>
@else
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "Corporation",
        "name": "Arabhardware",
        "alternateName": "عرب هاردوير",
        "url": "{{ url('') }}",
        "logo": "{{url('business-assets/images/logo.svg')}}",
        "sameAs": [
            "{{ @$set->site_facebook }}",
            "{{ @$set->site_twitter }}",
            "{{ @$set->site_youtube }}",
            "{{ @$set->site_instagram }}",
            "{{ @$set->site_tiktok }}",
            "{{ @$set->site_tiktok }}"
        ]
        }
    </script>
@endif

@if (Route::has('post.search'))
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "WebSite",
        "name": "arabhardware",
        "url": "{{url('')}}",
        "potentialAction": {
        "@type": "SearchAction",
        "target": "{{route('post.search')}}?s={search_term_string}",
        "query-input": "required name=search_term_string"
        }
    }
</script>
@endif
@if (!empty(@$breadcrumblist))
    <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "BreadcrumbList",
            "itemListElement": [@json($breadcrumblist)]
        }
    </script>
@endif--}}
@stack('rsnippets')
@stack('header')
@guest
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1196873931302632"
        crossorigin="anonymous"></script>
@endguest
@guest
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1196873931302632"
        crossorigin="anonymous"></script>
@endguest
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4Q0YRG9XSF"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-4Q0YRG9XSF');
</script>

