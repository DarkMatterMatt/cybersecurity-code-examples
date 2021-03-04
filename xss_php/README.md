# Cross Site Scripting (XSS)

## Overview

Modified from [owasp.org/www-community/attacks/xss/](https://owasp.org/www-community/attacks/xss/)

Cross-Site Scripting (XSS) attacks are a type of injection, in which malicious scripts are injected into otherwise benign and trusted websites. XSS attacks occur when an attacker uses a web application to send malicious code, generally in the form of a browser side script, to a user. Flaws that allow these attacks to succeed are quite widespread and occur anywhere a web application uses input from a user within the output it generates without validating or encoding it.

## Scripts

[bad.php](./bad.php), simply echoes the user's name to the HTML.

[bad-fix.php](./bad-fix.php), attempts to escape (convert special characters in) the user's name, but does so inadequately.

[good.php](./good.php), correctly uses PHP's `htmlspecialchars` to escape HTML control characters so that the name cannot inject HTML or JavaScript.
