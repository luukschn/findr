@extends('layouts.app')

@section('title', 'Upload a scale')

@section('content')
    <h3>Upload scale</h3>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                
                <form
                    role="form"
                    method="POST"
                    action="{{ url('scale/upload/submit') }}"
                    enctype="multipart/form-data"
                    >
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Internal Name</label>
                            <input class="form-control" type="text" name="internalName" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Official Name</label>
                            <input class="form-control" type="text" name="officialName" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Reference</label>
                            <input class="form-control" type="text" name="reference" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Explanation</label>
                            <input class="form-control" type="text" name="explanation" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Internal Name</label>
                            <input class="form-control" type="text" name="internalName" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Options</label>
                            <p>Note: format as CSV, e.g.: "always, sometimes, rarely, never"</p>
                            <input class="form-control" type="text" name="internalName" required>
                        </div>
                        
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Reference Mean</label>
                            <input class="form-control" type="text" name="referenceMean" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Reference Standard Deviation</label>
                            <input class="form-control" type="text" name="referenceSD" required>
                        </div>

                        {{-- Dynamic amount of inputs for the questions -> figure out how to do this --}}
                    </div>
                
                </form>
            </div>
        </div>
    </div>


@endsection()