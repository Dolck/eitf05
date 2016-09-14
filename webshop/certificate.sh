# https://www.digitalocean.com/community/tutorials/how-to-create-a-self-signed-ssl-certificate-for-apache-in-ubuntu-16-04

echo '#### 0. Clear old files'
rm ./cert/*

echo '#### 1. Generate cert'
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ./cert/apache-selfsigned.key -out ./cert/apache-selfsigned.crt -subj "/C=SE/ST=Skane/L=Lund/O=IT/CN=localhost"

echo '#### 2. Create SUPER STRONG Diffie-Hellman group'
openssl dhparam -out ./cert/dhparam.pem 2048
