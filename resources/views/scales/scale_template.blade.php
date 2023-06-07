@extends('layouts.app')


@section('title', 'Template')

@section('content')
    
    {{-- @include('scales.scale-1')
    {{ $scale = @yield('scale') }} --}}

    <h3 id="scale-title">{{ $data['scale']['officialName'] }}</h3>
    <p id="scale-explanation">{{ $data['scale']['explanation'] }}</p>
    <p id="scale-reference" class="small">Source:<br>{{ $data['scale']['reference'] }}</p>



    <div id="questionnaire">
        <form 
            id="scale"
            method="post"
            action="{{ url('/submit-scale') }}">
            @csrf

            <input type="hidden" name="internalName" value="{{ $data['scale']['internalName'] }}" />
            {{-- <input type="hidden" name="officialName" value=" {{ $scale['officialName'] }}" /> --}}
            <input type="hidden" name="questionCount" value="{{ count($data['questions']) }}" />
            <input type="hidden" name="optionCount" value="{{ $data['scale']['option-count'] }}"/> 
            <input type="hidden" name="scale_id" value="{{ request()->route('scale_id') }}" />

            <div id="scale-questions">
                <?php
                    echo "<ul id='questions-list'>";

                    $question_counter = 0;
                    
                    foreach ($data['questions'] as $question) {
                        //question itself
                        echo "<div class='question'>";
                        echo "<h5>". $question['question_text'] . "</h5>";
                        
                        

                        // item selector
                        for ($i = 0; $i <= ($data['scale']['option-count'] - 1); $i++) {

                            //label for questions:
                            // if (count($data['scale']['options']) == $data['scale']['option-count']) {
                            //     echo "<label class='form-check-label' for='" . $data['scale']['internalName'] . "-" . $data['scale']['options'][$i] . "-" . $q_counter . "'>" . $data['scale']['options'][$i] . "</label>";
                            // }
                            echo "<label class='form-check-label' for='" . $data['scale']['internalName'] . "-" . $question_counter . "'>" . $data['scale']['options'][$i] . "</label>";


                            echo "<div class='form-check form-check-inline'>";
                            echo "<input class='form-check-input' type='radio' name='" . $data['scale']['internalName'] . "-" . $question_counter . "' value='" . $i . "' required/>";

                            //probably not the best way of sending this information, but oh well. 
                            echo "<input type='hidden' name='" . $data['scale']['internalName'] . "-format-" . $question_counter . "' value='" . $question['format'] . "'/>";

                            //need to devise a way to dynamically spread the options evenly if options are fewer than the count of radio buttons

                            echo "</div>";

                            
                        }

                        $question_counter++;

                        echo "</div>";
                        
                    }
                    
                    echo "</ul>";
                ?>
             
            </div>

            <div class='mt-2'>
                <button type="submit" class="button-primary">Submit answers</button>
            </div>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                
        </form>

            
    </div>
@endsection