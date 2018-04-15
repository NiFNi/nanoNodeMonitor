# Nano Node Monitor

Nano Node Monitor is a server-side PHP/Bash/Python-based monitor for a Nano node. It connects to a running node via RPC and displays it's status on a simple webpage. Being server-side, it does not expose the RPC interface of the Nano node to the public. 

The biggest changes with this fork are that the data is not directly requested from the Node RPC for each request. The RPC will be contacted by Bash/Python scripts which save the data to files in the data directory. These files will then be processed by PHP to display them on the website. That way the node cannot be that easily DoSed by just accessing the website many times. 
I also removed data from the front page which do not seem relevant and added an about page which can be changed to your needs.
Last but not least I removed all JS libraries but bootstrap and JQuery to make the monitor more slim.


Here is what it looks like on a desktop computer (this fork looks a bit different [example](https://nano.nifni.net))...

![Desktop screenshot](https://i.imgur.com/1k5BCfc.png)


... and on a mobile device: 

![Mobile screenshot](https://i.imgur.com/PTSwL69.jpg)


## Prerequisites

- A running Nano Node with rpc enabled. For more information on this check the Nano repository wiki or drop by in the Nano Discord.
- A running webserver with php7 support.
- PHP-Curl Module, python3, jq

    `sudo apt-get install php7-curl python3 jq`

## Installation

In your empty webserver directory, e.g. `/var/www/html`, execute:

    git clone https://github.com/nifni/nanoNodeMonitor .

 
If you want it to run a subdirectory remove the `.` at the end.

In the `modules` folder, create your own config file by executing:


    cp config.sample.php config.php

..and set your intended values for each setting.

In the `scripts` folder create your config for the scripts:

    cp config.sample.json config.json
.. and set your values again.

Setup cronjobs for each script in the scripts folder of this repository:

`crontab -e`

Add this but be sure to change the path to the script if it is something else:
```
*/10 * * * * sh /var/www/nano/scripts/ldbsize.sh
* * * * * sh /var/www/nano/scripts/ninjablockcount.sh
*/5 * * * * sh /var/www/nano/scripts/votingweight.sh
* * * * * sh /var/www/nano/scripts/blockcount.sh
*/5 * * * * sh /var/www/nano/scripts/blocktypes.sh
*/30 * * * * python3 /var/www/nano/scripts/networkversions.py
*/5 * * * * sh /var/www/nano/scripts/peers.sh
@hourly sh /var/www/nano/scripts/delegcount.sh
```
You can change the timings when the scripts will be executed.

You now need to create the data directory in the cloned repository. This will be the place where the scripts will store the values. For that just go to the installation directory and:

    mkdir data

Last you need to create the about.php:
    
    cp about.sample.php about.php
Now change the about.php to your needs (if you don't know vim change `vim` to `nano` in this command):

    vim about.php

If anything did not work out as described message me or create an issue.


## Updating
Switch to your installation directory and execute `git pull`.



