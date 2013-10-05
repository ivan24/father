function Maps(options) {
    this.options = $.extend({},options,Maps.defaultOptions);
    this.init();
}
Maps.prototype.init = function (options) {
        var apiary = new google.maps.LatLng(this.options.coordinates.apiary.lat, this.options.coordinates.apiary.lon),
            center = new google.maps.LatLng(this.options.coordinates.mapCenter.lat,this.options.coordinates.mapCenter.lon),
            mapOptions = {
                center: center,
                zoom: 5,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            },
            map = new google.maps.Map(document.getElementById("map_canvas"),
                mapOptions),
            infowindow =new google.maps.InfoWindow({content: this.options.infoWindow.content}),
            marker = new google.maps.Marker({
                map: map,
                draggable:true,
                animation: google.maps.Animation.DROP,
                position: apiary,
                title:"Пасека Орешкова Сергея Васильевича"
            });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
};

Maps.defaultOptions = {
    coordinates: {
        apiary: {
            lat: 54.375883,
            lon: 26.382510
        },
        mapCenter: {
            lat: 54.387554,
            lon: 26.455889
        }
    },
    infoWindow: {
        content: '<div>Пасека</div>'
    }
};

new Maps();


