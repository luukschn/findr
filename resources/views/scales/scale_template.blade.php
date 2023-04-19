@extends('layouts.app')


@section('title', 'Template')

@section('content')
    
    {{-- @include('scales.scale-1')
    {{ $scale = @yield('scale') }} --}}

    <h3 id="scale-title">{{ $scale['officialName'] }}</h3>
    <p id="scale-explanation">{{ $scale['explanation'] }}</p>
    <p id="scale-reference" class="small">Source:<br>{{ $scale['reference'] }}</p>



    <div id="questionnaire">
        <form 
            id="scale"
            method="post"
            action="{{ url('/submit-scale') }}">
            @csrf

            {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

            <input type="hidden" name="internalName" value="{{ $scale['internalName'] }}" />
            <input type="hidden" name="questionCount" value="{{ count($scale['questions']) }}" />
            <input type="hidden" name="optionCount" value="{{ $scale['option-count'] }}"/>
            <input type="hidden" name="scaleId" value="{{ request()->route('scaleId') }}" />

            <div id="scale-questions">
                <?php
                    echo "<ul id='questions-list'>";
                    
                    foreach ($scale['questions'] as $key => $question) {
                        //question itself
                        
                        echo "<h5>". $question['q'] . "</h5>";
                        

                        // item selector
                        for ($i = 0; $i < $scale['option-count']; $i++) {

                            //label for questions:
                            if (count($scale['options']) == $scale['option-count']) {
                                echo "<label class='form-check-label' for='" . $scale['internalName'] . "-" . $key ."'>" . $scale['options'][$i] . "</label>";
                            }

                            echo "<div class='form-check form-check-inline'>";
                            echo "<input class='form-check-input' type='radio' name='" . $scale['internalName'] . "-" . $key . "' value='" . $i . "' required/>";

                            //probably not the best way of sending this information, but oh well. 
                            echo "<input type='hidden' name='" . $scale['internalName'] . "-format-" . $key . "' value='" . $question['format'] . "'/>";

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