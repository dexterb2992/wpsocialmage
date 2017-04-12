<?php
if(!isset($_FILES['image'])) exit(0);

if ( 0 < $_FILES['image']['error'] ) {
    echo json_encode( array('status' => 'failed', 'msg' => 'Error: '.$_FILES['image']['error'].'<br>') ); 
}else {
	if( file_exists($_FILES['image']['name']) ){
		$var = explode('.', $_FILES['image']['name']);
		$_FILES['image']['name'] = $var[0].time().$var[1];
	}

    if( move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $_FILES['image']['name']) ){
    	echo json_encode( array('status' => 'success', 'msg' => $_FILES['image']['name']." uploaded successfully.", 'filename' => $_FILES['image']['name']) );
    }
}
