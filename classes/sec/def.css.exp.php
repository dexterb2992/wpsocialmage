<style>
<?php echo '.',$prefix?>expsection {
    position: absolute;
    border: 1px solid #7ad03a;
    right: 10px;
    top: 10px;
    z-index: 10;
    background: white;
    overflow: hidden;
    font-family: sans-serif;
    font-size: 16px;
    color: #777
}
<?php echo '.',$prefix?>explabel, <?php echo '.',$prefix?>expdatetime {
    display: inline-block;
}
<?php echo '.',$prefix?>explabel {
    background-color: #F5F5F5;
    padding: 0px;
	width: 24px;
	background: #fff;
	text-align: center;
	padding: 4px 0px 1px 0px;
}
<?php echo '.',$prefix?>expdatetime {
    width: 0;
    background-color: #FFFFFF;
    -webkit-transition: width 0.25s ease-in-out;
    -moz-transition: width 0.25s ease-in-out;
    -o-transition: width 0.25s ease-in-out;
    transition: width 0.25s ease-in-out;
	text-align: left;
}
<?php echo '.',$prefix?>expdatetime <?php echo '.',$prefix?>inner {
    width: 154px;
}
<?php echo '.',$prefix?>expsection:hover <?php echo '.',$prefix?>expdatetime, <?php echo '.',$prefix?>expsection.active <?php echo '.',$prefix?>expdatetime {
    width: 154px;
}
<?php echo '.',$prefix?>expsection:hover <?php echo '.',$prefix?>explabel, <?php echo '.',$prefix?>expsection.active <?php echo '.',$prefix?>explabel {
	border-right: 1px solid #7ad03a;
}
<?php echo '.',$prefix?>explabel:hover {
	cursor: pointer;
}
<?php echo '.',$prefix?>explabel img {
    width: 100%;
    height: auto;
	margin-bottom: 2px;
}

</style>