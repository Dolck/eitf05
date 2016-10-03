# Configuration changes

## httpd.conf

* no directory indexing
* disable some unused modules
* enable vhost 

## httpd-vhosts.conf

* Rewrite all request to https

## httpd-ssl.conf

* SSLrandom seed
* strong SSL cipher suite

## php.ini

* display_errors -> off
* display_startup_errors -> off
* track_errors -> off
* html_errors -> off
* file_uploads -> off (don't need this)
* allow_url_fopen -> off (don't need this) 
* disable smtp
* session.bug_compat_42 -> off
* session.bug_compat_warn -> off
* session.hash_function -> sha256
