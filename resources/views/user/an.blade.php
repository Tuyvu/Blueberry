@extends('user.master')
@section('title', 'cart')
@section('main-content')
@include('user.header')

<style>
    #pano {
        width: 100%; /* Set width to 100% of the container */
        max-width: 1350px; /* Max width of 1350px */
        height: 680px; /* Set fixed height */
        background-color: #000;
        margin: 0 auto; /* Center the pano container */
        overflow: hidden; /* Prevent overflow */
    }
</style>

<section class="section-shop padding-b-50">
    <div class="container">
        <div id="pano"></div>
    </div>
    
    <script src="{{ asset('assets') }}/js/vendor/marzipano.js"></script>
    <script>
        // Initialize Marzipano viewer
        var viewer = new Marzipano.Viewer(document.getElementById('pano'));

        // Specify the URL for the 360 image
        var imageUrl = "{{ asset('assets') }}/img/product/3-loi-ich-tuyet-voi-sau-cho-cac-doanh-nghiep.jpg";

        // Define the source and geometry
        var source = Marzipano.ImageUrlSource.fromString(imageUrl);
        var geometry = new Marzipano.EquirectGeometry([{ width: 4000 }]);

        // Define the view parameters
        var limiter = Marzipano.RectilinearView.limit.traditional(1024, 100 * Math.PI / 180);
        var view = new Marzipano.RectilinearView(null, limiter);

        // Create a scene
        var scene = viewer.createScene({
            source: source,
            geometry: geometry,
            view: view
        });

        // Display the scene
        scene.switchTo();
    </script>
</section>

@include('user.footer')
@include('user.slider')
@endsection
