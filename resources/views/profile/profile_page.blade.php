@extends('layouts.app')

@section('title', 'Profile Page')

@section('content')

    <h3>Profile Page</h3>

    <br>

    <div class="container">

        <div class="row">
            <div class="col-md-11 w-50">
                <form 
                    id="profile-details"
                    method="post"
                    action="{{ url('profile/update') }}"
                    enctype="multipart/form-data"
                    class="needs-validation"
                    role="form"
                    novalidate
                    >
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name" value="{{ auth()->user()->name }}" autofocus="" required>
                                    <div class="invalid-tooltip">{{ trans('sentence.required') }}</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email" value="{{ auth()->user()->email }}" autofocus="" required>
                                    <div class="invalid-tooltip">{{ trans('sentence.required') }}</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                    <input class="form-control" type="date" id="dateOfBirth" name="dateOfBirth" value="{{ $userInfo['dateOfBirth'] }}" autofocus="" required>
                                    <div class="invalid-tooltip">{{ trans('sentence.required') }}</div>
                                </div>

                                <!-- What will happen if i dont select country. does it update the value? ideally want to have the value remembered 
                                can maybe get the DB and display that option automatically?-->
                                <div class="mb-3 col-md-6">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" data-flag="true" name="country">
                                        <option value="" {{ old('country') == '' ? 'selected' : '' }}></option>
                                        <option value="1" {{ old('country') == '1' || $userInfo['country'] == '1' ? 'selected' : ''}}>The Netherlands</option>
                                    </select>
                                    <!-- <input class="form-control" type="text" id="country" name="country" value="{{ $userInfo['country'] }}" autofocus="" required>-->
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="location" class="form-label">Location</label>
                                    <select class="form-select" data-flag="true" name="location">
                                        <option value="" {{ old('location') == '' ? 'selected' : '' }}></option>
                                        
                                        <?php 
                                            $location_array = [
                                                "1" => "Drenthe",
                                                "2" => "Flevoland",
                                                "3" => "Friesland",
                                                "4" => "Gelderland",
                                                "5" => "Groningen",
                                                "6" => "Limburg",
                                                "7" => "Noord-Brabant",
                                                "8" => "Noord-Holland",
                                                "9" => "Overijssel",
                                                "10" => "Utrecht",
                                                "11" => "Zeeland",
                                                "12" => "Zuid-Holland"
                                            ];

                                            foreach ($location_array as $key => $value) {
                                                echo "<option value='$key' " . (old('location') == $key || $userInfo['location'] == $key ? 'selected' : '') . ">$value</option>";
                                            };

                                        ?>

                                    </select>
                                    <!-- <input class="form-control" type="text" id="location" name="location" value="{{ $userInfo['location'] }}" autofocus="" required> -->
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="jobTitle" class="form-label">Job Title</label>
                                    <input class="form-control" type="text" id="jobTitle" name="jobTitle" value="{{ $userInfo['jobTitle'] }}" autofocus="" required>
                                    <div class="invalid-tooltip">{{ trans('sentence.required') }}</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" data-flag="true" name="gender">
                                        <option value="" {{ old('gender') == '' ? 'selected' : ''}}></option>
                                        <option value="1" {{ old('gender') == '1' || $userInfo['gender'] == '1' ? 'selected' : ''}}>Female</option>
                                        <option value="2" {{ old('gender') == '2' || $userInfo['gender'] == '2' ? 'selected' : ''}}>Male</option>
                                        <option value="3" {{old('gender') == '3' || $userInfo['gender']  == '3' ? 'selected' : ''}}>Other (more refined selection on this coming soon)</option>
                                    </select>
                                    <!-- <input class="form-control" type="text" id="gender" name="gender" value="{{ $userInfo['gender'] }}" autofocus="" required> -->
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control" type="text" id="bio" name="bio" autofocus="" required>{{ $userInfo['bio'] }}</textarea>
                                    <!-- <div class="invalid-tooltip">{{ trans('sentence.required') }}</div> -->
                                </div>

                                <div class="mt-2">
                                        <button type="submit" class="button-primary">Save changes</button>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        
                    </div>
                </form>
            </div>

            <div class="col-md-1">
            <a class="btn btn-secondary" href="{{ url('/logout') }}" onclick="event.preventDevault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            
            <form id="logout-form" action="{{ url('/logout') }}" method=POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        </div>

        <!-- How to get this next to the other info -->


    </div>



@endsection