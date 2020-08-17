const API_ENDPOINT = 'https://api.spotify.com/v1';
let ACCESS_TOKEN;

$(document).ready(function() {
    if (String(window.location).length > 80){
        $("#hid").css("visibility", "visible");
    }
    else $("#hid").css("visibility", "hidden");
});

function getPlaylist(){
    const currentQueryParameters = getCurrentQueryParameters('#');
    ACCESS_TOKEN = currentQueryParameters.get('access_token');

    if ($("#artist-list li").length + $("#song-list li").length + $("#genres input:checkbox:checked").length > 5){
        $('#error').text("Please fix error.");
    }
    else if ($("#artist-list li").length + $("#song-list li").length + $("#genres input:checkbox:checked").length == 0){
        $('#error').text("At least one artist, one song or genre needs to be selected.");
    } 
    else{
        $('#error').text("");
        let g = "";

        var x = 0;

        $("#genres input:checkbox:checked").each(function(){
            if (x == 0) {
                g += $(this).val();
            }
            else {
                g += ", " + $(this).val();
            }
            x++;
        });

        localStorage.setItem("genres", g);
        localStorage.setItem("artistsId", $('#artist-id').text());
        localStorage.setItem("tracksId", $('#track-id').text());
        localStorage.setItem("artists", $('#artist').text());
        localStorage.setItem("tracks", $('#tracks').text());
        window.location ="res.html#access_token=" + ACCESS_TOKEN;
    }
}

function searchResultsArtist(json){ 
    if ($("#artist-list li").length + $("#song-list li").length + $("#genres input:checkbox:checked").length >= 5){
        $('#too-much').text("Too many parameters.");
    }
    else{
        $('#too-much').text("");
        if (json.artists.items.length == 0){
            $('#not-found2').show();
            $('#not-found2').text("No matching artists with this name were found :(");
        }
        else {
            $('#not-found2').hide();
            if ($('#artist-id').html() != ""){
                $('#artist-id').append("," + json.artists.items[0].id);
                $('#artist').append( ", " +json.artists.items[0].name);
            }
            else {
                $('#artist-id').append(json.artists.items[0].id);
                $('#artist').append(json.artists.items[0].name);
            }

            var l = $("<li>");
            l.text(json.artists.items[0].name);

            $('#artist-list').append(l);
        }
    }
}


function searchArtist(){
    const currentQueryParameters = getCurrentQueryParameters('#');
    ACCESS_TOKEN = currentQueryParameters.get('access_token');
    var name = $("#artist").val();

    if (name == ""){
        $('#empty').text("No empty searches allowed.");

    }
    else{
        $('#empty').text("");
        $.ajax({
            url: 'https://api.spotify.com/v1/search',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer ' + ACCESS_TOKEN
            },
            data: {
                q: name,
                type: 'artist',
                limit: 1
            },
            success: function (response) {
                response = JSON.parse(JSON.stringify(response));
                searchResultsArtist(response);

            },
            error: function(e) {
                console.log(e);
                }
        });
    }
}


function searchResultsSong(json){
    if ($("#artist-list li").length + $("#song-list li").length + $("#genres input:checkbox:checked").length >= 5){
        $('#too-much').text("Too many parameters.");
    }
    else{
        $('#too-much').text("");
        if (json.tracks.items.length == 0){
            $('#not-found').show();
            $('#not-found').text("No matching tracks with this name were found :(");
        }
        else {
            $('#not-found').hide();
            if ($('#track-id').html() != ""){
                $('#track-id').append("," + json.tracks.items[0].id);
                $('#tracks').append(", " + json.tracks.items[0].name);
            }
            else {
                $('#track-id').append(json.tracks.items[0].id);
                $('#tracks').append(json.tracks.items[0].name);
            }

            var l = $("<li>");
            l.text(json.tracks.items[0].name + " by " + json.tracks.items[0].artists[0].name);

            $('#song-list').append(l);
        }
    }
}

function searchSong(){
    var song = $("#name").val();
    if (song == ""){
        $('#empty').text("No empty searches allowed.");
    }
    else{
        $('#empty').text("");
        $.ajax({
            url: 'https://api.spotify.com/v1/search',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer ' + ACCESS_TOKEN
            },
            data: {
                q: song,
                type: 'track',
                limit: 1
            },
            success: function (response) {
                response = JSON.parse(JSON.stringify(response));
                searchResultsSong(response);

            },
            error: function(e) {
                console.log(e);
                }
        });
    }
}

