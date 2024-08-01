@extends('layouts.dashboard')
@section('content')
<div class="row">
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
         <div class="page-wrapper">
            <div class="page-header d-print-none">
               <div class="container-xl">
                  <div class="row g-2 align-items-center">
                     <div class="col">
                        <h2 class="page-title">
                           Files
                        </h2>
                        <h5>Select File!</h5>
                     </div>
                  </div>
               </div>
            </div>
            <div class="page-body">
               <div class="container-xl">
                  <div class="row row-cards" id="container_cards">
                     @php
                     $i = 1;
                     @endphp
                     @if(isset($list['data']))
                        @foreach ($list['data'] as $file)
                        @foreach (json_decode($file->multifiles) as $image)
                        @php
                        $extension = pathinfo($image, PATHINFO_EXTENSION);
                        $filename = pathinfo($image, PATHINFO_FILENAME);
                        $customImage = isset($extensionToImage[$extension]) ? $extensionToImage[$extension] : 'file-icon.png';
                        $path = ($extension == 'svg' || $extension == 'png' || $extension == 'jpg' || $extension == 'webp' || $extension == 'jpeg' )
                        ? asset('storage/app/public/' . $image)
                        : asset('storage/app/public/' . $customImage);
                        $name = explode('.', $filename);
                        $Fname = explode('~', $name[0]);
                        @endphp
                        <div class="col-md-1">
                            <div class="card cardimg" id="card{{$i}}">
                            <div class="ribbon bg-primary">{{ $extension }}</div>
                            <!-- Photo -->
                            <div class="col-12 img">
                                <img src="{{ asset('public/images/' . $customImage) }}" alt="Image Alt Text" id="myImage{{ $i }}" class="img-fluid" onclick="FileManagement.toggleCheck( '{{ $i }}')">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title mt-2 card-text">{{Str::limit($Fname[1], 5) }}<i class="fa-solid fa-check" style="visibility: hidden;"></i></h3>
                            </div>
                            </div>
                            <div id="fullpage" onclick="this.style.display='none';"></div>
                            <input type="hidden" id="delete{{ $i }}" value="{{ $image }}">
                            <input type="hidden" id="imgpath{{ $i }}" value="{{ $path }}">
                        </div>
                        @php $i++; @endphp
                        @endforeach
                        @endforeach
                    @endif
                  </div>
               </div>
            </div>
            <div class="modal fade" id="newname" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Rename</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <form method="POST" action="{{ url('rename') }}">
                           @csrf
                           <div class="mb-3">
                              <label for="name" class="form-label">{{ __('New name') }}</label>
                              <input id="namec" type="text" class="form-control" name="name" maxlength="20" required>
                              <input id="imagenew" type="hidden" class="form-control" name="image" value="" required>
                           </div>
                     </div>
                     <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
            <div id="popup" class="popup">
               <div class="popup-content">
                  <span class="close_pop">&times;</span>
                  <p>Files</p>
                  <div class="hide" id="progress">
                     <table id="progressBarsContainer" class="prog-container">
                        <!-- Table rows will be dynamically added here -->
                     </table>
                  </div>
                  <button id="doneButton" class="btn btn-primary" style="display:none; float:right;" onclick="document.getElementById('upload-form').submit();closePopup();">Done</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection