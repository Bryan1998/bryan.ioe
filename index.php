<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}
</script>
<head>
<title>Push The Win Button</title>
<link rel="stylesheet" href="css/main.css" />
</head>
<body>
<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">
<img src="img/logo.png" draggable="true" ondragstart="drag(event)" id="drag1" />
</div>
<p>A very random number between 1 and 100 is <?php echo(mt_rand(0,100)); ?></p>
</br>
<div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
</body>
</html>
