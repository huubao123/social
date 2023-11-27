(function($){

var menu = {};
var page = {};
var index = {};
var map;
var infoWindow;
var curentPos;
$(document).ready(function() {
    page.district();
    menu.init();
    index.animate_cover();
});


index.map = function() {
    map = new google.maps.Map(document.getElementById('map'), {});
    infoWindow = new google.maps.InfoWindow({
        maxWidth: 350
    });
    var latlngbounds = new google.maps.LatLngBounds();
    var LatLngList = [];
    $('.map-list-store li').each(function() {
        var latlng = $(this).children("a").data("latlng");
        latlng = latlng.split("-");
        var lat = Number(latlng[0]);
        var lng = Number(latlng[1]);
        
        var marker = new google.maps.Marker({
            position: {
                lat: lat,
                lng: lng
            },
            map: map,
            icon: 'assets/images/video-play.png'
        });



        LatLngList.push(new google.maps.LatLng(lat, lng));
        $(this).children("a").click(function(e) {
            e.preventDefault();
            var latlng = $(this).data("latlng");
            latlng = latlng.split("-");
            var pos = {
                lat: Number(latlng[0]),
                lng: Number(latlng[1])
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent($(this).text());
            infoWindow.open(map);
            map.setCenter(pos);
        });
    });
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            curentPos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var marker = new google.maps.Marker({
                position: curentPos,
                map: map,
                icon: 'images/icons/icon_current.svg'
            });
            LatLngList.push(new google.maps.LatLng(curentPos.lat, curentPos.lng));
        });
    }
    LatLngList.forEach(function(latLng) {
        latlngbounds.extend(latLng);
    });
    map.setCenter(latlngbounds.getCenter());
    map.setZoom(13);
};
index.direction = function() {
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer({
        suppressMarkers: true,
        polylineOptions: {
            strokeColor: "#0C713D"
        }
    });
    directionsDisplay.setMap(map);
    $('.map-list-store li').each(function() {
        var latlng = $(this).children("a").data("latlng");
        latlng = latlng.split("-");
        var lat = Number(latlng[0]);
        var lng = Number(latlng[1]);
        $(this).children("button").click(function() {
            directionsService.route({
                origin: curentPos,
                destination: {
                    lat: lat,
                    lng: lng
                },
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        })
    });
};
index.animate_cover = function() {
    $('#home_id ul li').each(function() {
        $(this).hover(function() {
            $(this).children("img").toggleClass('animated bounceIn');
        });
    });
};
menu.init = function() {
    $(".h_menu__btn, .h_menu__overlay").click(function() {
        $(".h_menu").toggleClass("active");
    });
    if ($(window).width() <= 991) {
        $(".main-full").css("margin-top", function() {
            return $("header").outerHeight(true) + $(".h_logo").outerHeight(true);
        });
    } else {
        $(".main-full").css("margin-top", function() {
            return $("header").outerHeight(true);
        });
    }
};




var data_district = [{
        "id": "1",
        "name": "Tp Hồ Chí Minh",
        "lat": "10.7687085",
        "long": "106.4141728",
        "district": [

        {
            "id": "1",
            "name": "Quận 1",
            "store": [{
                "lat": "10.763924",
                "long": "106.682804",
                "name": "TTTM NowZone ",
                "address": "235 Nguyễn Văn Cừ, Quận 1",
                "phone": "0123456789"

            }, {
                "lat": "10.773045",
                "long": "106.702646",
                "name": "26 Huỳnh Thúc Kháng",
                "address": "235 Nguyễn Văn Cừ, Quận 1",
                "phone": "0123456789"
            }]
        }, {
            "id": "2",
            "name": "Quận 3",
            "store": [{
                "lat": "10.7830099",
                "long": "106.696067",
                "name": "42 Trần Cao Vân",
                "address": "235 Nguyễn Văn Cừ, Quận 1",
                "phone": "0123456789"
            }, {
                "lat": "10.777984",
                "long": "106.689742",
                "name": "B-004A, TTTM RomeA - 117 Nguyễn Đình Chiểu, Quận 3",
                "address": "235 Nguyễn Văn Cừ",
                "phone": "0123456789"
            }]
        }, {
            "id": "5",
            "name": "Phú Nhuận",
            "store": [{
                "lat": "10.7970586",
                "long": "106.6734174",
                "name": "Centre Point",
                "address": "235 Nguyễn Văn Cừ, Quận 1",
                "phone": "0123456789"
            }]
        }, {
            "id": "6",
            "name": "Tân Bình",
            "store": [{
                "lat": "10.8006119",
                "long": "106.6606479",
                "name": "1B Cộng Hòa",
                "address": "235 Nguyễn Văn Cừ, Quận 1",
                "phone": "0123456789"
            }]
        }, {
            "id": "7",
            "name": "Bình Tân",
            "store": [{
                "lat": "10.7437149",
                "long": "106.6130481",
                "name": "G17, Aeon Mall Bình Tân ",
                "address": "235 Nguyễn Văn Cừ, Quận 1",
                "phone": "0123456789"
            }]
        }]
    }, {
        "id": "2",
        "name": "Bình Dương",
        "lat": "11.1827222",
        "long": "106.3709458",
        "district": [{
            "id": "1",
            "name": "Thị xã Thuận An",
            "store": [{
                "lat": "10.931793",
                "long": "106.711701",
                "name": "G31, Aeon Mall Bình Dương Canary",
                "address": "235 Nguyễn Văn Cừ, Quận 1",
                "phone": "0123456789"
            }]
            
        }]
}];



//fillCity();


page.district = function() {
    fillCity();
    loadDistrict();
    loadDistrictFirst();
    loadStore();
    index.map();
    index.direction();
    $('#slb_city').on('change', function(e) {
        loadDistrict();
        loadStore();
        index.map();
        index.direction();
    });
    $("#slb_district").on('change', function() {
        loadStore();
        index.map();
        index.direction();
    });
};

function fillCity() {
        for (var i = 0; i < data_district.length; i++) {
            $("#slb_city").append('<option value="' + data_district[i].id + '">' + data_district[i].name + '</option>');
        }            
}        

function loadDistrictFirst() {
    for (var i = 0; i < data_district.length; i++) {
        $('#slb_district').html('');
        for (var j = 0; j < data_district[0].district.length; j++) {
            $("#slb_district").append('<option value="' + data_district[0].district[j].id + '">' + data_district[0].district[j].name + '</option>');
        }
    }
}


function loadDistrict() {
    $('#slb_city').on('change', function () {
        console.log($(this).val());
        for (var i = 0; i < data_district.length; i++) {
            if (data_district[i].id == $(this).val()) {
                //$('#slb_district').html('<option value="000">-Select State-</option>');
                $('#slb_district').html('');
                for (var j = 0; j < data_district[i].district.length; j++) {
                    $("#slb_district").append('<option value="' + data_district[i].district[j].id + '">' + data_district[i].district[j].name + '</option>');
                }
            }
        }
    });
}



function loadStore() {
    var c = Number($("#slb_city").val());
    var d = Number($("#slb_district").val());
    var store = [];
    for (var i = 0; i < data_district.length; i++) {
        if (c == data_district[i].id) {
            for (var j = 0; j < data_district[i].district.length; j++) {
                if (d == data_district[i].district[j].id) {
                    store = data_district[i].district[j].store;
                    break;
                }
            }
        }
    }
    var html = "";
    for (var i = 0; i < store.length; i++) {
        html += '<li><a href="http://maps.google.com/?q=' + store[i].name + '" data-latlng="' + store[i].lat + '-' + store[i].long + '">';
        html += '<span class="name">' + store[i].name + '</span> ';
        html += '<span class="address">' + store[i].address + '</span> ';
        html += '<span class="phone"> <span class="b"> Điện thoại </span>' + store[i].phone + '</span> </a>';
        html += '</li>';



    }





    $(".map-list-store").html(html);
}





})(jQuery);


