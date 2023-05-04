
$(document).ready(function(){
    // Live Search
    $(".statisticTable").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".statisticTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Sort by category
    $(".category").on("change", function() {
        var value = $(this).val().toLowerCase();
        $(".statisticTable tr").filter(function() {
            if (value == "") {
                $(this).toggle(true);
            } else {
                return $(this).children("td:nth-child(2)").text().toLowerCase().indexOf(value) > -1;
            }
        }).toggle();
    });
});

//terkep
// var attraction_id = <?php echo json_encode($attraction_id); ?>;

// var markers_array = [];
// function initMap() {
//     map = new google.maps.Map(document.getElementById('map'), {
//         center: center,
//         zoom: 8
//     });
//     $.ajax({
//         url: "../maps/attraction.php?id=" + attraction_id,
//         method: "GET",
//         dataType: "JSON",
//     }).done(function (data) {
//         manage_markers(data);
//     }).fail(function (err) {
//         console.log("error");
//     });
// }
// function manage_markers(data) {
//     for(var x in data) {
//         draw_markers(data[x]);
//     }
// }
// function draw_markers(positions) {
//     var marker = new google.maps.Marker({
//         position: {lat: parseFloat(positions['lattitude']), lng: parseFloat(positions['longitude'])},
//         map: map
//     });
//     markers_array.push(marker);
// }
