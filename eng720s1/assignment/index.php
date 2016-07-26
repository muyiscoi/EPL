<?php
require_once 'includes/header.php';
if ($_GET){
	if($_GET['r'] = 'nopub'){
	echo "NOTE: Search for publication to view/download";
}
}
?>
<div class="container col-md-offset-3 col-md-6 col-md-offset-3">
  <h1 style="text-align:center"> Engineering Publications Library </h1>
    <div class="row" style="line-height:150px">
<form method="get" action="search.php">
           <div id="imaginary_container">
               <div class="input-group stylish-input-group">
                   <input type="text" class="form-control input-lg" name="search" id="search" placeholder="Search" >
                   <span class="input-group-addon">
                       <button type="submit">
                           <span class="glyphicon glyphicon-search"></span>
                       </button>
                   </span>
               </div>
 </div>
</form>
</div>
<div class='col-xs-offset-3 col-xs-8'><h4> <a href='advanced.php'> Advanced Search </a> | <a href='search.php?search='>View all publications </a></h4></div>
</br>
	<div class="row">
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Recently added Publications</h3>
  </div>
  <div>
<?php
 $query = "SELECT * FROM publications ORDER BY date_added DESC";
 $result = queryMysql($query);
 $rows = $result->num_rows;
 $j = 0;
 while ($j < 4){
    $j = $j+1;
    $result->data_seek($j);
    $row = $result->fetch_assoc();
    echo "<h4><a href='viewpub.php?pubid=".$row['pub_id']."'>".$row['title']."</a></h4><hr>";
}
echo "  </div></div>
</div>
</div>
</div>";
require_once 'includes/footer.php';
echo "</body></html>";
?>
