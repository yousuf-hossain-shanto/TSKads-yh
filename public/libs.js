function loadAds(user_id, callback) {
    var xhttp;
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xhttp = new XMLHttpRequest();
        console.log('XMLHttpRequest');
    } else {
        // code for IE6, IE5
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        console.log('ActiveXObject');
    }
    xhttp.onreadystatechange = function() {
        if (this.status == 200 && this.readyState == 4) {
            //console.log('success');
            //console.log(this.responseText);
            callback(this.responseText);
        } else if(this.readyState == 4) {
            console.log('error');
        }
    };
    xhttp.open('GET', "http://127.0.0.1:8000/api/getads/"+user_id);
    xhttp.send();
}

function forAds(data, callback) {
    var json = JSON.parse(data);

    if (json.status == '1') {
        var ads = json.ads;
        for (var ad in ads) {
            //console.log(ads[ad]);
            callback(ads[ad]);
        }
    }

}