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
                questionTemplate.find('.format-checkbox').prop('checked', false);
                
                // var questionIndex = $('.question-container').length;
                // questionTemplate.find('input[type="hidden"]').attr('name', 'format[' + questionIndex + ']');
                // questionTemplate.find('input[type="checkbox"]').attr('name', 'format[' + questionIndex + ']');

                $('#questions-container').append(questionTemplate);
            });

        // Remove question
        $(document).on('click', '.remove-question', function(e) {
            e.preventDefault();

            //prevent removal of last question
            // var questions = document.getElementById(".question-container");
            // if (questions.getElementsByTagName('*').length > 1) {
                
            // }
            $(this).closest('.question-container').remove();
        });

        $('#submit-form').click(function(e) {
            e.preventDefault();

            var questions = $('input[name="questions[]"]').map(function() {
                return $(this).val();
            }).get();

            // var format = $('input[name="format[]"]').map(function() {
            //     return $(this).is('checked') ? '1' : '0';
            // }).get();

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
            <div class="col-md-3">
                
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
                            <p>Note: format as CSV, e.g.: "always, sometimes, rarely, never"</p>
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
                        {{-- <div class="question-container">
                            <input class='form-control' type="text" name="questions[]" placeholder="Enter question">
                            <br>
                            <label class="form-check-label" for="format-normal">Normal</label>
                            <input type="radio" class="form-check-input" name="format[]" value="0" id="format-normal" checked>
                            <label class="form-check-label" for="format-reversed">Reversed</label>
                            <input type="radio" class="form-check-input" name="format[]" value="1" id="format-reversed">
                            <br>
                            <button class="remove-question">Remove</button>
                        </div>

                        <div id="questions-container">
                            <!-- Existing questions will be appended here -->
                        </div>
                    <br>

                        <button id="add-question" class='btn btn-primary'>Add Question</button>
                    </div>--}}

                    <div id="questions-container">
                        <div class="question-container">
                            <input class='form-control' type="text" name="questions[]" placeholder="Enter question">
                            <label class="form-check-label" for="format">Reversed scoring</label>
                            <input type="checkbox" class="form-check-input format-checkbox" name="format[]" value="1">
                            <button class="remove-question">Remove</button>
                        </div>
                    </div>

                    <button class="btn btn-secondary" id="add-question">Add Question</button>
                    
                    <br>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary" id="submit-form">Submit Questionnaire</button>
                    </div>


                
                </form>
            </div>
        </div>
    </div>


@endsection()