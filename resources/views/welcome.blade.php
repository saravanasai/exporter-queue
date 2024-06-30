<!doctype html>
<html lang="en">

<head>
    <title>Xo-Game</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    {{-- <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> --}}
    {{-- @vite('resources/js/app.js') --}}
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Report Exporter</a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" aria-current="page">Home
                                <span class="visually-hidden">(current)</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>


    </header>
    <main>

        <div class="container mt-4">

            <p class="lead">
                Hello ! {{ auth()->user()->name }}
            </p>



            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Report ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr class="">
                                <td scope="row">{{ $report->id }}</td>
                                <td>{{ $report->name }}</td>
                                <td><a data-name="{{ $report->name }}" data-id="{{ $report->id }}"
                                        name="Export-{{ $report->id }}" id="Export-{{ $report->id }}"
                                        class="btn btn-success export-btn" href="#" role="button">Export</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <script src="{{ asset('build/assets/app-D8MUvmVC.js') }}"></script>

    <script>
        let exportBtns = document.getElementsByClassName("export-btn")

        var exportHandler = function(e) {
            reportName = this.getAttribute("data-name");
            reportId = this.getAttribute("data-id");
            console.log(reportName, reportId, e.target)
            e.target.textContent = "Loading..";
            e.target.classList.replace("btn-success", "btn-primary")

            fetch(`/export?id=${reportId}`)
                .then(response => {
                    alert("Report Started exporting");
                    Echo.private(`report.${reportId}`)
                        .listen('ExportReportEvent', (e) => {
                            element = document.getElementById(`Export-${e.reportId}`)
                            element.textContent = "Export";
                            element.classList.replace("btn-primary", "btn-success")
                            console.log(e);
                        });
                })


        };

        for (var i = 0; i < exportBtns.length; i++) {

            exportBtns[i].addEventListener('click', exportHandler, false);
        }
    </script>
</body>

</html>
