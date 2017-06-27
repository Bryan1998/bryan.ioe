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
      <th>Size</th>
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
      $dirArray = array_filter($dirArray, create_function('$a','return ($a[0]!=".");'));
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
		function convertToReadableSize($size){
		$base = log($size) / log(1000);
		$suffix = array("", "KB", "MB", "GB", "TB");
		$f_base = floor($base);
		return round(pow(1000, $base - floor($base)), 1) . "&nbsp;" . $suffix[$f_base];
	}
    // Loops through the array of files
    for($index=0; $index < $indexCount; $index++) {

      // Gets File Names
      $name=$dirArray[$index];
      $namehref=$dirArray[$index];

      // Gets Extensions
      $extn=findexts($dirArray[$index]);

      // Gets file size
      $size=convertToReadableSize(filesize($dirArray[$index]));

      // Gets Date Modified Data
      $modtime=date("m/d/Y G:i", filemtime($dirArray[$index]));
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
