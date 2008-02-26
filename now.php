<?php require("include/common.php"); ?>
<?php require("include/mpd.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Now playing</title>
<link rel="stylesheet" type="text/css" href="http://www.inspiralled.net/streamer/radio_template_css.css">
<meta http-equiv="refresh" content="30">
<style type="text/css">
<!--

#opacity {
      opacity: 0;
     }

#alltransparent {
      opacity: 0;
     }

#ietransparent {
       opacity: 0;
     }

#transparent {
	background:transparent url(http://www.inspiralled.net/images/transparent.png);
	}

-->
</style>
<!--[If lt IE 7]>
<style type="text/css">

#alltransparent {
   filter:alpha(opacity=0);
        height:1%;
      }

#ietransparent {
       filter:alpha(opacity=0);
        height:1%;
      }

#ietransparent * {
     filter:alpha(opacity=0);
        position:relative;
      }

#transparent {
filter:alpha(opacity=0);
        height:1%;
      }

#transparent * {
       filter:alpha(opacity=0);
        position:relative;
      }
</style>
<![endif]-->
</head><body marginwidth="0" marginheight="0">
<?php
if($data = mpd_now_playing()) {
	$album = new album();
 ?>
<table width="100" border="0">
	<tbody>
	<tr>
             <td colspan="2" align="center">
		<?php if($album->getByOther(array('name'=>$data['album']))) { ?>
		<a href="album.php?album_id=<?= $album->id ?>" target="_new">
		<?php
		if($album->image_id) {
			$image = new image();
			$image->show($album->image_id,100,100);
		}
		?></a>
		<?php } ?>
		</td>
	</tr>
	<tr>
		<td>Artist&nbsp;:</td>
		<td>
			<?php 
			$artist = new artist();
			if($artist->getByOther(array('name'=>$data['artist']))) {
				?><a href="browse.php?type=artist&amp;id=<?= $artist->id ?>" target="_new"><?= $data['artist'] ?></a><?php
			}
			else { ?><?= $data['artist'] ?><?php
			}
			?>
		</td>
	</tr>
	<tr>
		<td>Album&nbsp;:</td>
		<td><?if($album->id) { ?><a href="album.php?album_id=<?= $album->id ?>" target="_new" ><? } ?><?= $data['album'] ?><? if($album->id) { ?></a><? } ?></td>
        </tr>
	<tr>
		<td>Track&nbsp;:</td>
		<td><?= $data['title'] ?> (<?= $data['time'] ?>)</td>
	</tr>
</tbody>
</table>

	<?php
}
else { ?>
<p>Unknown</p>
<?php
}
?>
</body>
</html>
