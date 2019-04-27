@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>新增商品 <small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">商品名稱</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="輸入商品名稱">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">選擇類別</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control">
                                <option>----選擇類別----</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">商品說明 <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="form-control" rows="3" placeholder='商品說明'></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">價格</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" name="country" id="autocomplete-custom-append" class="form-control col-md-10"/>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <p>副件檔案</p>
                            </div>
                            <div class="col-md-1 pull-right image-upload">
                                <label for="file-input">
                                    <img src="https://goo.gl/pB9rpQ" title="上傳圖片"/>
                                </label>

                                <input id="file-input" type="file" multiple/>
                            </div>
                        </div>
                        <div class="col-md-55" photo-index="-1" style="display: none">
                            <div class="thumbnail">
                                <div class="image view view-first demo-gallery">
                                    <img style="width: 100%; height:80%;display: block;" src="#" alt="image" uuid=""/>
                                    <div class="mask">
                                        <p>Your Text</p>
                                        <div class="tools tools-bottom">
                                            <a href="#" title="預覽圖片" onclick="preview(this)"><i class="fa fa-search"></i></a>
                                            <input class="uploadEdit" id="upload" type="file"/>
                                            <a href="#" title="更改圖片" onclick="changeImg(this)"><i class="fa fa-pencil"></i></a>
                                            <a href="#" title="刪除圖片"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption">
                                    <p>Snow and Ice Incoming for the South</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-xs-7 col-xs-push-5">
                            <button type="submit" class="btn btn-success">確定</button>
                        </div>
                        <div class="col-xs-5">
                            <button type="button" class="btn btn-primary">取消</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
@endsection
@section('styles')
    <style>
        #upload{
            display:none
        }
        .image-upload > input
        {
            display: none;
        }

        .image-upload img
        {
            width: 80px;
            cursor: pointer;
        }
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }


        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
@endsection
@section('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>
        var modal = document.getElementById('myModal');
        var modalImg = document.getElementById("img01");
        var span = document.getElementsByClassName("close")[0];
        var max = $('.col-md-55').length - 1;
        var formData = new FormData();


        span.onclick = function() {
            modal.style.display = "none";
        }

        $('#file-input').change(function () {
            [].forEach.call(this.files, readyURL);
        })

        $('.uploadEdit').each(function () {
            $(this).change(function () {
                console.log(this.files)
            })
        })
        
        function changeImg(e) {
            let upload = $(e).closest('.col-md-55').find('#upload:hidden');
            upload.trigger('click');
        }

        function preview(e) {
            let src = $(e).closest('.col-md-55').find('img').attr('src');
            modal.style.display = "block";
            modalImg.src = src;
        }

        function readyURL(file){

          if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
             return alert(file.name + " is not an image");
          }
          cloneFeatured();
          newFilesAdd(max, file, file.name);
          reader(max, file);
          max++;
        }

        function newFilesAdd(max, file, file_name) {
            formData.append('photo-index['+max+']', max);
            formData.append('file['+max+']', file);
            formData.append('file_name['+max+']', file_name);
            formData.append('uuid['+max+']', "");
        }

        function reader(max, file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = $('.col-md-55').eq(max).find('img');
                let caption = $('.col-md-55').eq(max).find('.caption');
                img.attr('src', e.target.result)
                caption.find('p').html(file.name)
            }
            reader.readAsDataURL(file);
        }

        function cloneFeatured() {
           let clone = $('.col-md-55').last().clone(true);
           clone.insertBefore($('.col-md-55').last());
           clone.css('display','block');
           clone.attr('photo-index', max);
        }

    </script>
@endsection
