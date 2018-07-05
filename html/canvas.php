<!DOCTYPE html>
<html>
<head>
    <link rel = "stylesheet" href = "style.css">
    <title>Freed Soul</title>
</head>
    <body>
        <?php echo file_get_contents("navbar.html"); ?><br>

        <div id = "color-palette" class = "txt1">
            Color Palette<br>
            Red <input class = "slider1" id = "red1" type = "range" value = 255 min = 0 max = 255 oninput = "update_test_color(this);"><br>
            Green <input class = "slider1" id = "green1" type = "range" value = 255 min = 0 max = 255 oninput = "update_test_color(this);"><br>
            Blue <input class = "slider1" id = "blue1" type = "range" value = 255 min = 0 max = 255 oninput = "update_test_color(this);"><br>
            Hold <input id = "hold1" type = "checkbox"> <div style = "display:inline-block;" id = "test-color">color</div>
        </div><br><br>

        <div id = "dcolor-canvas" class = "txt1">
            CANVAS<br>
            <div class = "red3">Red</div><input class = "slider1 red3" id = "red3" type = "range" value = 255 min = 0 max = 255 oninput = "update_color_canvas(this);"><br>
            <div>Green</div>
            <div id = "blue-canvas">
                <div class = "vertical">Blue</div>
                <div id = "dcolor-canvas2">
                    <canvas onmouseup = "mouseDown = 0; gx = gy = -1;" onmousedown = "mouseDown = 1; catchxy_canvas(event); read_mouse_canvas(event);" onmousemove = "read_mouse_canvas(event);" id = "color-canvas"  width = 256 height = 256>
                    no support
                    </canvas>
                    <input type = "text" onmouseup = "readxy(this);"><br>
                    <input type = "text" onmouseup = "readxy(this);"><br>
                    <input type = "text" onmouseup = "readxy(this);"><br>
                    <input type = "text" onmouseup = "readxy(this);"><br>
                    <input type = "text" onmouseup = "readxy(this);"><br>
                    <input type = "text" onmouseup = "readxy(this);">
                </div>
            </div><br>
            <div>
                <input id = "input-color" type = "text"  readonly>
                <div id = "color-render"></div>
            </div>
        </div><br><br>

    <script src = "script.js"></script>
    </body>
</html>
