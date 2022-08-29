@extends('layouts.app')
@section('content')
<div class="container-form mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col12">
            <form action="{{ route('generate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="card-title text-capitalize">
                            Your Flip data
                        </div>
                    </div>
                    <div class="card-body pe-5">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">1. Is your FlipBook Private or
                                Public</label><br>
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="radio" name="type" value="private"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Private
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" value="public"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Public
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">2. Title</label>
                            <input type="text" name="title" class="form-control ms-3" id="title" placeholder="Your flipbook title">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">3. Description</label>
                            <textarea name="desc" id="" cols="30" rows="3" class="form-control ms-3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">4. Category / Sectors</label>
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
                            <label for="formFile" class="form-label">5. Select PDF to Convert</label>
                            <input name="filePdf" class="form-control ms-3" type="file" id="formFile">
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
