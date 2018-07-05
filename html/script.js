var mouseDown = 0;
var gx = -1;
var gy = -1;


function dclose(id) {
    document.getElementById(id).style.display = "none";
}

function animation_god() {
    var elem = document.getElementById("god");
    elem.style.display = "block";
    var posx = 400;
    var posy = 0;
    var id = setInterval(frame, 1);
    function frame () {
        if (posx == 0) {
            clearInterval(id);
            elem.style.display = "none";
        }
        else {
            posx--;
            elem.style.left = posx+'px';
            elem.style.top = posy+'px';
        }
    }
}

function open_cunha() {
    var elem = document.getElementById("cunha");
    elem.style.display = "block";
}

function two_dig_hex(s) {
    if (s.length == 1)
        return '0' + s;
    return s;
}

function update_test_color(col) {
    //alert("update");
    var elem = document.getElementById("test-color");
    var check = document.getElementById("hold1");
    var red, blue, green;
    if (check.checked == true) {
        document.getElementById("red1").value = col.value;
        document.getElementById("blue1").value = col.value;
        document.getElementById("green1").value = col.value;
    }
    red = parseInt(document.getElementById("red1").value).toString(16);
    blue = parseInt(document.getElementById("blue1").value).toString(16);
    green = parseInt(document.getElementById("green1").value).toString(16);
    red = two_dig_hex(red);
    blue = two_dig_hex(blue);
    green = two_dig_hex(green);
    var s = "#"+red+green+blue;
    s = s.toUpperCase();
    //alert(s);
    elem.style.color = s;
    elem.innerHTML = s;
}

function update_color_svg(red) {
    return;
    if (!(red.value === undefined))
        red = parseInt(red.value);
    var svg = "http://www.w3.org/2000/svg",
    container = document.getElementById("color-svg");
    while (container.lastChild) {
        container.removeChild(container.lastChild);
    }
    //alert("after clear");
    for (var x = 0; x < 256; x++) {
        for (var y = 0; y < 256; y++) {
            var dot = document.createElementNS(svg, 'circle');
            dot.setAttributeNS(null, 'cx', x);
            dot.setAttributeNS(null, 'cy', y);
            dot.setAttributeNS(null, 'r', 1);
            var color = '#'+two_dig_hex(red.toString(16))+two_dig_hex(x.toString(16))+two_dig_hex(y.toString(16));
            //alert(color);
            var div = document.getElementById("color-render");
            div.innerHTML = color;
            dot.setAttributeNS(null, 'style', "fill: "+color);
            container.appendChild(dot);
        }
    }
}

//update_color_svg(0);

function update_color_canvas (red) {
    if (!(red.value === undefined))
        red = parseInt(red.value);
    var canvas = document.getElementById("color-canvas");
    var cx = canvas.getContext("2d");
    cx.clearRect(0, 0, canvas.width, canvas.height);
    for (var x = 0; x < 256; x++) {
        for (var y = 0; y < 256; y++) {
            var color = '#'+two_dig_hex(red.toString(16))+two_dig_hex(x.toString(16))+two_dig_hex(y.toString(16));
            //alert(color);
            cx.beginPath();
            cx.lineWidth = 1;
            cx.strokeStyle = color;
            cx.rect(x,y,1,1);
            cx.stroke();
            //var div = document.getElementById("color-render");
            //div.innerHTML = color;
        }
    }
}

var temp = document.getElementById('red3');
temp = parseInt(temp.value);
update_color_canvas(temp);

function newx(canvas, event) {
    event = event || window.event;
    var rect = canvas.getBoundingClientRect(),
        scaleX = canvas.width / rect.width,
        x = parseInt((event.clientX - rect.left) * scaleX);
    return x;
}

function newy(canvas, event) {
    event = event || window.event;
    var rect = canvas.getBoundingClientRect(),
        scaleY = canvas.height / rect.height,
        y = parseInt((event.clientY - rect.top) * scaleY);
    return y;
}

function catchxy_canvas(event) {
    var canvas = document.getElementById('color-canvas');
    gx = newx(canvas, event);
    gy = newy(canvas, event);
}

function readxy(e) {
    if (gx == -1)
        return;
    var red = parseInt(document.getElementById('red3').value);
    var color = '#'+two_dig_hex(red.toString(16))+two_dig_hex(gx.toString(16))+two_dig_hex(gy.toString(16));
    e.value = color;
}

function read_mouse_canvas(event) {
    try {
    if (mouseDown == 0)
        return;

    event = event || window.event;
    var canvas = document.getElementById('color-canvas'),
        x = newx(canvas, event);
        y = newx(canvas, event);
        //x = event.pageX - canvas.offsetLeft,
        //y = event.pageY - canvas.offsetTop;
    if (x >= 256 || y >= 256)
        return;
    var div = document.getElementById("color-render");
    var div2 = document.getElementById("input-color");
    var red = parseInt(document.getElementById('red3').value);
    var color = '#'+two_dig_hex(red.toString(16))+two_dig_hex(x.toString(16))+two_dig_hex(y.toString(16));
    div.style.backgroundColor = color;
    div2.value = color;
}
catch(e) {
    alert(e.message);
}
}
