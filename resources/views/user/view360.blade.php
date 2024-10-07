<!-- resources/views/360view.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>360° Image Viewer</title>
    <style>
        #pano {
            width: 50%;
            height: 500px;
            background-color: #000;
        }
    </style>
</head>
<body>
    <a class="nav-link" href="{{ route('user.index') }}" style="color: #007bff; font-weight: bold; padding: 10px 15px; text-decoration: none; border-radius: 5px; background-color: #f8f9fa; border: 1px solid #007bff;">
        Trang chủ
    </a>
    <div id="pano"></div>

    <script src="{{ asset('assets') }}/js/vendor/marzipano.js"></script>

    <script>
        var viewer = new Marzipano.Viewer(document.getElementById('pano'));

        // Create source.
        var source = Marzipano.ImageUrlSource.fromString(
        "{{asset('storage/images/products')}}/{{$latestImage}}"
        );
        // Create geometry.
        var geometry
       var geometry = new Marzipano.EquirectGeometry([{ width: 4000 }]);

        // Create view.
        var limiter = Marzipano.RectilinearView.limit.traditional(4096/3, 100*Math.PI/180);
        var view = new Marzipano.RectilinearView(null, limiter);

        // Create scene.
        var scene = viewer.createScene({
        source: source,
        geometry: geometry,
        view: view,
        pinFirstLevel: true
        });
        // Display scene.
        scene.switchTo();

    </script>
</body>
</html>
