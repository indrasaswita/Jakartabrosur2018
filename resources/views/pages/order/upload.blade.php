@extends('layouts.flyer')
@section('content')
    <!-- <form> -->
			<!--  ng-controller = "UploadController"> -->

            @if(isset($files))
                @if($files!=null)
                    <div ng-init="initFiles('{{json_encode($files)}}')"></div>
                @endif
            @endif
            @if(isset($data))
                @if($data!=null)
                    <div ng-init="initData('{{json_encode($data)}}')"></div>
                @endif
            @endif
            <!-- NANTI MESTI BUAT VALIDASI KALO ORANG LANGSUNG MASUK KE UPLOAD HARUS DI CEK DULU UDA ADA SESSION DARI PAGE ORDER BLOM.. -->
            
            [[errorshow]]


	<div class="panel">
        <div class="panel-title">
             Upload File dan Gambar
        </div>
        <div class="panel-item panel-item-purple">
            <div class="panel-item-header">
                Upload Data
            </div>
            <div class="panel-item-block">
            <!-- <div class="alert alert-purple alert-sm size-16 text-xs-center">Ukuran file paling besar : <strong>50 MB</strong> / 50 MegaBytes (MAX)</div> -->
                <div class="alert alert-danger" ng-show="errorsshow">
                    <span class="margin-0-10">
                        Keterangan GAGAL pada proses upload:
                    </span>
                    <ol class="margin-0">
                        <li ng-repeat="item in errors">[[item]]</li>
                    </ol>
                </div>
                <div class="form-group">
                    {!! Form::open(['url' => URL::asset('API/upload/throw'), 'class' => 'dropzone', 'files'=>true, 'id'=>'real-dropzone']) !!}

                    <div class="dz-message">

                    </div>

                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>

                    <div class="dropzone-previews" id="dropzonePreview"></div>

                    <h4 class="text-center rockwell purple">Drop images in this area  <span class="glyphicon glyphicon-hand-down"></span></h4>

                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel-item-footer">
                Catatan Tambahan : 
                <ol>
                    <li>Harap upload file berkualitas baik (ex. Vector, TIFF, PSD, CDR, AI, EPS)</li>
                    <li>Bila file belum di convert, harap sertakan fonts</li>
                    <li>Agar proses lebih cepat, harap melebihkan 2mm untuk bleed pada file image</li>
                </ol>
            </div>
        </div>

        <div class="panel-item panel-item-red" ng-show="error!=null">
            <div class="col-xs-12 text-xs-center">
                <div class="alert alert-sm margin-10-0 alert-danger">[[error]]</div>
            </div>
        </div>
        <!-- <button type="button" class="btn-purple btn-circle btn-sticky" id="btn-prev" ng-click="uploadprev()" data-toggle="tooltip" data-title="Klik Untuk Kembali" data-placement="right">
            <span class="glyphicon glyphicon-chevron-left size-24"></span>
        </button>
        <button type="button" class="btn-purple btn-circle btn-sticky" id="btn-next" ng-click="uploadcheckout()" data-toggle="tooltip" data-title="Klik Untuk Lanjut" data-placement="left">
            <span class="glyphicon glyphicon-chevron-right size-24"></span>
        </button> -->

        <div ng-show="tableshow" class="panel-item panel-item-magenta">
            <div class="panel-item-header">
                File Anda <small>(sudah tersimpan di server)</small>
            </div>
            <div class="panel-item-block">
                <table class="table table-sm table-center">
                    <thead class="">
                        <tr>
                            <th class="width-min">#</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Ukuran</th>
                            <th class="width-min">
                                <span class="glyphicon glyphicon-trash"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in uploadedfiles">
                            <td>[[$index + 1]]</td>
                            <td><img ng-src="[[item.icon]]" class="img-rounded" width="70px" height="70px"></td>
                            <td>[[singkatText(item.filename, 30, '.')]]</td>
                            <td>[[(item.size/1024)|number:1]] KB</td>
                            <td>
                                <button class="btn-sm btn btn-danger" ng-click="deletefile(item)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('includes.sidebarflyersm')
    <!-- </form> -->
@stop