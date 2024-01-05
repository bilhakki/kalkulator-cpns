<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Kalkulator CPNS</title>

    <!-- Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
        rel="stylesheet"
    />

    <script src="https://cdn.tailwindcss.com"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs/0.4.3/fingerprint.min.js"
        integrity="sha512-AoIagR7lcH4NCvJqKXxUCBFTpJjSKwEN8+RnWAHhXIN9strU2y4fEMguDgVbO8piyjmOf/aeZXWqpkCTmDFBGQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>
</head>

<body class="min-h-[100vh] w-full bg-gray-800 text-white antialiased">

    <div class="flex min-h-screen flex-col justify-center py-6 sm:py-12">
        <div class="relative w-full py-3 sm:mx-auto sm:max-w-4xl">
            <div class="relative mx-8 rounded-3xl rounded-lg bg-gray-900 px-4 py-10 shadow sm:p-10 md:mx-0">
                <div class="">
                    <div class="flex flex-col justify-between md:flex-row">
                        <div class="mb-4 flex items-center space-x-5">
                            <div
                                class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-yellow-200 font-mono text-2xl text-yellow-500">
                                i
                            </div>
                            <div class="block self-start pl-2 text-xl font-semibold">
                                <h2 class="leading-relaxed">Kalkulator CPNS</h2>
                                <p class="text-sm font-normal leading-relaxed">Hitung nilai SKD, SKB, Wawancara dan TPK
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center justify-center rounded-lg bg-white px-4 pt-1 text-black">
                            <p class="font-medium">Nilai : </p>
                            <p
                                class="font-bold"
                                id="totalNilai"
                                style="font-size: 2.5rem;
                            line-height: 1.9rem;
                            padding-bottom: 0.7rem;"
                            >0</p>
                        </div>

                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="grid grid-cols-2 gap-4 py-8 text-base leading-6 sm:text-lg sm:leading-7">
                            <div class="flex flex-col">
                                <label class="text-sm leading-loose">SKD (40%)</label>
                                <input
                                    class="w-full rounded-md border border-gray-300 bg-gray-800 px-4 py-2 focus:border-gray-900 focus:outline-none focus:ring-gray-500 sm:text-sm"
                                    type="number"
                                    value="0"
                                    placeholder="SKD"
                                    name="skd"
                                >
                            </div>
                            <div class="flex flex-col">
                                <label class="text-sm leading-loose">SKB CAT (30%)</label>
                                <input
                                    class="w-full rounded-md border border-gray-300 bg-gray-800 px-4 py-2 focus:border-gray-900 focus:outline-none focus:ring-gray-500 sm:text-sm"
                                    value="0"
                                    type="number"
                                    placeholder="SKB CAT"
                                    name="skb"
                                >
                            </div>
                            <div class="flex flex-col opacity-50">
                                <label class="text-sm leading-loose">Wawancara (15%)</label>
                                <input
                                    class="w-full rounded-md border border-gray-300 bg-gray-800 px-4 py-2 focus:border-gray-900 focus:outline-none focus:ring-gray-500 sm:text-sm"
                                    type="number"
                                    placeholder="Wawancara"
                                    name="wawancara"
                                    value="90"
                                    disabled
                                >
                            </div>
                            <div class="flex flex-col opacity-50">
                                <label class="text-sm leading-loose">Tes Praktik Kerja (15%)</label>
                                <input
                                    class="w-full rounded-md border border-gray-300 bg-gray-800 px-4 py-2 focus:border-gray-900 focus:outline-none focus:ring-gray-500 sm:text-sm"
                                    type="number"
                                    placeholder="Tes Praktik Kerja"
                                    name="tpk"
                                    value="90"
                                    disabled
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/script.js') }}"></script>
</body>

</html>
