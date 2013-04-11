# Mite for Status Board

I wanted to show some time tracking reports from [Mite](http://mite.yo.lk/en/) on the iPad app [Status Board](http://panic.com/statusboard/) from Panic.

![status board](http://groenewege.com/files/mite_statusboard.jpg)

My status board shows the number of hours spend on each project by week for the current month OR by day for the current week.

You can find the PHP program necessary for these charts on this [github page](https://github.com/groenewege/Mitey/tree/statusboard).

Install the program on a PHP 5.3 server, add a graph to your Status Board and add the correct link, with the necessary parameters to this graph.

    /* by week for the last month */
    http://yourdomain.com/index.php?api_endpoint=https://username.mite.yo.lk/&api_key=xxxxxxxxxxxxxxx

    /* by day for the current week */
    http://yourdomain.com/index.php?api_endpoint=https://username.mite.yo.lk/&api_key=xxxxxxxxxxxxxxx&group_by=day


## Thanks to

* [Stefan hubeRsen](https://github.com/hubeRsen/Mitey)
* [Yolk](http://mite.yo.lk/en/)
* [Panic](http://panic.com/statusboard/)