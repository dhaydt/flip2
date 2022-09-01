@extends('layouts.app')
<style>
    #pass {
        transition: .5s;
    }

</style>
@section('content')
<div class="container-form mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col12">
            <form action="{{ route('generate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="card-title text-capitalize">
                            Your StarterHolic data
                        </div>
                    </div>
                    <div class="card-body pe-5">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">1. Is your StarterHolic Private or
                                Public</label><br>
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="radio" name="type" value="private"
                                    onclick="showPassword(true)" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Private
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" value="public"
                                    onclick="showPassword(false)" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Public
                                </label>
                            </div>
                        </div>
                        <div class="mb-3 d-none" id="pass">
                            <label for="title" class="form-label">Password For Private StarterHolic</label>
                            <input type="text" name="password" class="form-control ms-3" id="title"
                                placeholder="Your StarterHolic password">
                                <span class="text-danger ms-4" style="font-size: 11px;">Please note your password to open all of your private StarterHolic's</span>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">2. Email</label>
                            <input type="email" name="email" class="form-control ms-3" id="email"
                                placeholder="Your Email Address">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">3. Title</label>
                            <input type="text" name="title" class="form-control ms-3" id="title"
                                placeholder="Your StarterHolic title">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">4. Description</label>
                            <textarea name="desc" id="" cols="30" rows="3" class="form-control ms-3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">5. Category / Sectors</label>
                            <select class="form-select ms-3" name="sector" aria-label="Default select example" required>
                                <option selected>Select sector</option>
                                <option value="Agritect">Agritect</option>
                                <option value="B2B">B2B</option>
                                <option value="B2C">B2C</option>
                                <option value="BioTech">BioTech</option>
                                <option value="Climate">Climate</option>
                                <option value="Crypto">Crypto</option>
                                <option value="DeepTech">DeepTech</option>
                                <option value="Ecommerce">Ecommerce</option>
                                <option value="EdTech">EdTech</option>
                                <option value="Energy">Energy</option>
                                <option value="Fashion">Fashion</option>
                                <option value="FinTech">FinTech</option>
                                <option value="Food & Deverages">Food & Deverages</option>
                                <option value="Gaming">Gaming</option>
                                <option value="HR">HR</option>
                                <option value="Hardware">Hardware</option>
                                <option value="Health">Health</option>
                                <option value="Industry">Industry</option>
                                <option value="Logistics">Logistics</option>
                                <option value="Marketing">Marketing</option>
                                <option value="MarketPlace">MarketPlace</option>
                                <option value="Materials">Materials</option>
                                <option value="MedTech">MedTech</option>
                                <option value="BioTech">Media</option>
                                <option value="Mobility">Mobility</option>
                                <option value="Music">Music</option>
                                <option value="Productivity">Productivity</option>
                                <option value="PropTech">PropTech</option>
                                <option value="Saas">Saas</option>
                                <option value="Security">Security</option>
                                <option value="Social">Social</option>
                                <option value="Sports">Sports</option>
                                <option value="Travel & Hospitality">Travel & Hospitality</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">6. Select PDF to Convert</label>
                            <div class="row d-flex">
                                <div class="local col-11">
                                    <input name="filePdf" onchange="upload_check()" class="form-control ms-3" type="file" accept="application/pdf" id="formFile">
                                </div>
                                <div class="col-1 d-flex justify-content-start align-items-center">
                                    <a class="fs-5" data-bs-toggle="tooltip" title="Upload From Google Drive" id="authorize_button" onclick="handleAuthClick()"><i class="fab fa-google-drive"></i></a>
                                </div>
                                <a id="signout_button" class="d-none" onclick="handleSignoutClick()">Sign Out</a>
                            </div>
                            <div class="text-danger ms-4" style="font-size: 10px;">Max PDF size 5MB</div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-success">Generate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
    <script>
        function upload_check()
            {
                var upl = document.getElementById("formFile");
                var max = 5000000;
                // console.log('size', upl.files[0].size)

                if(upl.files[0].size > max)
                {
                    alert("File too big! Max Size is 5MB, You just select "+ formatBytes(upl.files[0].size) + " Mb PDF file");
                    upl.value = "";
                }
        };

        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        function showPassword(val){
            if(val == true){
                $('#pass').removeClass(`d-none`);
            }else{
                $('#pass').addClass(`d-none`);
            }
        }
    </script>
