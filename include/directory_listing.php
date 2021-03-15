<?php

// get the file list for the current directory
$files = scandir('.');

// files to exclude from the files array.
$exclude = array('.', '..', '.DS_Store', 'index.php', '.git');

// search files array and remove anything in the exclude array
foreach ($exclude as $ex) {
    if (($key = array_search($ex, $files)) !== false) {
        unset($files[$key]);
    }
}

// display a title on the top of the listing
print '<h1>' . $_SERVER['REQUEST_URI'] . '</h1>';

// if the array of files isn't empty
if (!empty($files)) {
    // open unordered list tag
    print '<ul>';

    // loop through directories
    foreach ($files as $file) {
        if (is_dir($file)) {
            // show the directory
            print '<a href="./' . $file . '"><li>' . $file . '/</li></a>';
        }
    }
    // loop through files
    foreach ($files as $file) {
        if (!is_dir($file)) {
            // show the file
            print '<a href="./' . $file . '"><li>' . $file . '</li></a>';
        }
    }

    // close unordered list tag
    print '</ul>';
}
else {
    // display empty directory message
    print '<p>This folder contains no files.</p>';
}
