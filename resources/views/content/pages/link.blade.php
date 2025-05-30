<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Join</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .pageContainer {
            height: 100vh;
            place-items: center;
            display: grid;
        }
    </style>
</head>

<body>
    <div class="pageContainer">
        <button class="btn btn-primary text-align-center" id="mark-attendance-btn" onclick="confirmJoin()">Join
            Class</button>
    </div>

    <script>
        let studentToken = "{{ $studentToken }}";
        let zoomToken = "{{ $zoomToken }}";
        let batchToken = "{{ $batchToken }}";

        let url = `/zoom-link?student_id=${studentToken}&zoom_id=${zoomToken}&batch_id=${batchToken}`;

        $(document).ready(function() {
            $("#mark-attendance-btn").trigger('click');
        });

        function confirmJoin() {
            Swal.fire({
                title: "Mark Attendance",
                text: "Join the class to mark your attendance",
                showCancelButton: true,
                confirmButtonColor: "#14A44D",
                cancelButtonColor: "#DC4C64",
                confirmButtonText: "Join Now"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: url,

                        error: function(err) {
                            console.log($($(err.responseText)[1]).text())
                        }
                    }).promise().then(function(data) {

                        if (data === "true") {
                            Swal.fire("Your Attendence is already Marked");
                        } else {
                            console.log(data);
                            let redirectUrl = data[0].link;
                            console.log(redirectUrl);
                            window.location.href = redirectUrl;

                        }

                    });

                }
            })
        }
    </script>

</body>

</html>
