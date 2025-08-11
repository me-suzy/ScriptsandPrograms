<?php
//Random Quotes by www.liquidfrog.com. Free scripts for webmasters
$random_quote_file = "randomquotes/thequotes.txt";
srand((double)microtime()*1000000);
if (file_exists($random_quote_file)) {
        $quotearray = preg_split("/<<BREAK>>/", join('', file($random_quote_file)));
        echo $quotearray[rand(0, sizeof($quotearray) -1)];
        } else {
        echo "This is the quote script by www.liquidfrog.com - I can't find the file called thequotes.txt <br>which I need to operate correctly. Please check the server to make sure the file is there.";
}

?>