function check(){
    if ($("#artist-list li").length + $("#song-list li").length + $("#genres input:checkbox:checked").length > 5){
        $('#error').text("Too many values added.");
    }
    else {
        $('#error').text("");
    }
}

function updateGenres(json){
    var row = $("<div class = 'row check-row'>");
    var col = $("<div class = 'col check-col'>");
    var colCount = 0;
    for (var i = 0; i < json.genres.length; i++){
        if (i % 8 == 0){
            colCount++;
            row.append(col);
            col = $("<div class = 'col check-col'>");
        }
        if (colCount == 4){
            row = $("<div class = 'row check-row'>");
            $('#genres').append(row);
            colCount = 0;
        }
        var c = $("<input>");
        c.attr({
            "type": "checkbox",
            "id": i,
            "name": json.genres[i],
            "value": json.genres[i],
            "style": "vertical-align: middle;"
        });

        var l = $("<label>");
        l.attr({
            "for": json.genres[i],
            "style": "padding-left: 5px; margin: 0"
        });
        l.text(json.genres[i]);

        var span = $("<div class = 'p-1' style = 'vertical-align: middle;'>");

        span.append(c);
        span.append(l);
        col.append(span);
    }
    $('#genres').append(row);
}

function updateGenresSmall(json){
    var row = $("<div class = 'row check-row-small'>");
    var col = $("<div class = 'col check-col-small'>");
    var colCount = 0;
    for (var i = 0; i < json.genres.length; i++){
        if (i % 8 == 0){
            colCount++;
            row.append(col);
            col = $("<div class = 'col check-col-small'>");
        }
        if (colCount == 2){
            row = $("<div class = 'row check-row-small'>");
            $('#genres').append(row);
            colCount = 0;
        }
        var c = $("<input>");
        c.attr({
            "type": "checkbox",
            "id": i,
            "name": json.genres[i],
            "value": json.genres[i],
            "style": "vertical-align: middle;"
        });

        var l = $("<label>");
        l.attr({
            "for": json.genres[i],
            "style": "padding-left: 5px; margin: 0"
        });
        l.text(json.genres[i]);

        var span = $("<div class = 'p-1' style = 'vertical-align: middle;'>");

        span.append(c);
        span.append(l);
        col.append(span);
    }
    $('#genres').append(row);
}

function fetchGenres() {
    const currentQueryParameters = getCurrentQueryParameters('#');
    ACCESS_TOKEN = currentQueryParameters.get('access_token');

    const fetchTopOptions = {
        method: 'GET',
        headers: new Headers({
            'Authorization': `Bearer ${ACCESS_TOKEN}`
        }),
        data: {
            time_range: 'medium_term',
            limit: 10
        }
    };

    let x = API_ENDPOINT + "/recommendations/available-genre-seeds";

    fetch(x, fetchTopOptions).then(function (response) {
        return response.json();
    }).then(function (json) {
        updateGenres(json);
        updateGenresSmall(json);
    }).catch(function (error) {
        console.log(error);
    });
}
	

function buildAuthLink() {
    const auth = "https://accounts.spotify.com/authorize?client_id=b17468a2df6a462285038526460b24eb&response_type=token&redirect_uri=https%3A%2F%2Fisabellelinhnguyen.com%2Fmusic-match%2F";
    window.location = auth;
}

function getCurrentQueryParameters(delimiter = '#') {
    const currentLocation = String(window.location).split(delimiter)[1];
    const params = new URLSearchParams(currentLocation);
    return params;
}

function l(x) {
	window.location= 'https://isabellelinhnguyen.com/music-match/like.php?id=' + x;
	return false;
}

function d(x) {
	 window.location= 'https://isabellelinhnguyen.com/music-match/delete.php?id=' + x;
	return false;
}

function link(x) {
    let ACCESS_TOKEN;
    const currentQueryParameters = getCurrentQueryParameters('#');
    ACCESS_TOKEN = currentQueryParameters.get('access_token');
    if (ACCESS_TOKEN != null){
        window.location = x +'#access_token=' + ACCESS_TOKEN;
    }
    else {
        window.location = x;
    }   
}

const validate = function(e) {
    if (e.target.value.length > 100 || e.target.value.length == 0){
        e.target.className += " is-invalid";
        document.querySelector('#message-help').style.color = "red";
    }
    else {
        e.target.classList.remove("is-invalid");
        document.querySelector('#message-help').style.color = "black";
    }
}
