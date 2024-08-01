@extends('layouts.dashboard')
@section('breadcrums')
    <div class="mt-3">
        @include('pages.breadcrums')
    </div>
@endsection
@section('content')
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, Roboto, Segoe UI,
                Helvetica Neue, Helvetica, Arial, sans-serif;
            margin: 0 auto;
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
            color:
                #2f2f2f;
            line-height: 1.5;
        }

        .ath_container {
            width: 740px;
            margin: 20px auto;
            padding: 0px 20px 0px 20px;
        }

        .ath_container {
            width: 820px;
            border:
                #d7d7d7 1px solid;
            border-radius: 5px;
            padding: 10px 20px 10px 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, .3);
            /* border-radius: 5px; */
        }

        #uploadStatus {
            color:
                #00e200;
        }

        .ath_container a {
            text-decoration: none;
            color:
                #2f20d1;
        }

        .ath_container a:hover {
            text-decoration: underline;
        }

        .ath_container img {
            height: auto;
            max-width: 100%;
            vertical-align: middle;
        }


        .ath_container .label {
            color:
                #565656;
            margin-bottom: 2px;
        }



        .ath_container .message {
            padding: 6px 20px;
            font-size: 1em;
            color:
                rgb(40, 40, 40);
            box-sizing: border-box;
            margin: 0px;
            border-radius: 3px;
            width: 100%;
            overflow: auto;
        }

        .ath_container .error {
            padding: 6px 20px;
            border-radius: 3px;
            background-color:
                #ffe7e7;
            border: 1px solid #e46b66;
            color:
                #dc0d24;
        }

        .ath_container .success {
            background-color:
                #48e0a4;
            border:
                #40cc94 1px solid;
            border-radius: 3px;
            color:
                #105b3d;
        }

        .ath_container .validation-message {
            color:
                #e20900;
        }

        .prog-container .font-bold {
            font-weight: bold;
        }

        .prog-container .display-none {
            display: none;
        }

        .prog-container .inline-block {
            display: inline-block;
        }

        .prog-container .float-right {
            float: right;
        }

        .prog-container .float-left {
            float: left;
        }

        .prog-container .text-center {
            text-align: center;
        }

        .prog-container .text-left {
            text-align: left;
        }

        .prog-container .text-right {
            text-align: right;
        }

        .prog-container .full-width {
            width: 100%;
        }

        .prog-container .cursor-pointer {
            cursor: pointer;
        }

        .prog-container .mr-20 {
            margin-right: 20px;
        }

        .prog-container .m-20 {
            margin: 20px;
        }



        .prog-container table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid#ddd;
            margin-top: 20px;
        }


        table.prog-container thead,
        table.prog-container td {
            text-align: left;
            padding: 5px;
            border: 1px solid#ededed;
            width: 60px;
        }

        tr:nth-child(2) {
            background-color: #f2f2f2;
            width: 240px !important;

        }

        .prog-container .prog {
            margin: 20px 0 0 0;
            width: 300px;
            border: 1px solid#ddd;
            padding: 5px;
            border-radius: 5px;
        }

        .prog-container .prog-bar {
            width: 0%;
            height: 24px;
            background-color: #4CAF50;
            margin-top: -3px;
            border-radius: 12px;
            text-align: center;
            color: #fff;
        }

        @media all and (max-width: 700px) {
            .prog-container {
                width: auto;
            }
        }


        .ath_container input,
        .ath_container textarea,
        .ath_container select {
            box-sizing: border-box;
            width: 200px;
            height: initial;
            padding: 8px 5px;
            border: 1px solid #9a9a9a;
            border-radius: 4px;
        }

        div.hide {
            display: none;
        }

        .ath_container input[type="checkbox"] {
            width: auto;
            vertical-align: text-bottom;
        }

        .ath_container textarea {
            width: 300px;
        }

        .ath_container select {
            display: initial;
            height: 30px;
            padding: 2px 5px;
        }

        .ath_container button,
        .ath_container input[type=submit],
        .ath_container input[type=button] {
            padding: 8px 30px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 25px;
            color:
                #ffffff;
            background-color:
                #6213d3;
            border-color:
                #9554f1 #9172bd #4907a9;
        }

        .ath_container input[type=submit]:hover {
            background-color:
                #f7c027;
        }

        ::placeholder {
            color:
                #bdbfc4;
        }

        .ath_container label {
            display: block;
            color:
                #565656;
        }

        @media all and (max-width: 400px) {
            .ath_container {
                padding: 0px 20px;
            }

            .ath_container {
                width: auto;
            }

            .ath_container input,
            .ath_container textarea,
            .ath_container select {
                width: 100%;
            }



        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        /* Styles for the close button */
        .close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 30px;
            color: #fff;
            cursor: pointer;
        }

        /* Styles for the full screen image */
        .fullScreenImage {
            display: block;
            margin: 0 auto;
            max-width: 80%;
            max-height: 80%;
            margin-top: 50px;
            /* Adjust as needed */
        }

        #fullpage {

            border-radius: 10px;
            display: none;
            position: fixed;
            z-index: 9999;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 500px;
            background-color: white;
            border: 1px solid rgba(0, 0, 0, 0.248);
            box-shadow: 0 0 100vh 100vw rgba(0, 0, 0, 0.455);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            /* Make background transparent */
            border: none;
            /* Remove default border */
            padding: 5px;
            /* Adjust padding as needed */
            font-size: 16px;
            /* Adjust font size */
            font-weight: bold;
            /* Add weight for visibility */
            cursor: pointer;
            /* Set cursor to hand */
        }

        .prog-container {

            width: 270px !important;
            margin-top: 4px !important;

        }

        .blue-box {

            /* Adjust the padding as needed */
            border: 1px solid #007bff;
            border-radius: 15px;

            /* Adjust the border-radius as needed */
            display: inline-block;
            /* Ensures the background color only covers the content */
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Black background for the popup */
        }

        .popup-content {
            background-color: #fff;
            /* Black background for the content */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 420px;
            /* Set a fixed width */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
            max-height: 75%;
            max-width: 80%;
            /* Added to make the content scrollable on overflow in Y direction */
        }

        .ribbon {
            z-index: unset !important;
        }



        .close_pop {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            color: #000;
            /* Set a suitable color for the close button */
        }

        .card-body i.fa-check {
            /* position: absolute;
                                                                                                                                                        top: 30px; */
            /* right: 9px; */
            color: #007bff;
            visibility: hidden;
        }

        .nav-link[disabled] {
            pointer-events: none;
            color: #999999;
            /* You can adjust the color for a disabled look */
        }

        @media (max-width:768px) {
            .img-fluid {
                width: 170px;
                height: 153px;
            }

            .card {
                padding: 0;

            }

            .col-md-1 .card {
                padding: 0;
                width: 100%;
            }

            .row-cards {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 2px;
            }


            /* .card-body {
                                                                                                                                                            padding-top: 0;
                                                                                                                                                        } */

            .card-body i.fa-check {
                position: absolute;
                top: 6px;
                right: 18px;
                color: #007bff;
                visibility: hidden;
            }

            .srch {
                padding-left: 14px;
                padding-right: 14px;
            }

            .btns {
                padding-left: 15px;
            }
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="navbar-nav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="download" disabled>
                            <i class="fa fa-download" aria-hidden="true"></i>
                            Download
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="delete" disabled>
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            Delete
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="nwname" data-bs-toggle="modal" data-bs-target="#newname"
                            disabled>
                            <i class="fas fa-edit" aria-hidden="true"></i>
                            Rename
                        </a>
                    </li>
                </ul>
            </div>
            <div class="d-flex flex-column flex-lg-row align-items-center">
                <form action="{{ url('dashboard/document/search') }}" method="POST" id="searchForm"
                    class="mb-2 mb-lg-0 me-lg-3">
                    <div class="input-group">
                        <input type="text" name="keyword" id="searchInput" class="form-control col-12"
                            placeholder="Search..." aria-label="Search in website" aria-describedby="basic-addon2">
                        <button class="btn btn-success" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
                <label class="mx-4 btn btn-primary py-2 my-sm-0  rounded">
                    <i class="fas fa-upload"></i> Upload
                    <form id="upload-form" method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div id="multifiles">
                            <input type="file" id="pop" class="custom-file-input" name="multifiles[]"
                                style="display: none;" multiple>
                        </div>
                    </form>
                </label>
            </div>
        </div>
    </nav>



    <div class=" card navbar-light bg-white">
        <div class="">

            <div class="container-fluid">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="container-xl">
                            <div class="row">
                                <div class="card-body">
                                    @if ($files->isEmpty())
                                        <div class="vw-25 mt-5 py-5 noFileDiv" id="noFileDiv">
                                            <div class="col justify-content-center text-center">
                                                <div class="row justify-content-center">
                                                    <svg style="width: 100px; height: 100px;"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        shape-rendering="geometricPrecision"
                                                        text-rendering="geometricPrecision"
                                                        image-rendering="optimizeQuality" fill-rule="evenodd"
                                                        clip-rule="evenodd" viewBox="0 0 512 406.8">
                                                        <path
                                                            d="M29.27 0h373.81c16.11 0 29.27 13.16 29.27 29.27v90.8c-2.23-1.1-4.48-2.14-6.77-3.13l-2.02-.92c-3.57-1.47-7.18-2.82-10.84-4.02V81.94h.14H20.83v221.61c0 4.5 3.59 8.09 8.09 8.09h193.04c.54 1.42 1.1 2.83 1.69 4.24 1.97 4.78 4.23 9.49 6.73 14.09H29.27C13.16 329.97 0 316.78 0 300.7V29.27C0 13.16 13.16 0 29.27 0zm335.71 140.37c31.07 0 60.75 12.29 82.72 34.27 30.33 30.33 41.62 75.06 29.4 116.14-2.83 9.53-6.85 18.55-11.88 26.89l45.3 49.38c2.09 2.27 1.95 5.82-.33 7.91l-33.26 30.38c-2.27 2.08-5.8 1.92-7.89-.35l-43.34-47.67c-18.35 11.18-39.22 17.02-60.72 17.02-31.06 0-60.75-12.3-82.71-34.27a117.18 117.18 0 0 1-25.39-37.99c-18.13-43.67-7.82-94.22 25.4-127.43a116.814 116.814 0 0 1 37.96-25.4c13.8-5.73 28.92-8.88 44.74-8.88zm70.93 46.04c-28.63-28.63-72.03-37.24-109.31-21.8-66.92 27.71-82.3 113.99-32.58 163.67 28.68 28.61 72 37.26 109.33 21.81 37.54-15.59 61.94-52.1 61.94-92.74 0-13.62-2.69-26.59-7.56-38.37a101.013 101.013 0 0 0-21.82-32.57zm-28.22 97.67-16.4 16.31-26.48-26.49-26.34 26.34-15.82-15.86 26.32-26.32-26.85-26.84 16.4-16.31 26.8 26.81 26.51-26.51 15.81 15.85-26.49 26.49 26.54 26.53zM375.21 32.9c7.99 0 14.46 6.47 14.46 14.46 0 7.98-6.47 14.46-14.46 14.46-7.98 0-14.46-6.48-14.46-14.46.04-7.99 6.51-14.46 14.46-14.46zm-97.95 0c7.99 0 14.46 6.47 14.46 14.46 0 7.98-6.47 14.46-14.46 14.46-7.99 0-14.46-6.48-14.46-14.46 0-7.99 6.47-14.46 14.46-14.46zm48.98 0c7.98 0 14.45 6.47 14.45 14.46 0 7.98-6.47 14.46-14.45 14.46-7.99 0-14.47-6.48-14.47-14.46 0-7.99 6.48-14.46 14.47-14.46z" />
                                                    </svg>
                                                </div>
                                                <h2 class="mb-3">No Files Found</h2>
                                                <p class="mb-0">Please upload some files to see content here.</p>
                                            </div>
                                        </div>
                                    @endif
                                    <!-------------------------All files tab start------------------->
                                    <div class="tab-pane fade show active">
                                        <div class="row " id="container_cards">
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($files as $file)
                                                @php
                                                    $extension = $file->file_extension;
                                                    $customImage = isset($extensionToImage[$extension]) ? $extensionToImage[$extension] : 'file-icon.png';
                                                @endphp
                                                <div class="col-xl-2 col-md-6 col-sm-12 tab-pane fade show">
                                                    <div class="card cardimg  mt-3" id="card{{ $i }}"
                                                        onclick="FileManagement.toggleCheck( '{{ $i }}')"
                                                        style=" border-radius: 15px;  display: inline-block;">
                                                        <div style="width: 50px; background-color:#2F2F2FE7; color: white; border-top-left-radius: 15px"
                                                            class="d-flex justify-content-center">{{ $extension }}
                                                        </div>
                                                        <!-- Photo -->
                                                        <div class="">
                                                            <div class="col-lg-12 col-md-6 col-sm-12 img">
                                                                <img src="{{ asset('file_resources/images/' . $customImage) }}"
                                                                    alt="Image Alt Text" id="myImage{{ $i }}"
                                                                    width="200px" class="img-fluid">
                                                            </div>
                                                        </div>
                                                        <div style="border-top: 1px solid rgba(0, 0, 0, 0.14)">
                                                            <h4 class="card-title  mx-4 card-text">
                                                                {{ Str::limit($file->file_name, 10, '..') }}<i
                                                                    class="fa-solid fa-check float-right text-primary mt-1"
                                                                    style="visibility: hidden;"></i></h4>
                                                        </div>
                                                        <div id="fullpage" onclick="this.style.display='none';">
                                                            <button class="close-button">X</button>
                                                        </div>
                                                        <input type="hidden" id="delete{{ $i }}"
                                                            value="{{ $file->id }}" file-path={{ $file->file_path }}>

                                                        <input type="hidden" id="imgpath{{ $i }}"
                                                            file-path={{ $file->file_path }}
                                                            class="file-old-name{{ $i }}"
                                                            file-old-name={{ $file->file_name }}
                                                            value="{{ $file->id }}">
                                                    </div>
                                                </div>

                                                @php $i++; @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-------------------------All files tab end------------------->
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-------------------------rename model start------------------->
                    <div class="modal fade" id="newname" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Rename</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('rename') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('New name') }}</label>
                                            <input id="namec" type="text" class="form-control" name="name"
                                                maxlength="20" required>
                                            <input id="imagenew" type="hidden" class="form-control" name="image"
                                                value="" required>

                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-------------------------rename model end------------------->

                    <div id="popup" class="popup">
                        <div class="popup-content">
                            <span class="close_pop">&times;</span>
                            <p>Files</p>
                            <div class="hide" id="progress">
                                <table id="progressBarsContainer" class="prog-container">
                                    <!-- Table rows will be dynamically added here -->
                                </table>
                            </div>
                            <button id="doneButton" class="btn btn-primary mt-3"
                                style="display:none; float:right;">Done</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // ------------get folder id to store file, also load relative folder files-------
        $(document).ready(function() {


            //--------------upload new and files and load files after uploading----
            $('body').on('click', '#doneButton', function(e) {
                e.preventDefault();
                $("#popup").hide();
                $('#noFileDiv').hide();
                $('#progressBarsContainer').find('tr').remove();
                var uploadingform = $('#upload-form');

                $.ajax({
                    url: uploadingform.attr("action"),
                    type: uploadingform.attr("method"),
                    dataType: "JSON",
                    data: new FormData(uploadingform[0]),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        toastr.success('Files uploaded successfully', 'Success');
                        fetchFiles();
                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });

            //--------to remove rows from popup table
            $('#popup').on('hidden.bs.modal', function(e) {
                $('#progressBarsContainer').find('tr').remove();
            });

            //----------delete files----------------
            $('body').on('click', '#delete', function(e) {
                e.preventDefault();
                var deleteUrl = $(this).attr('href');
                $.ajax({
                    url: deleteUrl,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                        toastr.success('Files deleted successfully', 'Success');
                        fetchFiles();
                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });

            //----------rename file------------
            $('#newname form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        toastr.success('File renamed successfully', 'Success');
                        fetchFiles();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(xhr.responseText);
                    }
                });
            });

            //--------------search files------------
            $('body').on('submit', '#searchForm', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    dataType: "JSON",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        var baseUrl = "{{ url('/public/file_resources/images') }}";
                        var files = response.files;
                        var extensionToImage = response.extensionToImage;
                        var htmlContent = '';
                        // Iterate over the array of files and generate HTML content for each file
                        files.forEach(function(file, index) {
                            var extension = file.file_extension;
                            var customImage = extensionToImage[extension] ||
                                'file-icon.png';

                            htmlContent +=
                                '<div class="col-xl-2 col-md-6 col-sm-12 tab-pane fade show">';
                            htmlContent +=
                                '<div class="card cardimg mt-3" id="card' + (
                                    index + 1) +
                                '" onclick="FileManagement.toggleCheck(\'' + (
                                    index +
                                    1) +
                                '\')" style="border-radius: 15px;display: inline-block;">';
                            htmlContent +=
                                '<div style="width: 50px; background-color:#2F2F2FE7; color: white; border-top-left-radius: 15px" class="d-flex justify-content-center">' +
                                extension + '</div>';
                            htmlContent += '<div>';
                            htmlContent +=
                                '<div class="col-lg-12 col-md-6 col-sm-12 img">';
                            htmlContent += '<img src="' + baseUrl + '/' +
                                customImage +
                                '" alt="Image Alt Text" id="myImage' + (index + 1) +
                                '" width="200px" class="img-fluid">';

                            htmlContent += '</div>';
                            htmlContent += '</div>';
                            htmlContent +=
                                '<div style="border-top: 1px solid rgba(0, 0, 0, 0.14)">';
                            htmlContent +=
                                '<h4 class="card-title mx-4 card-text">' + (
                                    file.file_name
                                    .substring(0, 10) + '..') +
                                '<i class="fa-solid fa-check float-right text-primary mt-1" style="visibility: hidden;"></i></h4>';
                            htmlContent += '</div>';
                            htmlContent +=
                                '<div id="fullpage" onclick="this.style.display=\'none\';">';
                            htmlContent +=
                                '<button class="close-button">X</button>';
                            htmlContent += '</div>';
                            htmlContent += '<input type="hidden" id="delete' + (
                                    index +
                                    1) + '" value="' +
                                file.id + '" file-path="' + file.file_path + '">';
                            htmlContent += '<input type="hidden" id="imgpath' + (
                                    index +
                                    1) +
                                '" class="file-old-name' + (index + 1) +
                                '" file-old-name="' + file
                                .file_name + '" value="' + file.id +
                                '" file-path="' +
                                file.file_path +
                                '">';

                            htmlContent += '</div>';
                            htmlContent += '</div>';
                        });
                        $('#container_cards').html(htmlContent);

                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });

        });

        //fetch files of selected folder
        function fetchFiles() {
            let data = {
                id: '1',
                expectsJson: true,
            };
            $.ajax({
                url: "{{ route('document.files') }}",
                type: 'post',
                data: data,
                success: function(response) {
                    console.log(response);
                    var baseUrl = "{{ url('/public/file_resources/images') }}";
                    var files = response.files;
                    var extensionToImage = response.extensionToImage;
                    var htmlContent = '';
                    // Iterate over the array of files and generate HTML content for each file
                    files.forEach(function(file, index) {
                        var extension = file.file_extension;
                        var customImage = extensionToImage[extension] ||
                            'file-icon.png';

                        htmlContent += '<div class="col-xl-2 col-md-6 col-sm-12 tab-pane fade show">';
                        htmlContent += '<div class="card cardimg mt-3" id="card' + (index + 1) +
                            '" onclick="FileManagement.toggleCheck(\'' + (index + 1) +
                            '\')" style="border-radius: 15px;display: inline-block;">';
                        htmlContent +=
                            '<div style="width: 50px; background-color:#2F2F2FE7; color: white; border-top-left-radius: 15px" class="d-flex justify-content-center">' +
                            extension + '</div>';
                        htmlContent += '<div>';
                        htmlContent += '<div class="col-lg-12 col-md-6 col-sm-12 img">';
                        htmlContent += '<img src="' + baseUrl + '/' + customImage +
                            '" alt="Image Alt Text" id="myImage' + (index + 1) +
                            '" width="200px" class="img-fluid">';

                        htmlContent += '</div>';
                        htmlContent += '</div>';
                        htmlContent += '<div style="border-top: 1px solid rgba(0, 0, 0, 0.14)">';
                        htmlContent += '<h4 class="card-title mx-4 card-text">' + (file.file_name
                                .substring(0, 10) + '..') +
                            '<i class="fa-solid fa-check float-right text-primary mt-1" style="visibility: hidden;"></i></h4>';
                        htmlContent += '</div>';
                        htmlContent += '<div id="fullpage" onclick="this.style.display=\'none\';">';
                        htmlContent += '<button class="close-button">X</button>';
                        htmlContent += '</div>';
                        htmlContent += '<input type="hidden" id="delete' + (index + 1) + '" value="' +
                            file.id + '" file-path="' + file.file_path + '">';
                        htmlContent += '<input type="hidden" id="imgpath' + (index + 1) +
                            '" class="file-old-name' + (index + 1) + '" file-old-name="' + file
                            .file_name + '" value="' + file.id + '" file-path="' + file.file_path +
                            '">';

                        htmlContent += '</div>';
                        htmlContent += '</div>';
                    });
                    $('#container_cards').html(htmlContent);

                },
                error: function(error) {
                    console.log(error);
                    var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                    myWindow.document.write(error.responseText);
                }
            });
        }
    </script>
@endsection
