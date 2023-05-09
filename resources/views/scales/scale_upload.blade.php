@extends('layouts.app')

@section('title', 'Upload a scale')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add question
            $('#add-question').click(function(e) {
                e.preventDefault();

                var questionTemplate = $('.question-container:first').clone();
                questionTemplate.find('input').val(''); // Clear the input field
                $('#questions-container').append(questionTemplate);
            });

        // Remove question
        $(document).on('click', '.remove-question', function(e) {
            e.preventDefault();

            $(this).closest('.question-container').remove();
        });
    });
    </script>


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
                        <div class="mb-3 col-md-21">
                            <label class="form-label">Internal Name</label>
                            <input class="form-control" type="text" name="internalName" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label">Official Name</label>
                            <input class="form-control" type="text" name="officialName" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label">Reference</label>
                            <input class="form-control" type="text" name="reference" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label">Explanation</label>
                            <input class="form-control" type="text" name="explanation" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label">Internal Name</label>
                            <input class="form-control" type="text" name="internalName" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label">Options</label>
                            <p>Note: format as CSV, e.g.: "always, sometimes, rarely, never"</p>
                            <input class="form-control" type="text" name="internalName" required>
                        </div>
                        
                        <div class="mb-3 col-md-21">
                            <label class="form-label">Reference Mean</label>
                            <input class="form-control" type="text" name="referenceMean" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label">Reference Standard Deviation</label>
                            <input class="form-control" type="text" name="referenceSD" required>
                        </div>


                        <p>Questions:</p>
                        <div class="question-container mb-3">
                            <input class='form-control' type="text" name="questions[]" placeholder="Enter question">
                            <button class="remove-question">Remove</button>
                        </div>

                        <div id="questions-container">
                            <!-- Existing questions will be appended here -->
                        </div>
                    <br>

                        <button id="add-question" class='btn btn-primary'>Add Question</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>


@endsection()