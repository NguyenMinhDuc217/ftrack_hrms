<main class="flex-grow overflow-auto">
    <style>
        .container {
            max-width: 1340px !important;
        }
        /* .page {
            max-width: 100vw !important;
        } */
        header .page {
            max-width: 1340px !important;
        }
    </style>
    @include('client.home.banner')

    @include('client.home.job-list')

    @include('client.home.statistical')

    @include('client.home.register-cv')

</main>