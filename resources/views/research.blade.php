@extends('layouts.app')

@section('title', 'Research')

@section('content')
<div>
    <h3>Research basis</h3>
    <?php 
        $sources = [
            "Miller R. S. (2018). Intimate relationships (Eighth). McGraw-Hill Education."
        ];

        
    ?>

    <p>
        Friendship dependent on:
        - Respect (not really quantifiable in scale) - Frei & Shvaer, 2002
            - The more we respect a friend the more satisfying a relationship (Hendrick et al., 2010)
                - Should find out metrics when people respect one another. Maybe education level has te be included?
                - What other metrics signal respect to another individual?
        - Trust
    </p>

    <p>
        Many scales separate between male and female, age, or other demographic characteristics in the relative score result. 
        This is not yet implemented.

        Scale standard deviations and averages are taken from the source of the scale. Data on SD and averages are collected but not (yet) used.
        Score percentiles are determines based on assumed normal distribution of scores in the scales.
    </p>
</div>
@endsection