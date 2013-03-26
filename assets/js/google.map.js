function initialize() {
    var paseka = new google.maps.LatLng(54.375883, 26.382510);
    var center = new google.maps.LatLng(54.387554,26.455889);
    var marker;
    var map;

    var mapOptions = {
        center: center,
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"),
        mapOptions);

    var contentString = '<div>Пасека</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    marker = new google.maps.Marker({
        map: map,
        draggable:true,
        animation: google.maps.Animation.DROP,
        position: paseka,
        title:"Пасека Орешкова Сергея Васильевича"
    });
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });
}
