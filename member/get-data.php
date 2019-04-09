
<?php
include_once(dirname(__FILE__) . '/../class/include.php');

$limit = 10;
if (isset($_POST['page']) && $_POST['page'] != "") {
    $page = $_POST['page'];
    $offset = $limit * ($page - 1);
} else {
    $page = 1;
    $offset = 0;
}

$total_rows = Post::totalRows();

$total_pages = ceil($total_rows['total_rows'] / $limit);

$limit_rows = Post::limitRows($offset, $limit);
//$query = "select * from `posts` limit $offset, $limit";
//$res = mysql_query($con, $query);
if (mysql_num_rows($limit_rows) > 0) {
    $results = "";
    $results .= '<input type="hidden" name="total_pages" id="total_pages" value="' . $total_pages . '">';
    $results .= '<input type="hidden" name="page" id="page" value="' . $page . '">';
    $results .= '<div id="results">';
    while ($row = mysql_fetch_object($limit_rows)) {
        $results .= '<h1 class="post-title"><a href="' . $row->member . '" target="_blank">' . $row->id . '</a></h1>';
        $results .= '<p class="text-justify">' . $row->description . '</p>';
    }
    $results .= '</div>';
    echo $results;
}
?>
