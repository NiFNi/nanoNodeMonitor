# Nano Node Monitor

Nano Node Monitor is a server-side PHP/Bash/Python-based monitor for a Nano node. It connects to a running node via RPC and displays it's status on a simple webpage. Being server-side, it does not expose the RPC interface of the Nano node to the public. 

Here is what it looks like on a desktop computer (this fork looks about the same)...

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

..and setting your intended values for each setting.

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
If your node is not reachable at localhost:7076 you need to change each script.



## Updating
Switch to your installation directory and execute `git pull`.



