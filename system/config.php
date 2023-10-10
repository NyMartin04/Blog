<?php

use Model\dbConnection;
use View\Html;

dbConnection::connectToDatabase('J_C_S__BLOG', 'AadminHOST', sha1('mdhashgenerated'));

Html::setDesc('Just Cars Site - Best Cars Only Website!');
Html::setImg('http://randomurl/image.webp'); // majd a favicon.ico urlje BE-n

Html::addStyle('src/style.css');
Html::addStyle('src/resp.css');
Html::addScript('src/jquery.js');
Html::addScript('src/script.js', true);


