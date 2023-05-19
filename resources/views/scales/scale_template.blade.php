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
            <input type="hidden" name="scaleId" value="{{ request()->route('scaleId') }}" />

            <div id="scale-questions">
                <?php
                    echo "<ul id='questions-list'>";
                    
                    foreach ($data['questions'] as $question) {
                        //question itself
                        
                        echo "<h5>". $question['question_text'] . "</h5>";
                        

                        // item selector
                        for ($i = 0; $i < ($data['scale']['option-count'] - 1); $i++) {

                            //label for questions:
                            if (count($data['scale']['options']) == $data['scale']['option-count']) {
                                echo "<label class='form-check-label' for='" . $data['scale']['internalName'] . "-" . $data['scale']['options'][$i] ."'>" . $data['scale']['options'][$i] . "</label>";
                            }

                            echo "<div class='form-check form-check-inline'>";
                            echo "<input class='form-check-input' type='radio' name='" . $data['scale']['internalName'] . "-" . $data['scale']['options'][$i] . "' value='" . $i . "' required/>";

                            //probably not the best way of sending this information, but oh well. 
                            echo "<input type='hidden' name='" . $data['scale']['internalName'] . "-format-" . $data['scale']['options'][$i] . "' value='" . $question['format'] . "'/>";

                            //need to devise a way to dynamically spread the options evenly if options are fewer than the count of radio buttons

                            echo "</div>";
                        }
                        
                    }
                    
                    echo "</ul>";
                ?>
             
            </div>

            <div class='mt-2'>
                <button type="submit" class="btn btn-primary">Submit answers</button>
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