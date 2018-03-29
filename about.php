<?php
// include required files
require_once __DIR__ . '/modules/includes.php';

include 'modules/header.php';
?>


    <h2>The Website</h2>
    <p>
        This website is a fork of this repository: <a href="https://github.com/nanotools/nanoNodeMonitor">original</a>.
        The fork can be found here: <a href="https://github.com/nifni/nanoNodeMonitor">fork</a>. I forked
        away because I wanted this frontend to be more simplistic than it was. For example I removed all Javascript
        libraries to make the side load faster and consume less traffic (espiacilly on mobile).
    </p>

    <h2>About Me</h2>

    <p>
        To choose a representative you trust I think it is most important that you trust the person who is running the
        node. Because of that I want to give you some personal information about me.
    </p>
    <p>
        My name is Nico Fricke and I am currently living in Bremen/Germany. I am into Nano since early December 2017.
        In the Nano Discord I am mainly around in the #support channel where you might have seen me. I am 21 years
        old and right now I study computer science at the University of Bremen. The plan is to be finished with that
        in the summer this year.
        You can find me on <a href="https://reddit.com/u/nifni">Reddit</a>,
        <a href="https://twitter.com/nifninif">Twitter</a>,
        <a href="http://steamcommunity.com/profiles/76561198035378497/">Steam</a>,
        <a href="https://t.me/@NiFNi">Telegram</a>, Matrix (@nif:nifni.net) and Discord (NiF#3422).
    </p>

    <h2>Why do I run this node?</h2>
    <p>
        I like hosting stuff. It is fun for me to setup something like this and keep it running as stable as possible.
        Also I like Nano. The tech behind it is so simple but also so awesome
        (check <a href="https://nano.org">nano.org</a> for more information on the tech).
        One problem that still exists is that there are only a small number of representatives which have most of
        the voting power. To change this I setup this node. And to make it easier for people to trust me with their
        voting power I give as much transparency as possible. So if you have any question remaining unanswered don't
        hesitate to contact me on any of the accounts mentioned in the about me section.
    </p>

    <h2>How do I keep sure the node is running 24/7?</h2>
    <p>
        This node is hosted on a root-server by <a href="https://netcup.de">Netcup</a>. Netcup is a german hosting
        provider with which I never had any problems. Downtimes outside of scheduled security patches never happened.
        The scheduled downtimes were always communicated accordingly and took only some minutes until everything
        was up again.
        The underlying OS is a headless Ubuntu 16.04 which has been stable for me on many different servers and VMs.
        The hardware specification of this server is 2 dedicated CPU cores, 6GB RAM and a 40 GB SSD.
    </p>
    <p>
        There are checks running which will notify me the moment the node goes offline or is not reachable for
        any reason. I will always keep the node software updated as soon as there is a new release in place.
    </p>

    <h2>How can you support me?</h2>
    <p>
        If you want to support me you can either donate me some Nano to the address at the bottom or scan this qr code:
    </p>
    <img src="static/img/qr.png">
    <!--- add the footer -->
<?php include 'modules/footer.php'; ?>