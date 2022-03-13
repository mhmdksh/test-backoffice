<?php
require("ROOT.php");
include(ROOT."includes/inc.config.php");
include(ROOT."includes/inc.dbopen.php");
include(ROOT."includes/inc.header.php");

$news = $data_manager->news_list();
if($news === false){
	handleError("Unable to get news list!");
}
?>

<div class="main-container">
<h1 class="main-container-header"><?php echo "News List";?></h1>
		<div class="table-responsive">

		<div class="report-count">Total: <?php echo count($news);?></div>

		<table class="table table-striped table-hover">
            <thead>
            <tr>
                <td>Title</td>
                <td>Date</td>
                <td>Image</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody>
            <?php 
            for($i=0; $i < count($news); $i++){
                echo '
                <tr>
                    <td>'.$news[$i]['n_title'].'</td>
                    <td>'.date(DATE_FORMAT, $news[$i]['n_timestamp']).'</td>
                    <td><a href="'.MEDIA_DIRECTORY."news/".$news[$i]['n_image'].'" target="_blank"><i class="fa fa-external-link-square"></i></a></td>
                    <td>'.($news[$i]['n_status']==1 ? "Active" : "InActive").'</td>
                    
                </tr>';
                }
            ?>
            </tbody>
            </table>
        </div>
	</div>
</div>
<?php 
include(ROOT."includes/inc.footer.php");
include(ROOT."includes/inc.dbclose.php");
?>