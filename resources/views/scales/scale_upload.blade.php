@extends('layouts.app')

@section('title', 'Upload a scale')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-question').click(function(e) {
                e.preventDefault();

                var questionTemplate = $('.question-container:first').clone();
                questionTemplate.find('input').val(''); // Clear the input field
                questionTemplate.find('.format-checkbox').prop('checked', false);

                $('#questions-container').append(questionTemplate);
            });

        $(document).on('click', '#remove-question', function(e) {
            if ($('.question-container').length > 1) {
                e.preventDefault();

                $(this).closest('.question-container').remove();
            }

        });

        $('#submit-form').click(function(e) {
            e.preventDefault();

            var questions = $('input[name="questions[]"]').map(function() {
                return $(this).val();
            }).get();

            var format = [];

            $('.question-container').each(function() {
                var checkbox = $(this).find('.format-checkbox');
                var value = checkbox.is(':checked') ? '1': '0';
                format.push(value);
            });

            var internalName = $('#internalName').val();
            var officialName = $('#officialName').val();
            var reference = $('#reference').val();
            var explanation = $('#explanation').val();
            var options = $('#options').val();
            var referenceMean = $('#referenceMean').val();
            var referenceSD = $('#referenceSD').val();

            var formData = {
                questions: questions,
                format: format,
                internalName: internalName,
                officialName: officialName,
                reference: reference,
                explanation: explanation,
                options: options,
                referenceMean: referenceMean,
                referenceSD: referenceSD
            };

            $.ajax({
                url: '/upload/scale/submit',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.href = '/finder';
                },
                error: function(xhr, status, error) {
                    console.error('Error: ', error);
                }
            });
        });
    });
    </script>


    <h3>Upload scale</h3>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-3 w-50">
                
                <form
                    role="form"
                    method="POST"
                    action="{{ url('upload/scale/submit') }}"
                    enctype="multipart/form-data"
                    >

                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="card-body">
                        <div class="mb-3 col-md-21">
                            <label class="form-label" for="internalName">Internal Name</label>
                            <input class="form-control" type="text" name="internalName" id="internalName" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label" for="officialName">Official Name</label>
                            <input class="form-control" type="text" name="officialName" id="officialName" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label" for="reference">Reference</label>
                            <input class="form-control" type="text" name="reference" id="reference" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label" for="explanation">Explanation</label>
                            <textarea class="form-control" type="text" name="explanation" id="explanation" required></textarea>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label" for="options">Options</label>
                            <p><i>Note: format as CSV, e.g.: "always, sometimes, rarely, never" </i></p>
                            <input class="form-control" type="text" name="options" id="options" required>
                        </div>
                        
                        <div class="mb-3 col-md-21">
                            <label class="form-label" for="referenceMean">Reference Mean</label>
                            <input class="form-control" type="text" name="referenceMean" id="referenceMean" required>
                        </div>

                        <div class="mb-3 col-md-21">
                            <label class="form-label" for="referenceSD">Reference Standard Deviation</label>
                            <input class="form-control" type="text" name="referenceSD" id="referenceSD" required>
                        </div>


                        <p>Questions:</p>

                    <div id="questions-container">
                        <div class="question-container">
                            <input class='form-control' type="text" name="questions[]" placeholder="Enter question">
                            <label class="form-check-label" for="format">Reversed scoring</label>
                            <input type="checkbox" class="form-check-input format-checkbox" name="format[]" value="1">
                            <button id="remove-question" class="button-tertiary">Remove</button>
                        </div>
                    </div>

                    <button class="btn btn-secondary" id="add-question">Add Question</button>
                    
                    <br>
                    <div class="mt-2">
                        <button type="submit" class="button-primary" id="submit-form">Submit Questionnaire</button>
                    </div>


                
                </form>
            </div>
        </div>
    </div>


@endsection()