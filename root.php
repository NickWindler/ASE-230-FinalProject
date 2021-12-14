<?php
if($_SERVER['SERVER_NAME']=='windler-ase-230-heroku.herokuapp.com') define('ROOT',$_SERVER['DOCUMENT_ROOT']);
else define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/Repo');