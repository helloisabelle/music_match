$(document).ready(function() {
if (String(window.location).length > 80){
    $("#hid").css("visibility", "visible");
}
else{
    $("#hid").css("visibility", "hidden");
}
})




    let ACCESS_TOKEN;

    function getCurrentQueryParameters(delimiter = '#') {
        const currentLocation = String(window.location).split(delimiter)[1];
        const params = new URLSearchParams(currentLocation);

        return params;
    }

function l(x) {
	window.location= 'http://303.itpwebdev.com/~isabelln/project/m/like.php?id=' + x;
	return false;
}


function d(x) {
	 window.location= 'http://303.itpwebdev.com/~isabelln/project/m/delete.php?id=' + x;
	return false;
}

function link(x) {
            const currentQueryParameters = getCurrentQueryParameters('#');
            ACCESS_TOKEN = currentQueryParameters.get('access_token');
            if (ACCESS_TOKEN != null){
                window.location = x +'#access_token=' + ACCESS_TOKEN;
            }
            else {
                window.location = x;
            }
            
        }
