<!DOCTYPE html>
<html lang="en-US">
	
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bryan Hernandez</title>
	<link rel="stylesheet" href="../css/main.css" />
	<script src="../js/sorttable.js"></script>
</head>
<body>
	<ul class="topnav">
	<li><a class="active" href="../index.php">Home</a></li>
	<li><a href="https://github.com/Bryan1998">GitHub</a></li>
	<li><a href="#">Downloads</a></li>
</ul> 
<hr />
<table class="sortable">
  <thead>
    <tr>
      <th>Filename</th>
      <th>Type</th>
      <th>Size <small>(bytes)</small></th>
      <th>Date Modified</th>
    </tr>
  </thead>
  <tbody>
  <?php
    // Opens directory
    $myDirectory=opendir(".");

    // Gets each entry
    while($entryName=readdir($myDirectory)) {
      $dirArray[]=$entryName;
    }

    // Finds extensions of files
    function findexts($filename) {
      $filename=strtolower($filename);
      $exts=explode(".", $filename);
      $n=count($exts)-1;
      $exts=$exts[$n];
      return $exts;
    }

    // Closes directory
    closedir($myDirectory);

    // Counts elements in array
    $indexCount=count($dirArray);

    // Sorts files
    sort($dirArray);

    // Loops through the array of files
    for($index=0; $index < $indexCount; $index++) {

      // Gets File Names
      $name=$dirArray[$index];
      $namehref=$dirArray[$index];

      // Gets Extensions
      $extn=findexts($dirArray[$index]);

      // Gets file size
      $size=number_format(filesize($dirArray[$index]));

      // Gets Date Modified Data
      $modtime=date("M j Y g:i A", filemtime($dirArray[$index]));
      $timekey=date("YmdHis", filemtime($dirArray[$index]));

      // Print 'em
      print("
      <tr class='$class'>
        <td><a href='./$namehref'>$name</a></td>
        <td>$extn</td>
        <td>$size</td>
        <td sorttable_customkey='$timekey'>$modtime</td>
      </tr>");
    }
  ?>
  </tbody>
</table>

</body>
</html>
